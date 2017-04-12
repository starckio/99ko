<?php
/*
 * 99ko CMS (since 2010)
 * http://99ko.org
 *
 * Creator / Developper :
 * helloJo (contact@99ko.org / j.coulet@gmail.com)
 * 
 * Contributors :
 * Frédéric Kaplon (frederic.kaplon@me.com)
 * Florent Fortat (florent.fortat@maxgun.fr)
 *
 */

defined('ROOT') OR exit('No direct script access allowed');

class core{
    private static $instance = null;
    private $config;
    private $hooks;
    private $urlParams;
    private $themes;
    private $pluginToCall;
    private $js;
    private $css;
    
    ## Constructeur
    public function __construct(){
        // Timezone
        date_default_timezone_set(date_default_timezone_get());
        // Configuration
        $this->config = util::readJsonFile(DATA.'config.json', true);
        // Error reporting
        if($this->config['debug']) error_reporting(E_ALL);
        else error_reporting(E_ERROR | E_PARSE);
        // Tableau des paramètres d'URL
        if($this->getConfigVal('urlRewriting') == 1){
            if(isset($_GET['param'])) $this->urlParams = explode($this->getConfigVal('urlSeparator'), $_GET['param']);
        }
        else{
            foreach($_GET as $k=>$v) if($k != 'p'){
                $this->urlParams[] = $v;
            }
        }
        // Liste des thèmes
        $temp = util::scanDir(THEMES);
        foreach($temp['dir'] as $k=>$v){
            $this->themes[$v] = util::readJsonFile(THEMES.$v.'/infos.json', true);
        }
        // Quel est le plugin solicité ?
        if(ROOT == './') $this->pluginToCall = isset($_GET['p']) ? $_GET['p'] : $this->getConfigVal('defaultPlugin');
        else $this->pluginToCall = isset($_GET['p']) ? $_GET['p'] : $this->getConfigVal('defaultAdminPlugin');
        // Ressources
        $this->css[] = 'https://cdnjs.cloudflare.com/ajax/libs/normalize/6.0.0/normalize.min.css';
        $this->js[] = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js';
    }
    
    ## Retourne l'instance core
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new core();
        }
        return self::$instance;
    }
    
    ## Retourne le paramètre d'URL ciblé
    public function getUrlParam($k){
        if(isset($this->urlParams[$k])) return $this->urlParams[$k];
        else return false;
    }
    
    ## Retourne la liste des thèmes
    public function getThemes(){
        return $this->themes;
    }
    
    ## Retourne une valeur de configuration
    public function getConfigVal($k){
        if(isset($this->config[$k])) return $this->config[$k];
        else return false;
    }
    
    ## Retourne l'information ciblée d'un thème
    public function getThemeInfo($k){
        if(isset($this->themes[$this->getConfigVal('theme')])) return $this->themes[$this->getConfigVal('theme')][$k];
        else return false;
    }
    
    ## Retourne l'identifiant du plugin solicité
    public function getPluginToCall(){
        return $this->pluginToCall;
    }
    
    public function getJs(){
        return $this->js;
    }
    
    public function getCss(){
        return $this->css;
    }
    
        ## Détermine si 99ko est installé
    public function isInstalled(){
        if(!file_exists(DATA.'config.json')) return false;
        else return true;
    }
    
    ## Génère l'URL du site
    public function makeSiteUrl(){
        $siteUrl = str_replace(array('install.php', '/admin/index.php'), array('', ''), $_SERVER['SCRIPT_NAME']);
        $isSecure = false;
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') $isSecure = true;
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') $isSecure = true;
        $REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';
        $siteUrl = $REQUEST_PROTOCOL.'://'.$_SERVER['HTTP_HOST'].$siteUrl;
        $pos = mb_strlen($siteUrl)-1;
        if($siteUrl[$pos] == '/') $siteUrl = substr($siteUrl, 0, -1);
        return $siteUrl;
    }
    
    ## Génère une URL réécrite ou retourne l'URL standard
    public function makeUrl($plugin, $params = array()){
        if($this->getConfigVal('urlRewriting') == 1){
            $url = $plugin.'/';
            if(count($params) > 0){
                foreach($params as $k=>$v) $url.= util::strToUrl($v).$this->getConfigVal('urlSeparator');
                $url = trim($url, $this->getConfigVal('urlSeparator'));
                $url.= '.html';
            }
        }
        else{
            $url = 'index.php?p='.$plugin;
            foreach($params as $k=>$v){
                $url.= '&amp;'.$k.'='.util::strToUrl($v);
            }
        }
        return $url;
    }
    
    ## Ajoute un hook à executter
    public function addHook($name, $function){
        $this->hooks[$name][] = $function;
    }
    
    ## Appel un hook
    public function callHook($name){
        $return = '';
        if(isset($this->hooks[$name])){
            foreach($this->hooks[$name] as $function){
                $return.= call_user_func($function);
            }
        }
        return $return;
    }
    
    ## Detecte le mode de l'administration
    public function detectAdminMode(){
        $mode = '';
        if(isset($_GET['action']) && $_GET['action'] == 'login') return 'login';
        elseif(isset($_GET['action']) && $_GET['action'] == 'logout') return 'logout';
        elseif(!isset($_GET['p'])) return 'plugin';
        elseif(isset($_GET['p'])) return 'plugin';
    }
    
    ## Renvoi une erreur 404
    public function error404(){
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            include_once(THEMES.$this->getConfigVal('theme').'/404.php');	
            die();
    }
    
    ## Sauvegarde le tableau de configuration
    public function saveConfig($val, $append = array()){
        $config = util::readJsonFile(DATA.'config.json', true);
        $config = array_merge($config, $append);
        foreach($config as $k=>$v) if(isset($val[$k])){
            $config[$k] = $val[$k];
        }
        if(util::writeJsonFile(DATA.'config.json', $config)){
            $this->config = util::readJsonFile(DATA.'config.json', true);
            return true;
        }
        else return false;
    }
    
    ## Installation de 99ko
    public function install(){
        $install = true;
        @chmod(ROOT.'.htaccess', 0666);
        if(!file_exists(ROOT.'.htaccess')){
            if(!@file_put_contents(ROOT.'.htaccess', "Options -Indexes", 0666)) $install = false;
        }
        if(!is_dir(DATA) && (!@mkdir(DATA) || !@chmod(DATA, 0777))) $install = false;
        if($install){
            if(!file_exists(DATA. '.htaccess')){
                if(!@file_put_contents(DATA. '.htaccess', "deny from all", 0666)) $install = false;
            }
            if(!is_dir(DATA_PLUGIN) && (!@mkdir(DATA_PLUGIN) || !@chmod(DATA_PLUGIN, 0777))) $install = false;
            if(!is_dir(UPLOAD) && (!@mkdir(UPLOAD) || !@chmod(UPLOAD, 0777))) $install = false;
            if(!file_exists(UPLOAD. '.htaccess')){
                if(!@file_put_contents(UPLOAD. '.htaccess', "allow from all", 0666)) $install = false;
            }
            if(!file_exists(__FILE__) || !@chmod(__FILE__, 0666)) $install = false;
            $key = uniqid(true);
            if(!file_exists(DATA. 'key.php') && !@file_put_contents(DATA. 'key.php', "<?php define('KEY', '$key'); ?>", 0666)) $install = false;
        }
        return $install;
    }
    
    public function getHtaccess(){
        return htmlspecialchars(@file_get_contents(ROOT.'.htaccess'), ENT_QUOTES, 'UTF-8');
    }
    
    public function saveHtaccess($content){
        @file_put_contents(ROOT.'.htaccess', str_replace('¶m', '&param', $content));
    }
}
?>
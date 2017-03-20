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

define('VERSION', '4.0');
define('CHECK_URL', 'http://99ko.org/version');
define('COMMON',  ROOT.'common/');
define('LANG', COMMON.'lang/');
define('DATA', ROOT.'data/');
define('UPLOAD', ROOT.'data/upload/');
define('DATA_PLUGIN', ROOT.'data/plugin/');
define('THEMES', ROOT.'theme/');
define('PLUGINS', ROOT.'plugin/');
define('ADMIN_PATH', ROOT.'admin/');
define('COMMON_CSS', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css');
define('COMMON_JS', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js');
if(file_exists(DATA.'key.php')) include(DATA.'key.php');
?>
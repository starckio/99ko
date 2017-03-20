<?php
if(!defined('ROOT')) die();
$action = (isset($_GET['action'])) ? urldecode($_GET['action']) : '';
switch($action){
    case 'save':
        $runPlugin->setConfigVal('content1', $_POST['content1']);
        $runPlugin->setConfigVal('content2', $_POST['content2']);
        $runPlugin->setConfigVal('label', trim($_POST['label']));
        $runPlugin->setConfigVal('copy', trim($_POST['copy']));
        $pluginsManager->savePluginConfig($runPlugin);
        header('location:index.php?p=contact');
        die();
        break;
    default:
}
?>
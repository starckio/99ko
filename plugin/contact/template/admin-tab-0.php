<?php defined('ROOT') OR exit('No direct script access allowed'); ?>

<p class="alert-box">
    <?php
    echo $core->lang("The address for receiving emails is ").' : '.$core->getConfigVal('adminEmail');
    if($runPlugin->getConfigVal('copy') != ''){ echo ' / '.$runPlugin->getConfigVal('copy'); }
    ?>
</p>
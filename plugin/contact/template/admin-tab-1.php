<?php defined('ROOT') OR exit('No direct script access allowed'); ?>

<form method="post" action="index.php?p=contact&action=save">
  <?php show::adminTokenField(); ?>
  
  <p>
      <label><?php echo $core->lang("Copy recipient"); ?></label><br>
      <input type="text" name="copy" value="<?php echo $runPlugin->getConfigVal('copy'); ?>" />
    </p>
  
  <p>
      <label><?php echo $core->lang("Label (meta title and page title)"); ?></label><br>
      <input type="text" name="label" value="<?php echo $runPlugin->getConfigVal('label'); ?>" required />
    </p>
  
  <p>
      <label><?php echo $core->lang("Insert contents before the form"); ?></label><br>
      <?php show::adminEditor('content1', $runPlugin->getConfigVal('content1')); ?>
    </p>
  
  <p>
      <label><?php echo $core->lang("Insert contents after the form"); ?></label><br>
      <?php show::adminEditor('content2', $runPlugin->getConfigVal('content2'), 'editor2', 'editor'); ?>
    </p>
	
  <p><button type="submit" class="button"><?php echo $core->lang("Save"); ?></button></p>
</form>
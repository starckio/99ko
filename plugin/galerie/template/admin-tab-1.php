<form method="post" action="index.php?p=galerie&action=saveconf">
  <?php show::adminTokenField(); ?>
  
  <p>
      <input <?php if($runPlugin->getConfigVal('showTitles')){ ?>checked<?php } ?> type="checkbox" name="showTitles" /> <?php echo $core->lang("Show titles thumbnails"); ?> 
    </p>
  
  <p>
      <label><?php echo $core->lang("Label (meta title and page title)"); ?></label><br>
      <input type="text" name="label" value="<?php echo $runPlugin->getConfigVal('label'); ?>" />
    </p>
    <p>
      <label><?php echo $core->lang("Order"); ?></label><br>
      <select name="order">
        <option <?php if($runPlugin->getConfigVal('order') == 'natural'){ ?>selected<?php } ?> value="natural"><?php echo $core->lang("by order of addition"); ?></option>
        <option <?php if($runPlugin->getConfigVal('order') == 'byName'){ ?>selected<?php } ?> value="byName"><?php echo $core->lang("by name"); ?></option>
        <option <?php if($runPlugin->getConfigVal('order') == 'byDate'){ ?>selected<?php } ?> value="byDate"><?php echo $core->lang("by date"); ?></option>
      </select>
    </p>
  
  <p>
      <label><?php echo $core->lang("Introduction"); ?></label><br>
      <?php show::adminEditor('introduction', $runPlugin->getConfigVal('introduction')); ?>
    </p>
  
  <p><button type="submit" class="button"><?php echo $core->lang("Save"); ?></button></p>
</form>
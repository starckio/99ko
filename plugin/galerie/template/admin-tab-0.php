<?php if($mode == 'list'){ ?>
<p><a class="button" href="index.php?p=galerie&action=edit"><?php echo $core->lang("Add"); ?></a></p>
<table>
  <tr>
    <th></th>
    <th><?php echo $core->lang('Title'); ?></th>
    <th><?php echo $core->lang('Category'); ?></th>
    <th><?php echo $core->lang('Action'); ?></th>
  </tr>
  <?php foreach($galerie->getItems() as $k=>$v){ ?>
    <tr>
      <td><img width="128" src="<?php echo UPLOAD.'galerie/'.$v->getImg().'" alt="'.$v->getImg(); ?>" /></td>
      <td><?php echo $v->getTitle() ?></td>
      <td><?php echo $v->getCategory(); ?></td>
      <td>
        <a href="index.php?p=galerie&action=edit&id=<?php echo $v->getId(); ?>" class="tiny button success"><?php echo $core->lang("Edit"); ?></a>
        <a href="index.php?p=galerie&action=del&id=<?php echo $v->getId().'&token='.$administrator->getToken(); ?>" onclick = "if(!confirm('<?php echo $core->lang("Delete this item ?"); ?>')) return false;" class="tiny button alert"><?php echo $core->lang("Delete"); ?></a>
      </td>
    </tr>
  <?php } ?>
</table>
<?php } ?>

<?php if($mode == 'edit'){ ?>
<form method="post" action="index.php?p=galerie&action=save" enctype="multipart/form-data">
  <?php show::adminTokenField(); ?>
  <input type="hidden" name="id" value="<?php echo $item->getId(); ?>" />
  
  <p>
      <label>
        <?php echo $core->lang("Category"); ?>
        <?php foreach($galerie->listCategories() as $k=>$v){ ?>
        &nbsp;&nbsp;&#8594; <a class="category" href="javascript:"><?php echo $v; ?></a>
        <?php } ?>
        </label><br>
      <input type="text" name="category" id="category" value="<?php echo $item->getCategory(); ?>" />
    </p>
  <p>
      <label><?php echo $core->lang("Title"); ?></label><br>
      <input type="text" name="title" value="<?php echo $item->getTitle(); ?>" required="required" />
    </p>
    <p>
      <label><?php echo $core->lang("Date"); ?></label><br>
      <input type="date" name="date" value="<?php echo $item->getDate(); ?>" /> 
    </p>
  
  <p>
      <label><?php echo $core->lang("Content"); ?></label><br>
      <textarea name="content"><?php echo $item->getContent(); ?></textarea>
    </p>
    <p>
      <label><?php echo $core->lang("File (jpg)"); ?></label><br>
      <input type="file" name="file" <?php if($item->getImg() == ''){ ?>required="required"<?php } ?> />
      <br>
      <?php if($item->getImg() != ''){ ?><img src="<?php echo UPLOAD; ?>galerie/<?php echo $item->getImg(); ?>" alt="<?php echo $item->getImg(); ?>" /><?php } ?>
    </p>
  
  <p><button type="submit" class="button"><?php echo $core->lang("Save"); ?></button></p>
</form>
<?php } ?>
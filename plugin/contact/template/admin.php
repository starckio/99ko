<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'admin/header.php');
?>
<form method="post" action="index.php?p=contact&action=save">

<?php show::adminTokenField(); ?>

	<div class="field">
		<label for="content1">Contenu avant le formulaire</label>
		<textarea class="editor" name="content1"><?php echo $runPlugin->getConfigVal('content1'); ?></textarea>
	</div>

	<div class="field">
		<label for="content2">Contenu après le formulaire</label>
		<textarea class="editor" name="content2"><?php echo $runPlugin->getConfigVal('content2'); ?></textarea>
	</div>

	<button class="btn" type="submit" name="submit">Enregistrer</button>

</form>

<?php include_once(ROOT.'admin/footer.php'); ?>
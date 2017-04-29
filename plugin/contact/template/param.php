<?php defined('ROOT') OR exit('No direct script access allowed'); ?>

<form method="post" action="index.php?p=contact&action=save&fromparam=1">

<?php show::adminTokenField(); ?>

	<div class="field">
		<label for="copy">Destinataire en copie</label>
		<input type="text" name="copy" value="<?php echo $runPlugin->getConfigVal('copy'); ?>" />
	</div>

	<div class="field">
		<label for="label">Titre de page</label>
		<input type="text" name="label" value="<?php echo $runPlugin->getConfigVal('label'); ?>" required />
	</div>

	<button class="btn" type="submit" name="submit">Enregistrer</button>

</form>
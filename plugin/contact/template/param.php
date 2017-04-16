<?php defined('ROOT') OR exit('No direct script access allowed'); ?>

<form method="post" action="index.php?p=contact&action=save&fromparam=1">
    <?php show::adminTokenField(); ?>
    <p>
        <label>Destinataire en copie</label><br>
        <input type="text" name="copy" value="<?php echo $runPlugin->getConfigVal('copy'); ?>" />
    </p>
    <p>
        <label>Titre de page</label><br>
        <input type="text" name="label" value="<?php echo $runPlugin->getConfigVal('label'); ?>" required />
    </p>
    <p><button type="submit" class="button">Enregistrer</button></p>
</form>
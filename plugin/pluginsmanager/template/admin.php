<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'admin/header.php');
?>

<form method="post" action="index.php?p=pluginsmanager&action=save" id="pluginsmanagerForm">
<?php show::adminTokenField(); ?>

<?php foreach($pluginsManager->getPlugins() as $plugin){ ?>

	<div class="item cf">

		<?php if(!$plugin->isRequired()){ ?>
		<div class="item-activate">
			<div class="field">
				<label for="activate[<?php echo $plugin->getName(); ?>]">Activer</label>
				<input onchange="document.getElementById('pluginsmanagerForm').submit();" id="activate[<?php echo $plugin->getName(); ?>]" type="checkbox" name="activate[<?php echo $plugin->getName(); ?>]" <?php if($plugin->getConfigVal('activate')){ ?>checked<?php } ?> />
			</div>
		</div>
		<?php } else { ?>
		<input style="display:none;" id="activate[<?php echo $plugin->getName(); ?>]" type="checkbox" name="activate[<?php echo $plugin->getName(); ?>]" checked />
		<?php } ?>

		<div class="item-info">
			<a href="<?php echo $plugin->getInfoVal('authorWebsite'); ?>" target="_blank">
				<h3><?php echo $plugin->getInfoVal('name'); ?>&nbsp;&nbsp;&nbsp;(<?php echo $plugin->getInfoVal('version'); ?>)</h3>
			</a>
			<?php if($plugin->getConfigVal('activate') && !$plugin->isInstalled()){ ?>&nbsp;&nbsp;<a class="button" href="index.php?p=pluginsmanager&action=maintenance&plugin=<?php echo $plugin->getName(); ?>&token=<?php echo administrator::getToken(); ?>">Maintenance requise</a><?php } ?>
			<div class="item-description">
				<?php echo $plugin->getInfoVal('description'); ?>
			</div>
		</div>

		<div class="item-priority">
			<div class="field">
				<label>Priorité</label>
				<div>
					<span class="drop-down"></span>
					<select name="priority[<?php echo $plugin->getName(); ?>]" onchange="document.getElementById('pluginsmanagerForm').submit();">
						<?php foreach($priority as $k=>$v){ ?>
						<option <?php if($plugin->getconfigVal('priority') == $v){ ?>selected<?php } ?> value="<?php echo $v; ?>"><?php echo $v; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>

	</div>

<?php } ?>

</form>

<?php include_once(ROOT.'admin/footer.php'); ?>
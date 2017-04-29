<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'admin/header.php');
?>
<form id="configForm" method="post" action="index.php?p=configmanager&action=save" autocomplete="off">
	<?php show::adminTokenField(); ?>
	<h3>Paramètres du site</h3>

	<div class="field">
		<label for="hideTitles">Masquer le titre des pages</label>
		<input <?php if($core->getConfigVal('hideTitles')){ ?>checked<?php } ?> type="checkbox" name="hideTitles" id="hideTitles" />
	</div>

	<div class="field">
		<label>Plugin par défaut (public)</label>
		<div>
			<span class="drop-down"></span>
			<select name="defaultPlugin">
			<?php foreach($pluginsManager->getPlugins() as $plugin) if($plugin->getAdminFile() && $plugin->getConfigVal('activate') && $plugin->getPublicFile()){ ?>
				<option <?php if($plugin->getIsDefaultPlugin()){ ?>selected<?php } ?> value="<?php echo $plugin->getName(); ?>"><?php echo $plugin->getInfoVal('name'); ?></option>
			<?php } ?>
			</select>
		</div>
	</div>

	<div class="field">
		<label>Plugin par défaut (admin)</label>
		<div>
			<span class="drop-down"></span>
			<select name="defaultAdminPlugin">
			<?php foreach($pluginsManager->getPlugins() as $k=>$v) if($v->getConfigVal('activate') && $v->getAdminFile()){ ?>
				<option <?php if($v->getName() == $v->getIsDefaultAdminPlugin()){ ?>selected<?php } ?> value="<?php echo $v->getName(); ?>"><?php echo $v->getInfoVal('name'); ?></option>
			<?php } ?>
			</select>
		</div>
	</div>	<div class="field">
		<label for="siteName">Nom du site</label>
		<input type="text" name="siteName" id="siteName" value="<?php echo $core->getConfigVal('siteName'); ?>" required />
	</div>

	<div class="field">
		<label>Thème</label>
		<div>
			<span class="drop-down"></span>
			<select name="theme">
			<?php foreach($core->getThemes() as $k=>$v){ ?>
				<option <?php if($k == $core->getConfigVal('theme')){ ?>checked<?php } ?> value="<?php echo $k; ?>"><?php echo $v['name']; ?> (<?php echo $v['version']; ?>)</option>
			<?php } ?>
			</select>
		</div>
	</div>

	<hr />

	<h3>Administrateur</h3>

	<div class="field">
		<label for="adminEmail">Email admin</label>
		<input type="email" name="adminEmail" id="adminEmail" value="<?php echo $core->getConfigVal('adminEmail'); ?>" />
	</div>

	<div class="field">
		<label for="_adminPwd">Mot de passe admin</label>
		<input type="password" name="adminPwd" value="" autocomplete="off" style="display: none;" />
		<input type="password" name="_adminPwd" value="" autocomplete="off" placeholder="••••••••" />
	</div>

	<div class="field">
		<label for="_adminPwd2">Confirmation</label>
		<input type="password" name="_adminPwd2" value="" autocomplete="off" placeholder="••••••••" />
	</div>
    <hr />

	<h3>Configuration avançés</h3>

	<div class="field">
		<label for="debug">Mode débogage</label>
		<input <?php if($core->getConfigVal('debug')){ ?>checked<?php } ?> type="checkbox" name="debug" id="debug" />
	</div>

	<div class="field">
		<label for="urlRewriting">Réécriture d'URL</label>
		<input type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($core->getConfigVal('urlRewriting')){ ?>checked<?php } ?> name="urlRewriting" id="urlRewriting" />
	</div>

	<div class="field">
		<label for="htaccessOptimization">Optimisations .htaccess</label>
		<input type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($core->getConfigVal('htaccessOptimization')){ ?>checked<?php } ?> name="htaccessOptimization" id="htaccessOptimization" />
	</div>

	<div class="field">
		<label for="siteUrl">URL du site (sans slash final)</label>
		<input type="text" name="siteUrl" id="siteUrl" value="<?php echo $core->getConfigVal('siteUrl'); ?>" />
	</div>

	<div class="field">
		<label for="urlSeparator">Séparateur d'URL</label>
		<div>
			<span class="drop-down"></span>
			<select name="urlSeparator">
				<option <?php if($core->getConfigVal('urlSeparator') == ','){ ?>selected<?php } ?> value=",">virgule</option>
				<option <?php if($core->getConfigVal('urlSeparator') == '.'){ ?>selected<?php } ?> value=".">point</option>
				<option <?php if($core->getConfigVal('urlSeparator') == '/'){ ?>selected<?php } ?> value="/">slash</option>
			</select>
		</div>
	</div>

	<div class="field">
		<label for="htaccess">.htaccess</label>
		<textarea name="htaccess" id="htaccess"><?php echo $core->getHtaccess(); ?></textarea>
	</div>

	<button class="btn" type="submit" name="submit">Enregistrer</button>

</form>
<?php include_once(ROOT.'admin/footer.php'); ?>
<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
<form id="configForm" method="post" action="index.php?p=configmanager&action=save" autocomplete="off">
	<?php show::adminTokenField(); ?>
	<h3>Configuration avançés</h3>

	<div class="field">
		<input <?php if($core->getConfigVal('debug')){ ?>checked<?php } ?> type="checkbox" name="debug" id="debug" />
		<label for="debug">Mode débogage</label>
	</div>

	<div class="field">
		<input type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($core->getConfigVal('urlRewriting')){ ?>checked<?php } ?> name="urlRewriting" id="urlRewriting" />
		<label for="urlRewriting">Réécriture d'URL</label>
	</div>

	<div class="field">
		<input type="checkbox" onclick="updateHtaccess('<?php echo $rewriteBase; ?>');" <?php if($core->getConfigVal('htaccessOptimization')){ ?>checked<?php } ?> name="htaccessOptimization" id="htaccessOptimization" />
		<label for="htaccessOptimization">Optimisations .htaccess</label>
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
<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="fr">
  <head>
	<?php eval($core->callHook('adminHead')); ?>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>99ko - Connexion</title>	
	<?php show::linkTags(); ?>
	<link rel="stylesheet" href="styles.css" media="all">
	<?php show::scriptTags(); ?>
	<script type="text/javascript" src="scripts.js"></script>
	<?php eval($core->callHook('endAdminHead')); ?>	
  </head>
  <body class="login">
  <div id="login">
	<?php show::msg($msg, 'error'); ?>
	<h1>Connexion</h1>
	<form method="post" action="index.php?action=login">   
	  <?php show::adminTokenField(); ?>          
	  <p><label for="adminEmail">Email</label><br>
	  <input type="email" id="adminEmail" name="adminEmail" required></p>
	  <p><label for="adminPwd">Mot de passe</label>
	  <input type="password" id="adminPwd" name="adminPwd" required></p>
	  <p>
		<input type="button" class="button alert" value="Quitter" rel="<?php echo $core->getConfigVal('siteUrl'); ?>" />
		<input type="submit" class="button" value="Valider" />
		</p>
	  <p class="just_using"><a target="_blank" href="http://99ko.org">Just using 99ko</a>
	  </p>
	</form>
  </div>
  <?php eval($core->callHook('endAdminBody')); ?>
  </body>
</html>
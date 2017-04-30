<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<?php $core->callHook('adminHead'); ?>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<title>99ko - Connexion</title>

	<?php show::linkTags(); ?>
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="login.css">
	<?php show::scriptTags(); ?>
	<script type="text/javascript" src="scripts.js"></script>

	<?php $core->callHook('endAdminHead'); ?>

</head>
<body>

<main class="main" role="main">

	<?php show::msg($msg); ?>
	<h1>Connexion</h1>

	<div class="text">
		<form method="post" action="index.php?action=login">
			<?php show::adminTokenField(); ?>
			<div class="field">
				<label for="adminEmail">Email</label>
				<input type="email" name="adminEmail" id="adminEmail" required />
			</div>
			<div class="field">
				<label for="adminPwd">Mot de passe</label>
				<input type="password" name="adminPwd" id="adminPwd" required />
			</div>
			<button class="btn" type="submit" name="submit">Valider</button>
		</form>
	</div>

</main>

<footer class="footer cf" role="contentinfo">
	<div class="copyright">
		Designed by <a href="http://www.starck.io"><b>Starckio</b></a>
	</div>
	<div class="colophon">
		<a href="http://99ko.org">Just using 99ko <b><?php echo VERSION; ?></b></a>
	</div>
</footer>

<?php eval($core->callHook('endAdminBody')); ?>
</body>
</html>
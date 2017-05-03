<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/header.php');
?>

<div class="top-contact">
	<?php echo $runPlugin->getConfigVal('content1'); ?>
</div>

<div id="form" class="cf">
	<?php show::msg($msg, $msgType); ?>
	<form method="post" action="<?php echo $core->makeUrl('contact', array('action' => 'send')); ?>">		<div class="field">
			<label for="name">Nom</label>
			<input type="text" name="name" id="name" value="<?php echo $name; ?>" />
		</div>

		<div class="field">
			<label for="firstname">Prénom</label>
			<input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" />
		</div>

		<div class="field">
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="<?php echo $email; ?>" />
		</div>

		<div class="field">
			<label for="message">Message</label>
			<textarea type="text" name="message" id="message" /><?php echo $message; ?></textarea>
		</div>

		<button class="btn" type="submit" name="submit">Envoyer</button>
	</form>
</div>

<div class="bottom-contact">
	<?php echo $runPlugin->getConfigVal('content2'); ?>
</div>

<?php include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/footer.php'); ?>
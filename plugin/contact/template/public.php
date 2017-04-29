<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/header.php');
echo $runPlugin->getConfigVal('content1');
?>

<?php show::msg($msg, $msgType); ?>
<form method="post" action="<?php echo $core->makeUrl('contact', array('action' => 'send')); ?>">
  <p>
    <label>Nom</label><br>
    <input required="required" type="text" name="name" value="<?php echo $name; ?>" />
  </p>	
  <p>
    <label>Prénom</label><br>
    <input required="required" type="text" name="firstname" value="<?php echo $firstname; ?>" />
  </p>
  <p>
    <label>Email</label><br>
    <input required="email" type="email" name="email" value="<?php echo $email; ?>" />
  </p>
  <p>
    <label>Message</label><br>
    <textarea required="required" name="message"><?php echo $message; ?></textarea>
  </p>
  <p>
    <input type="submit" value="Envoyer" />
  </p>
</form>

<?php
echo $runPlugin->getConfigVal('content2');
include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/footer.php');
?>
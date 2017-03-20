<?php include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/header.php') ?>

<?php echo $runPlugin->getConfigVal('content1'); ?>

<?php show::msg($msg, $msgType); ?>
<form method="post" action="<?php echo $core->makeUrl('contact', array('action' => 'send')); ?>">
  <p>
      <label><?php echo $core->lang("Name"); ?></label><br>
      <input required="required" type="text" name="name" value="<?php echo $name; ?>" />
  </p>	
  <p>
      <label><?php echo  $core->lang("First name"); ?></label><br>
      <input required="required" type="text" name="firstname" value="<?php echo $firstname; ?>" />
  </p>
  <p>
      <label><?php echo  $core->lang("E-mail"); ?></label><br>
      <input required="email" type="email" name="email" value="<?php echo $email; ?>" />
  </p>
  <p>
      <label><?php echo  $core->lang("Message"); ?></label><br>
      <textarea required="required" name="message"><?php echo $message; ?></textarea>
  </p>
  <?php if(contactUseCaptchaPlugin()){ showCaptcha(); } ?>
  <p>
    <input type="submit" value="<?php echo  $core->lang("Send"); ?>" />
  </p>
</form>

<?php echo $runPlugin->getConfigVal('content2'); ?>

<?php include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/footer.php') ?>
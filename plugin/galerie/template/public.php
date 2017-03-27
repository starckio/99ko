<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(THEMES .$core->getConfigVal('theme').'/header.php');
?>
<!-- Intro -->
<?php echo $runPlugin->getConfigVal('introduction'); ?>

<!-- Categories -->
<?php if($galerie->useCategories()){ ?>
<ul class="categories">
    <li><a rel="category_all" href="javascript:"><?php echo $core->lang("Show all"); ?></a></li>
    <?php foreach($galerie->listCategories() as $k=>$v){ ?>
    <li><a rel="category_<?php echo util::strToUrl($v); ?>" href="javascript:"><?php echo $v; ?></a></li>
    <?php } ?>
</ul>
<?php } ?>

<!-- Liste -->
<ul id="list">
    <?php foreach($galerie->getItems() as $k=>$obj){ ?>
    <li class="category_<?php echo util::strToUrl($obj->getCategory()); ?> category_all" style="background-image:url(<?php echo UPLOAD; ?>galerie/<?php echo $obj->getImg(); ?>);">
        <a href="<?php echo UPLOAD; ?>galerie/<?php echo $obj->getImg(); ?>" data-lightbox="portfolio" data-title="<?php echo $obj->getTitle(); ?><br><?php echo $obj->getCategory(); ?><br><?php echo htmlentities($obj->getContent()); ?>">
        <?php if($runPlugin->getConfigVal('showTitles')){ ?><span><?php echo $obj->getTitle(); ?></span><?php } ?>
        </a>
    </li>
    <?php } ?>
</ul>
<?php include_once(THEMES .$core->getConfigVal('theme').'/footer.php') ?>
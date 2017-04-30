<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'admin/header.php');
?>

<?php if($mode == 'list'){ ?>

<div class="items">

	<nav>
		<ul class="menu cf">
			<li><a href="index.php?p=page&amp;action=edit">Ajouter une page</a></li>
			<li><a href="index.php?p=page&amp;action=edit&parent=1">Ajouter un item parent</a></li>
			<li><a href="index.php?p=page&amp;action=edit&link=1">Ajouter un lien externe</a></li>
		</ul>
	</nav>

<?php foreach($page->getItems() as $k=>$pageItem) if($pageItem->getParent() == 0 && ($pageItem->targetIs() != 'plugin' || ($pageItem->targetIs() == 'plugin' && $pluginsManager->isActivePlugin($pageItem->getTarget())))){ ?>

	<div class="item cf">
		<?php if($pageItem->getIsHomepage()){ ?><div class="item-icon"><img src="icons/home.svg" alt="home" /></div><?php } ?> 
		<?php if($pageItem->getIsHidden()){ ?><div class="item-icon"><img src="icons/eye.svg" alt="eye" /></div><?php } ?>
		<?php if($pageItem->targetIs() == 'url'){ ?><div class="item-icon"><img src="icons/link.svg" alt="link" /></div><?php } ?>
		<?php if($pageItem->targetIs() == 'plugin'){ ?><div class="item-icon"><img src="icons/code.svg" alt="code" /></div><?php } ?>
		<?php if($pageItem->targetIs() == 'parent'){ ?><div class="item-icon"><img src="icons/star.svg" alt="star" /></div><?php } ?>

		<div class="item-info">
			<div class="item-name"><?php echo $pageItem->getName(); ?></div>
			<div class="item-url">
				<?php if($pageItem->targetIs() != 'parent'){ ?>
				<input readonly="readonly" type="text" value="<?php echo $page->makeUrl($pageItem); ?>" />
				<?php } ?>
			</div>
		</div>

		<nav class="item-options">
			<a href="index.php?p=page&action=up&id=<?php echo $pageItem->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="icons/chevron-top.svg" alt="up" /></a>
			<a href="index.php?p=page&action=down&id=<?php echo $pageItem->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="icons/chevron-bottom.svg" alt="donw" /></a>
			<a href="index.php?p=page&amp;action=edit&amp;id=<?php echo $pageItem->getId(); ?>"><img src="icons/edit.svg" alt="edit" /></a>
			<?php if(!$pageItem->getIsHomepage() && $pageItem->targetIs() != 'plugin'){ ?>
			<a class="red" href="index.php?p=page&amp;action=del&amp;id=<?php echo $pageItem->getId(). '&amp;token=' .administrator::getToken(); ?>" onclick = "if(!confirm('Supprimer cet élément ?')) return false;"><img src="icons/trash.svg" alt="trash" /></a>
			<?php } else{ ?>
			<div class="locked"><img src="icons/lock.svg" alt="lock" /></div>
			<?php } ?>
		</nav>
	</div>

	<?php foreach($page->getItems() as $k=>$pageItemChild) if($pageItemChild->getParent() == $pageItem->getId() && ($pageItemChild->targetIs() != 'plugin' || ($pageItemChild->targetIs() == 'plugin' && $pluginsManager->isActivePlugin($pageItemChild->getTarget())))){ ?>

	<div class="item second cf">
		<?php if($pageItemChild->getIsHomepage()){ ?><div class="item-icon"><img src="icons/home.svg" alt="home" /></div><?php } ?> 
		<?php if($pageItemChild->getIsHidden()){ ?><div class="item-icon"><img src="icons/eye.svg" alt="eye" /></div><?php } ?>
		<?php if($pageItemChild->targetIs() == 'url'){ ?><div class="item-icon"><img src="icons/link.svg" alt="link" /></div><?php } ?>
		<?php if($pageItemChild->targetIs() == 'plugin'){ ?><div class="item-icon"><img src="icons/code.svg" alt="code" /></div><?php } ?>
		<?php if($pageItemChild->targetIs() == 'parent'){ ?><div class="item-icon"><img src="icons/trash.svg" alt="trash" /></div><?php } ?>

		<div class="item-info">
			<div class="item-name"><?php echo $pageItemChild->getName(); ?></div>
			<div class="item-url">
				<input readonly="readonly" type="text" value="<?php echo $page->makeUrl($pageItemChild); ?>" />
			</div>
		</div>

		<nav class="item-options">
			<a href="index.php?p=page&action=up&id=<?php echo $pageItemChild->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="icons/chevron-top.svg" alt="up" /></a>
			<a href="index.php?p=page&action=down&id=<?php echo $pageItemChild->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="icons/chevron-bottom.svg" alt="down" /></a>
			<a href="index.php?p=page&amp;action=edit&amp;id=<?php echo $pageItemChild->getId(); ?>"><img src="icons/edit.svg" alt="edit" /></a>
			<?php if(!$pageItemChild->getIsHomepage() && $pageItemChild->targetIs() != 'plugin'){ ?><a class="red" href="index.php?p=page&amp;action=del&amp;id=<?php echo $pageItemChild->getId(). '&amp;token=' .administrator::getToken(); ?>" onclick = "if(!confirm('Supprimer cet élément ?')) return false;"><img src="icons/trash.svg" alt="trash" /></a><?php } ?>
		</nav>
	</div>

	<?php } } ?>

</div>

<?php } ?>

<?php if($mode == 'edit' && !$isLink && !$isParent && $pageItem->targetIs() != 'plugin'){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
<?php show::adminTokenField(); ?>

	<input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
	<input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />

	<div class="field">
		<input <?php if($pageItem->getIsHomepage()){ ?>checked<?php } ?> type="checkbox" name="isHomepage" id="isHomepage" />
		<label for="isHomepage">Page d'accueil</label>
	</div>

	<div class="field">
		<input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" id="isHidden" />
		<label for="isHidden">Ne pas afficher dans le menu</label>
	</div>

	<div class="field">
		<input <?php if($pageItem->getNoIndex()){ ?>checked<?php } ?> type="checkbox" name="noIndex" id="noIndex" />
		<label for="noIndex">Interdire l'indexation</label>
	</div>

	<div class="field">
		<label>Item parent</label>
		<div>
			<span class="drop-down"></span>
			<select name="parent">
				<option value="">Aucun</option>
				<?php foreach($page->getItems() as $k=>$v) if($v->targetIs() == 'parent'){ ?>
				<option <?php if($v->getId() == $pageItem->getParent()){ ?>selected<?php } ?> value="<?php echo $v->getId(); ?>"><?php echo $v->getName(); ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="field">
		<label for="name">Nom</label>
		<input type="text" name="name" id="name" value="<?php echo $pageItem->getName(); ?>" required />
	</div>

	<div class="field">
		<label for="mainTitle">Titre de page (optionel)</label>
		<input type="text" name="mainTitle" id="mainTitle" value="<?php echo $pageItem->getMainTitle(); ?>" />
	</div>

	<div class="field">
		<label for="metaTitleTag">Meta title (optionel)</label>
		<input type="text" name="metaTitleTag" id="metaTitleTag" value="<?php echo $pageItem->getMetaTitleTag(); ?>" />
	</div>

	<div class="field">
		<label for="metaDescriptionTag">Meta description (optionel)</label>
		<input type="text" name="metaDescriptionTag" id="metaDescriptionTag" value="<?php echo $pageItem->getMetaDescriptionTag(); ?>" />
	</div>

	<div class="field">
		<label>Inclure un fichier .php au lieu du contenu (doit être présent dans le dossier de votre thème)</label>
		<div>
			<span class="drop-down"></span>
			<select name="file">
				<option value="">--</option>
				<?php foreach($page->listTemplates() as $file){ ?>
				<option <?php if($file == $pageItem->getFile()){ ?>selected<?php } ?> value="<?php echo $file; ?>">
					<?php echo $file; ?>
				</option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="field">
		<label for="content">Contenu</label>
		<textarea name="content" id="content" class="editor"><?php echo $pageItem->getContent(); ?></textarea>
	</div>

	<button class="btn" type="submit" name="submit">Enregistrer</button>

</form>
<?php } ?>

<?php if($mode == 'edit' && ($isLink || $pageItem->targetIs() == 'plugin')){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
<?php show::adminTokenField(); ?>

	<input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
	<input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />

	<div class="field">
		<input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" id="isHidden" />
		<label for="isHidden">Ne pas afficher dans le menu</label>
	</div>

	<div class="field">
		<label>Item parent</label>
		<div>
			<span class="drop-down"></span>
			<select name="parent">
				<option value="">Aucun</option>
				<?php foreach($page->getItems() as $k=>$v) if($v->targetIs() == 'parent'){ ?>
				<option <?php if($v->getId() == $pageItem->getParent()){ ?>selected<?php } ?> value="<?php echo $v->getId(); ?>"><?php echo $v->getName(); ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="field">
		<label for="name">Nom</label>
		<input type="text" name="name" id="name" value="<?php echo $pageItem->getName(); ?>" required />
	</div>

	<?php if($pageItem->targetIs() == 'plugin'){ ?>

	<div class="field">
		<label>Cible : <?php echo $pageItem->getTarget(); ?></label>
		<input style="display:none;" type="text" name="target" value="<?php echo $pageItem->getTarget(); ?>" />
	</div>

	<?php } else { ?>

	<div class="field">
		<label for="target">Cible</label>
		<input placeholder="Example : http://www.google.com" <?php if($pageItem->targetIs() == 'plugin'){ ?>readonly<?php } ?> type="url" name="target" id="target" value="<?php echo $pageItem->getTarget(); ?>" required />
	</div>

	<?php } ?>

	<div class="field">
		<label>Ouverture</label>
		<div>
			<span class="drop-down"></span>
			<select name="targetAttr">
				<option value="_self" <?php if($pageItem->getTargetAttr() == '_self'){ ?>selected<?php } ?>>Même fenêtre</option>
				<option value="_blank" <?php if($pageItem->getTargetAttr() == '_blank'){ ?>selected<?php } ?>>Nouvelle fenêtre</option>
			</select>
		</div>
	</div>

	<button class="btn" type="submit" name="submit">Enregistrer</button>

</form>
<?php } ?>

<?php if($mode == 'edit' && $isParent){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
<?php show::adminTokenField(); ?>
	<input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
	<input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />
	<input type="hidden" name="target" value="javascript:" />

	<div class="field">
		<label for="name">Nom</label>
		<input type="text" name="name" id="name" value="<?php echo $pageItem->getName(); ?>" required />
	</div>

	<div class="field">
		<input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" id="isHidden" />
		<label for="isHidden">Ne pas afficher dans le menu</label>
	</div>

	<button class="btn" type="submit" name="submit">Enregistrer</button>

</form>
<?php } ?>

<?php include_once(ROOT.'admin/footer.php'); ?>
<?php include_once(ROOT.'admin/header.php'); ?>

<?php if($mode == 'list'){ ?>
<ul class="tabs_style">
  <li><a class="button" href="index.php?p=page&amp;action=edit">Ajouter une page</a></li>
  <li><a class="button" href="index.php?p=page&amp;action=edit&parent=1">Ajouter un item parent</a></li>
  <li><a class="button" href="index.php?p=page&amp;action=edit&link=1">Ajouter un lien externe</a></li>
</ul>
<table>
  <thead>
	<tr>
		<th></th>
		<th>Nom</th>
		<th>Adresse</th>
		<th>Position</th>
		<th>Actions</th>
	</tr>
  </thead>
  <tbody>
	<?php foreach($page->getItems() as $k=>$pageItem) if($pageItem->getParent() == 0 && ($pageItem->targetIs() != 'plugin' || ($pageItem->targetIs() == 'plugin' && $pluginsManager->isActivePlugin($pageItem->getTarget())))){ ?>
	<tr>
		<td><?php if($pageItem->getIsHomepage()){ ?><img title="Accueil" src="<?php echo PLUGINS; ?>page/template/house.png" alt="icon" /><?php } ?> 
		    <?php if($pageItem->getIsHidden()){ ?><img title="Fantôme" src="<?php echo PLUGINS; ?>page/template/ghost.png" alt="icon" /><?php } ?>
			<?php if($pageItem->targetIs() == 'url'){ ?><img title="Externe" src="<?php echo PLUGINS; ?>page/template/link.png" alt="icon" /><?php } ?>
			<?php if($pageItem->targetIs() == 'plugin'){ ?><img title="Plugin" src="<?php echo PLUGINS; ?>page/template/plugin.png" alt="icon" /><?php } ?>
			<?php if($pageItem->targetIs() == 'parent'){ ?><img title="Parent" src="<?php echo PLUGINS; ?>page/template/star.png" alt="icon" /><?php } ?>
		</td>
		<td><?php echo $pageItem->getName(); ?></td>
		<td><?php if($pageItem->targetIs() != 'parent'){ ?><input readonly="readonly" type="text" value="<?php echo $page->makeUrl($pageItem); ?>" /><?php } ?></td>
		<td>
		  <a class="up" href="index.php?p=page&action=up&id=<?php echo $pageItem->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/template/up.png" alt="icon" /></a>&nbsp;&nbsp;
		  <a class="down" href="index.php?p=page&action=down&id=<?php echo $pageItem->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/template/down.png" alt="icon" /></a>
		</td>
		<td>
		  <a class="button" href="index.php?p=page&amp;action=edit&amp;id=<?php echo $pageItem->getId(); ?>">Modifier</a> 
          <?php if(!$pageItem->getIsHomepage() && $pageItem->targetIs() != 'plugin'){ ?><a class="button alert" href="index.php?p=page&amp;action=del&amp;id=<?php echo $pageItem->getId(). '&amp;token=' .administrator::getToken(); ?>" onclick = "if(!confirm('Supprimer cet élément ?')) return false;">Supprimer</a><?php } ?>	
		</td>
	</tr>
	<?php foreach($page->getItems() as $k=>$pageItemChild) if($pageItemChild->getParent() == $pageItem->getId() && ($pageItemChild->targetIs() != 'plugin' || ($pageItemChild->targetIs() == 'plugin' && $pluginsManager->isActivePlugin($pageItemChild->getTarget())))){ ?>
	<tr>
		<td><?php if($pageItemChild->getIsHomepage()){ ?><img title="Accueil" src="<?php echo PLUGINS; ?>page/template/house.png" alt="icon" /><?php } ?> 
			<?php if($pageItemChild->getIsHidden()){ ?><img title="Fantôme" src="<?php echo PLUGINS; ?>page/template/ghost.png" alt="icon" /><?php } ?>
			<?php if($pageItemChild->targetIs() == 'url'){ ?><img title="Externe" src="<?php echo PLUGINS; ?>page/template/link.png" alt="icon" /><?php } ?>
			<?php if($pageItemChild->targetIs() == 'plugin'){ ?><img title="Plugin" src="<?php echo PLUGINS; ?>page/template/plugin.png" alt="icon" /><?php } ?>
			<?php if($pageItemChild->targetIs() == 'parent'){ ?><img title="Parent" src="<?php echo PLUGINS; ?>page/template/star.png" alt="icon" /><?php } ?>
		</td>
		<td>▸ <?php echo $pageItemChild->getName(); ?></td>
		<td><input readonly="readonly" type="text" value="<?php echo $page->makeUrl($pageItemChild); ?>" /></td>
		<td>
		  <a class="up" href="index.php?p=page&action=up&id=<?php echo $pageItemChild->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/template/up.png" alt="icon" /></a>&nbsp;&nbsp;
		  <a class="down" href="index.php?p=page&action=down&id=<?php echo $pageItemChild->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/template/down.png" alt="icon" /></a>
		</td>
		<td>
		  <a class="button" href="index.php?p=page&amp;action=edit&amp;id=<?php echo $pageItemChild->getId(); ?>">Modifier</a> 
		  <?php if(!$pageItemChild->getIsHomepage() && $pageItemChild->targetIs() != 'plugin'){ ?><a class="button alert" href="index.php?p=page&amp;action=del&amp;id=<?php echo $pageItemChild->getId(). '&amp;token=' .administrator::getToken(); ?>" onclick = "if(!confirm('Supprimer cet élément ?')) return false;">Supprimer</a><?php } ?>	
		</td>
	</tr>
	<?php } } ?>
  </tbody>
</table>
<?php } ?>

<?php if($mode == 'edit' && !$isLink && !$isParent && $pageItem->targetIs() != 'plugin'){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
  <?php show::adminTokenField(); ?>
  <input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
  <input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />
  <p>
      <input <?php if($pageItem->getIsHomepage()){ ?>checked<?php } ?> type="checkbox" name="isHomepage" /> Page d'accueil
	</p>
	<p>
      <input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> Ne pas afficher dans le menu
	</p>
	<p>
      <input <?php if($pageItem->getNoIndex()){ ?>checked<?php } ?> type="checkbox" name="noIndex" /> Interdire l'indexation
  </p>
  <p>
      <label>Item parent</label><br>
	  <select name="parent">
	  <option value="">Aucun</option>
	  <?php foreach($page->getItems() as $k=>$v) if($v->targetIs() == 'parent'){ ?>
	  <option <?php if($v->getId() == $pageItem->getParent()){ ?>selected<?php } ?> value="<?php echo $v->getId(); ?>"><?php echo $v->getName(); ?></option>
	  <?php } ?>
	  </select>
  </p>
  <p>
      <label>Nom</label><br>
      <input type="text" name="name" value="<?php echo $pageItem->getName(); ?>" required="required" />
  </p>
  <p>
      <label>Titre de page (optionel)</label><br>
      <input type="text" name="mainTitle" value="<?php echo $pageItem->getMainTitle(); ?>" />
  </p>
  <p>
      <label>Meta title (optionel)</label>
      <input type="text" name="metaTitleTag" value="<?php echo $pageItem->getMetaTitleTag(); ?>" />
  </p>
  <p>
      <label>Meta description (optionel)</label>
      <input type="text" name="metaDescriptionTag" value="<?php echo $pageItem->getMetaDescriptionTag(); ?>" />
  </p>
  <p>
      <label>Inclure un fichier .php au lieu du contenu (doit être présent dans le dossier de votre thème)
	  <select name="file" class="large-3 columns">
		  <option value="">--</option>
		  <?php foreach($page->listTemplates() as $file){ ?>
		  <option <?php if($file == $pageItem->getFile()){ ?>selected<?php } ?> value="<?php echo $file; ?>"><?php echo $file; ?></option>
		  <?php } ?>
	  </select>
  </p>
  <p>
      <label>Contenu</label>
      <?php show::adminEditor('content', $pageItem->getContent()); ?>
  </p>
  <p>
	<button type="submit" class="button success radius">Enregistrer</button>
  </p>
</form>
<?php } ?>

<?php if($mode == 'edit' && ($isLink || $pageItem->targetIs() == 'plugin')){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
  <?php show::adminTokenField(); ?>
  <input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
  <input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />
  <p>
      <input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> <label for="isHidden">Ne pas afficher dans le menu</label>
  </p>
  <p>
      <label>Item parent</label><br>
	  <select name="parent">
	  <option value="">Aucun</option>
	  <?php foreach($page->getItems() as $k=>$v) if($v->targetIs() == 'parent'){ ?>
	  <option <?php if($v->getId() == $pageItem->getParent()){ ?>selected<?php } ?> value="<?php echo $v->getId(); ?>"><?php echo $v->getName(); ?></option>
	  <?php } ?>
	  </select>
  </p>
  <p>
      <label>Nom</label><br>
      <input type="text" name="name" value="<?php echo $pageItem->getName(); ?>" required="required" />
  </p>
  <?php if($pageItem->targetIs() == 'plugin'){ ?>
  <p>
      <label>Cible : <?php echo $pageItem->getTarget(); ?></label>
      <input style="display:none;" type="text" name="target" value="<?php echo $pageItem->getTarget(); ?>" />
  </p>
  <?php } else{ ?>
  <p>
      <label>Cible</label><br>
      <input placeholder="Example : http://www.google.com" <?php if($pageItem->targetIs() == 'plugin'){ ?>readonly<?php } ?> type="url" name="target" value="<?php echo $pageItem->getTarget(); ?>" required="required" />
  </p>
  <?php } ?>
  <p>
      <label>Ouverture</label><br>
	  <select name="targetAttr">
		<option value="_self" <?php if($pageItem->getTargetAttr() == '_self'){ ?>selected<?php } ?>>Même fenêtre</option>
		<option value="_blank" <?php if($pageItem->getTargetAttr() == '_blank'){ ?>selected<?php } ?>>Nouvelle fenêtre</option>
	  </select>
  </p>
  <p>
	<button type="submit" class="button success radius">Enregistrer</button>
  </p>
</form>
<?php } ?>

<?php if($mode == 'edit' && $isParent){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
  <?php show::adminTokenField(); ?>
  <input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
  <input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />
  <input type="hidden" name="target" value="javascript:" />
  
  <p>
      <label>Nom</label><br>
      <input type="text" name="name" value="<?php echo $pageItem->getName(); ?>" required="required" />
  </p>
  <p>
      <input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> <label for="isHidden">Ne pas afficher dans le menu</label>
  </p>
  <p>
	<button type="submit" class="button success radius">Enregistrer</button>
  </p>
</form>
<?php } ?>

<?php include_once(ROOT.'admin/footer.php'); ?>
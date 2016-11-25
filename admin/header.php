<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="<?php show::siteLang(); ?>">
  <head>
	<?php eval($core->callHook('adminHead')); ?>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>99ko - <?php echo $core->lang('Backend'); ?></title>	
	<link rel="icon" href="data:image/gif;base64,R0lGODlhQABAALMAAENKWU5XaDlATTA1QFVfc0tUZTM5RDY8SUBHVVBZbFNcb0hQYT1DUUVNXVhidiwxOyH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4zLWMwMTEgNjYuMTQ1NjYxLCAyMDEyLzAyLzA2LTE0OjU2OjI3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpDMDA4QzM0QkQ0MUMxMUU1OEVGMzhGN0Y5QzUyNThGRiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpDMDA4QzM0Q0Q0MUMxMUU1OEVGMzhGN0Y5QzUyNThGRiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkMwMDhDMzQ5RDQxQzExRTU4RUYzOEY3RjlDNTI1OEZGIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkMwMDhDMzRBRDQxQzExRTU4RUYzOEY3RjlDNTI1OEZGIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAAAAAAAsAAAAAEAAQAAABP/wyUmrvTjrzbv/YCiOZGmeaKqubOu+cCwLtCCfwuLsfIDcogZvyFPYgJxBgsjc/ZCaAjEBADQUxAMUAxgSGBUGobi1DMY7gtZyQDueZUmXB+byCp7aEYXdBTQDQxs5TD4mBkNwGAE8axdCTTtGJHM7HIw7exRKkUSKHzp+lzwAF1JDVFZ9jSKYDqUbrrAUlQ5fYW4KraQcQ7MSZzxqF208n6M7v8RDmg+1dReVeCCyG5CZFat/GYE8IacO0xjBPAYUiMaxrB8IQ+Z2grTxGq7NG+QO2xYCRPoSofmQvQpRq8CACgjc7GhQoZq6ZCE4DVkAQACAJUygSXCowZcIiZ34iBykwBHDAWYjBgBkUgBcAgslH6EkYWDBqnAC8Cl7AE7cBXwO3h2iMaFdOQtGdwi1UMvBi1U+J+DzR4HfEKopkjqwJ2eIQYQKHTBkMUAbN4w8KFpEO0SjBgOONKzkKpVtyB0jOQC4pUHrWEAribTk8dLDqQJL5RHOu6HmzQI53ezMQGQBg5EDENwcFsIAUQlaE2cwEDYk5xNQQRhwFTJB3BJa6WoQwJoIAQCMS5TtUeIAANYBcHOA22FuHDl8M/g9LuGw6K6LmT+ofBmYZi+vt5C+i126hNXcHbj2XrW2F+HkK/gGjj69+/fw48ufT7++/fv48+uXEQEAOw==">
	<?php show::linkTags(); ?>
	<link rel="stylesheet" href="styles.css" media="all">
	<?php show::scriptTags(); ?>
	<script type="text/javascript" src="scripts.js"></script>
	<?php eval($core->callHook('endAdminHead')); ?>	
  </head>
  <body>
	<div id="alert"><?php show::msg($msg, $msgType); ?></div>
	<div id="container">
		<div id="header">
			<div id="header_content">	
			  <ul>
				<li><h1><a class="active" href="./"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Q0M1NkFFQTcyQkY4MTFFNkI3MjdBMUY3QjM0QzQ1NjkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6Q0M1NkFFQTgyQkY4MTFFNkI3MjdBMUY3QjM0QzQ1NjkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpDQzU2QUVBNTJCRjgxMUU2QjcyN0ExRjdCMzRDNDU2OSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpDQzU2QUVBNjJCRjgxMUU2QjcyN0ExRjdCMzRDNDU2OSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PrSYOhgAAAISSURBVHja7Jo9L0NRGMdblFImEpSwNBEGCxORIBYJm6hILGKW8AG8jBoLiZBQBm+TwWj2CcQiTEIqYakIg1Sv/0keS9MXac996/0/yS/NvT3nuff+7st5zm39hmH4vBwVPo8HBVAABVAABVAABVAABVAABVAABVCAB6OqlM6JRKKU7kNgEWyD62KThMNhV14Bo+AQTMnniJdugUlwBiKyHJHlCS8ImJGDbc5Y3yLro+UsYAEcgPoc3zeAuLQrOwHLYAuECrQLSbulchGg8q+CDVD3zz6qXQysAL+bBVSDTbBWxHCr2q9L/2o3ClD3866GS1ndOjuSzzUCmuRhN6/x4bkPGt0gQJVlR2Bac96o5G11soBOcGpiQaMKqBPQ4UQBPeACDFtQQqvtdDtJwCC4BH0WDd39sr0BJwgYk+qtHSTBB0ibdOBpyZ+U7cXlirBvOox4kKf9J0iBNpnedpkg4F6mzy+gUqrGZ7sFPAp/8Qa+TLoCVN4b8OrkYTCoQWquUGe9RndSs3Y23318DG4zStxv0AvmrKj/7RTwA87BVZbvxsGs1ftk9QsRdXYDeSZPlocdr8T8PgcFfxegAAqgAArQnC9YoO7INQwGCtQAtWacMN1Fh5qp7clsLZVFjiqE7nL0Vetj0s7Isp9P4F37mMx/i/MZQAEUQAEUQAEUQAEUQAEUQAEUQAEUQAEei18BBgCL8EygwJPNuAAAAABJRU5ErkJggg==" alt="<?php echo $core->lang('Administration'); ?>" /></a></h1></li>
				<li><a target="_blank" href="../"><?php echo $core->lang('Show website'); ?></a></li>
				<li><a href="index.php?action=logout&token=<?php echo administrator::getToken(); ?>"><?php echo $core->lang('Logout'); ?></a></li>
				<?php eval($core->callHook('adminSecondaryMenu')); ?>
			  </ul>
			</div>
		</div>
		<div id="body">
		  <div id="sidebar">
			<ul id="navigation">
			  <?php foreach($pluginsManager->getPlugins() as $k=>$v) if($v->getConfigVal('activate') && $v->getAdminFile()){ ?>
			  <li class="<?php if($v->isRequired()){ ?>last<?php } ?>"><a href="index.php?p=<?php echo $v->getName(); ?>"><?php echo $core->lang($v->getInfoVal('name')); ?></a></li>
			  <?php } ?>
			</ul>
			<div id="notifs">
			  <?php foreach($core->check() as $k=>$v){ ?>
			  <?php echo show::msg($v['msg'], $v['type']); ?>
			  <?php } ?>
			  <?php eval($core->callHook('adminNotifications')); ?>
			</div>
			<p class="just_using">
			  <a title="<?php echo $core->lang("NoDB CMS"); ?>" target="_blank" href="http://99ko.org"><?php echo $core->lang("Just using 99ko"); ?><br><?php echo VERSION; ?> « <i><?php echo VERSION_NAME; ?></i> »</a>
			</p>
		  </div>
		  <div id="content_mask">
			<div id="content" class="<?php echo $runPlugin->getName(); ?>-admin">	
			  <h2><?php echo $core->lang($pageTitle); ?></h2>        
			  <?php if($core->detectAdminMode() == 'plugin' && $runPlugin->useAdminTabs()){ ?>
			  <ul class="tabs">
				<?php foreach($runPlugin->getAdminTabs() as $k=>$v){ ?>
				<li><a class="button" href="#tab-<?php echo $k; ?>"><?php echo $core->lang($v); ?></a></li>
				<?php } ?>
			  </ul>
			  <div class="tabs-content">
			  <?php } ?>
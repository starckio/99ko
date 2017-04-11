<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
		</div>
	</div>
	<div id="sidebar">
		<div id="sidebar_content">
			<?php $core->callHook('sidebar'); ?>
			<?php $core->callHook('endSidebar'); ?>
		</div>
	</div>
	<div id="footer">
		<div id="footer_content">
			<p>
				<a target='_blank' href='http://99ko.org'>Just using 99ko</a> - Thème <?php show::theme(); ?> - <a rel="nofollow" href="<?php echo ADMIN_PATH ?>">Administration</a>
			</p>
		</div>
	</div>
</div>
<?php $core->callHook('endFrontBody'); ?>
</body>
</html>
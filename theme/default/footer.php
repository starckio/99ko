<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
	</div>

</main>

<footer class="footer cf" role="contentinfo">
	<?php $core->callHook('footer'); ?>
	<div class="copyright">
		Copyright © <?php echo date('Y'); ?>, thème: <?php show::theme(); ?> - <a rel="nofollow" href="<?php echo ADMIN_PATH ?>">Administration</a>
	</div>
	<div class="colophon">
		<a href="http://99ko.org">Just using 99ko <b>♥</b></a>
	</div>
	<?php $core->callHook('endFooter'); ?>
</footer>

<?php $core->callHook('endFrontBody'); ?>
</body>
</html>
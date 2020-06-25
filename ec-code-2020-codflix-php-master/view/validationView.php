<?php ob_start();

	echo '<p>'.$error.'</p>';
	$content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
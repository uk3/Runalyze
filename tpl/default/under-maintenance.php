<?php
/**
 * Template: under-maintenance.php
 * 
 * This template is used in `/inc/tpl/login.php`.
 * A maintenance message is displayed if `USER_CAN_REGISTER` is set to false.
 * 
 * You can create your own version of this template as `/tpl/under-maintenance.php`.
 */
if (!defined('RUNALYZE'))
	die;
?>
<p>
	<?php
	_e('We\'re working on something to make Runalyze a little bit smarter. '
		.'To do this without breaking the system we had to disable the login for a few moments. '
		.'Stay tuned and come back soon!');
	?>
</p>
<?php
$HideForm = true;
$ErrorString = '';
$OkayString = '';

if (isset($_POST['new_username'])) {
	$Errors = AccountHandler::tryToRegisterNewUser();
	$HideForm = false;

	if (is_array($Errors)) {
		foreach ($Errors as $Error) {
			if (is_array($Error)) {
				foreach ($Error as $String) {
					$ErrorString .= $String.'<br>';
				}
			} else {
				$ErrorString .= $Error;
			}
		}
	} elseif (System::isAtLocalhost()) {
		$OkayString = __('You can login now. Enjoy Runalyze!');
	} else {
		$OkayString = __('Thanks for your registration. You should receive an email within the next minutes with further instructions for activating your account.');
	}
}
?>

<form action="login.php?register" method="post" autocomplete="off">
	<p class="last">
		<?php _e('Email:'); ?>
	</p>
	<div class="input-container bottom-margin">
		<div class="input-icon">
			<i class="fa fa-fw fa-envelope"></i>
		</div>
		<div class="input-field">
			<input type="text" name="email" placeholder="<?php _e('Your Email'); ?>" autocomplete="off">
		</div>
	</div>

	<p class="last">
		<?php _e('Login Credentials:'); ?>
	</p>
	<div class="input-container">
		<div class="input-icon">
			<i class="fa fa-fw fa-user"></i>
		</div>
		<div class="input-field">
			<input type="text" name="new_username" placeholder="<?php _e('Create Username'); ?>" autocomplete="off">
		</div>
	</div>
	<div class="input-container">
		<div class="input-icon">
			<i class="fa fa-fw fa-lock"></i>
		</div>
		<div class="input-field">
			<input type="password" name="password" placeholder="<?php _e('Create Password'); ?>" autocomplete="off">
		</div>
	</div>
	<div class="input-container bottom-margin">
		<div class="input-icon">
			<i class="fa fa-fw fa-lock"></i>
		</div>
		<div class="input-field">
			<input type="password" name="password_again" placeholder="<?php _e('Confirm Password'); ?>" autocomplete="off">
		</div>
	</div>

	<p class="last">
		<?php _e('Optional Data:'); ?>
	</p>
	<div class="input-container">
		<div class="input-icon">
			<i class="fa fa-fw fa-child"></i>
		</div>
		<div class="input-field">
			<input type="text" name="name" placeholder="<?php _e('Your Real Name'); ?>" autocomplete="off">
		</div>
	</div>

	<div class="input-container r">
		<p class="left">
			<?php printf('You hereby accept our <a href="%s" class="%s">terms of use</a>.', '#', 'modest-link active'); ?>
		</p>
		<input class="input-submit" type="submit" name="submit" value="<?php _e('Sign Up'); ?>">
	</div>

	<?php if (!empty($ErrorString)): ?>
	<div class="message message-error topspace">
		<p class="title"><i class="fa fa-fw fa-warning"></i> Error</p>
		<p><?php echo $ErrorString; ?></p>
	</div>
	<?php elseif (!empty($OkayString)): ?>
	<div class="message message-okay topspace">
		<p class="title"><i class="fa fa-fw fa-check"></i> Success</p>
		<p><?php echo $OkayString; ?></p>
	</div>
	<?php endif; ?>
</form>

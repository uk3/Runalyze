<?php
$ErrorString = '';
if (SessionAccountHandler::$ErrorType != SessionAccountHandler::$ERROR_TYPE_NO) {
	if (SessionAccountHandler::$ErrorType == SessionAccountHandler::$ERROR_TYPE_WRONG_USERNAME) {
		$ErrorString    = __('The username is not known.');
	} elseif (SessionAccountHandler::$ErrorType == SessionAccountHandler::$ERROR_TYPE_WRONG_PASSWORD) {
		$ErrorString    = __('The password was incorrect.');
	} elseif (SessionAccountHandler::$ErrorType == SessionAccountHandler::$ERROR_TYPE_ACTIVATION_NEEDED)
		$ErrorString    = __('The account hasn\'t been activated.<br>Have a look at your email inbox.');
}

$HideForm = (isset($_POST['new_username']) || isset($_POST['send_username']));
?>
<div class="<?php echo $HideForm ? 'hidden ': ''; ?>container login" id="login">
	<div class="row">
		<div class="panel">
			<div class="panel-header panel-header-single">
				<?php _e('Login'); ?>
			</div>
			<div class="panel-content">
				<form action="login.php" method="post">
					<div class="input-container">
						<div class="input-icon">
							<i class="fa fa-fw fa-user"></i>
						</div>
						<div class="input-field">
							<?php if (USER_CAN_REGISTER): ?>
							<button class="modest-link inline over-input" type="button" id="register-link"><?php _e('Create new account'); ?></button>
							<?php endif; ?>
							<input type="text" name="username" placeholder="<?php _e('Username'); ?>" autofocus>
						</div>
					</div>
					<div class="input-container">
						<div class="input-icon">
							<i class="fa fa-fw fa-lock"></i>
						</div>
						<div class="input-field">
							<button class="modest-link inline over-input" type="button" id="password-link"><?php _e('Forgot password?'); ?></button>
							<input type="password" name="password" placeholder="<?php _e('Password'); ?>">
						</div>
					</div>
					<div id="autologin-container" class="input-container-checkbox">
						<input id="autologin" name="autologin" type="checkbox" style="display:none;">
						<div class="input-icon">
							<label for="autologin" onclick="$('#autologin-container').toggleClass('checked')"><i class="fa fa-fw fa-toggle-off"></i></label>
						</div>
						<div class="input-checkbox-text">
							<label for="autologin" onclick="$('#autologin-container').toggleClass('checked')"><?php _e('Remember me?'); ?></label>
						</div>
					</div>
					<div class="input-container r">
						<input class="input-submit" type="submit" name="submit" value="<?php _e('Sign In'); ?>">
					</div>
					<?php if (!empty($ErrorString)): ?>
					<div class="input-container input-message message-error">
						<div class="input-icon">
							<i class="fa fa-fw fa-warning"></i>
						</div>
						<div class="input-field">
							<?php echo $ErrorString; ?>
						</div>
					</div>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>
</div>

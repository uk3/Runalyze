<?php
$HideForm = true;
$OkayString = '';
$MessageString = __('A link for changing your password will be sent via email.');

if (isset($_POST['send_username'])) {
	$HideForm = false;
	$OkayString = AccountHandler::sendPasswordLinkTo($_POST['send_username']);
}
?>
<div class="<?php echo $HideForm ? 'hidden ': ''; ?> animation-fade-in-out" id="password">
	<div class="container login">
		<div class="row">
			<p class="c">
				<button class="modest-link inline login-back"><i class="fa fa-fw fa-chevron-up"></i> back to login</button>
			</p>
		</div>
		<div class="row">
			<div class="panel">
				<div class="panel-header panel-header-single">
					Request New Password
				</div>
				<div class="panel-content">
					<form action="login.php" method="post">
						<div class="input-container">
							<div class="input-icon">
								<i class="fa fa-fw fa-user"></i>
							</div>
							<div class="input-field">
								<input type="text" name="send_username" placeholder="Your Username">
							</div>
						</div>
						<div class="input-container r">
							<input class="input-submit" type="submit" name="submit" value="Send Request">
						</div>
						<?php if (!empty($OkayString)): ?>
						<div class="input-container input-message message-okay">
							<div class="input-icon">
								<i class="fa fa-fw fa-warning"></i>
							</div>
							<div class="input-field">
								<?php echo $OkayString; ?>
							</div>
						</div>
						<?php else: ?>
						<div class="input-container input-message">
							<p>
								<?php echo $MessageString; ?>
							</p>
						</div>
						<?php endif; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
 </div>
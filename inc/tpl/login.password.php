<?php
$HideForm = true;
$ResponseString = '';
$NoteString = __('A link with further instructions will be sent via mail.');

if (isset($_POST['send_username'])) {
	$HideForm = false;
	$ResponseString = AccountHandler::sendPasswordLinkTo($_POST['send_username']);
}
?>
<form action="login.php?password" method="post">
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
	<?php if (!empty($ResponseString)): ?>
	<div class="message topspace">
		<p class="title"><i class="fa fa-fw fa-exclamation-circle"></i> Note</p>
		<p><?php echo $ResponseString; ?></p>
	</div>
	<?php else: ?>
	<div class="message message-note topspace">
		<p class="title"><i class="fa fa-fw fa-info-circle"></i> Note</p>
		<p><?php echo $NoteString; ?></p>
	</div>
	<?php endif; ?>
</form>

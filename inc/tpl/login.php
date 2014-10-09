<?php
$ShowCreate = isset($_POST['new_username']) || isset($_GET['register']);
$ShowPassword = isset($_POST['send_username']) || isset($_GET['password']);
$ShowLogin = !$ShowCreate && !$ShowPassword;
$active = ' active';
?>
<div class="container login">
	<div class="row carousel" data-carousel="login">
		<div class="panel">
			<div class="panel-header panel-header-single">
				<div class="content-carousel<?php if ($ShowLogin) echo $active; ?>" data-page="login">
					<?php _e('Login'); ?>
				</div>
				<div class="content-carousel<?php if ($ShowCreate) echo $active; ?>" data-page="register">
					<?php _e('Create Account'); ?>
				</div>
				<div class="content-carousel<?php if ($ShowPassword) echo $active; ?>" data-page="password">
					<?php _e('Request New Password'); ?>
				</div>
			</div>
			<div class="panel-content">
				<div class="content-carousel<?php if ($ShowLogin) echo $active; ?>" data-page="login">
<?php include FRONTEND_PATH.'tpl/login.form.php'; ?>
				</div>
				<div class="content-carousel<?php if ($ShowCreate) echo $active; ?>" data-page="register">
<?php include FRONTEND_PATH.'tpl/login.register.php'; ?>
					<p class="c clear last"><button class="modest-link solid inline login-back"><i class="fa fa-fw fa-chevron-up"></i> back to login</button></p>
				</div>
				<div class="content-carousel<?php if ($ShowPassword) echo $active; ?>" data-page="password">
<?php include FRONTEND_PATH.'tpl/login.password.php'; ?>
					<p class="c clear last"><button class="modest-link solid inline login-back"><i class="fa fa-fw fa-chevron-up"></i> back to login</button></p>
				</div>
			</div>
		</div>
	</div>
</div>
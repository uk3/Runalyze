<div class="container login">
	<div class="row">
		<div class="panel">
			<div class="panel-header panel-header-single">
				Maintenance
			</div>
			<div class="panel-content">
				<div class="input-container input-message message-error">
					<div class="input-icon">
						<i class="fa fa-fw fa-warning"></i>
					</div>
					<div class="input-field">
						<button class="modest-link inline over-input button-toggle" data-toggle="maintenance-more-info">What?</button>
						Runalyze is currently under maintenance.<br>
						Hang on, we'll be back right soon.
					</div>
				</div>
				<div class="hidden animation-fade-in-out" id="maintenance-more-info">
					<div class="input-container input-message">
						<?php
							if (file_exists(FRONTEND_PATH.'../tpl/under-maintenance.php')) {
								include FRONTEND_PATH.'../tpl/under-maintenance.php';
							} else {
								include FRONTEND_PATH.'../tpl/default/under-maintenance.php';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
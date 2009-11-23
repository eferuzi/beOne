<?php 
	$email = array('name'=>'email', 'id'=>'email', 'value'=>'youremail@domain.com');
	$password = array('name'=>'password', 'id'=>'password');
	$login_button = array('name'=>'login', 'id'=>'login', 'value'=>'Login');
?>

<div class="box">
	<h2>
		<a href="#" id="toggle-login-forms">Login Forms</a>
	</h2>
	<div class="block" id="login-forms">
			<?php echo form_open('home/login_action'); ?>
			<fieldset class="login">
				<legend>Login</legend>
				<?php echo validation_errors('<p class="error" />');?> 
				<p>
					<?php 
						echo form_label('Email', 'email'); 
						echo form_input($email);
					?>
				</p>
				<p>
					<?php 
						echo form_label('Password', 'password'); 
						echo form_password($password);
					?>
				</p>
				<?php 
					echo form_submit($login_button); 
					echo form_close();
				?>
			</fieldset>	
	</div>
</div>

<div class="box">	
	<h2>
		<a href="#" id="toggle-sections">New Users</a>
	</h2>
	<div class="block" id="sections">
	<p>
		To make use of the tool you need to register.
	</p>
	<p class="center">
		<?php echo anchor("home/register","Register", array('title'=>'Register')); ?>
	</p>
	</div>
</div>
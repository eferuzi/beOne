<?php 
	$email = array('name'=>'email', 'id'=>'email', 'value'=>'your email address');
	$password = array('name'=>'password', 'id'=>'password');
	$repassword = array('name'=>'repassword', 'id'=>'repassword');
	$register_button = array('name'=>'register', 'id'=>'register', 'value'=>'Register');
?>

<div class="box">
	<h2><a href="#" >Register</a></h2>
	<div class="block" id="register-forms">
			<?php echo form_open('home/register_action'); ?>
			<fieldset class="login">
				<legend>Login Information</legend>
				
				<p>
					<?php 
						echo form_label('Email', 'email'); 
						echo form_input('email', set_value('email', 'Email'));
						echo form_error('email', '<p class="error">', '</p>');
					?>
				</p>
				<p>
					<?php 
						echo form_label('Password', 'password'); 
						echo form_password($password);
						echo form_error('password', '<p class="error">', '</p>');
					?>
				</p>
				<p>
					<?php 
						echo form_label('Re-type Password', 'repassword'); 
						echo form_password($repassword);
						echo form_error('repassword', '<p class="error">', '</p>');
					?>
				</p>
				<?php 
					echo form_submit($register_button); 
					echo form_close();
				?>
			</fieldset>
	</div>
</div>

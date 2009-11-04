<?php 
	$code = array('name'=>'code', 'id'=>'code', 'value'=>'Activation Code');
	$activate_button = array('name'=>'activate', 'id'=>'activate', 'value'=>'Activate');
?>

<div class="box">
	<h2><a href="#" >Activation</a></h2>
	<div class="block" id="register-forms">
			<?php echo form_open('home/activate_action'); ?>
			<fieldset class="login">
				<legend>Activation Information</legend>
				
				<p>
					<?php 
						echo form_label('Activation Code', 'code'); 
						echo form_input($code);
						echo form_error('code', '<p class="error">', '</p>');
					?>
				</p>
				<?php 
					echo form_submit($activate_button); 
					echo form_close();
				?>
			</fieldset>
	</div>
</div>

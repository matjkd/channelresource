<?=form_open('admin/create_user')?>
	<?php 
	
	$this->table->add_row('Firstname', form_input('firstname'));
	$this->table->add_row('Lastname', form_input('lastname'));
	$this->table->add_row('Username', form_input('username'));
	$this->table->add_row('Password', form_input('password'));
	$this->table->add_row('Re-Type Password', form_input('password2'));
	$this->table->add_row('Email', form_input('email'));
	 echo $this->table->generate();
	?>
	<br/>
	<?=form_hidden('company_id', $company_id)?>
	<?=form_submit('submit', 'Submit')?>
	<?=form_close()?>
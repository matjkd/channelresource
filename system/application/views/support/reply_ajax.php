

<?=form_open('support/add_reply/'.$ticket_id.'')?>
	
	<textarea cols='155' rows='3'  name='comment' class='wymeditor'></textarea>
	<?=form_submit('submit', 'Submit')?>

	<?=form_close()?>



<div style="padding: 0 0 0 0px;">


<?php foreach($comments as $key => $row):

if ($row['comment']==NULL)
{
	echo "There are no replies";
	
}
else
{
	if ($row['added_by']==$this->session->userdata('user_id'))
		{
		echo form_open('support/edit_reply/'.$row['support_id'].'')
			?>
			<hr>
			<?php echo "<em>Reply added by ".$row['firstname']."  - ".$row['date_added']."</em>"; ?>
			<textarea cols='150' rows='3'  name='comment'><?=$row['comment']?></textarea>
			
			<?=form_hidden('comments_id', $row['comments_id'])?>
			
			<?php echo form_submit('submit', 'Update');
			echo form_submit('submit', 'Delete');
			echo form_close();
				
		}
	else
		{
		
		echo "<hr><em>added by ".$row['firstname']." - ";
		echo $row['date_added'];
		echo "</em><br/>";
		echo $row['comment'];
		}
}
endforeach;?>
</div>
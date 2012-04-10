 <?php 
$this->load->view('admin/table');
foreach ($company_info as $key => $row):
$company_name = ($row['company_name']);
endforeach;?>
<style>
.title {
float:left;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('#table_id2').dataTable({
		"bStateSave": true,
		"bJQueryUI": true,
		"sDom": '<"H"<"title">fl>rt<"F"ip>',
		"sPaginationType": "full_numbers"
		
		});
	$("div.title").html('<?=$company_name?>');
	
} );

function confirmuser(id) {
	var answer = confirm("Are you sure you want to delete this user?")
	if (answer){
		
		window.location = "delete_user/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}

</script>



<table id="table_id2"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($employees_detail as $key => $row2):?>
		<tr >
			<td style="padding:5px;"><a href="mailto:<?=$row2['email_address'];?>"><?=$row2['firstname'];?> <?=$row2['lastname'];?></a></td>
					
			<td style="padding:5px;"><?=$row2['username']?></td>
			
			<td style="padding:5px;"><a href="<?=base_url()?>admin/view_user/<?=$row2['user_id'];?>">View</a> | 
<a href='#' onclick='confirmuser(<?=$row2['user_id']?>)'>X</a><br/></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>
<br/>

<strong>Add User</strong><br/>
<hr/>
<?=$this->load->view('admin/add_user')?>


<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this company and all users?")
	if (answer){
		
		window.location = "delete_company/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>
 

<table id="table_id"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>id</th>
			<th>Company Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($company_data as $key => $row):

$idcode=$row['company_id'];
	
?>
		<tr >
			<td style="padding:5px;"><?=$row['company_id']?></td>
					
			<td style="padding:5px;"><?=$row['company_name']?></td>
			
			<td style="padding:5px;"><?="<a class='trigger2' href='#' id=".$row['company_id'].">Users</a> 
  						   | <a href='#' onclick='confirmation(".$row['company_id'].")'>Delete</a>"?></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>

<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this calculation?")
	if (answer){
		
		window.location = "/roi/delete_roi/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>
<?php 
$user =  $user_id;

//$this->load->view('admin/table');
//foreach($roi_list as $key => $row):

//convert channel partner id into the name
	
//end of conversion




//$this->table->set_heading("Ref.", 'Customer/Prospect', 'date changed', 'added by', '');
//$this->table->add_row($row['roi_ref'], "<a href=$viewcustomer>$customer_name</a>", $row['date_added'], $row['firstname']." ".$row['lastname'], "<a href=$viewroi>view</a> | <a href='#' onclick='confirmation(".$row['roi_id'].")'>Delete</a>");
//endforeach; 

?>


<table id="table_id"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>Ref</th>
			<th>Customer/Prospect</th>
			<th>Date changed</th>
			<th>Added By</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($roi_list as $key => $row):

$data['customer_detail'] = $this->prospect_model->get_customer($row['customer_id']);
	foreach ($data['customer_detail'] as $row2):
	if(($row2['customer_name'])!="C")
	{
		$customer_name = $row2['customer_name'];
		$customer_id = $row2['customer_id'];
		$viewcustomer = '/prospect/edit_customer/'.$customer_id;
	}
	else
	{
		$customer_name = "n/a";
		$customer_id = "";
		$viewcustomer = '/prospect';
	}
	endforeach;
		
		$viewroi ='/roi/results/'.$row['roi_id'];
		

?>
		<tr >
			<td style="padding:5px;"><?=$row['roi_ref']?></td>
			<td style="padding:5px;"><?="<a href=$viewcustomer>$customer_name</a>"?></td>
			<td style="padding:5px;"><?=$row['date_added']?></td>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
			<td style="padding:5px;"><?="<a href=$viewroi>View</a> | <a href='#' onclick='confirmation(".$row['roi_id'].")'>Delete</a>"?></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>





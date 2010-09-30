<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>
<script type="text/javascript">
//<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this customer?")
	if (answer){
		
		window.location = "/prospect/delete_customer/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>
<?php 
$user =  $this->session->userdata('user_id');

	
?>
<table id="table_id"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>Customer Name</th>
			<th>Channel Partner</th>
			<th>Added By</th>
			<th>Date Added</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php
if($customer_list == NULL)
{

}
else
{
foreach($customer_list as $key => $row):
		
		


//convert channel partner id into the name
	$data['channel_detail'] = $this->Membership_model->get_company_detail($row['channel_partner']);
	foreach ($data['channel_detail'] as $row2):
	$channel_partner_name2 = $row2['company_name'];
			endforeach;

			//end of conversion

		$customer_status = "No Entries";
	
	
		if ($row['customer_status']==1)
			{
			$customer_status = "Prospect";	
			}
		if ($row['customer_status']==2)
			{
			$customer_status = "Customer";		
			}
		if ($row['customer_status']==3)
			{
			$customer_status = "Dead";		
			}
		$viewquote ='/prospect/edit_customer/'.$row['customer_id'];
		$roi ='/roi/main/'.$row['customer_id'];
		$deletequote ='/prospect/delete/'.$row['customer_id'];

?>
		<tr >
			<td style="padding:5px;"><?=$row['customer_name']?></td>
			<td style="padding:5px;"><?=$channel_partner_name2?></td>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
			<td style="padding:5px;"><?=$row['date_added']?></td>
			<td style="padding:5px;"><?=$customer_status?></td>
			<td style="padding:5px;"><?="<a href=$viewquote>Edit</a> |  <a href='#' onclick='confirmation(".$row['customer_id'].")'>Delete</a>"?></td>
		</tr>
		<?php endforeach;   }	?>
	</tbody>
</table>



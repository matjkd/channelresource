<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>
<script type="text/javascript">

function confirmation(id) {
	var answer = confirm("are you sure you want to delete this calculation?")
	if (answer){
		
		window.location = "/pricelist/delete_pricelist/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
</script>



<table id="table_id"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>Ref</th>
			<th>Customer/Prospect</th>
			<th>Date Changed</th>
			<th>Added By</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($pricelist_list as $key => $row):
		
						//convert channel partner id into the name
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
						//end of conversion
				
					
				
				$viewpricelist ='/pricelist/results/'.$row['pricelist_id']; 

?>
		<tr >
			<td style="padding:5px;"><?=$row['pricelist_ref']?></td>
			<td style="padding:5px;"><?="<a href='$viewcustomer'>$customer_name</a>"?></td>
			<td style="padding:5px;"><?=$row['date_updated']?></td>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
			<td style="padding:5px;"><?="<a href='$viewpricelist'>View</a> | <a href='#' onclick='confirmation(".$row['pricelist_id'].")'>Delete</a>"?></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>
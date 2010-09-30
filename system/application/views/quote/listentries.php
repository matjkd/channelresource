
<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>

<script type="text/javascript">

function confirmation(id) {
	var answer = confirm("Are you sure you want to delete this quote?")
	if (answer){
		
		window.location = "/quote/delete_quote/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
</script>

<?php 
$user =  $this->session->userdata('user_id');
?>


	


	




<table id="table_id"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>List of Previous Entries</th>
			<th>Date Changed</th>
			<th>Added By</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($quote_list as $key => $row):
		
		$viewquote ='/quote/results/'.$row['quote_id'];
		$deletequote ='/quote/delete/'.$row['quote_id']; 

?>
		<tr >
			<td style="padding:5px;"><?=$row['quote_ref']?></td>
			<td style="padding:5px;"><?=$row['date_added']?></td>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
			<td style="padding:5px;"><?php echo "<a href=$viewquote>View</a> | <a href='#' onclick='confirmation(".$row['quote_id'].")'>Delete</a>"?></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>


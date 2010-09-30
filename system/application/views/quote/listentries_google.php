<script type="text/javascript">

function confirmation(id) {
	var answer = confirm("are you sure you want to delete this quote?")
	if (answer){
		
		window.location = "/quote/delete_quote/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
google.load('visualization', '1', {packages:['table']});
google.setOnLoadCallback(drawTable);
function drawTable() {
	 var cssClassNames = {
			    'headerRow': 'dark-background'
			    };
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Ref');
  data.addColumn('date', 'Date Changed');
  data.addColumn('string', 'Added By');
  data.addColumn('string', 'Actions');

  <?php 
  		$user =   $this->session->userdata('user_id');
  		
  	
  		echo "data.addRows(".$rowcount.");";
  	
  		$tablerow = 0;
  		
  		

			foreach($quote_list as $key => $row):
			
					//convert channel partner id into the name
					//	$data['customer_detail'] = $this->prospect_model->get_customer($row['customer_id']);
					//	foreach ($data['customer_detail'] as $row2):
					//		if(($row2['customer_name'])!="C")
					//		{
					//			$customer_name = $row2['customer_name'];
					//			$customer_id = $row2['customer_id'];
					//			$viewcustomer = '/prospect/edit_customer/'.$customer_id;
					//		}
					//		else
					//		{
					//			$customer_name = "n/a";
					//			$customer_id = "";
					//			$viewcustomer = '/prospect';
					//		}
					//		endforeach;
					//end of conversion
			
				
				$datetime = new DateTime($row['date_added']);
        				$thedate = $datetime->format('m/d/Y');
			$viewquote ='/quote/results/'.$row['quote_id'];
  				echo "
  				data.setCell($tablerow, 0, '".$row['quote_ref']."');
  				data.setCell($tablerow, 1, new Date('".$thedate."'));
  				data.setCell($tablerow, 2, '".$row['firstname']." ".$row['lastname']."');
  				data.setCell($tablerow, 3, '<a href=\'$viewquote\'>View</a> | <a href=\'#\' onclick=\'confirmation(".$row['quote_id'].")\'>Delete</a>');
  				";


			$tablerow = $tablerow+1;
  		endforeach; 
  						      				
  ?>
	var formatter_medium = new google.visualization.DateFormat({pattern:  "EEE, MMM d, yyyy"});	
		 formatter_medium.format(data,1);
  		 var table = new google.visualization.Table(document.getElementById('table_div'));
  	      table.draw(data, {'allowHtml': true, 'page': 'enable', 'pageSize': 10, 'showRowNumber': false, 'cssClassNames': cssClassNames, pagingSymbols:{prev: 'Prev', next: 'Next'} });

}
</script>
<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
	

<div id="tabs" style="width:800px;">
	<ul>
		<li><a href="#tabs-1">Previous Entries</a></li>
		
		
	</ul>
	



<div id="tabs-1">




<div id='table_div'></div>





</div>
</div>
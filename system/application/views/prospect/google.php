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

  google.load('visualization', '1', {packages:['table']});
      google.setOnLoadCallback(drawTable);
      function drawTable() {
    	  var cssClassNames = {
  			    'headerRow': 'dark-background'
  			    };  
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Customer Name');
        data.addColumn('string', 'Channel Partner');
        data.addColumn('string', 'Added By');
        data.addColumn('date', 'Date Added');
        data.addColumn('string', 'Status');
        data.addColumn('string', 'Actions');
      
        <?php 
        		$user =   $this->session->userdata('user_id');
        		
        	
        		echo "data.addRows(".$rowcount.");";
        	
        		$tablerow = 0;
        		foreach($customer_list as $key => $row):
        		
        		//convert channel partner id into the name
        			$data['channel_detail'] = $this->Membership_model->get_company_detail($row['channel_partner']);
        			
        			foreach ($data['channel_detail'] as $row2):
        			
        			
        			$channel_partner_name = $row2['company_name'];
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
        				$editquote ='<a href="/prospect/edit_customer/'.$row['customer_id'].'">edit</a>';
        				$roi ='/roi/main/'.$row['customer_id'];
        				$price ='/pricelist/main/'.$row['customer_id'];
        				
        				$deletequote ='/prospect/delete/'.$row['customer_id'];
        				
        				//reformat the date so it works in IE
        				$datetime = new DateTime($row['date_added']);
        				$thedate = $datetime->format('m/d/Y');
        				
        				echo "
        				data.setCell($tablerow, 0, '".$row['customer_name']."');
        				data.setCell($tablerow, 1, '".$channel_partner_name."');
        				data.setCell($tablerow, 2, '".$row['firstname']." ".$row['lastname']."');
        				data.setCell($tablerow, 3, new Date('".$thedate."'));
        				data.setCell($tablerow, 4, '".$customer_status."');
        				data.setCell($tablerow, 5, '<a href=\'$viewquote\'>Edit</a>|<a href=\'#\' onclick=\'confirmation(".$row['customer_id'].")\'>Delete</a>');
        				
        				
        				";?>
  

	<? $tablerow = $tablerow+1;
        				endforeach; 
        								

        				
        		?>



        	


       var table = new google.visualization.Table(document.getElementById('table_div'));
   		var formatter = new google.visualization.DateFormat({pattern:  "EEE, MMM d, yyyy"});
	  formatter.format(data, 3);
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
		<li><a href="#tabs-1">Customers</a></li>
		
		
	</ul>
	



<div id="tabs-1">




<div id='table_div'></div>





</div>
</div>

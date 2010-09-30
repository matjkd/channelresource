<script type="text/javascript">

function confirmation(id) {
	var answer = confirm("are you sure you want to delete this ticket?")
	if (answer){
		
		window.location = "/support/delete_ticket/"+ id;
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
        data.addColumn('string', 'Priority');
        data.addColumn('string', 'Priority');
        data.addColumn('string', 'Subject');
        data.addColumn('string', 'Company');
        data.addColumn('string', 'Re:');
        data.addColumn('date', 'Date Changed');
        data.addColumn('string', 'Added By');
        data.addColumn('string', 'Actions');
      
        <?php 
        		$user =   $this->session->userdata('user_id');
        		
        	
        		echo "data.addRows(".$rowcount.");";
        	
        		$tablerow = 0;
        		
        		

				foreach($ticket_list as $key => $row):
				
						
				if(($row['support_type'])==1)
				{
					$type = "Lease Desk";
				}		
				if(($row['support_type'])==2)
				{
					$type = "Channel-Resource";
				}		
				if(($row['support_type'])==3)
				{
					$type = "Customer-Resource";
				}		
				if(($row['support_type'])==4)
				{
					$type = "Training";
				}	
					if(($row['support_type'])==5)
				{
					$type = "Account Review";
				}	
				
				
										
				if(($row['support_priority'])==1)
				{
					$priority = "URGENT";
				}		
				if(($row['support_priority'])==2)
				{
					$priority = "High";
				}		
				if(($row['support_priority'])==3)
				{
					$priority = "Medium";
				}		
				if(($row['support_priority'])==4)
				{
					$priority = "Low";
				}	
					
				
					
				
				$viewticket ='/support/results/'.$row['support_id'];
        				echo "
        				data.setCell($tablerow, 0, '".$row['support_priority']."');
        				data.setCell($tablerow, 1, '".$priority."');
        				data.setCell($tablerow, 2, '".$row['support_subject']."');
        				data.setCell($tablerow, 3, '".$row['company_name']."');
        				data.setCell($tablerow, 4, '".$type."');
        				data.setCell($tablerow, 5, new Date('".$row['date_updated']."'));
        				data.setCell($tablerow, 6, '".$row['firstname']." ".$row['lastname']."');
        				data.setCell($tablerow, 7, '<a href=\'$viewticket\'>View</a> | <a href=\'#\' onclick=\'confirmation(".$row['support_id'].")\'>Delete</a>');
        				";
  

				$tablerow = $tablerow+1;
        		endforeach; 
        						      				
        ?>


        var formatter_medium = new google.visualization.DateFormat({pattern:  "EEE, MMM d, yyyy, HH:mm:ss"});	
        formatter_medium.format(data,5);
        
        var formatter = new google.visualization.TableColorFormat();
        formatter.addRange(0.1, 1.1, 'red', '');
      	
        formatter.format(data, 0); // Apply formatter to second column

        var formatter2 = new google.visualization.TablePatternFormat('{1}');
        formatter2.format(data, [0,1]); // Apply formatter and set the formatted value of the first column.
		
        var view = new google.visualization.DataView(data);
        view.setColumns([0,2,3,4,5,6,7]); // Create a view with the first column only.
        
        var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(view, {'allowHtml': true, 'page': 'enable', 'pageSize': 10, 'showRowNumber': false, 'cssClassNames': cssClassNames, pagingSymbols:{prev: 'Prev', next: 'Next'} });
      
      }
</script>


<div id='table_div'></div>
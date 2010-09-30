
<script type="text/javascript">

 google.load('visualization', '1', {packages:['table']});
      google.setOnLoadCallback(drawTable);
      function drawTable() {
    	 var cssClassNames = {
    			    'headerRow': 'dark-background'
    			    };
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Ref');
      
        data.addColumn('string', 'Date Changed');
       
        data.addColumn('string', 'Actions');
      
        <?php 
        		$user =   $this->session->userdata('user_id');
        		
        	
        		echo "data.addRows(".$rowcount2.");";
        	
        		$tablerow = 0;
        		
        		

				foreach($roidata as $key => $row):
				
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
				
					
				
				$viewroi ='/roi/results/'.$row['roi_id'];
        				echo "
        				data.setCell($tablerow, 0, '".$row['roi_ref']."');
        				
        				data.setCell($tablerow, 1, '".$row['date_added']."');
        				
        				data.setCell($tablerow, 2, '<a href=\'$viewroi\'>View</a>');
        				";
  

				$tablerow = $tablerow+1;
        		endforeach; 
        						      				
        ?>
        		
        		 var table = new google.visualization.Table(document.getElementById('table_div2'));
        	      table.draw(data, {'allowHtml': true, 'page': 'enable', 'pageSize': 10, 'showRowNumber': false, 'cssClassNames': cssClassNames, pagingSymbols:{prev: 'Prev', next: 'Next'} });
      
      }
</script>


<div id='table_div2'></div>
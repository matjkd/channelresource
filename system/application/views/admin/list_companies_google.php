<script type="text/javascript">

function confirmation(id) {
	var answer = confirm("are you sure you want to delete this company and all users?")
	if (answer){
		
		window.location = "/admin/delete_company/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
google.load('visualization', '1', {packages:['table']});
google.setOnLoadCallback(drawTable);
function drawTable() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'id');
  data.addColumn('string', 'Company Name');
  data.addColumn('string', 'Actions');

  <?php 
  
  	
  		echo "data.addRows(".$rowcount.");";
  	
  		$tablerow = 0;
  		foreach($company_data as $key => $row):
  		$idcode=$row['company_id'];
  		
  				echo "
  				data.setCell($tablerow, 0, '".$row['company_id']."');
  				data.setCell($tablerow, 1, '".$row['company_name']."');
  				data.setCell($tablerow, 2, '<a class=\"trigger2\" href=\"/admin/view_companies/$idcode\" id=".$idcode.">Users</a>|<a href=\'#\' onclick=\'confirmation(".$row['company_id'].")\'>Delete</a>');
  				
  				
  				";?>


<? $tablerow = $tablerow+1;
  				endforeach; 
  								

  				
  		?>




  		

 var table = new google.visualization.Table(document.getElementById('table_div'));
 table.draw(data, {allowHtml: true, page: 'enable', pageSize: 10, showRowNumber: false});
}



</script>

<div id='table_div'></div>

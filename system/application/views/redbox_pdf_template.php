<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>

body {
  margin: 0pt 22pt 24pt 22pt;
   font-family: 'Helvetica';
  font-size: 9px;
}

table {
	width:100%;
  margin-top: 2em;
  
}

thead {
  background-color: #cccccc;
}

tbody {
  background-color: #ffffff;
}

th,td {
  padding: 3pt;
}


table.collapse {

  border-collapse: collapse;
  border: 0.5pt solid #333333;  
}

table.collapse td {
  border: 0.5pt solid #333333;
  
}
</style>
</head>

<body>

<table>
	<tr>
	<td width="303px"><img style="width: 303px;" src="redboxlogo.jpg"/></td>
	
	<td align=right><h2 style="margin-bottom:3px;"> Red Box Recorders</h2>
	The Coach House<br/>
	Tollerton Hall<br/>
	Tollerton<br/>
	Nottingham NG12 4GQ<br/>
	
	<?php echo "<strong>t +44 (0)115 937 7100</strong>  <br/><strong>f +44 (0)115 937 7494<br/> <strong>w</strong> www.redboxrecorders.com"; ?>
	</td>
	</tr>
	
</table>

<?php
//fix currency if euro
$currency2 = "£";
        if ($currency == NULL) {

            $currency2 = "£";
        }
        if ($currency == '€') {
            $currency2 = "&#0128;";
        }
         if ($currency == '$') {
            $currency2 = "$";
        }

//set date
        $old_date_added = strtotime($date_added);
        $new_date_added = date('l jS \of F Y', $old_date_added);
        ?>



<?php 
	$this->load->view('admin/table');
	
	$this->table->add_row("<strong>Company Name</strong>: $assigned_company_name", '');
	$this->table->add_row("<strong>User</strong>: $assigned_name", '');
	$this->table->add_row("<strong>Email</strong>: $assigned_email", '');
	$this->table->add_row("<strong>Quote Ref</strong>: $quote_ref", '');
foreach($quote_results as $key => $row):


$this->table->add_row('<h2>Results</h2>', '');
	$this->table->add_row('<strong>Capital Amount</strong>', $currency.number_format($row['capital'], 2));
	
	
	$this->table->add_row('<strong>Payment Type</strong>', $row['payment_type']); 
	$this->table->add_row('<strong>Payment Frequency</strong>', $row['payment_frequency']);
	$this->table->add_row('<strong>Payment Profile</strong>', $row['initial']."+".$row['regular']);
	$this->table->add_row('<strong>Initial</strong>', $currency2.$row['initial_result']);
	$this->table->add_row('<strong>Regular</strong>', $currency2.$row['regular_result']);
	$this->table->add_row('', '');

	$this->table->add_row('<h2>Subscription Pricing Results</h2>', '');
	
	$this->table->add_row('<strong>Number of channels</strong>', $row['number_of_ports']);
	$this->table->add_row('<strong>Product cost per channel</strong>', $currency2.$row['product_cost_per_port']);
	$this->table->add_row('<strong>Service cost per channel</strong>', $currency2.$row['service_cost_per_port']);
	$this->table->add_row('<hr>', '<hr>');
	$this->table->add_row('<strong>Total Cost Per Channel per Month</strong>', $currency2.$row['cost_per_port_per_month']);
	
	echo $this->table->generate();
	$this->table->clear();
	
endforeach;	
	?>









<script type="text/php">

if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("verdana");;
  $size = 6;
  $color = array(0,0,0);
  $text_height = Font_Metrics::get_font_height($font, $size);

  $foot = $pdf->open_object();
  
  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - 2 * $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 1);

  $y += $text_height;

  $text = "ID:  <?=$quote_ref?>";
  $pdf->text(16, $y, $text, $font, $size, $color);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

 // global $initials;
 // $initials = $pdf->open_object();
  
  // Add an initals box
  //$text = "Initials:";
  //$width = Font_Metrics::get_text_width($text, $font, $size);
  //$pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
  //$pdf->rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);
    

  //$pdf->close_object();
 // $pdf->add_object($initials);
 
  // Mark the document as a duplicate
  //df->text(110, $h - 240, "DUPLICATE", Font_Metrics::get_font("verdana", "bold"),
   //        110, array(0.85, 0.85, 0.85), 0, -52);

  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script>

</body>
</html>
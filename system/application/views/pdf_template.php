<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
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
	<td width="280px"><img style="width: 180px;" src="logo_pdf.jpg"/></td>
	
	<td align=right><h2 style="margin-bottom:3px;"> <?php echo "name" ?></h2>
	<?php echo "address"; ?><br/>
	<?php echo "<strong>t 12</strong>  <br/><strong>e</strong> em  <br/> <strong>w</strong> ww"; ?>
	</td>
	</tr>
	
</table>




<table>
	<tr>
	
	<td><h1><?php echo "something"; ?> <?php echo "something"; ?></h1></td>
	</tr>
</table>





body to go here





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

  $text = "ID: <?php echo "something"; ?>";
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
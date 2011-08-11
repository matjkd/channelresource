<script type="text/javascript">
$(document).ready(function() {
	$('#file_list').dataTable({
		"bStateSave": false,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"

		});
} );
</script>
<h3>Attachments</h3>

<table id="file_list"  width="100%" style="clear:both;">

	<thead>
		<tr>
		<th>Filename</th>
			<th>filesize</th>
			<th>Time Added</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>

<?php
foreach ($bucket_contents as $file):

    $fname = $file['name'];
	$size = $file['size'];
	$sizeMB = round($size/1048576, 4);
	$timeadded = $file['time'];
	$timeadded = date('Y-m-d H:i:s', $timeadded);
    $furl = "http://".$mainbucket.".s3.amazonaws.com/".$fname;

	if(strlen(strstr($fname, $bucket_name))>0) {
    //output a link to the file
    $filename = str_replace($bucket_name."/", "", $fname); ?>


<tr>
<td><?php echo "<a href=\"$furl\">$filename</a>"; ?> </td>
<td> <?=$size?> bytes</td>
<td> <?=$timeadded?></td>
<td><?=form_open('support/delete_file')?>

	<?=form_hidden('folder', $bucket_name)?>

	<?=form_hidden('filename', $filename)?>


	<?=form_submit('submit', 'delete file')?>
	<?=form_close()?> </td>
</tr>








 <?
	}

endforeach;

?>
	</tbody>
</table>
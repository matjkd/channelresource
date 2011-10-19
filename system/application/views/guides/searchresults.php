<?=$this->load->view('guides/search')?>
<?php foreach($guides as $row): ?>
<hr/>
<strong><?=$row['title']?></strong><br/>
<?php 
$short = substr($row['description'], 0, 100);
$short = strip_tags($short, '<em><strong>');
echo trim($short);
?>

<?=$short?>...<a href="<?=base_url()?>userguide/viewguide/<?=$row['user_guide_id']?>">read more</a>
<?php endforeach; ?>

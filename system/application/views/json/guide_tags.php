[
<?php foreach($source as $row):?>
{ "id": "<?=$row['tag_id']?>", "label": "<?=$row['tag']?>", "value": "<?=$row['tag']?>" }
<?php endforeach; ?>
]
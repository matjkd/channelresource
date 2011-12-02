<h2>All Guides</h2>

<p><a href="<?=base_url()?>userguide/createguide">Create a New Guide</a></p>

<?php foreach($all_guides as $row): ?>


<a href="<?=base_url()?>userguide/viewguide/<?=$row['user_guide_id']?>"><?=$row['title']?></a><br/>


<?php endforeach; ?>

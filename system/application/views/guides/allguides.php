<h2>All Guides</h2>

<p><a href="<?=base_url()?>userguide/createguide">Create a New Guide</a></p>

<?php foreach($all_guides as $row): ?>


<div style="float:left; width:380px; border:1px solid #dddddd; margin:5px; background:#dddddd; padding:3px;">
    <div style="float:left; padding-right:5px;"><img width="50px" src="http://img.youtube.com/vi/<?=$row['filename']?>/0.jpg"/></div> <a href="<?=base_url()?>userguide/viewguide/<?=$row['user_guide_id']?>"><?=$row['title']?></a><br/>
</div>

<?php endforeach; ?>

<h2>All Guides</h2>

<p><a href="<?=base_url()?>userguide/createguide">Create a New Guide</a></p>

<?php foreach($all_guides as $row): ?>

<?=form_open(base_url().'userguide/delete_userguide/'.$row['user_guide_id'], "id='delform_".$row['user_guide_id']."'")?>

<div style="float:left; width:380px; border:1px solid #dddddd; margin:5px; background:#dddddd; padding:3px;">
    <div style="float:left; padding-right:5px;"><img width="50px" src="http://img.youtube.com/vi/<?=$row['filename']?>/0.jpg"/></div> <?=$row['title']?><br/>
    <a href="<?=base_url()?>userguide/viewguide/<?=$row['user_guide_id']?>">edit</a>
    <?=form_hidden('guide_id', $row['user_guide_id'])?>
<a href="#" onclick="$(this).parents('form').submit(); return false;">Delete</a>

</div>
<?=form_close()?>

<?php endforeach; ?>

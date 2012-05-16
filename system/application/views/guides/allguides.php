<script type="text/javascript">
    
    <!--
    function confirmation(id) {
        var answer = confirm("Are you sure you want to delete this?")
        if (answer){
		
            $.post("/userguide/delete_userguide/", {guide_id: id},
          
            function(data) {
      
                alert("Guide Deleted");
                location.reload();
      
            }    
        );
              
	
	
        }
        else{
            alert("Nothing deleted!")
        }
    }
    //-->

</script>
<h1>All Guides</h1>



<p><a href="<?= base_url() ?>userguide/createguide">Create a New Guide</a></p>

<?php foreach($categories as $row2):?>
<h2><?=$row2['guide_cat']?></h2>

<?php foreach ($all_guides as $row): ?>

<?php if($row2['guide_cat_id'] == $row['guide_category']) { ?>
    <?= form_open(base_url() . 'userguide/delete_userguide/' . $row['user_guide_id'], "name='delform_" . $row['user_guide_id'] . "'") ?>

    <div style="float:left; width:380px; border:1px solid #dddddd; margin:5px; background:#dddddd; padding:3px;">
        <div style="float:left; padding-right:5px;"><img width="50px" src="http://img.youtube.com/vi/<?= $row['filename'] ?>/0.jpg"/></div> <?= $row['title'] ?><br/>
        <a href="<?= base_url() ?>userguide/viewguide/<?= $row['user_guide_id'] ?>">edit</a>
        <?= form_hidden('guide_id', $row['user_guide_id']) ?>

        <a href="#" onclick="confirmation(<?= $row['user_guide_id'] ?>)" onclick="">Delete</a>


    </div>
    <?= form_close() ?>
<?php }?>
<?php endforeach; ?>


<?php endforeach;?>




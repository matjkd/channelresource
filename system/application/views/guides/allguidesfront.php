<style>

    .cat_head {
        background:#4C585B;
        width:781px;
        margin: 0 2px 2px; 
        padding-bottom:3px;
        clear:both;
    }
    .cat_head h2 {
        color:#fff;
        padding-left:10px;
    }
    .guideItems {
        float:left; 
        width:380px;
        border:1px solid #dddddd;
        margin-right:2px; margin-left:2px; 
        margin-bottom:5px;
        background:#dddddd;
        padding:3px;
    }
    
    .guideList {
        display:none;
    }
</style>

<script type="text/javascript">
    
    $(document).ready(function() {
        
        
        $(".cat_head").hover(
        function(){
            $(this).stop(true).animate({
                backgroundColor:"#bdc4c6",
                color: "#000"
            },150)
        },
            function(){
                $(this).stop(true).animate({
                    backgroundColor:"#4C585B"
                }, 150)
            
        });
            
            
        $(".cat_head").click(
        function(){
            if( $(this).next().is(":visible")) {
                $(this).next().slideUp(500);     
            } else {
                $(".guideList").slideUp(500);       
                $(this).next().slideDown(500);    
            }
        });
    
    });

</script>

<h1>All Guides</h1>



<?php foreach ($categories as $row2): ?>
    <div class="cat_head" >
        <h2><?= $row2['guide_cat'] ?></h2>
    </div>
    <div  class="guideList" >
        <?php foreach ($all_guides as $row): ?>

            <?php if ($row2['guide_cat_id'] == $row['guide_category']) { ?>


                <div  class="guideItems">
                    <a href="<?= base_url() ?>userguide/viewguide/<?= $row['user_guide_id'] ?>"> <?= $row['title'] ?></a>






                </div>


            <?php } ?>

        <?php endforeach; ?>

    </div>

<?php endforeach; ?>








<?php foreach($news as $news):?>
<?php

	$old_date = strtotime($news['date_added']);
	$new_date = date('l jS \of F Y', $old_date);
$day = date('j', $old_date);
$month = date('M', $old_date);
?>
<div class="news_date"><?=$day?><br/>
    <?=$month?>
</div>
<p><h2>
<?=$news['news_title'];?> <?php if(isset($edit))
{
	echo "  <a  style='float:right;' href='".base_url()."admin/editnews/".$news['news_id']."'><img width='16px' height='16px' alt='edit' src='".base_url()."images/icons/social/edit_16.png'></a>";
}
?>
</h2>


</p>
<?php
$content = str_replace('[readmore]', '', $news['news_content']);

echo $content;
?>
<div class="social-single">


<div id="twitterbutton">
    <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="leasedeskdotcom">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>



<!-- Place this tag where you want the +1 button to render -->
<div  style="float:left;" class="g-plusone" data-size="medium" href="<?=base_url()?>news/post/<?=$news['news_id']?>"></div>

    <div id="likebutton">
    <fb:like href="<?=base_url()?>news/post/<?=$news['news_id']?>" send="false" layout="button_count" width="0" height="20" show_faces="false" font=""></fb:like>
</div>
</div>
<div style="clear:both"></div>



<?php endforeach; ?>



<div id="body_container">
    <div class="gap">&nbsp;</div>

<h2>Latest Videos</h2>
<br/>
<!-- "previous page" action -->
<a class="prev browse left"><</a>

<!-- root element for scrollable -->
<div class="scrollable">   
   
   <!-- root element for the items -->
   <div class="items">
   <?php $count = 1; ?>
      <!-- 1-5 -->
      <?php foreach($recent_guides as $row): ?>
      
      <?php if($count == 1) { echo "<div>"; } ?>
          
          
          <div class="scrollitem">
              
              <a href="<?=base_url()?>userguide/viewguide/<?=$row['user_guide_id']?>"><img src="http://img.youtube.com/vi/<?=$row['filename']?>/0.jpg" title="<?=$row['title']?>" /></a>
         
          </div>
            
    
       <?php if($count == 4) { echo "</div>"; } ?>
      <?php $count = $count+1; ?>
      <?php endforeach; ?>
    
   </div>
   
</div>

<!-- "next page" action -->
<a class="next browse right">></a>
</div>



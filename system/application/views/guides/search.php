<script type="text/javascript">        
    
$(function() {
    var availableTags = [<?php $this->load->view('ajax/json_tags');?>];
         $( "#search" ).autocomplete({
            source: availableTags,
            minLength: 2
        });
    });
    </script>
    <div id="searchbox">   
       
<?=form_open('userguide/search_guides')?>
<label for="searchterm"><h2>What do you want to do?</h2></label>


                            <input  type="text" name="searchterm" id="search" />
                            
                         <input type="submit" id="searchbutton" name="mysubmit" value="Search!" />
                         
                            
<?=form_close()?>
                            

    </div>
    
    <?=$this->load->view('global/searchmessage')?>
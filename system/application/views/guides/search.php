<script type="text/javascript">        
    
$(function() {
    var availableTags = [<?php $this->load->view('ajax/json_tags');?>];
         $( "#search" ).autocomplete({
            source: availableTags,
            minLength: 2
        });
    });
    </script>
<?=form_open('userguide/search_guides')?>
<label for="searchterm">What do you want to do?</label>


                            <input  type="text" name="searchterm" id="search" />
                            <?=form_submit('submit', 'Search')?>
                            
<?=form_close()?>
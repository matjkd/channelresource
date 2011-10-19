<script type="text/javascript">        
    
$(function() {
         $( "#search" ).autocomplete({
            source: function(request, response) {
                $.ajax({
                  url: "/datasource/json_tags",
                  data: { term: $("#search").val()},
                  dataType: "json",
                  type: "POST",
                  success: function(data){
                  response(data);
                  }
                });
              },
            minLength: 2
        });
    });
    </script>
<?=form_open('userguide/search_guides')?>
<label for="searchterm">What do you want to do?</label>


                            <input  type="text" name="searchterm" id="search" />
                            <?=form_submit('submit', 'Search')?>
                            
<?=form_close()?>
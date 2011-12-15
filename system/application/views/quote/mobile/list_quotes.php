<script type="text/javascript">
    $(document).ready(function(){
        var num_messages = <?= $num_messages ?>;
        var loaded_messages = 0;
        $("#more_button").click(function(){
            loaded_messages += 10;
            $.get("<?= base_url() ?>mobile/more_quotes/" + loaded_messages, function(data){
                $("#main_list").append(data);
 
            });
 
            if(loaded_messages >= num_messages - 10)
            {
                $("#more_button").hide();
                //alert('hide');
            }
            
        })
    })
</script>

<form action="<?=base_url()?>mobile/search_quotes" method="post" data-ajax="false">
    <label for="search-basic">Search Input:</label>
    <input type="search" name="search" id="searc-basic" value="" />
<div data-theme="c" class="ui-btn ui-btn-up-c ui-btn-corner-all ui-shadow" aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all" aria-hidden="true"><span class="ui-btn-text">Search
	
	
	</span></span><button type="submit" class="ui-btn-hidden" aria-disabled="false">Search
	
	
	</button></div>
    <br/>
</form>
<div >       
    <ul data-role="listview" id="main_list" data-split-icon="gear" data-split-theme="d" data-filter="true">

        <?php
        foreach ($quote_list as $key => $row):


            $old_date_added = strtotime($row['date_added']);
            $new_date_added = date('l jS \of F Y h:i:s A', $old_date_added);
            ?>



            <li><a href="<?= base_url() ?>mobile/view_quote_results/<?= $row['quote_id'] ?>" data-ajax="false">
                    <p><strong>Ref:</strong> <?= $row['quote_ref'] ?></p>

                    <?php if ($this->session->userdata('user_id') < 3) { ?>
                        <p><strong>Assigned to:</strong> <?= $row['fname'] ?> <?= $row['lname'] ?></p>
                    <?php } ?>

                    <p><strong>Added By:</strong><?= $row['firstname'] ?> <?= $row['lastname'] ?></p>
                    <p><?= $new_date_added ?></p>
                </a>
            </li>


        <?php endforeach; ?>


    </ul>
</div>

<br/>
<?php if(isset($more) && $more == "true") { ?>
<div style="clear:both;" id="more_button" data-role="button" data-icon="arrow-d">
    more
</div>
<?php } ?>
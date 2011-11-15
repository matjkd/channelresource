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
<div style="clear:both;" id="more_button" data-role="button" data-icon="arrow-d">
    more
</div>
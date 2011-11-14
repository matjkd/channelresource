
<?php
    foreach ($quote_list as $key => $row):


        $old_date_added = strtotime($row['date_added']);
        $new_date_added = date('l jS \of F Y h:i:s A', $old_date_added);
        ?>


                                
                                
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c"><div class="ui-btn-inner ui-li" aria-hidden="true"><div class="ui-btn-text">
            <a href="<?= base_url() ?>mobile/view_quote_results/<?= $row['quote_id'] ?>" data-ajax="false" class="ui-link-inherit">
                <p class="ui-li-desc"><strong>Ref:</strong> <?= $row['quote_ref'] ?></p>
                <p class="ui-li-desc"><strong>Assigned to:</strong> <?= $row['fname'] ?> <?= $row['lname'] ?></p>
                <p class="ui-li-desc"><strong>Added By:</strong><?= $row['firstname'] ?> <?= $row['lastname'] ?></p>
                <p class="ui-li-desc"><?= $new_date_added ?></p>
            </a>
           </div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div></li>


    <?php endforeach; ?>


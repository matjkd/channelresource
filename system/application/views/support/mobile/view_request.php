<div data-role="collapsible" data-content-theme="c">
    <h3>Add Note</h3>
    <form action="<?=base_url()?>mobilesupport/addnote" method="post" data-role="fieldcontain"  data-ajax="false">
        <input type="hidden" name="supportid" value="<?=$support_id?>"/>
        <div data-theme="b"   aria-disabled="false">
            <label for="comment">Note:</label>
            <textarea name="comment" id="comment" value="" placeholder="Add a new note here"></textarea>
        </div>

        <div data-theme="b" class="ui-btn ui-btn-corner-all ui-shadow ui-btn-up-b" aria-disabled="false">

            <span class="ui-btn-inner ui-btn-corner-all" aria-hidden="true">
                <span class="ui-btn-text">Submit</span>

            </span><button type="submit" data-theme="b" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Submit</button>
        </div>
    </form>

</div>
<ul data-role="listview" data-inset="true">

    <li data-role="list-divider">
        Support Request ID: <?= $support_id ?> - <?= $support_status ?>
    </li>
    <li>Priority:<p class="ui-li-aside"><strong> <?= $support_priority ?></strong></p></li>
    <li>Issue:<p class="ui-li-aside"><strong> <?= $support_issue ?></strong></p></li>
    <li>Subject:<p class="ui-li-aside"><strong> <?= $support_subject ?></strong></p></li>
    <li>Company:<p class="ui-li-aside"><strong> <?= $channel_partner_name ?></strong></p></li>
    <li>Telephone:<p class="ui-li-aside"><strong> <?= $telephone ?></strong></p></li>
    <li>Email:<p class="ui-li-aside"><a href="mailto:<?= $email_address ?>" ><?= $email_address ?></a></p></li>
    <li>Support Type:<p class="ui-li-aside"><strong> <?= $support_type ?></strong></p></li>

    <li data-role="list-divider">
        Description
    </li>
    <li><?= $support_description ?></li>
</ul>


<ul data-role="listview" data-inset="true">

    <?php
    $previoustime = "none";
    foreach ($comments as $key => $row):
        ?>
        <?php
        //convert date to readable date and readbale time
        $old_date_added = strtotime($row['date_added']);
        $new_date_added = date('l jS \of F Y', $old_date_added);
        $time = date('H:i', $old_date_added);
        ?>

        <?php if ($new_date_added != $previoustime) { ?>
            <li data-role="list-divider">




                <?= $new_date_added ?>
            </li>
        <?php } ?>


        <li><h3>    <?= $row['firstname'] ?> <?= $row['lastname'] ?></h3>

            <?= form_prep($row['comment']) ?>
            <p class="ui-li-aside"><strong><?= $time ?></strong></p>
        </li>
        <?php
        $previoustime = $new_date_added;

    endforeach;
    ?>
</ul>
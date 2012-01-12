
<ul data-role="listview" data-inset="true">

    <li data-role="list-divider">
        Support Request ID: <?= $support_id ?> - <?= $support_status ?>
    </li>
    <li>Priority:<p class="ui-li-aside"><strong> <?= $support_priority ?></strong></p></li>
    <li>Subject:<p class="ui-li-aside"><strong> <?= $support_subject ?></strong></p></li>
    <li>Company:<p class="ui-li-aside"><strong> <?= $channel_partner_name ?></strong></p></li>
    <li>Telephone:<p class="ui-li-aside"><strong> <?= $telephone ?></strong></p></li>
    <li>Email:<p class="ui-li-aside"><strong> <?= $email_address ?></strong></p></li>
    <li>Support Type:<p class="ui-li-aside"><strong> <?= $support_type ?></strong></p></li>
    <li>Priority:<p class="ui-li-aside"><strong> <?= $support_priority ?></strong></p></li>
    <li data-role="list-divider">
        Description
    </li>
    <li><p><?= $support_description ?></p></li>
</ul>


<ul data-role="listview" data-inset="true">

    <li data-role="list-divider">
       Notes
    </li>
    <li>Note:<p class="ui-li-aside">added by blah</p><br/>text</li>
  
</ul>
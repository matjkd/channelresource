<?php foreach ($supportRequest as $row): ?>
    <?php foreach ($supportRequestLog as $row2): ?>
        <?php if ($row['assignedfirstname'] != NULL && $row['assignedID'] != $row['userID']) { ?>
            <p>The following Support Request has been updated by  <?= $row['updatedbyfirstname'] ?> <?= $row['updatedbylastname'] ?> </p>

        <?php } else { ?>
            <p>The following Support Request has been updated by  <?= $row['updatedbyfirstname'] ?> <?= $row['updatedbylastname'] ?></p>
        <?php } ?>                     
        <p>

        <h4> Support Request <?= $row['support_id'] ?></h4>

        <strong>Subject:</strong><?= $row['support_subject'] ?> <?php if($row['support_subject'] != $row2['support_subject']) { echo "(changed from ".$row2['support_subject'].")"; }?><br/><br/>

        <strong>Company: </strong> <?= $row['company_name'] ?> <?php if($row['company_name'] != $row2['company_name']) { echo "(changed from ".$row2['company_name'].")"; }?><br/><br/>

        <strong>Customer Tel:</strong>  <?= $row['telephone'] ?> 	<?php if($row['telephone'] != $row2['telephone']) { echo "(changed from ".$row2['telephone'].")"; }?><br/><br/>


        <strong>Description: </strong><?= $row['support_description'] ?> <?php if($row['support_description'] != $row2['support_description']) { echo "(changed from ".$row2['support_description'].")"; }?><br/><br/>

        <strong>Support Type:</strong> <?= $support_type ?> <?php if($support_type != $support_typeLog) { echo "(changed from ".$support_typeLog.")"; }?><br/><br/>

        <strong>Support Issue:</strong> <?= $support_issue ?> <?php if($support_issue != $support_issueLog) { echo "(changed from ".$support_issueLog.")"; }?><br/><br/>

        <strong>Priority: </strong><?= $support_priority ?> <?php if($support_priority != $support_priorityLog) { echo "(changed from ".$support_priorityLog.")"; }?><br/><br/>
        
         <strong>Status: </strong><?= $support_status ?> <?php if($support_status != $support_statusLog) { echo "(changed from ".$support_statusLog.")"; }?><br/><br/>

        <br/>
        Originally added by <?= $row['userfirstname'] ?> <?= $row['userlastname'] ?>


        </p>

    <?php endforeach; ?>
<?php endforeach; ?>
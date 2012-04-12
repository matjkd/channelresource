<?php foreach ($supportRequest as $row): ?>
    <?php foreach ($supportRequestLog as $row2): ?>
        <?php if ($row['assignedfirstname'] != NULL && $row['assignedID'] != $row['userID']) { ?>
            <p>The following Support Request has been updated by  <?= $row['updatedbyfirstname'] ?> <?= $row['updatedbylastname'] ?> 
                on behalf of <?= $row['assignedfirstname'] ?> <?= $row['assignedlastname'] ?></p>
        <?php } else { ?>
            <p>The following Support Request has been updated by  <?= $row['updatedbyfirstname'] ?> <?= $row['updatedbylastname'] ?></p>
        <?php } ?>                     
        <p>

        <h4> Support Request <?= $row['support_id'] ?></h4>

        <strong>Subject:</strong><?= $row['support_subject'] ?> <?php if($row['support_subject'] != $row2['support_subject']) { echo "changed from".$row2['support_subject']; }?><br/><br/>

        <strong>Company: </strong> <?= $row['company_name'] ?> <br/><br/>

        <strong>Customer Tel:</strong>  <?= $row['telephone'] ?> 	<br/><br/>


        <strong>Description: </strong><?= $row['support_description'] ?><br/><br/>

        <strong>Support Type:</strong> <?= $support_type ?><br/><br/>

        <strong>Support Issue:</strong> <?= $support_issue ?><br/><br/>

        <strong>Priority: </strong><?= $support_priority ?><br/><br/>

        <br/>
        Originally added by <?= $row['userfirstname'] ?> <?= $row['userlastname'] ?>


        </p>

    <?php endforeach; ?>
<?php endforeach; ?>
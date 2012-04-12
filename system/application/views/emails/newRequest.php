<?php foreach ($supportRequest as $row): ?>

    <?php if ($row['assignedfirstname'] != NULL && $row['assignedID'] != $row['userID']) { ?>
        <p>The following Support Request has been logged by <?= $row['userfirstname'] ?> <?= $row['userlastname'] ?> at 
            <?= $row['company_name'] ?> on behalf of <?= $row['assignedfirstname'] ?> <?= $row['assignedlastname'] ?></p>
    <?php } else { ?>
        <p>The following Support Request has been logged by  <?= $row['userfirstname'] ?> <?= $row['userlastname'] ?></p>
    <?php } ?>                     
    <p>

    <h4> Support Request <?= $row['support_id'] ?></h4>

        <strong>Subject:</strong> <?= $row['support_subject'] ?><br/><br/>

        <strong>Company: </strong> <?= $row['company_name'] ?> <br/><br/>

        <strong>Customer Tel:</strong>  <?= $row['telephone'] ?> 	<br/><br/>


        <strong>Description: </strong><?= $row['support_description'] ?><br/><br/>

        <strong>Support Type:</strong> <?=$support_type?><br/><br/>

        <strong>Support Issue:</strong> <?=$support_issue?><br/><br/>

        <strong>Priority: </strong><?=$support_priority?><br/><br/>


    </p>

<?php endforeach; ?>

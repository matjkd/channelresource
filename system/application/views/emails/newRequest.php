<?php foreach ($supportRequest as $row): ?>

    <?php if ($row['assignedfirstname'] != NULL) { ?>
        <p>The following Support Request has been logged by <?= $row['userfirstname'] ?> <?= $row['userlastname'] ?> at 
            <?= $row['company_name'] ?> on behalf of <?= $row['assignedfirstname'] ?> <?= $row['assignedlastname'] ?></p>
    <?php } else { ?>
        <p>The following Support Request has been logged by  <?= $row['userfirstname'] ?> <?= $row['userlastname'] ?></p>
    <?php } ?>                     
    <p>

    <h4> Support Request <?= $row['support_id'] ?></h4>

        <strong>Subject:</strong> <?= $row['support_subject'] ?><br/>

        <strong>Company: </strong> <?= $row['company_name'] ?> <br/>

        <strong>Customer Tel:</strong>  <?= $row['telephone'] ?> 	<br/>


        <strong>Description: </strong><?= $row['support_description'] ?><br/>

        <strong>Support Type:</strong> <?=$support_type?><br/>

        <strong>Support Issue:</strong> <?=$support_issue?><br/>

        <strong>Priority: </strong><?=$support_priority?><br/>


    </p>

<?php endforeach; ?>

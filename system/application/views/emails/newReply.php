<?php foreach ($supportReply as $row): ?>


        <p> Support Request <?= $row['support_id'] ?> has been replied to by <?= $row['firstname'] ?> <?= $row['lastname'] ?> of <?= $row['userCompanyName'] ?></p>
                 
    <p>

  
                        
<strong>Support Request:</strong> <?= $row['support_id'] ?>      <br/>                 
                        
<strong>Subject:</strong> <?= $row['support_subject'] ?><br/>
                        
                        
<strong>Company:</strong> <?= $row['supportCompanyName'] ?><br/>
                        
                        
<strong>Reply:</strong>  <?= $row['comment'] ?><br/>


    </p>

<?php endforeach; ?>

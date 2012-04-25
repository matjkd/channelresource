<?php foreach ($supportReply as $row): ?>


        <p> Support Request <?= $row['support_id'] ?> has been replied to by <?= $row['firstname'] ?> <?= $row['lastname'] ?> of <?= $row['userCompanyName'] ?></p>
                 
    <p>

  
                        
<strong>Support Request:</strong> <?= $row['support_id'] ?>      <br/> <br/>                  
                        
<strong>Subject:</strong> <?= $row['support_subject'] ?><br/> <br/> 
                        
                        
<strong>Company:</strong> <?= $row['supportCompanyName'] ?><br/> <br/> 
                        
                        
<strong>Reply:</strong>  <?= $row['comment'] ?><br/> <br/> 


    </p>

<?php endforeach; ?>

<?php foreach($supportRequest as $row): ?>

The following Support Request has been created by $ticket_added_by at $added_by_company_name
                        
Support Request <?=$row['support_id']?>
                        
Subject: <?=$row['support_subject']?>

Company: $company_name

Customer Tel: $telephone	
	

Description: <?=$row['support_description']?>
                        
Support Type: $support_type1
                        
Support Issue: $support_issue1

Priority: $support_priority1


<?php endforeach; ?>

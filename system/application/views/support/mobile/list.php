<div >       
    <ul data-role="listview" id="main_list" data-split-icon="gear" data-split-theme="d" data-filter="true">

        <?php
        if(isset($ticket_list)) {
        foreach ($ticket_list as $key => $row):

            if (($row['support_type']) == 1) {
                $type = "Lease-Desk.com";
            }
            if (($row['support_type']) == 2) {
                $type = "Channel-Resource";
            }
            if (($row['support_type']) == 3) {
                $type = "Customer-Resource";
            }
            if (($row['support_type']) == 4) {
                $type = "Training";
            }
            if (($row['support_type']) == 5) {
                $type = "Account Review";
            }



            if (($row['support_priority']) == 1) {
                $priority = "1.<span style='color:red;'>URGENT</span>";
            }
            if (($row['support_priority']) == 2) {
                $priority = "2.High";
            }
            if (($row['support_priority']) == 3) {
                $priority = "3.Medium";
            }
            if (($row['support_priority']) == 4) {
                $priority = "4.Low";
            }
            if (($row['support_priority']) == 5) {
                $priority = "5.Closed";
            }

            //   $statusarray = array(1 => 'Submitted', 4 => 'Accepted', 2 => 'Assigned', 5 => 'Awaiting Customer', 6=> 'Resolved', 7=> 'Development', 3 => 'CLOSED');

            if (($row['support_status']) == 1) {
                $status = "Submitted";
            }
            if (($row['support_status']) == "Submitted") {
                $status = "Submitted";
            }
            if (($row['support_status']) == 2) {
                $status = "Assigned";
            }
            if (($row['support_status']) == 3) {
                $status = "Closed";
            }

            if (($row['support_status']) == 4) {
                $status = "Accepted";
            }

            if (($row['support_status']) == 5) {
                $status = "Awaiting Customer";
            }

            if (($row['support_status']) == 6) {
                $status = "Resolved";
            }

            if (($row['support_status']) == 7) {
                $status = "Development";
            }

            $old_date_added = strtotime($row['date_added']);
            $new_date_added = date('l jS \of F Y h:i:s A', $old_date_added);
            ?>



            <li><a href="<?= base_url() ?>mobilesupport/view_support_request/<?= $row['support_id'] ?>" data-ajax="false">
                    <p><?= $priority ?></p>
                    <p><strong>Ref:</strong> <?= $row['support_id'] ?></p>


                    <p><strong>Subject:</strong> <?= $row['support_subject'] ?></p>
                    <p><strong>Company:</strong> <?= $row['company_name'] ?></p>
                    <p><strong>Type:</strong> <?= $type ?></p>
                    <p><strong>Status:</strong> <?= $status ?></p>

                    <p><?= $new_date_added ?></p>
                </a>
            </li>



        <?php endforeach; ?>
            
            <?php } else {?>
No Requests to display
<?php } ?>
    </ul>
</div>
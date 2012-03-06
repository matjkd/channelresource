<div  style="padding-bottom: 10px;">       
    <ul data-role="listview" id="main_list" data-split-icon="gear" data-split-theme="d" data-filter="true">

        <?php
        $priority = "";
        $type = "";

        $order = "";
        if (isset($ticket_list)) {
            foreach ($ticket_list as $key => $row):

                foreach ($areas as $statusrow):

                    if (($row['support_type']) == $statusrow['status_value']) {
                        $type = $statusrow['status_name'];
                    }
                endforeach;


                foreach ($prioritylist as $statusrow):

                    if (($row['support_priority']) == $statusrow['status_value']) {
                        $priority = $statusrow['status_name'];
                        $order = $statusrow['status_value'];
                    }
                    if ($statusrow['status_value'] == 1) {
                        $priority = "<span  style='color:red;'>" . $priority . "</span>";
                    } else if ($statusrow['status_value'] != 1) {
                        $priority = "<span  style='color:#000000;'>" . $priority . "</span>";
                    }
                endforeach;


                foreach ($statuslist as $statusrow):

                    if (($row['support_status']) == $statusrow['status_value']) {
                        $status = $statusrow['status_name'];
                    }
                endforeach;
                if (!isset($status)) {
                    $status = "Submitted.";
                }

                $old_date_added = strtotime($row['date_added']);
                $new_date_added = date('l jS \of F Y H:i:s', $old_date_added);


                if ($row['completion_date'] != "0000-00-00" && $row['completion_date'] != "") {
                    $old_completion_date = strtotime($row['completion_date']);
                    $new_completion_date = date('l jS \of F Y', $old_completion_date);
                } else {
                    $new_completion_date = "N/A";
                }
                ?>



                <li><a href="<?= base_url() ?>mobilesupport/view_support_request/<?= $row['support_id'] ?>" data-ajax="false">
                        <p><?= $priority ?></p>
                        <p><strong>Ref:</strong> <?= $row['support_id'] ?></p>


                        <p><strong>Subject:</strong> <?= $row['support_subject'] ?></p>
                        <p><strong>Company:</strong> <?= $row['company_name'] ?></p>
                        <p><strong>Type:</strong> <?= $type ?></p>
                        <p><strong>Status:</strong> <?= $status ?></p>
                        <p><strong>Estimated Completion Date:</strong> <?= $new_completion_date ?></p>

                        <p><?= $new_date_added ?></p>
                    </a>
                </li>



            <?php endforeach; ?>

        <?php } else { ?>
            No Requests to display
        <?php } ?>
    </ul>
</div>
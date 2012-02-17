<h2>Closed Tickets</h2>

<table id="closed_table"  width="100%" style="clear:both;">
    <thead>
        <tr>
            <th>Priority</th>
            <th>ID</th>
            <th>Subject</th>
            <th>Company</th>
            <th>Re:</th>
            <th>Updated</th>
            <th>Status</th>
            <th>Added By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $user = $this->session->userdata('user_id');
        $priority = "";
        $type = "";
        $status = "";
        if ($closed_ticket_list == NULL) {
            
        } else {
            foreach ($closed_ticket_list as $key => $row):


                foreach ($areas as $statusrow):

                    if (($row['support_type']) == $statusrow['status_value']) {
                        $type = $statusrow['status_name'];
                    }
                endforeach;


                foreach ($prioritylist as $statusrow):

                    if (($row['support_priority']) == $statusrow['status_value']) {
                        $priority = $statusrow['status_name'];
                    }
                    if ($statusrow['status_value'] == 1) {
                        $priority = "<span style='color:red;'>" . $priority . "</span>";
                    } else if ($statusrow['status_value'] != 1) {
                        $priority = "<span style='color:black;'>" . $priority . "</span>";
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




                $viewticket = '/support/results/' . $row['support_id'];
                ?>
                <tr >
                    <td style="padding:5px;"><?= $priority ?></td>
                    <td style="padding:5px;"><?= $row['support_id'] ?></td>
                    <td style="padding:5px;"><?= $row['support_subject'] ?></td>
                    <td style="padding:5px;"><?= $row['company_name'] ?></td>
                    <td style="padding:5px;"><?= $type ?></td>
                    <td style="padding:5px;"><?= $row['date_updated'] ?></td>
                    <td style="padding:5px;"><?= $status ?></td>
                    <td style="padding:5px;"><?= $row['firstname'] ?> <?= $row['lastname'] ?></td>
                    <td style="padding:5px;"><?= "<a href=$viewticket>View</a> | <a href='#' onclick='confirmation(" . $row['support_id'] . ")'>Delete</a>" ?></td>
                </tr>
                <?php
            endforeach;
        }
        ?>
    </tbody>
</table>
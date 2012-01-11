<script type="text/javascript">
    $(document).ready(function() {
        $('#support_table').dataTable({
            "bStateSave": false,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"

        });
    } );



    function confirmation(id) {
        var answer = confirm("Are you sure you want to delete this ticket?")
        if (answer){

            window.location = "/support/delete_ticket/"+ id;
        }
        else{
            alert("nothing deleted!")
        }
    }
</script>
<h2>Current Requests</h2>

<table id="support_table"  width="100%" style="clear:both;">
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

        if ($ticket_list == NULL) {
            
        } else {
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
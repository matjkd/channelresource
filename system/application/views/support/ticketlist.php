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


                foreach ($areas as $statusrow):

                    if (($row['support_type']) == $statusrow['status_value']) {
                        $type = $statusrow['status_name'];
                    }
                endforeach;


                   foreach ($prioritylist as $statusrow):

                    if (($row['support_priority']) == $statusrow['status_value']) {
                        $priority = $statusrow['status_value'].".".$statusrow['status_name'];
                    }
                    if($statusrow['status_value'] == 1) {
                        $priority = "<span style='color:red;'>".$priority."</span>";
                    } else if($statusrow['status_value'] != 1) {
                         $priority = "<span style='color:black;'>".$priority."</span>";
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
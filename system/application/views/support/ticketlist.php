<script type="text/javascript">
    $(document).ready(function() {
        $('#support_table').dataTable({
            "bStateSave": false,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
              "aaSorting": [[ 0, "asc" ]],
              "aoColumnDefs": [ 
						{ "bSearchable": false, "bVisible": false, "aTargets": [ 0 ] }
					]
           

        });
    } );

    $(document).ready(function() {
        $('#closed_table').dataTable({
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
            <th>Order</th>
            <th>Priority</th>
            <th>ID</th>
            <th>Subject</th>
            <th>Company</th>
            <th>Re:</th>
            <th>Updated</th>
             <th>Estimated Completion Date</th>
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
       
        $order = "";
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

if($row['completion_date'] != "0000-00-00" && $row['completion_date'] != "") {
  $old_completion_date  = strtotime($row['completion_date']);
                $new_completion_date = date('l jS \of F Y', $old_completion_date);
} else {
    $new_completion_date = "N/A";
}

                $viewticket = '/support/results/' . $row['support_id'];
                ?>
                <tr >
                    <td style="padding:5px;"><?= $order ?></td>
                    <td style="padding:5px;"><?= $priority ?></td>
                    <td style="padding:5px;"><?= $row['support_id'] ?></td>
                    <td style="padding:5px;"><?= $row['support_subject'] ?></td>
                    <td style="padding:5px;"><?= $row['company_name'] ?></td>
                    <td style="padding:5px;"><?= $type ?></td>
                    <td style="padding:5px;"><?= $row['date_updated'] ?></td>
                    <td style="padding:5px;"><span style="display:none"><?=$row['completion_date']?></span><?= $new_completion_date ?></td>
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
<div style="clear:both; margin-top:20px;">
<?=$this->load->view('support/closedtickets')?>
</div>
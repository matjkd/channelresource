
<script src="<?= base_url() ?>js/tables/tables.js" type="text/javascript"></script>

<script type="text/javascript">

    function confirmation(id) {
        var answer = confirm("Are you sure you want to delete this quote?")
        if (answer){
		
            window.location = "/quote/delete_quote/"+ id;
        }
        else{
            alert("nothing deleted!")
        }
    }
 
</script>

<?php
$user = $this->session->userdata('user_id');
?>










<table id="table_id"  width="100%" style="clear:both;">
    <thead>
        <tr>
            <th>Reference</th>

            <th>Date Changed</th>
            <th>Added By</th>
            <th>Assigned To</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($quote_list as $key => $row):

            $viewquote = '/quote/results/' . $row['quote_id'];
            $deletequote = '/quote/delete/' . $row['quote_id'];
            $pdfquote = '/quote/results/' . $row['quote_id'] . '/pdf';

            if (isset($row['aemail'])) {
                $assigned_email_address = $row['aemail'];
            }
            else {
                $assigned_email_address = '';
            }

            if ($row['date_updated'] == NULL) {
                $date_updated = $row['date_added'];
            } else {
                $date_updated = $row['date_updated'];
            }

            $old_date_added = strtotime($date_updated);
            $new_date_added = date('l jS \of F Y h:i:s A', $old_date_added);
            ?>
            <tr >
                <td style="padding:5px;"><?= $row['quote_ref'] ?></td>

                <td style="padding:5px;"><div style="display:none;"><?= $row['date_added'] ?></div><?= $new_date_added ?></td>
                <td style="padding:5px;"><?= $row['firstname'] ?> <?= $row['lastname'] ?></td>
                <td style="padding:5px;">  <?php if (isset($row['lname'])) { ?><?= $row['fname'] ?> <?= $row['lname'] ?> <?php } else { ?> <?php } ?></td>
                <td style="padding:5px;" class="<?= $row['quote_id'] ?>"><?php echo "<a href=$viewquote>View</a> | <a href='#' onclick='confirmation(" . $row['quote_id'] . ")'>Delete</a> 
                        | <a href=$pdfquote>PDF</a>" ?> |

                    <span class="spanlink" onclick="emailpdftable2(<?= $row['quote_id'] ?>, '<?= $assigned_email_address ?>')" > Email</span></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="dialog-form2" title="Email PDF " >
    <p class="validateTips">All form fields are required.</p>

    <form>
        <fieldset>

            <label  for="email">Email</label><br/>

            <input type="text" name="email" id="emailtable" value="" class="text ui-widget-content ui-corner-all" />

        </fieldset>

        <fieldset>
            <label for="emessage">Message</label>
            <textarea  name="emessage" id="emessage" value="" class="text ui-widget-content ui-corner-all" /></textarea>
        </fieldset>

    </form>

    <div id="emailID" class="none"></div>
</div>



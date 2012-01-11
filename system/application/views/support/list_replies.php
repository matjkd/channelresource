<script type="text/javascript">
    $(document).ready(function() {
        $('#notesTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
            
        });
    } );
</script>

<div style="padding: 10px 0 0 0px;">

    <table cellpadding="0" cellspacing="0" border="0" class="display" id="notesTable">
        <thead>
            <tr>
                <th>date</th>
                <th>Added By</th>
                <th>Note</th>
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $key => $row): ?>


                <tr>
                    <td>
                        <?= $row['date_added'] ?>
                    </td>

                    <td>
                        <?= $row['firstname'] ?>
                    </td>

                    <td>
                        <?= $row['comment'] ?>
                    </td>

                    <td>
                        <?php if ($row['added_by'] == $this->session->userdata('user_id')) { ?><span class="spanlink" onclick="editNote(<?= $row['comment'] ?>,  <?= $row['comments_id'] ?>)">Edit</span> |  <span class="spanlink">Delete</span><?php } ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>


    </table>
</div>

<div id="dialog-note" title="Email PDF " >
    <p class="validateTips">All form fields are required.</p>

    <form>
        <fieldset>

          

            <input type="text" name="noteid" id="noteid" value="" class="text ui-widget-content ui-corner-all" />

        </fieldset>

        <fieldset>
            <label for="notecomment">Message</label>
            <textarea  name="notecomment" id="notecomment" value="" class="text ui-widget-content ui-corner-all" /></textarea>
        </fieldset>

    </form>
    
    <div id="emailID" class="none"></div>
</div>

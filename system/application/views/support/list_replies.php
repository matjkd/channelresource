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
                <th>Date</th>
                <th>Added By</th>
                <th>Note</th>
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $key => $row): ?>


                <tr id="row<?= $row['comments_id'] ?>">
                    <td>
                        <?= $row['date_added'] ?>
                    </td>

                    <td>
                        <?= $row['firstname'] ?>
                    </td>

                    <td id="comment<?= $row['comments_id'] ?>">
                        <?= $row['comment'] ?>
                    </td>

                    <td>
                        <?php if ($row['added_by'] == $this->session->userdata('user_id')) { ?>
                        <?php $commentupdated = str_replace('"', '\"', $row['comment']);?>
                        <span class="spanlink" onclick='editNote("<?=form_prep($commentupdated) ?>",  <?= $row['comments_id'] ?>)'>Edit</span> |  
                        <span class="spanlink" onclick="deleteNote(<?= $row['comments_id'] ?>)">Delete</span><?php } ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>


    </table>
</div>

<div id="dialog-note" title="Edit Note" >
    <p class="validateTips">All form fields are required.</p>

    <form>
        <fieldset>

          

            <input type="hidden" name="noteid" id="noteid" value="" class="text ui-widget-content ui-corner-all" />

        </fieldset>

        <fieldset>
            <label for="notecomment">Message</label>
            <textarea  name="notecomment" id="notecomment" value="" class="text ui-widget-content ui-corner-all" /></textarea>
        </fieldset>

    </form>
    
    <div id="emailID" class="none"></div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#notesTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
            
        });
    } );
</script>

<div style="padding: 0 0 0 0px;">

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
                        <?php if ($row['added_by'] == $this->session->userdata('user_id')) { ?><span class="spanlink">Edit</span> |  <span class="spanlink">Delete</span><?php } ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>


    </table>
</div>

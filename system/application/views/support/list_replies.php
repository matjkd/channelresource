<script type="text/javascript">
    $(document).ready(function() {
	$('#notesTable').dataTable();
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
        <?php foreach($comments as $key => $row):?>
          
       
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


 <?php
    foreach ($comments as $key => $row):

        if ($row['comment'] == NULL) {
            echo "There are no notes";
        } else {
            if ($row['added_by'] == $this->session->userdata('user_id')) {
                echo form_open('support/edit_reply/' . $row['support_id'] . '')
                ?>
                <hr>
                <em>Reply added by <?= $row['firstname'] ?>  - <?= $row['date_added'] ?> </em><br/>
                <textarea style="width:100%;" cols='150' rows='3'  name='comment'><?= $row['comment'] ?></textarea>

                <?= form_hidden('comments_id', $row['comments_id']) ?>
                <br/>
                <?= form_submit('submit', 'Edit Note') ?>
                <?= form_submit('submit', 'Delete') ?>
                <?= form_close() ?>
            <?php } else { ?>

                <hr><strong><em>added by <?= $row['firstname'] ?> - <?= $row['date_added'] ?>
                    </em></strong><br/>
                <?= $row['comment'] ?>
                    
                    
                    
                    
                <?php
            }
        }
    endforeach;
    ?>
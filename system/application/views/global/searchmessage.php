
<?php
if ($this->session->flashdata('searchmessage')) {
    ?>



    <div id="warningbox" class="ui-widget" style="padding-bottom:10px; width:370px;">
        <div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
                <span class='ui-icon ui-icon-alert' style='float:left; margin-top:0px; margin-right:.3em;'></span>
                <?= $this->session->flashdata('searchmessage') ?>


                <a href='#' onclick='javascript:this.parentNode.parentNode.parentNode.style.display="none"; return false;'>

                </a>
            </p>
        </div>
    </div>


<?php } ?>


<?php
if (isset($searchmessage)) {
    ?>



    <div id="warningbox" class="ui-widget" style="padding-bottom:10px; width:370px;">
        <div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
                <span class='ui-icon ui-icon-alert' style='float:left; margin-top:0px; margin-right:.3em;'></span>
    <?= $searchmessage ?>


                <a href='#' onclick='javascript:this.parentNode.parentNode.parentNode.style.display="none"; return false;'>

                </a>
            </p>
        </div>
    </div>


<?php } ?>

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function() { $('#warningbox').fadeOut(); }, 5000);
    });
</script>

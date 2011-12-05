



<div data-role="dialog" data-url="/demos/1.0/docs/pages/dialog.html" data-external-page="true" tabindex="0" class="ui-page ui-body-c ui-overlay-a ui-dialog ui-page-active" role="dialog" style="min-height: 867px; ">

    <div data-role="header" data-theme="d" class="ui-corner-top ui-overlay-shadow ui-header ui-bar-d" role="banner">

        <h1 class="ui-title" tabindex="0" role="heading" aria-level="1">Email PDF</h1>

    </div>

    <div data-role="content" data-theme="c" class="ui-overlay-shadow ui-corner-bottom ui-content ui-body-c" role="main">

        <form action="<?= base_url() ?>quote/results/<?= $quote_id ?>/email" method="post"  data-ajax="false">

            <p>Enter the email address below to send pdf</p>


            <label for="basic">Email address:</label>
            <input type="text" name="email" id="basic" value=""/>
  <input type="hidden" name="mobile" id="basic" value="1"/>
             
           <a href="docs-dialogs.html" data-role="button" data-rel="back" data-theme="c" class="ui-btn ui-btn-up-c ui-btn-corner-all ui-shadow"><span class="ui-btn-inner ui-btn-corner-all" aria-hidden="true"><span class="ui-btn-text">Cancel</span></span></a>    

        
           <div data-theme="b" class="ui-btn ui-btn-corner-all ui-shadow ui-btn-up-b" aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all" aria-hidden="true">
                   <span class="ui-btn-text">Send Email</span></span>
               <button type="submit" data-theme="b" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Send Email</button></div>
           
           

        </form>
    </div>
</div>


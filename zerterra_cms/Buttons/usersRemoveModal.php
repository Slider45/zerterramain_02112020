
<div id="delete<?php echo $id; ?>" class="modal" role="dialog">

<div class="modal-background"></div>
<div class="modal-card">
  <header class="modal-card-head">
    <p class="modal-card-title">REMOVE ACCOUNT</p>
    <button class="modal-close" aria-label="close"></button>
  </header>
<form method="POST" class="modal-card-body">

  <div class="field">
  <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
  </div>

   <div class="is-danger">Are you Sure you want Delete <strong>
                            "<?php echo $fname .' '.$lname;?>"?</strong> </div>
                <div class="modal-footer">
      </div>
  <div style = "margin-bottom: 10px; margin-top: 20px; margin-left: 400px; margin-right: auto;">
     <button  class="button is-success" name="acnt_remove">REMOVE</button>
      <button class="button is-danger">Cancel</button>
  </div>
</form>

</div>
</div>
</div>

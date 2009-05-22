<?php use_helper('Object'); ?>
<?php use_helper('Javascript') ?>
<div id="passForm">
<?php echo form_remote_tag(array(
    'update'   => 'errors',
    'url'      => 'users/changePasswordAjax',
    'script'   =>	true,
    'complete' => "hideModal()",
)); ?>
<fieldset>

    <div class="form-row">
        <label for="title">Current Password:</label>
        <INPUT TYPE=password NAME="currentPass" ID="currentPass" SIZE="15" MAXLENGTH="50">
    </div>

    <div class="form-row">
        <label for="make">New Password:</label>
       <INPUT TYPE=password NAME="password" ID="password" SIZE="15" MAXLENGTH="50">
    </div>

     <div class="form-row">
        <label for="make">Re-enter Password:</label>
       <INPUT TYPE=password NAME="vpassword" ID="vpassword" SIZE="15" MAXLENGTH="50">
    </div>

</fieldset>

<div class="submit-row">
    <?php echo submit_tag('Change Password') ?>
</div>
</form>
</div>
<div>
</div>
<div id="errors"></div>

<?php use_helper('Javascript') ?>

<div id="loginForm">
<?php echo form_remote_tag(array(
    'update'   => 'errors',
    'url'      => 'users/authenticate',
    'script'   =>	true,
    'complete' => "hideModal()",
)); ?>

  <fieldset>
  <div class="form-row">
    <label for="nickname">nickname:</label>
    <?php echo input_tag('nickname', $sf_params->get('nickname')) ?>
  </div>

  <div class="form-row">
    <label for="password">password:</label>
    <?php echo input_password_tag('password') ?>
    <?php echo link_to_function(
  'Forgot password?',
  visual_effect('appear', 'forgot').visual_effect('blindUp', 'loginForm')
) ?>
  </div>

  </fieldset>

  <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
  <?php echo submit_tag('sign in') ?>

</form>
</div>

<?php echo form_remote_tag(array(
    'update'   => 'msg',
    'url'      => 'users/forgot',
    'script'   =>	true

)); ?>
<div id="forgot" style="display:none">
<div class="form-row">
    <label for="nickname">nickname:</label>
    <?php echo input_tag('nickname', $sf_params->get('nickname')) ?>
  </div>
   <div class="submit-row">
    <?php echo submit_tag('reset') ?>
  </div>
</form>
<div id="msg">
</div>
</div>
<div id="errors"></div>


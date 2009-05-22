
<?php use_helper('Javascript') ?>
<?php echo form_remote_tag(array(
    'update'   => 'errors',
    'url'      => 'users/newUser',
    'script'   =>	true,
    'complete' => "hideModal()",
)); ?>


<fieldset>

    <div class="form-row">
        <label for="title">First Name:</label>
        <INPUT TYPE=text NAME="fname" ID="fname" SIZE="15" MAXLENGTH="50"
               ONCHANGE="validatePresent(this, 'inf_from');">
        <LI id="inf_from">Required</LI>
    </div>

    <div class="form-row">
        <label for="make">Last Name:</label>
         <INPUT TYPE=text NAME="lname" ID="lname" SIZE="15" MAXLENGTH="50"
               ONCHANGE="validatePresent(this, 'inf_lname');">
        <LI id="inf_lname">Required</LI>
    </div>

    <div class="form-row">
        <label for="model">Email Address:</label>
         <INPUT TYPE=text NAME="email" ID="email" SIZE="15" MAXLENGTH="50"
               ONCHANGE="validateEmail(this, 'inf_email');">
        <LI id="inf_email">Required</LI>
    </div>

     <div class="form-row">
        <label for="make">Username:</label>
         <INPUT TYPE=text NAME="username" ID="username" SIZE="15" MAXLENGTH="50"
               ONCHANGE="validatePresent(this, 'inf_userName');">
        <LI id="inf_userName">Required</LI>
    </div>

    <div class="form-row">
        <label for="model">Password:</label>
         <INPUT TYPE=password NAME="password" ID="password" SIZE="15" MAXLENGTH="50"
               ONCHANGE="validatePresent(this, 'inf_password');">
        <LI id="inf_password">&nbsp;</LI>
    </div>

      <div class="form-row">
        <label for="model">Verify Password:</label>
         <INPUT TYPE=password NAME="vpassword" ID="vpassword" SIZE="15" MAXLENGTH="50">
        <LI id="inf_vPass">&nbsp;</LI>
    </div>
    
  </fieldset>

  <div class="submit-row">
    <?php echo submit_tag('add') ?>
  </div>
</form>

<div id="errors"></div>


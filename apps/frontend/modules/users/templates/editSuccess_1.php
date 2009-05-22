<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
        Rounded("div.main","#FFF","#A9D467");
        RoundedTop("h2.rounded-heading","#A9D467","#555555");
        RoundedBottom("div.content-1-details","#A9D467","#555555");
    }
</script>
<div id="wrapper-1">
    <div id="wrapper-content-1" class="main">
     <form method="post" action="<?=url_for('users/edit?id='.$form->getObject()->getUserId()) ?>">
  <?=$form["id"]->render() ?>
  <table>
  	<?php if ($errors): ?>
    <tr>
    	<td colspan="2">
    		<ul>
    			<?php foreach ($errors as $error): ?>
					<li><?=$error ?></li>
				<?php endforeach; ?>
    		</ul>
    	</td>
    </tr>
	<?php endif; ?>
 </table>

 <div class="form-row">
        <label for="fname">First Name:</label>
        <?php echo input_tag('fname', $sf_params->get('fname')) ?>
    </div>

    <div class="form-row">
        <label for="lname">Last Name:</label>
        <?php echo input_tag('lname', $sf_params->get('lname')) ?>
    </div>

    <div class="form-row">
        <label for="email">Email Address:</label>
        <?php echo input_tag('email', $sf_params->get('email')) ?>
    </div>

     <div class="form-row">
        <label for="bday">Birth Date:</label>
        <?php echo input_date_tag('bday', 'now', 'rich=false') ?>
    </div>

    <div class="form-row">
        <label for="weight">Weight:</label>
        <?php echo input_tag('weight', $sf_params->get('weight')) ?>
    </div>

    <div class="form-row">
        <label for="height">Height:</label>
        <?php echo input_tag('height', $sf_params->get('height')) ?>
    </div>

    <div class="form-row">
        <label for="address">Home:</label>
        <?=include_partial('address_edit',array('form'=>$form)) ?>
    </div>

     <div class="form-row">
        <label for="zip">Zip:</label>
        <?php echo input_tag('zip', $sf_params->get('zip')) ?>
    </div>

     <div class="form-row">
        <label for="units">Unit Preference:</label>
        <?php echo radiobutton_tag('units[]', 'miles', true) ?>
        <label for="units">Miles</label>
        <?php echo radiobutton_tag('units[]', 'kilo', false) ?>
        <label for="units">Kilometers</label>
    </div>

    <div class="submit-row">
        <input type="submit" name="submit" value="save"/>
        <?=button_to('cancel','users/profile') ?>
    </div>

</form>
    </div>
</div>

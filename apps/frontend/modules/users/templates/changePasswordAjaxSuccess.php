<?php echo form_tag('users/changePasswordAjax') ?>
<?php use_helper('Javascript') ?>

 <?php echo $errors ?>
 <?php echo input_hidden_tag('hide',$hide) ?>

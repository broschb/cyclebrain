<?php use_helper('Object'); ?>
<?php echo form_tag('userbike/edit') ?>
<?php use_helper('Javascript') ?>
<?php echo include_partial('bike_form',array('bike_make'=>$make,'bike_model'=>$model,'bike_year'=>$year,'description'=>$description)) ?>
<div class="submit-row">
<?php echo input_hidden_tag('bikeid',$bikeid) ?>
    <?php echo submit_tag('save') ?>
</div>
</form>
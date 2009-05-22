<?php echo form_tag('userbike/add') ?>
<?php use_helper('Javascript') ?>
<?=include_partial('bike_form',array('bike_make'=>$sf_params->get('bike_make'),'bike_model'=>$sf_params->get('bike_model'),'bike_year'=>$sf_params->get('bike_year'),'description'=>$sf_params->get('description'))) ?>

  <div class="submit-row">
    <?php echo submit_tag('add') ?>
  </div>
</form>


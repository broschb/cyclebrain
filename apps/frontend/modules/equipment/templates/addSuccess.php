<?php use_helper('Object'); ?>
<?php echo form_tag('equipment/add') ?>
<?php use_helper('Javascript') ?>

<?=include_partial('bike_equipment',array('description'=>$sf_params->get('description'),'make'=>$sf_params->get('make'),'model'=>$sf_params->get('model'),'cost'=>$sf_params->get('cost'),'bike'=>null,'type'=>null)) ?>

<div class="submit-row">
    <?php echo submit_tag('add') ?>
</div>
</form>


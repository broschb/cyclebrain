<?php use_helper('Object'); ?>
<?php echo form_tag('userrides/add') ?>

<?php include_partial('ride_form',array('route_desc'=>$sf_params->get('ride_date'),'distance'=>$sf_params->get('ride_time'))) ?>

<div class="submit-row">
<input type="submit" name="Add" value="Add" />
<input type="submit" name="AddCreateMap" value="Add & Create Map" />
<input type="submit" name="AddEditMap" value="Add & EditMap" />
</div>
</form>


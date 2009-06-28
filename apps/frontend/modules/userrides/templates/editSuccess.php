<?php use_helper('Object'); ?>
<?php echo form_tag('userrides/edit') ?>
<?php use_helper('Javascript') ?>
<?php include_partial('ride_form',array('route_desc'=>$userRide->getDescription(),'distance'=>utils::getMileageFromMeters($userRide->getMileage()))) ?>
<div class="submit-row">
<?php echo input_hidden_tag('rideid',$rideid) ?>
<input type="submit" name="Save" value="Save" />
<input type="submit" name="AddCreateMap" value="Save & Create Map" />
<input type="submit" name="AddEditMap" value="Save & EditMap" />
</div>
</form>
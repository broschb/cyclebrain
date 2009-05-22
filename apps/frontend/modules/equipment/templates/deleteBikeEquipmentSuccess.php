<?php use_helper('Object'); ?>
<?php use_helper('Javascript') ?>
<?php echo form_tag('equipment/deleteBikeEquipment') ?>

<h3>Are you sure you wish to delete this piece of equipment?
All data associated with this equipment will be deleteted!</h3>
<?php echo input_hidden_tag('equip',$equip) ?>
<div class="submit-row">
    <?php echo submit_tag('delete') ?>
</div>
</form>


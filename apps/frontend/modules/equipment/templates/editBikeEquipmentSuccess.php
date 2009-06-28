<?php use_helper('Object'); ?>
<?php echo form_tag('equipment/editBikeEquipment') ?>
<?php use_helper('Javascript') ?>
<?php echo include_partial('bike_equipment',array('bike'=>$userEquip->getBikeId(),'type'=>$userEquip->getEquipFunction(),'date'=>$userEquip->getPurchaseDate(),'description'=>$userEquip->getDescription(),'make'=>$userEquip->getMake(),'model'=>$userEquip->getModel(),'cost'=>$userEquip->getPurchasePrice())) ?>
<div class="submit-row">
<?php echo input_hidden_tag('equip',$equip) ?>
    <?php echo submit_tag('save') ?>
</div>
</form>
<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<div id="detailList">
    <?php if ($equips): ?>
    <ul>
        <?php foreach ($equips as $userEquipment): ?>
        <li>
            <H3> <?php echo $userEquipment->getDescription() ?>
                <?php
                $editUrl = "Modalbox.show('equipment/editBikeEquipment?equip=".$userEquipment->getEquipmentId()."', {title:' Edit Equipment', width: 600});return false;";
                echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                <?php
                $url = "Modalbox.show('equipment/deleteBikeEquipment?equip=".$userEquipment->getEquipmentId()."', {title:' Delete Equipment', width: 600});return false;"?>
                <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
            </H3>
            <p>Purchase Date: <?php echo $userEquipment->getPurchaseDate() ?></p>
            <P>Total Mileage: <?php echo $userEquipment->getMileage()." ".utils::getMileageString() ?></P>
            <p>Cost: <?php echo $userEquipment->getPurchasePrice() ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <?php if (!$equips): ?>
    <ul>
        <li>
            <H3>You have no equipment assigned to this bike!</H3>
        </li>
    </ul>
    <?php endif; ?>

</div>

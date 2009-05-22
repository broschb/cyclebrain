<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
        Rounded("div.subsubtopic","#A9D467","#555555");
    }

</script>
<div>
    <?php if ($equips):
     $divCount=0;
    ?>
        <?php foreach ($equips as $userEquipment): ?>
        <div id="subsubtopic" class="subsubtopic">
            <?php echo $userEquipment->getDescription() ?>
                <?php
                $subDivName='equip'.$divCount;
                $innerTreeName='innerEquip'.$divCount;
                $innerTreeId='id='.$innerTreeName;
                $expandUrl="showHideInnerDiv('$innerTreeName','$subDivName'); return false;";
                 echo link_to_function('Show Details', $expandUrl,$innerTreeId);
                ?>
                <?php
                $editUrl = "Modalbox.show('equipment/editBikeEquipment?equip=".$userEquipment->getEquipmentId()."', {title:' Edit Equipment', width: 600});return false;";
                echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                <?php
                $url = "Modalbox.show('equipment/deleteBikeEquipment?equip=".$userEquipment->getEquipmentId()."', {title:' Delete Equipment', width: 600});return false;"?>
                <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
                 <div id="<?php echo $subDivName ?>" style="display:none">
                    <div id="detailList">
                        Purchase Date: <?php echo $userEquipment->getPurchaseDate() ?>
                        <br>
                        Total Mileage: <?php echo $userEquipment->getMileage()." ".utils::getMileageString() ?>
                        <br>
                        Cost: <?php echo $userEquipment->getPurchasePrice() ?>
                    </div>
                </div>
            </div>
        <?php
        $divCount++;
        endforeach; ?>
    <?php endif; ?>
    <?php if (!$equips): ?>
            <H3>You have no equipment assigned to this bike!</H3>
    <?php endif; ?>

</div>

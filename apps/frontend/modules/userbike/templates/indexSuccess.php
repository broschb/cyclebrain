<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
        Rounded("div.pagetitle","#A9D467","#222222");
        Rounded("div.pagesubtopic","#A9D467","#555555");
    }

</script>
<div id="wrapper-1">
    <div id="wrapper-content-1" class="main">
        <div id="pagetitle" class="pagetitle">
            <h2><span>Bikes
                    <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('userbike/add', {title:' Add Bike', width: 600});return false;"); 
                    echo button_to_function('Add Equipment', "Modalbox.show('equipment/add', {title:' Add Equipment', width: 600});return false;");
                    ?>
                </span>
            </h2>
            </div>
            <?php 
            $divCount=0;
            foreach ($user_bikess as $user_bikes): ?>
            <?php
            $divName='equipment'.$divCount;
            $subDivName='bike'.$divCount;
            $treeName='tree'.$divCount;
            $innerTreeName='innerTree'.$divCount;
            $innerTreeId='id='.$innerTreeName;
            ?>
            <div id="pagesubtopic" class="pagesubtopic">
                <input type="image" src="/images/closed2.png" id=<?php echo $treeName ?> onclick="expandCollapseDiv(<?php echo "'".$treeName."'" ?>,<?php echo "'".$divName."'" ?>,'<?php echo url_for('equipment/getBikeEquipment') ?>',<?php echo $user_bikes->getUserBikeId() ?>); return false;">
                <?php echo $user_bikes?>
                <?php
                $expandUrl="showHideInnerDiv('$innerTreeName','$subDivName'); return false;";
                $editUrl = "Modalbox.show('userbike/edit?bikeid=".$user_bikes->getUserBikeId()."', {title:' Edit Bike', width: 600});return false;";
                echo link_to_function('Show Details', $expandUrl,$innerTreeId);
                echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                <?php
                $url = "Modalbox.show('userbike/delete?bikeid=".$user_bikes->getUserBikeId()."', {title:' Delete Bike', width: 600});return false;"?>
                <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
                <br>
                <div id="<?php echo $subDivName ?>" style="display:none">
                    <div id="detailList">
                        Total Mileage: <?php echo $user_bikes->getBikeMileage()." ".utils::getMileageString() ?>
                        <br>
                        Last Ride Date: <?php echo $user_bikes->getLastRideDate() ?>
                    </div>
                </div>
            </div>
            <div id="<?php echo $divName ?>" style="display:none"></div>
            <?php
            $divCount++;
            endforeach; ?>
        

        <div style="clear:both; height:78px;"></div>
    </div>
</div>
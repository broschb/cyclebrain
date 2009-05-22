<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
        Rounded("div.main","#FFF","#A9D467");
        RoundedTop("h2.rounded-heading","#A9D467","#555555");
        RoundedBottom("div.content-1-details","#A9D467","#555555");
    }

</script>
<div id="wrapper-1">
    <div id="wrapper-content-1" class="main">
        <div id="content-1-left" class="itemHead">
            <h2 class="rounded-heading"><span>Bikes
            <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('userbike/add', {title:' Add Bike', width: 600});return false;") ?>
                </span>
            </h2>
            <div class="content-1-details">
                <ol class="steps">
                    <?php foreach ($user_bikess as $user_bikes): ?>
                     <li class="nselected" onclick="doClick(this),hideDiv('equipment','<?=url_for('equipment/getBikeEquipment') ?>',<?php echo $user_bikes->getUserBikeId() ?>); return false;">
                        <h2><?php echo $user_bikes ?>
                        <?php
                        $editUrl = "Modalbox.show('userbike/edit?bikeid=".$user_bikes->getUserBikeId()."', {title:' Edit Bike', width: 600});return false;";
                        echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                        <?php
                        $url = "Modalbox.show('userbike/delete?bikeid=".$user_bikes->getUserBikeId()."', {title:' Delete Bike', width: 600});return false;"?>
                        <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
                        </h2>
                        <p>Total Mileage: <?php echo $user_bikes->getBikeMileage()." ".utils::getMileageString() ?>
                            <br>
                            Last Ride Date: <?php echo $user_bikes->getLastRideDate() ?>
                        </p>

                    </li>
                    <?php endforeach; ?>
                </ol>
            </div>

        </div>

        <div id="content-1-right">
            <h2 class="rounded-heading"><span>Equipment
            <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('equipment/add', {title:' Add Equipment', width: 600});return false;") ?>
            </span></h2>
            <div class="content-1-details">
                <div id="equipment"></div>
            </div>
        </div>

        <div style="clear:both; height:78px;"></div>
    </div>
</div>
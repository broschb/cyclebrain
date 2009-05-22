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
            <h2 class="rounded-heading"><span>My Routes
            <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('userrides/add', {title:' Add Route', width: 600});return false;") ?>
            </span></h2>
            <div class="content-1-details">
             <ol class="steps">
                     <?php foreach ($user_rides as $user_route): ?>
                    <li class="nselected" onclick="doClick(this),hideDiv('userrides','<?=url_for('userrides/getRideDetails') ?>',<?php echo $user_route->getUserRideId() ?>); return false;">
                        <h2><?php echo $user_route->getDescription() ?>
                        <?php
                        $editUrl = "Modalbox.show('userrides/edit?rideid=".$user_route->getUserRideId()."', {title:' Edit Route', width: 600});return false;";
                        echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                        <?php
                        $url = "Modalbox.show('userrides/delete?rideid=".$user_route->getUserRideId()."', {title:' Delete Route', width: 600});return false;"?>
                        <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
                        </h2>
                        <p>Total Mileage: <?php echo utils::getMileageFromMeters($user_route->getMileage())." ".utils::getMileageString() ?>
                        </p>

                    </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
        <div id="content-1-right">
            <h2 class="rounded-heading"><span>Route Details</span></h2>
            <div class="content-1-details">
                <div id="userrides"></div>
            </div>
        </div>
        <div style="clear:both; height:78px;"></div>
    </div>
</div>
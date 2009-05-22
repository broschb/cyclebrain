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
            <h2 class="rounded-heading"><span>Recent Rides
            <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('userstats/add', {title:' Add Ride', width: 600});return false;") ?>
            </span></h2>
            <div class="content-1-details">
            <ol class="steps">
                      <?php foreach ($user_stats as $user_stat): ?>
                      <li class="nselected" onclick="doClick(this),hideDiv('statdiv','<?=url_for('userstats/getStatDetails') ?>',<?php echo $user_stat->getStatNo() ?>); return false;">
                        <h2><?php echo $user_stat->getRideDate() ?>
                        <?php
                        $editUrl = "Modalbox.show('userstats/edit?statid=".$user_stat->getStatNo()."', {title:' Edit Ride', width: 600});return false;";
                        echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                        <?php
                        $url = "Modalbox.show('userstats/delete?statid=".$user_stat->getStatNo()."', {title:' Delete Ride', width: 600});return false;"?>
                        <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
                        </h2>
                        <p>Description: <?php echo $user_stat->getUserRides()->getDescription() ?>
                        <br>
                        Bike: <?php echo $user_stat->getUserBikes() ?>
                        </p>

                    </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
        <div id="content-1-right">
            <h2 class="rounded-heading"><span>Ride Details</span></h2>
            <div class="content-1-details">
                <div id="statdiv"></div>
            </div>
        </div>
         <div style="clear:both; height:78px;"></div>
    </div>
</div>
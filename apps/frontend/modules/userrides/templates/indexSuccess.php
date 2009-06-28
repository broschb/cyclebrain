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
            <h2 class="rounded-heading"><span>My Routes
            <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('userrides/add', {title:' Add Route', width: 600});return false;") ?>
            </span></h2>
        </div>
        <?php
            $divCount=0;
            foreach ($user_rides as $user_route): ?>
        <div id="pagesubtopic" class="pagesubtopic">
         <?php
            $divName='userrides'.$divCount;
             $treeName='tree'.$divCount;
            ?>
        <input type="image" src="/images/closed2.png" id=<?php echo $treeName ?> onclick="expandCollapseDiv(<?php echo "'".$treeName."'" ?>,<?php echo "'".$divName."'" ?>,'<?php echo url_for('userrides/getRideDetails') ?>',<?php echo $user_route->getUserRideId() ?>); return false;">
               <?php
                echo $user_route->getDescription();
                $editUrl = "Modalbox.show('userrides/edit?rideid=".$user_route->getUserRideId()."', {title:' Edit Route', width: 600});return false;";
                echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                <?php
                $url = "Modalbox.show('userrides/delete?rideid=".$user_route->getUserRideId()."', {title:' Delete Route', width: 600});return false;"?>
                <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
        </div>
        <div id="<?php echo $divName ?>" style="display:none"></div>
        <?php
        $divCount++;
        endforeach; ?>

        <div style="clear:both; height:78px;"></div>
    </div>
</div>
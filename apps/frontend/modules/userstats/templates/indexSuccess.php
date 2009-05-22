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
            <h2 class="rounded-heading"><span>Recent Rides
            <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('userstats/add', {title:' Add Ride', width: 600});return false;") ?>
            </span></h2>
            </div>
            <?php
            $divCount=0;
            foreach ($user_stats as $user_stat): ?>
            <div id="pagesubtopic" class="pagesubtopic">
                <?php
                $divName='statdiv'.$divCount;
                echo $user_stat->getRideDate();
                $innerTreeName='innerTree'.$divCount;
                $innerTreeId='id='.$innerTreeName;
                $expandUrl="expandCollapseLinkDiv('$innerTreeName','$divName','".url_for('userstats/getStatDetails')."',".$user_stat->getStatNo()."); return false;";
                echo link_to_function('Show Details', $expandUrl,$innerTreeId);
                ?>
                <?php
                $editUrl = "Modalbox.show('userstats/edit?statid=".$user_stat->getStatNo()."', {title:' Edit Ride', width: 600});return false;";
                echo link_to_function(image_tag('/images/Modify.png'), $editUrl) ?>
                <?php
                $url = "Modalbox.show('userstats/delete?statid=".$user_stat->getStatNo()."', {title:' Delete Ride', width: 600});return false;"?>
                <?php echo link_to_function(image_tag('/images/Delete.png'), $url) ?>
                <br>
                <div id="<?php echo $divName ?>" style="display:none"></div>
            </div>
            <?php
            $divCount++;
            endforeach; ?>
         <div style="clear:both; height:78px;"></div>
    </div>
</div>
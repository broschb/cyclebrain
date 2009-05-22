<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<div id="detailList">

<ul>
<li>
<p>
    <?php
    echo link_to_function('showMap', "Modalbox.show('userrides/map', {title:' Edit Map', width: 1000});return false;")
   ?>
    <?php echo link_to(
  'view/edit route',
  'userrides/map?rideId='.$rideId
) ?>

</p>
</li>
</ul>

</div>

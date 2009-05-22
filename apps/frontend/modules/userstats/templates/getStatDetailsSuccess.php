<div id="detailList">
<?php if ($stats): ?>
        <?php foreach ($stats as $userStat): ?>
        Ride Time: <?php echo $userStat->getRideTime() ?><br>
        Average Speed: <?php echo $userStat->getAvgSpeed() ?><br>
        Calories Burned: <?php echo $userStat->getCaloriesBurned() ?><br>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

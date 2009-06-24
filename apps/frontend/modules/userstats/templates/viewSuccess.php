<?php use_helper('Object'); ?>
<?php echo form_tag('userstats/view') ?>
<?php use_helper('Javascript') ?>
<fieldset>

    <div class="form-row">
        <label for="title">Ride Date:</label>
        <?php
        if($ride_date)
        $curDate = $ride_date;
        else
        $curDate='';
        echo $curDate?>
    </div>

    <div class="form-row">
     <label for="title">Bike:</label>
     <?php echo $bike ?>
    </div>

    <div class="form-row">
     <label for="title">Route:</label>
     <?php echo $route ?>
    </div>

    <div class="form-row">
        <label for="make">Ride Time(minutes):</label>
        <?php
        if($ride_time)
        $time=$ride_time;
        else
        $time=$sf_params->get('ride_time');
        echo $time?>
    </div>

    <div class="form-row">
        <label for="model">Avg Speed:</label>
        <?php
        if($speed)
        $avgSpeed=$speed;
        else
        $avgSpeed=$sf_params->get('avg_speed');
        echo $avgSpeed ?>
    </div>

    <div class="form-row">
        <label for="model">Calories Burned:</label>
        <?php
        if($calories)
        $cal=$calories;
        else
        $cal=$sf_params->get('cal_burned');
        echo  $cal ?>
    </div>

</fieldset>
<div class="submit-row">
<?php echo input_hidden_tag('statid',$statid);
    $editUrl = "Modalbox.show('userstats/edit?statid=".$statid."', {title:' Edit Ride', width: 600});return false;";
    $cancelUrl="Modalbox.hide();return false;";
    echo link_to_function('Edit', $editUrl);
    echo link_to_function('Cancel', $cancelUrl);
    ?>
</div>
</form>
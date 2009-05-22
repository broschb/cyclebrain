<fieldset>

    <div class="form-row">
        <label for="title">Ride Date:</label>
        <?php 
        if($ride_date)
        $curDate = $ride_date;
        else
        $curDate='now';
        echo input_date_tag('ride_date', $curDate, 'rich=false') ?>
    </div>

    <div class="form-row">
     <label for="title">Bike:</label>
        <?php echo select_tag('user_bike_id',
            objects_for_select(UserBikesPeer::getUserBikes(), 'getUserBikeId', 'getBikeMake',$bike),
      array('style' => 'width:150px')) ?>
    </div>

    <div class="form-row">
     <label for="title">Route:</label>
        <?php echo select_tag('user_ride_id',
            objects_for_select(UserRidesPeer::getUserRides(), 'getUserRideId', 'getDescription',$route),
      array('style' => 'width:150px')) ?>
    </div>

    <div class="form-row">
        <label for="make">Ride Time(minutes):</label>
        <?php
        if($ride_time)
        $time=$ride_time;
        else
        $time=$sf_params->get('ride_time');
        echo input_tag('ride_time', $time) ?>
    </div>

    <div class="form-row">
        <label for="model">Avg Speed:</label>
        <?php
        if($speed)
        $avgSpeed=$speed;
        else
        $avgSpeed=$sf_params->get('avg_speed');
        echo input_tag('avg_speed', $avgSpeed) ?>
    </div>

    <div class="form-row">
        <label for="model">Calories Burned:</label>
        <?php 
        if($calories)
        $cal=$calories;
        else
        $cal=$sf_params->get('cal_burned');
        echo input_tag('cal_burned', $cal) ?>
    </div>

</fieldset>
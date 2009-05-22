<?php use_helper('Javascript') ?>
<?php use_helper('Object'); ?>
<?php use_helper('ModalBox') ?>
<?php echo form_tag('reports/index') ?>
<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
        Rounded("div.main","#FFF","#A9D467");
        Rounded("div.chartcontrols","#A9D467","#555555");
    }

</script>
<div id="wrapper-1">
    <div id="wrapper-content-1" class="main">
    <div id="chartcontrols" class="chartcontrols">
        <table>
            <tr>
                <td>
                    <div class="form-row">
                        <label for="title">Report:</label>
                        <?php echo select_tag('report',options_for_select(array('Distance(week)',
                            'Distance(month)','Time(week)','Time(month)','Avg Speed(week)','Avg Speed(month)',
                        'Number Rides(week)','Number Rides(month)'),0))?>
                    </div>
                </td>
                <td>
                    <div class="form-row">
                        <label for="title">From Date:</label>
                        <?php echo input_date_tag('from_date', 'now', 'rich=true') ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-row">
                        <label for="title">Bike:</label>
                        <?php echo select_tag('user_bike_id',
                            objects_for_select(UserBikesPeer::getUserBikesWithAll(), 'getUserBikeId', 'getBikeMake',$bike),
                            array('style' => 'width:150px')) ?>
                    </div>
                </td>
                <td>
                    <div class="form-row">
                        <label for="title">To Date:</label>
                        <?php echo input_date_tag('to_date', 'now', 'rich=true') ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-row">
                        <label for="title">Route:</label>
                        <?php echo select_tag('user_ride_id',
                            objects_for_select(UserRidesPeer::getUserRidesWithAll(), 'getUserRideId', 'getDescription',$route),
                            array('style' => 'width:150px')) ?>
                    </div>
                </td>
                <td>
                    <div class="form-row">
                        <label for="units">Chart Type:</label>
                        <?php echo radiobutton_tag('chart[]', 'Bar',false) ?>
                        <label for="units">Bar</label>
                        <?php echo radiobutton_tag('chart[]', 'Line',true) ?>
                        <label for="units">Line</label>
                        <?php echo checkbox_tag('threeD')."3D Chart" ?>
                    </div>
                </td>
            </tr>
        </table>
<div class="submit-row">
    <?php echo submit_tag('Generate Report') ?>
</div>
</div>
</form>

<div id="chart">
<?php if ($title): ?>
  <object data="<?php echo '/'.$title ?>" type="image/svg+xml">
        You need a browser capeable of SVG to display this image.
</object>
<?php endif; ?>
</div>
     </div>
</div>
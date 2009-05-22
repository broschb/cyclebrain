<fieldset>

    <div class="form-row">
        <label for="title">Route Description:</label>
        <?php echo input_tag('route_desc', $route_desc) ?>
    </div>

    <div class="form-row">
        <label for="make">Distance(<?php echo utils::getMileageString()?>):</label>
        <?php echo input_tag('distance', $distance) ?>
    </div>

</fieldset>
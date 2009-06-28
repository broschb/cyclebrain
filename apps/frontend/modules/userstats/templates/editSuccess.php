<?php use_helper('Object'); ?>
<?php echo form_tag('userstats/edit') ?>
<?php use_helper('Javascript') ?>
<?php echo include_partial('stat_form',array('ride_date'=>$ride_date,'ride_time'=>$ride_time,'speed'=>$speed,'calories'=>$calories,'route'=>$route,'bike'=>$bike)) ?>
<div class="submit-row">
<?php echo input_hidden_tag('statid',$statid) ?>
    <?php echo submit_tag('save') ?>
</div>
</form>
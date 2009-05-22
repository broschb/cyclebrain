<?php use_helper('Object'); ?>
<?php echo form_tag('userstats/add') ?>
<?php use_helper('Javascript') ?>

<?=include_partial('stat_form',array('ride_date'=>null,'ride_time'=>null,'speed'=>null,'calories'=>null,'route'=>null,'bike'=>null)) ?>

<div class="submit-row">
    <?php echo submit_tag('add') ?>
</div>
</form>


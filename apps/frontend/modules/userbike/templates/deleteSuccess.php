<?php use_helper('Object'); ?>
<?php use_helper('Javascript') ?>
<?php echo form_tag('userbike/delete') ?>

<h3>Are you sure you wish to delete this bike?
All data associated with this bike will be delteted!</h3>
<?php echo input_hidden_tag('bikeid',$bikeid) ?>
<div class="submit-row">
    <?php echo submit_tag('delete') ?>
</div>
</form>


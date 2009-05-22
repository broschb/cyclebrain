<?php use_helper('Object'); ?>
<?php use_helper('Javascript') ?>
<?php echo form_tag('userstats/delete') ?>

<h3>Are you sure you wish to delete this ride?</h3>
<?php echo input_hidden_tag('statid',$statid) ?>
<div class="submit-row">
    <?php echo submit_tag('delete') ?>
</div>
</form>


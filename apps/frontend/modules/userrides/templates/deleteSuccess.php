<?php use_helper('Object'); ?>
<?php use_helper('Javascript') ?>
<?php echo form_tag('userrides/delete') ?>

<h3>Are you sure you wish to delete this route?<br>
    This will delete all rides and statistics associated with this route!</h3>
<?php echo input_hidden_tag('rideid',$rideid) ?>
<div class="submit-row">
    <?php echo submit_tag('delete') ?>
</div>
</form>


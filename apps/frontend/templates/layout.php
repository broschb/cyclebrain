<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <?php if (has_slot('gmapheader')): ?>
    <?php include_slot('gmapheader') ?>
    <?php endif; ?>

<?php use_helper('Url'); ?>
<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>
<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<?php echo javascript_tag("
   function hideModal(){
        //Modalbox.hide();
    var hide = document.getElementById('hide').value;
    if(hide)
        Modalbox.hide();
    }

function modalRefresh(){
        //history.go(0);
        location.reload(true);
    }
") ?>

<link rel="shortcut icon" href="/favicon.ico" />

   
</head>
<body>
<div id="header">
   <img src="/images/cycleBrain100.png" align="left" border="0" class="image" /><span class="text">CycleBrain</span>
</div>
<div id="content_bar">
 <?php include_component_slot('sidebar') ?>
  <div class="verticalalign"></div>
</div>
<br>

<?php echo $sf_data->getRaw('sf_content') ?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7963349-1");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>

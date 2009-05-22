<?php use_helper('Object');?>
<?php use_helper('Javascript') ?>
<div id="stateSelection">
<?php
echo select_tag( 'classes',  objects_for_select($states, 'getId',
'getName'),array('style' => 'width:150px',
   'onchange' => remote_function( array(
'update' => 'citySelection',
'url' => 'users/getCities',
'with' => "'id=' + this.value" ,
'loading' => "Element.show('indicator')",
'complete' => "Element.hide('indicator')"
                    )    )
            ) );
?>
</div>

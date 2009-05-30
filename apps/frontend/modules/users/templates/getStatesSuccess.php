<?php use_helper('Object');?>
<?php use_helper('Javascript') ?>
<span id="stateSelection">
<label for="title">State:</label>
<?php
echo select_tag( 'state',  objects_for_select($states, 'getId',
'getName',$currentState),array('style' => 'width:150px',
   'onchange' => remote_function( array(
'update' => 'citySelection',
'url' => 'users/getCities',
'with' => "'state=' + this.value" ,
'loading' => "Element.show('indicator')",
'complete' => "Element.hide('indicator')"
                    )    )
            ) );
?>
</span>

<?php
use_helper('Object');
?>
<div id="citySelection">
<?php
echo select_tag( 'cities',  objects_for_select($cities, 'getId',
'getName') );
?>
</div>

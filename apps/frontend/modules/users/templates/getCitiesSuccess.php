<?php
use_helper('Object');
?>
<span id="citySelection">
<label for="title">City:</label>
<?php
echo select_tag( 'city',  objects_for_select($cities, 'getId',
'getName',$currentCity) );
?>
</span>

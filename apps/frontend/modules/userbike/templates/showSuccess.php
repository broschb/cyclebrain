<?php
// auto-generated by sfPropelCrud
// date: 2008/12/07 21:34:35
?>
<table>
<tbody>
<tr>
<th>User: </th>
<td><?php echo $user_bikes->getUserId() ?></td>
</tr>
<tr>
<th>User bike: </th>
<td><?php echo $user_bikes->getUserBikeId() ?></td>
</tr>
<tr>
<th>Bike year: </th>
<td><?php echo $user_bikes->getBikeYear() ?></td>
</tr>
<tr>
<th>Bike make: </th>
<td><?php echo $user_bikes->getBikeMake() ?></td>
</tr>
<tr>
<th>Bike model: </th>
<td><?php echo $user_bikes->getBikeModel() ?></td>
</tr>
<tr>
<th>Equip function: </th>
<td><?php echo $user_bikes->getEquipFunction() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to('edit', 'userbike/edit?user_bike_id='.$user_bikes->getUserBikeId()) ?>
&nbsp;<?php echo link_to('list', 'userbike/list') ?>

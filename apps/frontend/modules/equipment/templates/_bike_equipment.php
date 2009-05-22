<fieldset>

    <div class="form-row">
        <label for="desc">Description:</label>
        <?php echo input_tag('description', $description) ?>

    </div>

    <div class="form-row">
        <label for="desc">Make:</label>
        <?php echo input_tag('make', $make) ?>

    </div>

    <div class="form-row">
        <label for="desc">Model:</label>
        <?php echo input_tag('model', $model) ?>

    </div>

    <div class="form-row">
     <label for="assoc">Equipment Association:</label>
        <?php echo select_tag('assocId',
            objects_for_select(UserBikesPeer::getUserBikesWithShelf(), 'getUserBikeId', 'getBikeMake',$bike),
      array('style' => 'width:150px')) ?>
    </div>

    <div class="form-row">
     <label for="type">Equipment Type:</label>
        <?php echo select_tag('equip_id',
            objects_for_select(BaseEquipFunctionPeer::doSelect(new Criteria()), 'getFunctionId', 'getFunctionName',$type),
      array('style' => 'width:150px')) ?>
    </div>

    <div class="form-row">
        <label for="cost">Purchase Cost:</label>
        <?php echo input_tag('cost', $cost) ?>
    </div>

     <div class="form-row">
        <label for="pdate">Purchase Date:</label>
        <?php echo input_date_tag('purchaseDate', 'now', 'rich=false') ?>

    </div>

</fieldset>
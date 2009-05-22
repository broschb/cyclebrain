<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<?php use_helper('Object'); ?>
<?php echo form_tag('users/edit') ?>
<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
        Rounded("div.main","#FFF","#A9D467");
        RoundedTop("h2.rounded-heading","#A9D467","#555555");
        RoundedBottom("div.content-1-details","#A9D467","#555555");
    }
</script>
<div id="wrapper-1">
    <div id="wrapper-content-1" class="main">
 <div class="form-row">
        <label for="fname">First Name:</label>
        <?php echo input_tag('fname', $user->getFname()) ?>
    </div>

    <div class="form-row">
        <label for="lname">Last Name:</label>
        <?php echo input_tag('lname', $user->getLname()) ?>
    </div>

    <div class="form-row">
        <label for="email">Email Address:</label>
        <?php echo input_tag('email', $user->getEmail()) ?>
    </div>

     <div class="form-row">
        <label for="bday">Birth Date:</label>
        <?php
        $date='now';
        if($user->getUserProfile()){
            if($user->getUserProfile()->getBirthdate()){
                $date=$user->getUserProfile()->getBirthdate();
            }
        }
        echo input_date_tag('bday', $date, 'rich=false','year_start = 1910', 'year_end = 2009') ?>
    </div>

    <div class="form-row">
        <label for="weight">Weight:</label>
        <?php echo input_tag('weight',$user->getUserProfile()->getWeight()) ?>
    </div>

    <div class="form-row">
        <label for="height">Height:</label>
        <?php echo input_tag('height', $user->getUserProfile()->getHeight()) ?>
    </div>


     <div class="form-row">
        <label for="zip">Zip:</label>
        <?php echo input_tag('zip',$user->getUserProfile()->getZip()) ?>
    </div>

     <div class="form-row">
        <label for="units">Unit Preference:</label>
        <?php echo radiobutton_tag('units[]', 'miles', $miles) ?>
        <label for="units">Miles</label>
        <?php echo radiobutton_tag('units[]', 'kilo', $kilo) ?>
        <label for="units">Kilometers</label>
    </div>

    <div class="form-row">
     <label for="title">Country:</label>
     <?php echo select_tag('id',
            objects_for_select(CpCountriesPeer::getAllCountries(), 'getId', 'getName',null),
            array('style' => 'width:150px',
   'onchange' => remote_function( array(
'update' => 'stateSelection',
'url' => 'users/getStates',
'with' => "'id=' + this.value" ,
'loading' => "Element.show('indicator')",
'complete' => "Element.hide('indicator')"
                    )    )
            )) ?>
   <label for="title">State:</label>
   <div id="stateSelection"></div>
   <label for="title">City:</label>
   <div id="citySelection"></div>
   
    </div>

    <div class="submit-row">
        <input type="submit" name="submit" value="save"/>
        <?=button_to('cancel','users/profile') ?>
    </div>

</form>
    </div>
</div>

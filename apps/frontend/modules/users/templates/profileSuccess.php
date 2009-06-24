<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
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
     <?php foreach ($user as $u): ?>
        <div>
            <div class="form-row">
                <label for="title">UserName: <?php echo $u->getUsername() ?></label>
            </div>
            <div class="form-row">
                <label for="title">First Name: <?php echo $u->getFname() ?></label>
            </div>
            <div class="form-row">
                <label for="title">Last Name: <?php echo $u->getLname() ?></label>
            </div>
            <div class="form-row">
                <label for="title">Email: <?php echo $u->getEmail() ?></label>
            </div>
            <div>
                <!--input type="button" value="Change Password" onClick="Modalbox.show('users/changePassword', {title:' Change Password', width: 600});return false;"/-->
                <?php echo m_link_to('Change Password',
      'users/changePassword',
array('title' => 'Change Password'
      ),
array('width' => 400, 'height' => 180,'afterHide' => 'modalRefresh')) ?>
            </div>

        </div>
        <?php endforeach; ?>
        <?=button_to('edit','users/edit') ?>
    </div>
</div>

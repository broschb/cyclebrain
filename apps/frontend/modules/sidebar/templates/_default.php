<div id="menu">
<ul class="menu1">
<?php if ($sf_user->isAuthenticated()): ?>
<li><?php echo link_to('<b>Home</b>', 'main/index',array('class'  => 'current')) ?></li>
<li><?php echo link_to('<b>Bikes</b>', 'userbike/index') ?></li>
<li><?php echo link_to('<b>Rides</b>', 'userstats/index') ?></li>
<li><?php echo link_to('<b>Routes</b>', 'userrides/index') ?></li>
<li><?php echo link_to('<b>Reports/Stats</b>', 'reports/index') ?></li>
<li><?php echo link_to('<b>Profile</b>', 'users/profile') ?></li>
<?php endif ?>
<?php if ($sf_user->isAuthenticated()): ?>
  <li><?php echo link_to('<b>sign out</b>', 'users/logout') ?></li>
  <?php else: ?>
  <li><?php echo m_link_to('<b>sign in</b>',
      'users/login',
array('title' => 'Sign In'
      ),
array('width' => 400, 'height' => 180,'afterHide' => 'modalRefresh')) ?></li>
  <!--li><?php echo m_link_to('<b>Register</b>',
      'users/add',
array('title' => 'Register'),
array('width' => 700, 'height' => 380)) ?></li-->
<?php endif ?>
</ul>
</div>




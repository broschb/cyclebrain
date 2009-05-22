<script type="text/javascript">
window.onload=function(){
if(!NiftyCheck())
    return;
            Rounded("div.main","#FFF","#A9D467");
            RoundedTop("h2.rounded-heading","#A9D467","#555555");
            RoundedBottom("div.content-1-details","#A9D467","#555555");
}
</script>
<div id="wrapper-1" >
    <div id="wrapper-content-1" class="main">
    
    <?php if ($sf_user->isAuthenticated()):
    $milString = utils::getMileageString();
    ?>
    <div id="content-1-left" class="itemHead">
        <h2 class="rounded-heading">
            <span>Quick Stats
            </span>
        </h2>
        <div class="content-1-details">
           <div id="widgetdiv">
           <div>
           mileage this year:<?php echo " ".$user->getYearlyMileage()." ".$milString ?>
           <br>
           mileage this month:<?php echo " ".$user->getMonthlyMileage()." ".$milString ?>
           <br>
           
           </div>
           </div>
        </div>
    </div>

    <div id="content-1-right">
        <h2 class="rounded-heading">
            <span>Weeks Top Riders
        </span></h2>
        <div class="content-1-details">
           <div id="widgetdiv">
           <div>
            <?php
            $weekResults = queries::getWeekTopRiders();
          for ( $counter = 1; $counter <= count($weekResults); $counter ++) {
              echo $counter.'.'.$weekResults[$counter].' '.utils::getMileageString();
              echo "<br>";
          }
          ?>
           </div>
           </div>
        </div>

        <h2 class="rounded-heading">
            <span>Months Top Riders
        </span>  </h2>
        <div class="content-1-details">
            <div id="widgetdiv">
            <div>
            <?php
            $monthResults = queries::getMonthTopRiders();
          for ( $counter = 1; $counter <= count($monthResults); $counter ++) {
              echo $counter.'.'.$monthResults[$counter].' '.utils::getMileageString();
              echo "<br>";
          }
          ?>
            </div>
            </div>
        </div>

        <h2 class="rounded-heading">
            <span>Years Top Riders
        </span>  </h2>
        <div class="content-1-details">
          <div id="widgetdiv">
          <div>
          <?php
          $yearResults = queries::getYearTopRiders();
          for ( $counter = 1; $counter <= count($yearResults); $counter ++) {
              echo $counter.'.'.$yearResults[$counter].' '.utils::getMileageString();
              echo "<br>";
          }
          ?>
          </div>
          </div>
        </div>
    </div>

    <div style="clear:both; height:78px;"></div>
    <?php else: ?>
    <H3>Welcome to CylceBrain!</H3>
    <br>
    <p>We're just getting things up and running.  We hope to provide one place to record and manage all cycling related data.  We want to be your 'CycleBrain'.
    We know things aren't perfect yet, but we are currently inviting cyclists to sign up and participate and provide some
    initial feedback.  If you would be interested please enter your email below.  As we are trying to make this a place to provide useful
    and meaningful feedback for as many as possible, we will take recommendations for changes and features from the members.  If you would
    like to offer input please signup below.</p>
    <?php echo form_tag('main/index') ?>
     <div class="form-row">
        <label for="model">Email Address:</label>
         <INPUT TYPE=text NAME="email" ID="email" SIZE="15" MAXLENGTH="50">
    </div>
    <?php echo submit_tag('sign me up!') ?>
    </form>
    <?php if ($subscribe): ?>
    <?php echo $subscribe ?>
    <?php endif ?>
    <?php endif ?>
    </div>
</div>

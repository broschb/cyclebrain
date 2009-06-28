<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
         Rounded("div.pagetitle","#A9D467","#222222");
        Rounded("div.pagesubtopic","#A9D467","#555555");
        validateSetupMouseOver();
    }

    function navigate(direction){
        document.getElementById("navdir").value=direction;
        document.calform.submit();
    }

    function validateSetupMouseOver(){
        for (i=0;i<=31;i++)
    {
        var cell = 'cell'+i;
        var button = 'button'+i;
        if (document.getElementById(cell) && document.getElementById(button)){
            setUpMouseover(document.getElementById(cell), document.getElementById(button));
        }
    }
    }

    function bubbledFromChild(element, event)  {
  var target = event.element();
  if (target === element) target = event.relatedTarget;
  return (target && target.descendantOf(element));

}

function setUpMouseover(o,id){
  o.observe('mouseover', function(event){
    if (!bubbledFromChild(this, event))
        Effect.Appear(id);
     //appearElement(id);

  }).observe('mouseout', function(event) {
    if (!bubbledFromChild(this, event))
        Effect.Fade(id);
     //fadeElement(id);
  });

}
    
    
</script>
<div id="wrapper-1">
    <div id="wrapper-content-1" class="main">
    <div id="pagetitle" class="pagetitle">
    <?php echo form_tag('userstats/index','name=calform') ?>
      <?php echo input_hidden_tag('navdir','') ?>
            <?php echo input_hidden_tag('year',$year) ?>
            <?php echo input_hidden_tag('month',$month) ?>
            <h2 class="rounded-heading"><span><?php echo $monthText." ".$year ?>
            </span></h2>
             <input type="button" value="prev" onclick="navigate('prev');"/>
            <input type="button" value="next" onclick="navigate('next');"/>
            </form>
            </div>
            <table>
                <thead>
                    <tr class="odd">
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($weekArray as $a): ?>
                    <tr>
                        <?php foreach ($a as $day): ?>
                        <?php $dateId='button'.$day;
                        $cellId='cell'.$day;
                        ?>
                        <td id="<?php echo $cellId ?>" >
                            <?php
                            if ($day && $day!="0"):
                            ?>
                            <div id="calDate" >
                                <span>
                                    <?php
                                    echo $day ?>
                                    <span id="<?php echo $dateId ?>" style="display:none" >
                                        <?php echo link_to_function(image_tag('/images/Add.png'), "Modalbox.show('userstats/add', {title:' Add Ride', width: 600});return false;") ?>
                                    </span>
                                </span>
                            </div>
                            <?php endif; ?>
                            <div id="calInfo" >
                                <?php if($statsByDay):
                                if(array_key_exists($day, $statsByDay)):
                                $stats = $statsByDay[$day];
                                foreach($stats as $s):
                                $editUrl = "Modalbox.show('userstats/view?statid=".$s->getStatNo()."', {title:' Ride Details', width: 400});return false;";
                                echo link_to_function(utils::getMileageFromMeters($s->getMileage()).' '.utils::getMileageString(), $editUrl);
                                ?>
                            <br>
                                <?php
                                endforeach;
                                ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div id="calInfo" >

                            </div>
                        </td>
                        <?php endforeach; ?>
                </tr>
               <?php endforeach; ?>
                </tbody>
            </table>

         
         <div style="clear:both; height:78px;"></div>
    </div>
</div>
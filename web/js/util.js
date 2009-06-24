/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function ajaxCall(toChange,url,paramvalue){
    //new Ajax.Updater('userrides', '<?=url_for('userrides/getRideDetails') ?>', {parameters: {rideId: <?php echo $user_route->getUserRideId() ?> }, asynchronous:true, evalScripts:false,onComplete:showDiv});
    new Ajax.Updater(toChange, url, {parameters: {param: paramvalue }, asynchronous:true, evalScripts:false,onSuccess:setTimeout( function(){showDiv(toChange);Rounded("div.subsubtopic","#A9D467","#3399CC");}, 1500)});
}

showDiv = function(elementId){
    Effect.BlindDown(elementId, { duration: 1.0 });
}

hideDivNoAjax = function(elementId){
    Effect.BlindUp(elementId, { duration: 1.0 });
}

 hideDiv = function(toChange,url,param,paramvalue){
  Effect.BlindUp(toChange, { duration: 1.0 });
  ajaxCall(toChange,url,param,paramvalue);
}

showHideInnerDiv = function(textToChange,divId){
    if(document.getElementById(divId).style.display == 'none'){
        document.getElementById(textToChange).innerHTML="Hide Details";
        showDiv(divId);
    }else{
        document.getElementById(textToChange).innerHTML="Show Details";
        hideDivNoAjax(divId);
    }
}

 expandCollapseDiv = function(iconToChange,toChange,url,param,paramvalue){
    if(document.getElementById(toChange).style.display == 'none'){
        ajaxCall(toChange,url,param,paramvalue);
        document.getElementById(iconToChange).src="/images/open2.png";
    }else{
        document.getElementById(iconToChange).src = "/images/closed2.png";
        hideDivNoAjax(toChange);
    }
}

expandCollapseLinkDiv = function(textToChange,toChange,url,param,paramvalue){
    if(document.getElementById(toChange).style.display == 'none'){
        ajaxCall(toChange,url,param,paramvalue);
        document.getElementById(textToChange).innerHTML="Hide Details";
    }else{
        document.getElementById(textToChange).innerHTML="Show Details";
        hideDivNoAjax(toChange);
    }
}

fadeElement = function(toFade){
   // Effect.Fade(toFade);
    new Effect.Fade(toFade, {
    queue: {
        scope:      toFade,
        position:   'end'
    }

});
}

appearElement = function(toFade){
//if(document.getElementById(toFade).style.display == 'none'){
   // Effect.Appear(toFade);
     new Effect.Appear(toFade, {
    queue: {
        scope:      toFade,
        position:   'end'
    }
});
//}

}

 function doClick(element){
        var parent = element.parentNode;
        for (var i = 0; i < parent.childNodes.length; i++) {
		    parent.childNodes[i].className='nselected';
		}
        element.className='selected';
     }



<?php

/**
 * @package sfModalBoxPlugin
 *
 * @author Mickael Kurmann <mickael.kurmann@gmail.com>
 * @since  22 Apr 2007
 * @version 1.0.0
 *
 */

/**
 * @package sfModalBoxPlugin
 *
 * @author Olivier Kofler <contact@olivierkofler.ch>
 * @since  24 sept 2008
 * @version 1.0.1
 *
 */
function m_link_to_function($url, $modal_options = array(), $modal = false)
{
	use_helper('Javascript');
    
    if(isset($modal_options['title']))
    {
    	$modal_options = array_merge($modal_options, array('title' => $modal_options['title']));
    }
    
    $params_to_escape = sfConfig::get('app_params_to_escape_list');
    
    // escape strings for js
    foreach($modal_options as $option => $value)
    {
        if(in_array($option, $params_to_escape))
        {
            $modal_options[$option] = "'" . $value . "'";
        }
    }
    
    $js_options = _options_for_javascript($modal_options);

	$result = "Modalbox.show('".$url."', " . $js_options . "); ";
	
	if($modal)
		$result .= "Modalbox.deactivate()";

    return $result;
}

function _options_for_javascript($modal_options)
{
    options_for_javascript($modal_options);
}

/**
 * @package sfModalBoxPlugin
 *
 * @author Vitalii Tverdokhlib <new2@ua.fm>
 * @since  11 oct 2008
 * @version 1.0.0
 *
 */
function m_link_to_element($url, $modal_options = array(), $modal = false)
{
	use_helper('Javascript');
    
    if(isset($modal_options['title']))
    {
    	$modal_options = array_merge($modal_options, array('title' => $modal_options['title']));
    }
    
    $params_to_escape = sfConfig::get('app_params_to_escape_list');
    
    // escape strings for js
    foreach($modal_options as $option => $value)
    {
        if(in_array($option, $params_to_escape))
        {
            $modal_options[$option] = "'" . $value . "'";
        }
    }
    
    $js_options = _options_for_javascript($modal_options);
	
	$result = "Modalbox.show(".$url.", " . $js_options . "); ";
	
	if($modal)
		$result .= "Modalbox.deactivate()";

    return $result;

}


/**
 * Enable to use Modalbox script : http://www.wildbit.com/labs/modalbox/
 *
 * *
 * @author Gerald Estadieu <gestadieu@gmail.com>
 * @since  15 Apr 2007
 *
 */
function m_link_to($name, $url, $html_options = array(), $modal_options = array())
{
    use_helper('Javascript');
    
    if(!isset($html_options['title']))
    {
        $html_options['title'] = $name;
    }
    
    $modal_options = array_merge($modal_options, array('title' => 'this.title'));
    
    $params_to_escape = sfConfig::get('app_params_to_escape_list');
    
    // escape strings for js
    foreach($modal_options as $option => $value)
    {
        if(in_array($option, $params_to_escape))
        {
            $modal_options[$option] = "'" . $value . "'";
        }
    }
    
    $js_options = options_for_javascript($modal_options);

    $html_options['onclick'] = "Modalbox.show(this.href, " . $js_options . "); return false;";

    return link_to($name, $url, $html_options);
}


function loadRessources()
{
    // Prototype & scriptaculous
    $response = sfContext::getInstance()->getResponse();
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir'). '/js/prototype');
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir'). '/js/scriptaculous');
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir'). '/js/effects');

    $response->addJavascript('/sfModalBoxPlugin/js/modalbox', 'last');
    $response->addStylesheet('/sfModalBoxPlugin/css/modalbox');
}

loadRessources();
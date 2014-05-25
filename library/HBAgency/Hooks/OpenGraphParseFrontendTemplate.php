<?php

/**
 * OpenGraph tag integration for Contao Open Source CMS
 *
 * Copyright (C) 2014 HB Agency
 *
 * @package    OpenGraph
 * @link       http://www.hbagency.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
 
 
namespace HBAgency\Hooks;

 
/**
 * Add OpenGraph Tags to the output of a frontend page
 * 
 * @package   OpenGraph
 * @author    Blair Winans <bwinans@hbagency.com>
 * @copyright 2014 HB Agency
 */
class OpenGraphParseFrontendTemplate extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param Contao\Template  $objTemplate       The template object
	 *
	 * @return void
	 */
    public function ogParseFrontendTemplate($strBuffer, $strTemplate)
    {
        if( is_array($GLOBALS['OPENGRAPH']) )
        {
           $ogp = $GLOBALS['OPENGRAPH']['PAGE'];
           
           if(null !== $ogp)
           {           
                $GLOBALS['TL_HEAD']['opengraph'] = $ogp->toHTML();                     
           }
        }
                        
        return $strBuffer;
    }
    
}
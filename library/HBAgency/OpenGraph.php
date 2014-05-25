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
 
 
namespace HBAgency;

 
/**
 * Add OpenGraph Tags to the output when certain CE's are detected
 * 
 * @package   OpenGraph
 * @author    Blair Winans <bwinans@hbagency.com>
 * @copyright 2014 HB Agency
 */
class OpenGraph extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param Contao\Database\Result  $objRow     A raw database result
	 * @param Contao\ContentElement $objElement   The CE Object
	 *
	 * @return void
	 */
    public static function addContentTags($objRow, $objElement)
    {
        $objOpenGraph = null;
        $strType    = $GLOBALS['OPENGRAPH_CONFIG'][$objRow->type]['type'];
        $strClass   = $GLOBALS['OPENGRAPH_CONFIG'][$objRow->type]['parser'];
        
        //If class exists and has add method, we can go for it
        if( class_exists($strClass)  && is_callable(array($strClass, 'add')) )
        {
            $objOpenGraph = $strClass::add($objRow, $objElement);
        }

    }
    
}
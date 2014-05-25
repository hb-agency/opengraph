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

use \HBAgency\OpenGraph;

 
/**
 * Add OpenGraph Tags to the output when certain CE's are detected
 * 
 * @package   OpenGraph
 * @author    Blair Winans <bwinans@hbagency.com>
 * @copyright 2014 HB Agency
 */
class OpenGraphGetContentElement extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param Contao\Database\Result  $objRow     A raw database result
	 * @param string $strBuffer                   The current string buffer
	 * @param Contao\ContentElement $objElement   The CE Object
	 *
	 * @return string The content element HTML markup
	 */
    public function ogGetContentElement($objRow, $strBuffer, $objElement)
    {
        //Pass row to controller
        OpenGraph::addContentTags($objRow, $objElement);
        
        return $strBuffer;
    }
    

}
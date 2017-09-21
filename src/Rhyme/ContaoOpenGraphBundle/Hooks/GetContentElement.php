<?php

/**
 * Open Graph Tag integration for Contao Open Source CMS
 *
 * Copyright (C) 2017 Rhyme Digital
 *
 * @package    OpenGraph
 * @link       http://rhyme.digital
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
 
namespace Rhyme\ContaoOpenGraphBundle\Hooks;

 
/**
 * Add OpenGraph Tags to the output when certain CE's are detected
 *
 * @package   OpenGraph
 * @author    Blair Winans <blair@rhyme.digital>
 * @copyright 2017 Rhyme Digital
 */
class GetContentElement extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param \Contao\Database\Result  $objRow     A raw database result
	 * @param string $strBuffer                    The current string buffer
	 * @param \Contao\ContentElement $objElement   The CE Object
	 *
	 * @return string The content element HTML markup
	 */
    public function run($objRow, $strBuffer, $objElement)
    {
        //Pass row to parser controller
        if (isset($GLOBALS['OG_PARSERS']['CONTENT_ELEMENTS'][$objRow->type]) && is_array($GLOBALS['OG_PARSERS']['CONTENT_ELEMENTS'][$objRow->type]))
        {
            foreach ($GLOBALS['OG_PARSERS']['CONTENT_ELEMENTS'][$objRow->type] as $callback)
            {
                static::importStatic($callback[0])->{$callback[1]}($objRow, $objElement);
            }
        }
        
        return $strBuffer;
    }
    

}
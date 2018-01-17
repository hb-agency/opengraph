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
 * Add OpenGraph Tags to the output of a frontend page
 *
 * @package   OpenGraph
 * @author    Blair Winans <blair@rhyme.digital>
 * @copyright 2017 Rhyme Digital
 */
class ParseFrontendTemplate extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param string            $strBuffer
     * @param \Contao\Template  $objTemplate       The template object
	 *
	 * @return string
	 */
    public function run($strBuffer, $strTemplate)
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
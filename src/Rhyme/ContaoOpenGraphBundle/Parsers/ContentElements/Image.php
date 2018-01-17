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


namespace Rhyme\ContaoOpenGraphBundle\Parsers\ContentElements;
 
use ChrisKonnertz\OpenGraph\OpenGraph as OG;
use Contao\File;


/**
 * Add OpenGraph Tags to the output when certain CE's are detected
 * 
 * @package   OpenGraph
 * @author    Blair Winans <blair@rhyme.digital>
 * @copyright 2017 Rhyme Digital
 */
class Image extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param \Contao\Database\Result  $objRow     A raw database result
	 * @param \Contao\ContentElement $objElement   The CE Object
	 *
	 * @return void
	 */
    public static function parse($objRow, $objElement)
    {
        //We will only include images that are larger than 600w x 315h per Facebook's Best Practices
        //https://developers.facebook.com/docs/sharing/best-practices/#images

        //The Element has already called ::generate() so we know it is good and there, just check size
        $image = new File($objElement->singleSRC);
        if($image->width < 600 || $image->height < 315){ return; }

        $fullPath = \Environment::get('url') . '/' . $image->path;

        $og = new OG();
        $og->image($fullPath, [
            'width'     => $image->width,
            'height'    => $image->height
        ]);

        $GLOBALS['TL_HEAD'][] = $og->renderTags();
    }
    
}
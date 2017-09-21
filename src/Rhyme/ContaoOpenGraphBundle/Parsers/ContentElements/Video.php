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
class Video extends \Controller
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
        //https://developers.facebook.com/docs/sharing/webmasters#media

        //The Element has already called ::generate() so we know it is good and there, just check size
        $size = \StringUtil::deserialize($objElement->playerSize);
        if (!is_array($size) || empty($size[0]) || empty($size[1]))
        {
            $size = array(640, 480);
        }
        $attributes = array(
            'width'     => $size[0],
            'height'    => $size[1]
        );

        //Check media player element and grab videos only
        if($objRow->type === 'player' && $objElement->Template->isVideo) {
            if($objElement->Template->poster) {
                $attributes['image'] = \Environment::get('url') . '/' . $objElement->Template->poster;
            }
            $og = new OG();
            foreach($objElement->Template->files as $file) {
                $src = \Environment::get('url') . '/' . $file->path;
                $og->video($src, $attributes);
            }
            $GLOBALS['TL_HEAD'][] = $og->renderTags();
        }
        else {

            //Youtube & Vimeo
            $og = new OG();
            $og->video($objElement->Template->src, $attributes);
        }

        $GLOBALS['TL_HEAD'][] = $og->renderTags();
    }

}
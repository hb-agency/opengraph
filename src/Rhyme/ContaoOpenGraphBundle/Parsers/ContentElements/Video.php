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
 
namespace HBAgency\OpenGraph;
 
use Chewbakka\OpenGraphProtocolTools\Media\OpenGraphProtocolVideo; 
 
/**
 * Add OpenGraph Tags to the output when certain CE's are detected
 * 
 * @package   OpenGraph
 * @author    Blair Winans <bwinans@hbagency.com>
 * @copyright 2014 HB Agency
 */
class Video extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param Contao\Database\Result  $objRow     A raw database result
	 * @param Contao\ContentElement $objElement   The CE Object
	 *
	 * @return Chewbakka\OpenGraphProtocolTools\Media\OpenGraphProtocolMedia
	 */
    public static function add($objRow, $objElement)
    {
        $video = new OpenGraphProtocolVideo();
        $video->setURL( 'http://example.com/video.swf' );
        $video->setSecureURL( 'https://example.com/video.swf' );
        $video->setType( OpenGraphProtocolVideo::extension_to_media_type( pathinfo( parse_url( $video->getURL(), PHP_URL_PATH ), PATHINFO_EXTENSION ) ) );
        $video->setWidth( 500 );
        $video->setHeight( 400 );
        
        return $video;
    }
    
}
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
 
 
namespace HBAgency\OpenGraph;
 
use Chewbakka\OpenGraphProtocolTools\Media\OpenGraphProtocolImage; 
 
/**
 * Add OpenGraph Tags to the output when certain CE's are detected
 * 
 * @package   OpenGraph
 * @author    Blair Winans <bwinans@hbagency.com>
 * @copyright 2014 HB Agency
 */
class Image extends \Controller
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
        $image = new OpenGraphProtocolImage();
        $image->setURL( 'http://example.com/image.jpg' );
        $image->setSecureURL( 'https://example.com/image.jpg' );
        $image->setType( 'image/jpeg' );
        $image->setWidth( 400 );
        $image->setHeight( 300 );
        
        $ogp = $GLOBALS['OPENGRAPH']['PAGE'];
        if(null !== $ogp)
        {   
            $ogp->addImage($image);  
            $GLOBALS['OPENGRAPH']['PAGE'] = $ogp;                     
        }
    }
    
}
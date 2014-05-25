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

use Chewbakka\OpenGraphProtocolTools\OpenGraphProtocol;

 
/**
 * Add OpenGraph Tags to the output of a frontend page
 * 
 * @package   OpenGraph
 * @author    Blair Winans <bwinans@hbagency.com>
 * @copyright 2014 HB Agency
 */
class OpenGraphGeneratePage extends \Controller
{
    /**
	 * Add in OpenGraph tags when we detect certain content elements
	 *
	 * @param Contao\PageModel  $objPage          The current page model
	 * @param Contao\LayoutModel $objLayout       The current page layout model
	 * @param Contao\PageRegular $objPageRegular  The PageRegular Object
	 *
	 * @return void
	 */
    public function ogGeneratePage($objPage, $objLayout, &$objPageRegular)
    {    
        $ogp = new OpenGraphProtocol();
        $ogp->setLocale( self::getLocale($objPage) );
        $ogp->setSiteName( $objPage->rootTitle );
        $ogp->setTitle( $objPage->title );
        $ogp->setDescription( $objPage->description );
        $ogp->setType( 'website' );
        $ogp->setURL( \Environment::get('base') . \Environment::get('request') );
        
        $GLOBALS['OPENGRAPH']['PAGE'] = $ogp;        
        
        $prefix = ' ' . $ogp::PREFIX . ': ' . $ogp::NS;
        
        $objPageRegular->Template->prefix = $prefix;
    }
    
    /**
	 * Try to determine the locale - this may not always be accurate and should be improved!
	 *
	 * @param Contao\PageModel  $objPage    The current page model
	 *
	 * @return string
	 */
    public static function getLocale($objPage)
    {
        $tz = new \DateTimeZone( \Config::get('timeZone'));
        $arrLocation = $tz->getLocation();
        return substr($objPage->language, 0, 2) . '_' . $arrLocation['country_code'];
    }

}
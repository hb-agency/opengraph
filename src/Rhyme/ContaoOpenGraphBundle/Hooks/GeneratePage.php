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
class GeneratePage extends \Controller
{
    /**
	 * Add in OpenGraph tags to the page HEAD
	 *
	 * @param \Contao\PageModel  $objPage          The current page model
	 * @param \Contao\LayoutModel $objLayout       The current page layout model
	 * @param \Contao\PageRegular $objPageRegular  The PageRegular Object
	 *
	 * @return void
	 */
    public function run($objPage, $objLayout, &$objPageRegular)
    {    

    }

}
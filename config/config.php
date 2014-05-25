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
 
/**
 * Hooks
 */ 
$GLOBALS['TL_HOOKS']['generatePage'][]      = array('\HBAgency\Hooks\OpenGraphGeneratePage', 'ogGeneratePage');
$GLOBALS['TL_HOOKS']['getContentElement'][] = array('\HBAgency\Hooks\OpenGraphGetContentElement', 'ogGetContentElement');
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][]      = array('\HBAgency\Hooks\OpenGraphParseFrontendTemplate', 'ogParseFrontendTemplate');

/**
 * CE Classifications and their corresponding parsers
 */
$GLOBALS['OPENGRAPH_CONFIG'] = array
(
    'wfimage'    => array
    (
        'parser'   => '\HBAgency\OpenGraph\Image',
        'type'     => 'image',
    ),
    'video'    => array
    (
        'parser'   => '\HBAgency\OpenGraph\Video',
        'type'     => 'video',
    ),
);
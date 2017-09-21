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
 
/**
 * Hooks
 */ 
$GLOBALS['TL_HOOKS']['generatePage'][]      = array('\Rhyme\ContaoOpenGraphBundle\Hooks\GeneratePage', 'run');
$GLOBALS['TL_HOOKS']['getContentElement'][] = array('\Rhyme\ContaoOpenGraphBundle\Hooks\GetContentElement', 'run');
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][]      = array('\Rhyme\ContaoOpenGraphBundle\Hooks\ParseFrontendTemplate', 'run');

/**
 * Contao Classifications and their corresponding parsers
 */
$GLOBALS['OG_PARSERS'] = array
(
    'CONTENT_ELEMENTS' => array(
        'image' => array( array('\Rhyme\ContaoOpenGraphBundle\Parsers\ContentElements\Image', 'parse')),
    ),
);
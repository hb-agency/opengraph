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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'addOGImage';

foreach($GLOBALS['TL_DCA']['tl_page']['palettes'] as $strKey => &$strPalette) if($strKey != '__selector__') {
    $strPalette = preg_replace(
        '@(\{meta_legend\}[^;]*;)@',
        '$1{og_legend},addOGImage;',
        $strPalette
    );
}

/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['addOGImage'] = 'ogSingleSRC,ogSize';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['addOGImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['addOGImage'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['ogSingleSRC'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['ogSingleSRC'],
    'exclude'                 => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'mandatory'=>true, 'tl_class'=>'clr'),
    'sql'                     => "binary(16) NULL"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['ogSize'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['ogSize'],
    'exclude'                 => true,
    'inputType'               => 'imageSize',
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
    'options_callback' => function ()
    {
        return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
    },
    'sql'                     => "varchar(64) NOT NULL default ''"
);

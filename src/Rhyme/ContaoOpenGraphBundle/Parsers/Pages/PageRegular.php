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


namespace Rhyme\ContaoOpenGraphBundle\Parsers\Pages;

use ChrisKonnertz\OpenGraph\OpenGraph as OG;


/**
 * Add OpenGraph Tags to the output of PageRegular pages
 *
 * @package   OpenGraph
 * @author    Blair Winans <blair@rhyme.digital>
 * @copyright 2017 Rhyme Digital
 */
class PageRegular extends \Controller
{
    /**
     * Add in OpenGraph tags when we detect certain content elements
     *
     * @param \Contao\PageModel     $objPage     The PageModel
     * @param \Contao\LayoutModel   $objLayout   The LayoutModel
     * @param \Contao\PageRegular   $objPageRegular A PageRegular object
     *
     * @return void
     */
    public static function parse($objPage, $objLayout, &$objPageRegular)
    {
        $type = 'website';
        $title = $objPage->pageTitle ?: $objPage->title;
        $description = str_replace(array("\n", "\r", '"'), array(' ' , '', ''), $objPage->description);

        //Basic tags
        $og = new OG();
        $og->title($title)
            ->type('website')
            ->description($description)
            ->url(\Environment::get('uri'));

        //Check for a news article first
        if($GLOBALS['TL_NEWS']['IS_READER']) {
            $og->type('article')
                ->article($GLOBALS['TL_NEWS']['IS_READER']);
        }

        //Save initial tags
        $ogTags = $og->renderTags();

        //Add news images first
        if($GLOBALS['TL_NEWS']['IMAGES']){
            $ogTags .= $GLOBALS['TL_NEWS']['IMAGES'];
        }

        //Then page images if they exist. Need to check for inheritance
        $pid = $objPage->pid;
        $singleSRC = $objPage->ogSingleSRC;
        $objParentPage = \PageModel::findParentsById($pid);
        if ($objParentPage !== null) {
            while ($pid > 0 && $type != 'root' && $objParentPage->next()) {
                $pid = $objParentPage->pid;
                if(null === $singleSRC){
                    $singleSRC = $objParentPage->ogSingleSRC;
                }
            }
        }
        if($singleSRC) {
            $image = \FilesModel::findByUuid($singleSRC);
            $size = \StringUtil::deserialize($objPage->ogSize);
            if ($image !== null && is_file(TL_ROOT . '/' . $image->path))
            {
                $src = \System::getContainer()->get('contao.image.image_factory')->create(TL_ROOT . '/' . $image->path, $size)->getUrl(TL_ROOT);
                $fullPath = \Environment::get('url') . '/' . $src;

                //Add images separately
                $og = new OG();
                $og->image($fullPath, [
                    'width'     => $image->width,
                    'height'    => $image->height
                ]);
                $ogTags .= $og->renderTags();
            }
        }

        //We want these guys to go first
        array_insert($GLOBALS['TL_HEAD'], 0, array($ogTags));


    }

}
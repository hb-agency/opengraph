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

use ChrisKonnertz\OpenGraph\OpenGraph as OG;
use Contao\File;
use Contao\ModuleNewsReader;


/**
 * Flag if we are using a reader module
 *
 * @package   OpenGraph
 * @author    Blair Winans <blair@rhyme.digital>
 * @copyright 2017 Rhyme Digital
 */
class ParseArticles extends \Controller
{
    /**
     * Flag if we are using a reader module
     *
     * @param \Contao\Template      $objTemplate       The current news template
     * @param array                 $arrArticleRow     An array of the news item row values
     * @param \Contao\Module        $objModule         The module being called
     *
     * @return void
     */
    public function run($objTemplate, $arrArticleRow, $objModule)
    {
        //Save the article info to pass to the Page parser
        if($objModule instanceof ModuleNewsReader) {
            $arrAttributes = array(
                'published_time' => $objTemplate->datetime
            );
            if($objTemplate->author !== '')
            {
                $author = \UserModel::findByPk($arrArticleRow['author']);
                if(null !== $author){
                    $arrAttributes['author'] = $author->name;
                }
            }

            $GLOBALS['TL_NEWS']['IS_READER'] = $arrAttributes;

            if($objTemplate->addImage)
            {
                $image = new File($objTemplate->src);
                if($image->width < 600 || $image->height < 315){ return; }

                $fullPath = \Environment::get('url') . '/' . $image->path;

                //Add images separately
                $og = new OG();
                $og->image($fullPath, [
                    'width'     => $image->width,
                    'height'    => $image->height
                ]);

                $GLOBALS['TL_NEWS']['IMAGES'] = $og->renderTags();
            }
        }
    }

}
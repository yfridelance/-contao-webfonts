<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * @package   fd_webfonts
 * @author    Yves Fridelance
 * @license   LPGL
 * @copyright Fridelance Design <http://www.fridelance.ch>
 */

/**
 * Namespace
 */
namespace FD;

/**
 * Class Webfonts
 *
 *
 * @copyright  Fridelance Design
 * @author     Yves Fridelance
 * @package    fd_webfonts
 */
class Webfonts extends \Frontend
{

    public function addWebfonts(\PageModel $objPage, \LayoutModel $objLayout, \PageRegular $objPageRegular) {

        $objRecords = $this->Database->prepare("SELECT * FROM tl_webfonts WHERE  published=1 ORDER by sorting ASC")
            ->execute();

        if($objRecords !== null)
        {
            while($objRecords->next())
            {

                $arrPages = unserialize($objRecords->pages);

                foreach($arrPages as $intPageId)
                {
                    $arrWebfonts[$intPageId] = $objRecords;
                }

                if(isset($arrWebfonts[$objPage->id]))
                {
                    $this->callProvider($arrWebfonts[$objPage->id]);
                }
                else
                {
                    $objParentPage = \PageModel::findParentsById($objPage->id);
                    if($objParentPage !== null)
                    {
                        while($objParentPage->next())
                        {
                            if(isset($arrWebfonts[$objParentPage->id]))
                            {
                                $this->callProvider($arrWebfonts[$objParentPage->id]);
                            }
                        }
                    }
                }

            }
        }
    }

    private function callProvider($objRecord) {

        // HOOK: compile form fields
        if (isset($GLOBALS['TL_HOOKS']['setWebfontsProvider']) && is_array($GLOBALS['TL_HOOKS']['setWebfontsProvider']))
        {
            foreach ($GLOBALS['TL_HOOKS']['setWebfontsProvider'] as $callback)
            {
                $this->import($callback[0]);
                $this->$callback[0]->$callback[1]($objRecord);
            }
        }
    }
}
<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   fd_webfonts
 * @author    Yves Fridelance <yves@fridelance.ch>
 * @license   GNU/LGPL
 * @copyright Fridelance 2014
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace FD\Webfonts\Provider;



/**
 * Class AdobeTypekit
 *
 * @copyright  Fridelance 2015
 * @author     Yves Fridelance <yves@fridelance.ch>
 * @package    fridelance.ch
 */
class AdobeTypekit
{

    protected $strTemplate = 'mod_webfonts_typekit';


    /**
     * @param $objWebfont
     */
    public function addFont($objWebfont) {


        if($objWebfont->enableTypekit) {

            $objTemplate = new \FrontendTemplate($this->strTemplate);
            $objTemplate->typekitId  = $objWebfont->typekitId;

            $GLOBALS['TL_HEAD'][] = $objTemplate->parse();
        }
    }
}
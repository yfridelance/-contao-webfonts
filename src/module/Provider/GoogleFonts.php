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
class GoogleFonts
{

    /**
     * @param $objWebfont
     */
    public function addFont($objWebfont) {

        if($objWebfont->enableGoogleFonts) {

            $GLOBALS['TL_CSS'][] = 'http://fonts.googleapis.com/css?family=' . str_replace('|', '%7C', $objWebfont->googleFontsStr);
        }
    }
}
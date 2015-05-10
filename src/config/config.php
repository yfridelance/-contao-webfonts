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

$GLOBALS['BE_MOD']['design']['webfonts'] = array
(
    'tables' => array('tl_webfonts'),
    'icon'   => 'system/modules/fd_webfonts/assets/icon.png'
);

// Register Provider
$GLOBALS['TL_HOOKS']['setWebfontsProvider'] = array(
    array('FD\Webfonts\Provider\AdobeTypekit','addFont'),
    array('FD\Webfonts\Provider\GoogleFonts','addFont'),
);

// Hooks
$GLOBALS['TL_HOOKS']['generatePage'][] = array('FD\Webfonts', 'addWebfonts');

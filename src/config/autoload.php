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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'FD',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'FD\Webfonts' => 'system/modules/fd_webfonts/module/Webfonts.php',

    // Provider
    'FD\Webfonts\Provider\AdobeTypekit' => 'system/modules/fd_webfonts/module/Provider/AdobeTypekit.php',
    'FD\Webfonts\Provider\GoogleFonts' => 'system/modules/fd_webfonts/module/Provider/GoogleFonts.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_webfonts_typekit'  => 'system/modules/fd_webfonts/templates/',
    'mod_webfonts_googlefonts'  => 'system/modules/fd_webfonts/templates/',
));
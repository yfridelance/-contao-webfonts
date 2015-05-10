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
 * Load tl_content language file
 */
System::loadLanguageFile('tl_content');
System::loadLanguageFile('tl_article');


/**
 * Table tl_webfonts
 */
$GLOBALS['TL_DCA']['tl_webfonts'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'            => 'Table',
        'enableVersioning'         => true,
        'switchToEdit'             => true,
        'onsubmit_callback'        => array
        (
            //array('DF\Webfonts', 'generateIcons')
        ),
        'sql' => array
        (
            'keys' => array
            (
                'id'               => 'primary',
                'pid'              => 'index'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                 => 1,
            'fields'               => array('name'),
            'flag'                 => 1,
            'panelLayout'          => 'search,limit',
        ),
        'label' => array
        (
            'fields'               => array('name'),
            'format'               => '%s',
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'            => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'             => 'act=select',
                'class'            => 'header_edit_all',
                'attributes'       => 'onclick="Backend.getScrollOffset();"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'            => &$GLOBALS['TL_LANG']['tl_tiles']['edit'],
                'href'             => 'act=edit',
                'icon'             => 'edit.gif'
            ),
            'copy' => array
            (
                'label'            => &$GLOBALS['TL_LANG']['tl_tiles']['copy'],
                'href'             => 'act=copy',
                'icon'             => 'copy.gif'
            ),
            'cut' => array
            (
                'label'            => &$GLOBALS['TL_LANG']['tl_tiles']['cut'],
                'href'             => 'act=paste&amp;mode=cut',
                'icon'             => 'cut.gif'
            ),
            'delete' => array
            (
                'label'            => &$GLOBALS['TL_LANG']['tl_tiles']['delete'],
                'href'             => 'act=delete',
                'icon'             => 'delete.gif',
                'attributes'       => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'toggle' => array
            (
                'label'            => &$GLOBALS['TL_LANG']['tl_tiles']['toggle'],
                'icon'             => 'visible.gif',
                'attributes'       => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'  => array('tl_webfonts', 'toggleIcon')
            ),
            'show' => array
            (
                'label'            => &$GLOBALS['TL_LANG']['tl_tiles']['show'],
                'href'             => 'act=show',
                'icon'             => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'             => array(
            'enableTypekit',
            'enableGoogleFonts'
        ),
        'default'                  =>   '{title_legend},name,alias;'
            . '{destination_legend:hide},pages;'
            . '{typekit_legend},enableTypekit;'
            . '{googleFonts_legend},enableGoogleFonts;'

    ),

    // Subpalettes
    'subpalettes' => array(
        'enableTypekit' => 'typekitId',
        'enableGoogleFonts' => 'googleFontsStr'
    ),

    // Fields
    'fields' => array
    (
        'name' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_webfonts']['name'],
            'exclude'              => true,
            'inputType'            => 'text',
            'eval'                 => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                  => "varchar(200) NOT NULL default ''"
        ),
        'alias' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_webfonts']['alias'],
            'exclude'              => true,
            'search'               => true,
            'flag'                 => 1,
            'inputType'            => 'text',
            'eval'                 => array('rgxp'=>'alias', 'unique'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
            'save_callback'        => array
            (
                array('tl_webfonts', 'generateAlias')
            ),
            'sql'                  => "varbinary(128) NOT NULL default ''"
        ),
        'pages' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_webfonts']['pages'],
            'exclude'              => true,
            'search'               => true,
            'sorting'              => true,
            'flag'                 => 1,
            'inputType'            => 'pageTree',
            'eval'                 => array('multiple'=>true, 'fieldType'=>'checkbox', 'mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                  => "blob NULL"
        ),

        // Adobe Typekit
        'enableTypekit' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_webfonts']['enableTypekit'],
            'exclude'              => true,

            'inputType'            => 'checkbox',
            'eval'                 => array('submitOnChange'=>true, 'tl_class'=>'clr'),
            'sql'                  => "char(1) NOT NULL default ''"
        ),

        'typekitId' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_webfonts']['typekitId'],
            'exclude'              => true,
            'inputType'            => 'text',
            'eval'                 => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr w50'),
            'sql'                  => "varchar(7) NOT NULL default ''"
        ),

        // Google Fonts
        'enableGoogleFonts' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_webfonts']['enableGoogleFonts'],
            'exclude'              => true,
            'inputType'            => 'checkbox',
            'eval'                 => array('submitOnChange'=>true, 'tl_class'=>'clr'),
            'sql'                  => "char(1) NOT NULL default ''"
        ),
        'googleFontsStr' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_webfonts']['googleFontsStr'],
            'exclude'              => true,
            'inputType'            => 'text',
            'eval'                 => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr w50'),
            'sql'                  => "varchar(200) NOT NULL default ''"
        ),

        'published' => array
        (
            'label'                => &$GLOBALS['TL_LANG']['tl_tiles']['published'],
            'exclude'              => true,
            'search'               => true,
            'sorting'              => true,
            'flag'                 => 1,
            'inputType'            => 'checkbox',
            'eval'                 => array('doNotCopy'=>true),
            'sql'                  => "char(1) NOT NULL default ''"
        ),

        'id' => array
        (
            'sql'                  => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'sql'                  => "int(10) unsigned NOT NULL default '0'",
        ),
        'tstamp' => array
        (
            'sql'                  => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
        (
            'sql'                  => "int(10) unsigned NOT NULL default '0'",
        ),
    )


);

/**
 * Class tl_tiles
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @package   trilobit
 * @author    Peter Adelmann
 * @license   LPGL
 * @copyright trilobit GmbH <http://www.trilobit.de>
 */
class tl_webfonts extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    /**
     * Auto-generate the news alias if it has not been set yet
     * @param mixed
     * @param \DataContainer
     * @return string
     * @throws \Exception
     */
    public function generateAlias($varValue, DataContainer $dc)
    {
        $autoAlias = false;

        // Generate alias if there is none
        if ($varValue == '')
        {
            $autoAlias = true;
            $varValue = standardize(String::restoreBasicEntities($dc->activeRecord->name));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_webfonts WHERE alias=?")
            ->execute($varValue);

        // Check whether the news alias exists
        if ($objAlias->numRows > 1 && !$autoAlias)
        {
            throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
        }

        // Add ID to alias
        if ($objAlias->numRows && $autoAlias)
        {
            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }


    /**
     * Return the "toggle visibility" button
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen(Input::get('tid')))
        {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if (!$row['published'])
        {
            $icon = 'invisible.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
    }


    /**
     * Disable/enable
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnVisible)
    {
        // Check permissions to edit
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');

        $objVersions = new Versions('tl_webfonts', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_webfonts']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_webfonts']['fields']['published']['save_callback'] as $callback)
            {
                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_webfonts SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_tiles.id='.$intId.'" has been created'.$this->getParentEntries('tl_webfonts', $intId), 'tl_webfonts toggleVisibility()', TL_GENERAL);
    }
}

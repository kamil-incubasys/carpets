<?php

/**
 * Class GirdGallery_Settings_Module
 * User settings module
 *
 * @package GirdGallery\Settings
 * @author Artur Kovalevsky
 */
class GirdGallery_Settings_Module extends Rsc_Mvc_Module
{

    /**
     * @var GirdGallery_Settings_Registry
     */
    private $registry;

    /**
     * Returns the Settings Registry
     *
     * @param GirdGallery_Settings_SettingsStorageInterface $storage
     * @return GirdGallery_Settings_Registry
     */
    public function getRegistry(GirdGallery_Settings_SettingsStorageInterface $storage = null)
    {
        if ($this->registry === null) {
            $this->registry = new GirdGallery_Settings_Registry(
                $this->getEnvironment()->getConfig()->get('hooks_prefix'),
                $storage
            );
        }

        return $this->registry;
    }

    /**
     * {@inheritdoc}
     */
    public function onInit()
    {
        $prefix = $this->getEnvironment()->getConfig()->get('hooks_prefix');

        add_action($prefix . 'after_ui_loaded', array(
            $this, 'loadAssets'
        ));

        $menu = $this->getEnvironment()->getMenu();
        $submenu = $menu->createSubmenuItem();
        $submenu->setCapability('manage_options')
            ->setMenuSlug('gird-gallery-settings')
            ->setMenuTitle('Settings')
            ->setPageTitle('Settings')
            ->setModuleName('settings');

        $menu->addSubmenuItem('settings', $submenu)->register();
    }

    public function onInstall()
    {
        parent::onInstall();

        $registry = $this->getRegistry();
        $registry->set('send_stats', 1);
    }

    /**
     * Loads the assets required by the module
     */
    public function loadAssets(GirdGallery_Ui_Module $ui)
    {
        $ui->add(new GirdGallery_Ui_BackendJavascript(
            'gg-settings-save-js',
            $this->getLocationUrl() . '/assets/js/gird-gallery.settings.clearCache.js'
        ));
    }
}
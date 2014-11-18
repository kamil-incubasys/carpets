<?php

/**
 * Class GirdGallery_Installer_Module
 */
class GirdGallery_Installer_Module extends GirdGallery_Core_Module
{
    const LAST_VERSION = 'grid_gallery_last_version';

    /**
     * @var GirdGallery_Installer_Model
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function onInit()
    {
        if (true == $this->getRequest()->query->get('force_db_update')) {
            $this->onInstall();
        }

        $config = $this->getEnvironment()->getConfig();
        $currentVersion = $config->get('plugin_version');
        $lastVersion = get_option(self::LAST_VERSION);

        if ($lastVersion === false) {
            update_option(self::LAST_VERSION, $currentVersion);
        }

        if (version_compare($currentVersion, $lastVersion, '>')) {
            update_option(self::LAST_VERSION, $currentVersion);

            if (false === $config->get('plugin_db_update')) {
                return;
            }

            $model = self::getModel();
            $queries = self::getQueries();

            $model->update($queries);
        }
    }

    /**
     * {@inhertidoc}
     */
    public function onInstall()
    {
        parent::onInstall();

        $model = self::getModel();
        $queries = self::getQueries();

        if (!$model->install($queries)) {
            wp_die('Failed to update database.');
        }
    }

    public function onDeactivation()
    {
        $response = $this->getController()->askUninstallAction();

        if (!is_bool($response)) {
            exit($response);
        }

        if ($response) {
            $model = self::getModel();
            $queries = self::getQueries();

            $model->drop($queries);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function onUninstall()
    {
        global $grid_gallery_ready;

        $self = $grid_gallery_ready->getModule('installer');
        $self->onDeactivation();
    }

    /**
     * Returns the database queries.
     * @return array|null
     */
    protected static function getQueries()
    {
        if (!is_file($file = dirname(__FILE__) . '/Queries.php')) {
            return null;
        }

        return include $file;
    }

    protected static function getModel()
    {
        return new GirdGallery_Installer_Model();
    }

}

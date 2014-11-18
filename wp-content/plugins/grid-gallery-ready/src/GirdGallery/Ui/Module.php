<?php

/**
 * Class GirdGallery_Ui_Module
 * User Interface Module
 *
 * @package GirdGallery\Ui
 * @author Artur Kovalevsky
 */
class GirdGallery_Ui_Module extends Rsc_Mvc_Module
{
    /**
     * @var array
     */
    protected $javascripts;

    /**
     * @var array
     */
    protected $stylesheets;

    /**
     * @var GirdGallery_Ui_AssetsCollection
     */
    protected $assets;

    /**
     * {@inheritdoc}
     */
    public function onInit()
    {
        parent::onInit();

        $this->assets = new GirdGallery_Ui_AssetsCollection();

        $this->preload();

        $config = $this->getEnvironment()->getConfig();

        add_action(
            $config->get('hooks_prefix') . 'after_modules_loaded',
            array($this->assets, 'load')
        );

        add_action('admin_enqueue_scripts', array($this, 'colorpicker'));
    }

    public function colorpicker()
    {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('gg-color-picker', $this->getLocationUrl() . '/js/colorpicker.js', array('wp-color-picker'));
    }

    /**
     * Adds the asset
     * @param GirdGallery_Ui_Asset $asset
     */
    public function add(GirdGallery_Ui_Asset $asset)
    {
        $this->assets->add($asset);
    }

    /**
     * Returns the asset if it exists.
     * @param string $handle
     * @param mixed $default
     * @return GirdGallery_Ui_Asset
     */
    public function get($handle, $default = null)
    {
        return $this->assets->get($handle, $default);
    }

    /**
     * Deletes the asset.
     * @param string $handle
     * @return bool
     */
    public function delete($handle)
    {
        return $this->assets->delete($handle);
    }

    /**
     * Preloads the assets
     */
    protected function preload()
    {
        /* URL to the plugin folder */
        $url = $this->getEnvironment()->getConfig()->get('plugin_url');

        /* CSS */
        $this->add(new GirdGallery_Ui_BackendStylesheet('gg-ui', $url . '/app/assets/css/ready-ui.css'));
        $this->add(new GirdGallery_Ui_BackendStylesheet('gg-jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css'));
        $this->add(new GirdGallery_Ui_BackendStylesheet('gg-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'));
        $this->add(new GirdGallery_Ui_BackendStylesheet('gg-jgrowl', '//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.2.12/jquery.jgrowl.min.css'));
        $this->add(new GirdGallery_Ui_BackendStylesheet('gg-tooltipster', '//cdn.jsdelivr.net/jquery.tooltipster/2.1.4/css/tooltipster.css'));
        $this->add(new GirdGallery_Ui_BackendStylesheet('gg-animate-css', $url . '/app/assets/css/animate.css'));

        /* Javascript */
        $this->add(new GirdGallery_Ui_BackendJavascript('jquery'));
        $this->add(new GirdGallery_Ui_BackendJavascript('jquery-ui-dialog'));

        $this->add(new GirdGallery_Ui_BackendJavascript('gg-types', $this->getLocationUrl() . '/js/types.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-ui-js', $url . '/app/assets/js/gird-gallery.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-lazy-load-ks', $url . '/app/assets/js/jquery.lazyload.min.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-form-serializer-js', $this->getLocationUrl() . '/plugins/gird-gallery.ui.formSerialize.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-jgrowl-js', '//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.2.12/jquery.jgrowl.min.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-tooltipster-js', '//cdn.jsdelivr.net/jquery.tooltipster/2.1.4/js/jquery.tooltipster.min.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-toolbar-js', $this->getLocationUrl() . '/plugins/gird-gallery.ui.toolbar.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-cb-observ', $this->getLocationUrl() . '/js/checkbox-observer.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-ui-toolbar', $this->getLocationUrl() . '/js/toolbar.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-common', $this->getLocationUrl() . '/js/common.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-ajax', $this->getLocationUrl() . '/js/ajax.js'));
        $this->add(new GirdGallery_Ui_BackendJavascript('gg-ajax-queue', $this->getLocationUrl() . '/js/ajaxQueue.js'));
    }

}

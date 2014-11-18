<?php

/**
 * Class GirdGallery_Galleries_Module
 *
 * @package GirdGallery\Galleries
 * @author Artur Kovalevsky
 */
class GirdGallery_Galleries_Module extends Rsc_Mvc_Module
{

    /**
     * {@inheritdoc}
     */
    public function onInit()
    {
        parent::onInit();

        $this->registerMenu();
        $this->registerShortcode();

        $resources = new GirdGallery_Galleries_Model_Resources();

        $config = $this->getEnvironment()->getConfig();
        $prefix = $config->get('hooks_prefix');

        add_action($prefix . 'after_ui_loaded', array($this, 'loadAssets'));
        add_action($prefix . 'gallery_delete', array($resources, 'deleteByGalleryId'));

        /* Delete attachment */
        add_action(
            'gird_gallery_delete_image',
            array(
                $resources,
                'deleteByResourceId'
            )
        );

        add_action(
            'gg_delete_photo_id',
            array(
                $resources,
                'deletePhotoById'
            )
        );

        add_image_size('gg_gallery_thumbnail', 350, 150, true);

        // !!!!!! use {} for preg_* functions as start and end of the expresion.
        $pregReplaceFilter = new Twig_SimpleFilter(
            'preg_replace',
            array($this, 'pregReplace')
        );

        $httpFilter = new Twig_SimpleFilter(
            'force_http',
            array($this, 'forceHttpUrl')
        );

        $twig = $this->getEnvironment()
            ->getTwig();

        $twig->addFilter($pregReplaceFilter);
        $twig->addFilter($httpFilter);

        // It allows to extract settings for presets.
        // It will be removed in next version.
        if ($this->getRequest()->query->has('extract')) {
            $galleryId = $this->getRequest()->query->get('gallery_id');

            if (!$galleryId) {
                return;
            }

            $settings = new GirdGallery_Galleries_Model_Settings();
            $entity = $settings->getByGalleryId($galleryId);

            if (!is_object($entity)) {
                add_action('admin_notices', array($this, 'extractNoticeError'));
            }

            $data = $entity->data;

            if (isset($data['cover'])) {
                $data['cover'] = '';
            }

            add_filter('extractNoticeSettings', create_function('', 'return serialize(' . var_export($data, true) . ');'));
            add_action('admin_notices', array($this, 'extractNoticeSettings'));
        }
    }

    // --- Will be removed.

    public function extractNoticeError()
    {
        echo '<div class="error"><p>This gallery is not configured.</p></div>';
    }

    public function extractNoticeSettings()
    {
        $settings = apply_filters('extractNoticeSettings', '');

        printf('<div class="updated"><p><pre style="word-wrap:break-word;">%s</pre></p></div>', $settings);
    }

    // ---

    public function pregReplace($value, $pattern, $replacement)
    {
        return preg_replace($pattern, $replacement, $value);
    }

    /**
     * Adds the http:// to the URL's without it.
     * @param  string $url URL.
     * @return string
     */
    public function forceHttpUrl($url)
    {
        if (!preg_match('/^https?:\/\//', $url)) {
            return 'http://' . $url;
        }

        return $url;
    }

    /**
     * Loads assets
     * @param GirdGallery_Ui_Module $ui An instance of the UI module.
     */
    public function loadAssets(GirdGallery_Ui_Module $ui)
    {
        /* CSS */
        $ui->add(new GirdGallery_Ui_BackendStylesheet(
            'gg-galleries-style',
            $this->getLocationUrl() . '/assets/css/gird-gallery.galleries.style.css'
        ));

        // Ok, we need to include frontend effects to backend to use it with effects preview.
        $ui->add(new GirdGallery_Ui_BackendStylesheet(
            'gg-galleries-effects-be',
            $this->getLocationUrl() . '/assets/css/gird-gallery.galleries.effects.css'
        ));

        /* JS */
        $ui->add(new GirdGallery_Ui_BackendJavascript(
            'gg-galleries-index-js',
            $this->getLocationUrl() . '/assets/js/gird-gallery.galleries.index.js'
        ));

        $ui->add(new GirdGallery_Ui_BackendJavascript(
            'gg-galleries-view-js',
            $this->getLocationUrl() . '/assets/js/gird-gallery.galleries.view.js'
        ));

        $ui->add(new GirdGallery_Ui_BackendJavascript(
            'gg-galleries-preview-js',
            $this->getLocationUrl() . '/assets/js/gird-gallery.galleries.preview.js'
        ));

        $ui->add(new GirdGallery_Ui_BackendJavascript(
            'gg-galleries-thumb-js',
            $this->getLocationUrl() . '/assets/js/gird-gallery.galleries.thumb.js'
        ));

        $ui->add(new GirdGallery_Ui_BackendJavascript(
            'gg-gallery-settings',
            $this->getLocationUrl() . '/assets/js/settings.js'
        ));

        $ui->add(
            new GirdGallery_Ui_BackendJavascript(
                'gg-gallery-images',
                $this->getLocationUrl() . '/assets/js/addImages.js'
            )
        );

        $ui->add(
            new GirdGallery_Ui_BackendJavascript(
                'gg-galleries-pos',
                $this->getLocationUrl() . '/assets/js/position.js'
            )
        );

        $ui->add(new GirdGallery_Ui_Javascript('jquery'));
    }

    /**
     * Shortcode callback.
     * @param  array $attributes An array of the shortcode parameters.
     * @return string
     */
    public function getGallery($attributes)
    {
        $galleries = new GirdGallery_Galleries_Model_Galleries();
        $twig = $this->getEnvironment()->getTwig();
        $cache = $this->getEnvironment()->getCache();
        $gallery = $galleries->getById($attributes['id']);

        if (!$gallery) {
            return;
        }

        $key = sprintf('gallery_settings_%s', $attributes['id']);

        /** @var GirdGallery_Settings_Registry $registry */
        $registry = $this->getEnvironment()
            ->getModule('settings')
            ->getRegistry();

        if (true === (bool)$registry->get('cache_enabled')) {
            $ttl = $registry->get('cache_ttl');
            $cache->setTtl($ttl);

            if (null === $settings = $cache->get($key)) {
                $settings = $this->getGallerySettings($attributes['id']);
                $cache->set($key, $settings, (int)$ttl);
            }
        } else {
            $settings = $this->getGallerySettings($attributes['id']);
        }

        add_action('wp_footer', array($this, 'addFrontendCss'));
        add_action('wp_footer', array($this, 'addFrontendJs'));

        if (property_exists($gallery, 'photos') && is_array($gallery->photos)) {
            $position = new GirdGallery_Photos_Model_Position();

            foreach ($gallery->photos as $index => $row) {
                $gallery->photos[$index] = $position->setPosition(
                    $row,
                    'gallery',
                    $gallery->id
                );
            }

            $gallery->photos = $position->sort($gallery->photos);

            $cats = array();
            foreach ($gallery->photos as $photo) {
                if (property_exists($photo, 'tags') && is_array($photo->tags) && count($photo->tags) > 0) {
                    foreach ($photo->tags as $tag) {
                        if (!isset($cats[$tag])) {
                            $cats[$tag] = true;
                        }
                    }
                }
            }
        }

        if(get_option('post_to_render' . $attributes['id'])) {
            $posts = array();
            foreach(get_option('post_to_render' . $attributes['id']) as $id) {
                $row = array();
                $post = get_post($id);
                $row['author'] = get_user_by('id', $post->post_author)->user_login;
                $row['title'] = $post->post_title;
                $row['content'] = $post->post_content;
                $row['date'] = $post->post_date;
                $row['url'] = get_permalink($id);
                $row['photo'] = wp_get_attachment_url(get_post_thumbnail_id($id));
                $posts[] = $row;
            }
            update_option('post_photos', $posts);
        }

        $template = $twig->render(
            '@galleries/shortcode/gallery.twig',
            array(
                'gallery' => $gallery,
                'settings' => is_object($settings) ? $settings->data : $settings,
                'colorbox' => $this->getEnvironment()->getModule('colorbox')
                    ->getLocationUrl(),
                'categories' => isset($cats) ? $cats : array(),
                'posts' => $posts,
            )
        );
        
        return preg_replace('/\s+/', ' ', trim($template));
    }

    public function addFrontendCss()
    {
        $stylesheets = $this->getFrontendCss();

        foreach ($stylesheets as $url) {
            echo '<link rel="stylesheet" type="text/css" href="' . $url . '"/>';
        }
    }

    public function addFrontendJs()
    {
        $javascripts = array(
            // $this->getLocationUrl() . '/assets/js/gird-gallery.galleries.frontend.js'
            $this->getLocationUrl() . '/assets/js/frontend.js'
        );

        foreach ($javascripts as $url) {
            echo '<script type="text/javascript" src="' . $url . '"></script>';
        }
    }

    public function getFrontendCss()
    {
        $css = array(
            $this->getLocationUrl() . '/assets/css/gird-gallery.galleries.frontend.css',
            $this->getLocationUrl() . '/assets/css/gird-gallery.galleries.effects.css',
        );

        return $css;
    }

    /**
     * Returns the gallery settings from the database.
     * If gallery is not configured, then default settings will be loaded.
     * @param int $galleryId Gallery identifier.
     * @return array
     */
    public function getGallerySettings($galleryId)
    {
        $model = new GirdGallery_Galleries_Model_Settings();

        if (null === $settings = $model->get((int)$galleryId)) {
            $config = $this->getEnvironment()->getConfig();
            $config->load('@galleries/settings.php');

            $settings = unserialize($config->get('gallery_settings'));
        }

        return $settings;
    }

    /**
     * Registers the Grid Gallery shortcode in the WordPress.
     */
    public function registerShortcode()
    {
        $attachment = new GirdGallery_Galleries_Attachment();
        $handler = array($this, 'getGallery');
        $shortcode = $this->getEnvironment()
            ->getConfig()
            ->get('shortcode_name');

        $this->getEnvironment()
            ->getTwig()
            ->addFunction(
                new Twig_SimpleFunction('get_attachment', array(
                        $attachment,
                        'getAttachment'
                    )
                )
            );

        if (!empty($shortcode) && $shortcode !== null) {
            add_shortcode($shortcode, $handler);
        }

        // for the backward capability =< 0.2.2
        add_shortcode('gird-gallery', $handler);
    }

    /**
     * Adds the submenu item "New gallery".
     */
    public function registerMenu()
    {
        $lang = $this->getEnvironment()->getLang();
        $menu = $this->getEnvironment()->getMenu();
        $submenu = $menu->createSubmenuItem();

        $submenu->setCapability('manage_options')
            ->setMenuSlug('gird-gallery-new')
            ->setMenuTitle($lang->translate('New gallery'))
            ->setPageTitle($lang->translate('New gallery'))
            ->setModuleName('galleries');

        $menu->addSubmenuItem('newGallery', $submenu)
            ->register();
    }
}

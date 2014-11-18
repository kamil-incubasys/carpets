<?php

/**
 * Class GirdGallery_Ui_Stylesheet
 *
 * Object-Oriented stylesheet implementation for the WordPress.
 */
class GirdGallery_Ui_Stylesheet extends GirdGallery_Ui_Asset
{
    /**
     * @var string
     */
    protected $media;

    /**
     * Constructor
     * @param string $handle
     * @param string $source
     * @param bool $preventCaching
     */
    public function __construct($handle, $source = null, $preventCaching = false)
    {
        parent::__construct($handle, $source, $preventCaching);

        $this->media = 'all';
    }

    /**
     * Sets the media
     * @param string $media
     * @return GirdGallery_Ui_Stylesheet
     */
    public function setMedia($media)
    {
        $this->media = $media;
        return $this;
    }

    /**
     * Returns the media
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Enqueue the asset
     */
    public function enqueue()
    {
        wp_enqueue_style(
            $this->handle,
            $this->source,
            $this->deps,
            $this->version,
            $this->media
        );
    }

    public function load()
    {
        $this->register('wp_print_styles');
    }
}
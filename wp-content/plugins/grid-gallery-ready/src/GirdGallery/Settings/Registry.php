<?php

/**
 * Class GirdGallery_Settings_Registry
 *
 * @package GirdGallery\Settings
 * @author Artur Kovalevsky
 */
class GirdGallery_Settings_Registry
{

    /**
     * @var GirdGallery_Settings_SettingsStorageInterface
     */
    private $storage;

    /**
     * @var null|string
     */
    protected $prefix;

    /**
     * Constructor
     *
     * @param string $prefix
     * @param GirdGallery_Settings_SettingsStorageInterface $storage
     */
    public function __construct(
        $prefix = null,
        GirdGallery_Settings_SettingsStorageInterface $storage = null
    )
    {
        $this->prefix = $prefix;
        $this->storage = $storage ? $storage : $this->createDefaultStorage();
    }

    /**
     * @param null|string $prefix
     * @return GirdGallery_Settings_Registry
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param \GirdGallery_Settings_SettingsStorageInterface $storage
     * @return GirdGallery_Settings_Registry
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return \GirdGallery_Settings_SettingsStorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @see GirdGallery_Settings_SettingsStorageInterface::add
     */
    public function add($key, $value)
    {
        $this->storage->add($this->prefix . $key, $value);
    }

    /**
     * @see GirdGallery_Settings_SettingsStorageInterface::get
     */
    public function get($key, $default = null)
    {
        return $this->storage->get($this->prefix . $key, $default);
    }

    /**
     * @see GirdGallery_Settings_SettingsStorageInterface::set
     */
    public function set($key, $value)
    {
        $this->storage->set($this->prefix . $key, $value);
    }

    /**
     * @see GirdGallery_Settings_SettingsStorageInterface::delete
     */
    public function delete($key)
    {
        $this->storage->delete($this->prefix . $key);
    }

    /**
     * @see GirdGallery_Settings_SettingsStorageInterface::all
     */
    public function all()
    {
        return $this->storage->all($this->prefix);
    }

    private function createDefaultStorage()
    {
        return new GirdGallery_Settings_Storage_WordpressStorage();
    }
} 
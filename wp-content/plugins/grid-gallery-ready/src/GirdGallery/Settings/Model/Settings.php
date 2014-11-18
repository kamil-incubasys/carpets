<?php

/**
 * Class GirdGallery_Settings_Model_Settings
 *
 * @package GirdGallery\Settings\Model
 * @author Artur Kovalevsky
 */
class GirdGallery_Settings_Model_Settings extends GirdGallery_Core_BaseModel
{

    /**
     * @var GirdGallery_Settings_Registry
     */
    private $registry;

    /**
     * Sets the Settings Registry object
     *
     * @param \GirdGallery_Settings_Registry $registry
     * @return GirdGallery_Settings_Model_Settings
     */
    public function setRegistry($registry)
    {
        $this->registry = $registry;
        return $this;
    }

    public function save(Rsc_Http_Request $request)
    {
        foreach ($request->post as $field => $value) {
            $this->registry->set($field, $value);
        }
    }
} 
<?php

/**
 * Class GirdGallery_Ui_BackendStylesheet
 *
 * Loads the stylesheet to backend.
 */
class GirdGallery_Ui_BackendStylesheet extends GirdGallery_Ui_Stylesheet
{
    /**
     * {@inheritdoc}
     */
    public function load()
    {
        $request = Rsc_Http_Request::create();

        if (false !== strpos($request->query->get('page'), 'gird-gallery')) {
            $this->register('admin_print_styles');
        }
    }
} 
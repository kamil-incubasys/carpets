<?php

/**
 * Class GirdGallery_Ui_BackendJavascript
 */
class GirdGallery_Ui_BackendJavascript extends GirdGallery_Ui_Javascript
{
    /**
     * {@inheritdoc}
     */
    public function load()
    {
        $request = Rsc_Http_Request::create();

        if (false !== strpos($request->query->get('page'), 'gird-gallery')) {
            $this->register('admin_print_scripts');
        }
    }
}
<?php


class GirdGallery_Installer_Controller extends GirdGallery_Core_BaseController
{
    public function askUninstallAction()
    {
        $request = $this->getRequest();

        if ($request->query->has('drop')) {
            if ('Yes' == $request->query->get('drop')) {
                return true;
            } else {
                return false;
            }
        }

        return $this->getEnvironment()
            ->getTwig()
            ->render(
                '@installer/uninstall.twig',
                array(
                    'request' => $this->getRequest(),
                )
            );
    }
} 
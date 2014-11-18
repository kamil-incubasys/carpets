<?php


class GirdGallery_Insta_Module extends Rsc_Mvc_Module
{

    protected $client;

    /**
     * {@inheritdoc}
     */
    public function onInit()
    {
        $environment = $this->getEnvironment();
        $config = $environment->getConfig();

        // Client ID
        $config->add('instagram_id', 'c7eca993fa6c47549df930dbed07c7da');

        // Client Secret
        $config->add('instagram_secret', 'e8db8713c91945559d26bb5d77eed5c0');

        // Authenticator's Instagram URL
        $config->add('instagram_redirect', 'http://readyshoppingcart.com/authenticator/index.php/authenticator/instagram');

        // Authenticator redirect uri
        $config->add(
            'instagram_state',
            $environment->generateUrl('insta', 'complete')
        );
    }

    /**
     * Returns Instagram client.
     *
     * @return GirdGallery_Insta_Client
     */
    public function getClient()
    {
        if (!$this->client) {
            $config = $this->getEnvironment()->getConfig();
            $client = new GirdGallery_Insta_Client();

            $client->setClientId($config->get('instagram_id'));
            $client->setClientSecret($config->get('instagram_secret'));
            $client->setRedirectUri($config->get('instagram_redirect'));
            $client->setState($config->get('instagram_state'));

            $this->client = $client;
        }

        return $this->client;
    }
} 
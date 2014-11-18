<?php

/**
 * Class GirdGallery_Galleries_Controller
 * The controller of the Galleries module.
 *
 * @package GirdGallery\Galleries
 * @author  Artur Kovalevsky
 */
class GirdGallery_Galleries_Controller extends GirdGallery_Core_BaseController
{

    const STD_VIEW = 'list'; // list or block

    /**
     * {@inheritdoc}
     */
    protected function getModelAliases()
    {
        return array(
            'galleries' => 'GirdGallery_Galleries_Model_Galleries',
            'resources' => 'GirdGallery_Galleries_Model_Resources',
            'settings' => 'GirdGallery_Galleries_Model_Settings',
            'preset' => 'GirdGallery_Galleries_Model_Preset',
            'photos' => 'GirdGallery_Photos_Model_Photos',
            'folders' => 'GirdGallery_Photos_Model_Folders',
            'position' => 'GirdGallery_Photos_Model_Position',
        );
    }

    /**
     * Index Action
     * Shows the list of the galleries
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function indexAction(Rsc_Http_Request $request)
    {
        if ('gird-gallery-new' === $request->query->get('page')) {
            $redirectUrl = $this->generateUrl('galleries') . '#add';

            return $this->redirect($redirectUrl);
        }

        $galleries = $this->getModel('galleries')->getAll();

        $twig = $this->getEnvironment()->getTwig();
        $twig->addFunction(
            new Twig_SimpleFunction(
                'get_image_src',
                'wp_get_attachment_image_src'
            )
        );

        return $this->response(
            '@galleries/index.twig',
            array(
                'galleries' => $galleries,
                'attachment_size' => 'gg_gallery_thumbnail',
            )
        );
    }

    /**
     * Preview Action
     */
    public function previewAction(Rsc_Http_Request $request)
    {
        $this->saveEvent('galleries.preview');

        $galleryId = $request->query->get('gallery_id');
        $shortcode = $this->getEnvironment()
            ->getConfig()
            ->get('shortcode_name', 'gird-gallery');

        try {
            $preview = new GirdGallery_Galleries_Model_Preview();
            $postId = $preview->setPostContent(
                sprintf('[%s id="%s"]', $shortcode, $galleryId)
            );
        } catch (Exception $e) {
            return $this->response('error.twig', array(
                'message' => $e->getMessage(),
            ));
        }

        if(!get_option('wpurl')) {
            update_option('wpurl', '/wordpress');
        }

        return $this->response('@galleries/preview.twig', array(
            'base_url' => get_option('wpurl'),
            'post_id' => $postId,
            'gallery_id' => $galleryId,
        ));
    }

    /**
     * View Action
     * Renders single gallery page
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function viewAction(Rsc_Http_Request $request)
    {
        if (!$galleryId = $request->query->get('gallery_id')) {
            $this->redirect($this->generateUrl('galleries', 'index'));
        }

        if (!$gallery = $this->getModel('galleries')->getById(
            (int)$galleryId
        )
        ) {
            $this->redirect($this->generateUrl('galleries', 'index'));
        }

        $position = $this->getModel('position');

        if (is_object($gallery) && (property_exists($gallery, 'photos') && is_array($gallery->photos))) {
            foreach ($gallery->photos as $index => $row) {
                $gallery->photos[$index] = $position->setPosition(
                    $row,
                    'gallery',
                    $gallery->id
                );
            }

            $gallery->photos = $position->sort($gallery->photos);
        }

        return $this->response(
            '@galleries/view.twig',
            array(
                'gallery' => $gallery,
                'viewType' => $request->query->get('view', self::STD_VIEW),
                'ajaxUrl' => admin_url('admin-ajax.php'),
            )
        );
    }

    /**
     * List Action
     * Returns the AJAX response with galleries list
     *
     * @return Rsc_Http_Response
     */
    public function listAction()
    {
        return $this->response(
            'ajax',
            array(
                'galleries' => $this->getModel('galleries')->getList(),
            )
        );
    }

    /**
     * Create Action
     * Creates the new gallery from the POST request
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function createAction(Rsc_Http_Request $request)
    {
        $galleries = $this->getModel('galleries');
        $language = $this->getEnvironment()->getLang();
        $logger = $this->getEnvironment()->getLogger();
        $config = $this->getEnvironment()->getConfig();

        $stats = $this->getEnvironment()->getModule('stats');
        $stats->save('galleries.create');

        try {
            $galleries->createFromRequest($request, $language, $config);
        } catch (Exception $e) {
            if ($logger) {
                $logger->error(
                    'Create a new gallery failed: {exception}',
                    array('exception' => $e)
                );
            }

            return $this->response(
                'ajax',
                $this->getErrorResponseData($e->getMessage())
            );
        }

        return $this->response(
            'ajax',
            $this->getSuccessResponseData(
                $this->translate('New gallery successfully created'),
                array(
                    'id' => $galleries->getInsertId(),
                    'url' => $this->generateUrl('galleries', 'settings', array(
                        'gallery_id' => $galleries->getInsertId(),
                    ))
                )
            )
        );
    }

    /**
     * Attach Action
     * Attaches resources to the specified gallery
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function attachAction(Rsc_Http_Request $request)
    {
        $logger = $this->getEnvironment()->getLogger();
        $lang = $this->getEnvironment()->getLang();

        try {

            $gid = $this->getModel('resources')->attachFromRequest($request, $lang);

        } catch (GirdGallery_Galleries_Exception_AttachException $e) {

            if ($logger) {
                $logger->error(
                    'Failed to attach resources to gallery: {exception}',
                    array(
                        'exception' => $e,
                    )
                );
            }

            return $this->response(
                'ajax',
                $this->getErrorResponseData(
                    $e->getMessage()
                )
            );
        }

        $galleries = new GirdGallery_Galleries_Model_Galleries();
        $gallery = $galleries->getById($gid);

        return $this->response(
            'ajax',
            $this->getSuccessResponseData(
                sprintf(
                    $lang->translate(
                        'The resources are successfully attached to the <a href="%s">%s</a>'
                    ),
                    $this->generateUrl(
                        'galleries',
                        'view',
                        array('gallery_id' => $gid)
                    ),
                    $gallery->title
                )
            )
        );

    }

    /**
     * Rename Action
     * Renames the specified gallery
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function renameAction(Rsc_Http_Request $request)
    {
        $lang = $this->getEnvironment()->getLang();
        $logger = $this->getEnvironment()->getLogger();

        $stats = $this->getEnvironment()->getModule('stats');
        $stats->save('galleries.rename');

        try {

            $this->getModel('galleries')->renameFromRequest($request, $lang);

        } catch (Exception $e) {

            if ($logger) {
                $logger->error(
                    'Invalid argument specified: {exception}',
                    array(
                        'exception' => $e,
                    )
                );
            }

            return $this->response(
                'ajax',
                $this->getErrorResponseData(
                    $e->getMessage()
                )
            );

        }

        return $this->response(
            'ajax',
            $this->getSuccessResponseData(
                $lang->translate('Title successfully updated')
            )
        );
    }

    /**
     * Delete Action
     * Deletes the gallery
     *
     * @param Rsc_Http_Request $request An instance of the HTTP request
     * @return Rsc_Http_Response
     */
    public function deleteAction(Rsc_Http_Request $request)
    {
        $env = $this->getEnvironment();
        $lang = $env->getLang();
        $logger = $env->getLogger();
        $prefix = $env->getConfig()->get('hooks_prefix');

        $stats = $this->getEnvironment()->getModule('stats');
        $stats->save('galleries.delete');

        try {

            $this->getModel('galleries')->deleteFromRequest(
                $request,
                $lang,
                $prefix
            );

        } catch (Exception $e) {

            if ($logger) {
                $logger->error(
                    'Failed to delete the gallery: {exception}',
                    array(
                        'exception' => $e,
                    )
                );
            }

            return $this->response(
                'ajax',
                $this->getErrorResponseData($e->getMessage())
            );
        }

        return $this->redirect($this->generateUrl('galleries'));
    }

    /**
     * Deletes the resources from the specified gallery.
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function deleteResourceAction(Rsc_Http_Request $request)
    {
        $resources = $this->getModel('resources');

        try {
            $resources->deleteFromRequest($request);
        } catch (Exception $e) {
            return $this->response(
                'ajax',
                $this->getErrorResponseData($e->getMessage())
            );
        }

        return $this->response('ajax', $this->getSuccessResponseData('Deleted successfully.'));

    }

    /**
     * Shows the page with photos to attach them to the gallery.
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function addImagesAction(Rsc_Http_Request $request)
    {
        if (null === $galleryId = $request->query->get('gallery_id')) {
            // 404 - gallery not found
        }

        /** @var GirdGallery_Galleries_Model_Galleries $galleries */
        $galleries = $this->getModel('galleries');
        $gallery = $galleries->getById($galleryId);


        return $this->response(
            '@galleries/add_images.twig',
            array(
                'gallery' => $gallery,
                'photos' => $this->getModel('photos')->getAllWithoutFolders(),
                'folders' => $this->getModel('folders')->getAll(),
                'viewType' => $request->query->get('view', 'block'),
            )
        );
    }

    /**
     * Settings Action.
     * Manage gallery settings
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function settingsAction(Rsc_Http_Request $request)
    {
        $galleryId = $request->query->get('gallery_id');

        $this->getEnvironment()->getConfig()->load('@galleries/tooltips.php');

        $tooltips = $this->getEnvironment()->getConfig()->get('tooltips');
        $icon = $this->getEnvironment()->getConfig()->get('tooltips_icon');

        $tooltips = array_map(array($this, 'rewrite'), $tooltips);

        $this->getEnvironment()->getTwig()->addGlobal('tooltips', $tooltips);
        $this->getEnvironment()->getTwig()->addGlobal('tooltips_icon', $icon);

        $twig = $this->getEnvironment()->getTwig();
        $twig->addFunction(
            new Twig_SimpleFunction(
                'get_image_src',
                'wp_get_attachment_image_src'
            )
        );

        $settings = $this->getModel('settings')->get($galleryId);
//        $preset   = $this->getModel('preset')->getBySettingsId($settings->id);

        if (!is_object($settings) || null === $settings->data) {
            $config = $this->getEnvironment()->getConfig();
            $config->load('@galleries/settings.php');

            $settings = new stdClass;

            $settings->id = null;
            $settings->data = unserialize($config->get('gallery_settings'));
        }

        $postsSelect = array();
        $postsRender = array();
        foreach(get_posts() as $post)
            $postsSelect[$post->ID] = $post->post_title;

        update_option('posts_select', $postsSelect);

        foreach(get_option('post_to_render' . $galleryId) as $id) {
            $row = array();
            $post = get_post($id);
            $row['author'] = get_user_by('id', $post->post_author)->user_login;
            $row['title'] = $post->post_title;
            $row['id'] = $post->ID;
            $row['comments'] = $post->comment_count;
            $row['date'] = $post->post_date;
            $postsRender[] = $row;
        }

        return $this->response(
            '@galleries/settings.twig',
            array(
                'gallery' => $this->getModel('galleries')->getById($galleryId),
                'settings' => $settings->data,
                'id' => $settings->id,
                'posts' => $postsSelect,
                'postsRender' => $postsRender,
                // deprecated
                'preset' => null,
            )
        );
    }

    public function savePostsAction(Rsc_Http_Request $request) {
        $posts_id = array();
        $currentPosts = get_option('post_to_render' . $request->post->get('galleryId'));
        if(!$currentPosts) {
            array_push($posts_id, $request->post->get('id'));
        } else {
            foreach($currentPosts as $current) {
                array_push($posts_id, $current);
            }
            array_push($posts_id, $request->post->get('id'));
        }
        update_option('post_to_render' . $request->post->get('galleryId'), $posts_id);

        $post = get_post($request->post->get('id'));
        return $this->response(Rsc_Http_Response::AJAX, array(
            'post_author' => get_user_by('id', $post->post_author)->user_login,
            'post_date' => $post->post_date,
            'comment_count' => $post->comment_count,
        ));
    }

    public function removePostsAction(Rsc_Http_Request $request) {
        $currentPosts = get_option('post_to_render' . $request->post->get('galleryId'));
        foreach($request->post->get('id') as $id) {
            if(($key = array_search($id, $currentPosts)) !== false) {
                unset($currentPosts[$key]);
            }
        }
        update_option('post_to_render' . $request->post->get('galleryId'), $currentPosts);
        return $this->response(Rsc_Http_Response::AJAX);
    }

    /**
     * Save Settings Action
     * Saves the specified gallery's settings
     *
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function saveSettingsAction(Rsc_Http_Request $request)
    {
        /** @var GirdGallery_Galleries_Model_Settings $settings */
        $settings = $this->getModel('settings');

        $settings->save(
            $request->query->get('gallery_id'),
            $request->post->all()
        );

        return $this->redirect(
            $this->generateUrl(
                'galleries',
                'settings',
                array(
                    'gallery_id' => $request->query->get('gallery_id'),
                )
            )
        );
    }

    /**
     * Save Preset Action
     * Saves the settings preset to the database.
     * @param Rsc_Http_Request $request HTTP request.
     * @return Rsc_Http_Response
     */
    public function savePresetAction(Rsc_Http_Request $request)
    {
        $preset = $this->getModel('preset');
        $settingsId = $request->post->get('settings_id');
        $presetTitle = $request->post->get('title');

        $lang = $this->getEnvironment()->getLang();

        if (empty($settingsId) || empty($presetTitle)) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    $lang->translate('Not enough data.')
                )
            );
        }

        if ($preset->set($settingsId, $presetTitle)) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getSuccessResponseData(
                    $lang->translate('Preset successfully saved.')
                )
            );
        }

        return $this->response(
            Rsc_Http_Response::AJAX,
            $this->getErrorResponseData(
                $lang->translate(
                    sprintf(
                        'Failed to save the preset: %s',
                        $preset->getLastError()
                    )
                )
            )
        );
    }

    /**
     * Remove Preset Action
     * Removes the settings preset by the preset id.
     * @param Rsc_Http_Request $request
     * @return Rsc_Http_Response
     */
    public function removePresetAction(Rsc_Http_Request $request)
    {
        $preset = $this->getModel('preset');
        $presetId = $request->post->get('preset_id');

        $lang = $this->getEnvironment()->getLang();

        if (null === $presetId || empty($presetId)) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    $lang->translate('The preset ID is not specified.')
                )
            );
        }

        if ($preset->remove($presetId)) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getSuccessResponseData(
                    $lang->translate('Preset successfully removed.')
                )
            );
        }

        return $this->response(
            Rsc_Http_Response::AJAX,
            $this->getErrorResponseData(
                $lang->translate(
                    sprintf(
                        'Failed to remove the preset: %s.',
                        $preset->getLastError()
                    )
                )
            )
        );
    }

    public function getPresetListAction()
    {
        return $this->response(
            Rsc_Http_Response::AJAX,
            array(
                'error' => false,
                'presets' => $this->getModel('preset')->getAll(),
            )
        );
    }

    public function applyPresetAction(Rsc_Http_Request $request)
    {
        $galleryId = $request->post->get('gallery_id');
        $presetId = $request->post->get('preset_id');

        $presets = $this->getModel('preset');
        $settings = $this->getModel('settings');

        $lang = $this->getEnvironment()->getLang();

        $preset = $presets->getById($presetId);

        if (!$preset) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    $lang->translate('Failed to find the preset.')
                )
            );
        }

        $settings->save($galleryId, $preset->settings->data);

        return $this->response(
            Rsc_Http_Response::AJAX,
            $this->getSuccessResponseData(
                $lang->translate('Preset successfully applied to the gallery.')
            )
        );
    }

    /**
     * Rewrites @url annotation to the full url.
     *
     * @param string $element
     * @return string
     */
    public function rewrite($element)
    {
        $url = $this->getEnvironment()->getConfig()->get('plugin_url');

        return str_replace('@url', $url . '/app/assets/img', $element);
    }

    public function ajaxGetImagesAction(Rsc_Http_Request $request)
    {
        if (null === $galleryId = $request->post->get('gallery_id')) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    'Gallery identifier is not specified.'
                )
            );
        }

        /** @var GirdGallery_Galleries_Model_Galleries $galleries */
        $galleries = $this->getModel('galleries');

        if (null === $gallery = $galleries->getById((int)$galleryId)) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData('The gallery does not exists.')
            );
        }

        $gallery->settings = $this->getModel('settings')->get($galleryId)->data;

        return $this->response(
            Rsc_Http_Response::AJAX,
            $this->getSuccessResponseData(
                null,
                array(
                    'photos' => $gallery->photos,
                    'area' => $gallery->settings['area']
                )
            )
        );
    }

    public function ajaxResizeImageAction(Rsc_Http_Request $request)
    {
        if (!function_exists('wp_get_image_editor')) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    'Current WordPress revision has not Image Editor.'
                )
            );
        }

        $attachmentId = $request->post->get('attachment_id');
        $width = $request->post->get('width');
        $height = $request->post->get('height');

        if (!$attachmentId) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    'The attachment id is not specified.'
                )
            );
        }

        $meta = wp_get_attachment_metadata($attachmentId);
        $upload = wp_upload_dir();

        if (!is_file($file = $upload['basedir'] . '/' . $meta['file'])) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    sprintf('File not found: %s', $file)
                )
            );
        }

        if (!$width || !$height) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData('Width or Height is not specified.')
            );
        }

        $editor = wp_get_image_editor($file);

        if (is_wp_error($editor)) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    sprintf('Unable to load the image: %s', $file)
                )
            );
        }

        if (is_wp_error($error = $editor->resize((int)$width, (int)$height, true))) {
            return $this->response(
                Rsc_Http_Response::AJAX,
                $this->getErrorResponseData(
                    sprintf(
                        'Unable to resize the image: %s.',
                        $file
                    ),
                    array(
                        'reason' => $error->get_error_message(),
                    )
                )
            );
        }

        $image = $editor->save();

        return $this->response(
            Rsc_Http_Response::AJAX,
            $this->getSuccessResponseData(
                sprintf('Attachment %s resized successfully.', $attachmentId),
                array(
                    'image' => $image
                )
            )
        );
    }
}

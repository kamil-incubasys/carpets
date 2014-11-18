<?php

/**
 * Class GirdGallery_Galleries_Model_Settings
 *
 * @package GirdGallery\Galleries\Model
 * @author Artur Kovalevsky
 */
class GirdGallery_Galleries_Model_Settings extends GirdGallery_Core_BaseModel
{

    /**
     * @var string
     */
    protected $table;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = $this->db->prefix . 'gg_settings_sets';
    }

    /**
     * Saves the settings to the database.
     *
     * @param int $id Gallery Id.
     * @param mixed $data The settings.
     */
    public function save($id, $data)
    {
        if (null === $this->get($id)) {
            return $this->insert($id, $data);
        }

        return $this->update($id, $data);
    }

    /**
     * Returns the settings for the gallery by id.
     *
     * @param int $id Gallery Id.
     * @return stdClass
     */
    public function get($id)
    {
        return $this->getBy('gallery_id', (int)$id);
    }


    public function getByGalleryId($galleryId)
    {
        return $this->get($galleryId);
    }

    public function getById($id)
    {
        return $this->getBy('id', (int)$id);
    }

    /**
     * Saves the data to the database.
     * @param int $id Gallery Id.
     * @param array $data
     * @return bool|int
     */
    protected function insert($id, $data)
    {
        $fields = array(
            'gallery_id' => $id,
            'data' => serialize($data)
        );

        $query = $this->getQueryBuilder()->insertInto($this->table)
            ->fields(array_keys($fields))
            ->values(array_values($fields));

        if (false !== $this->db->query($query->build())) {
            return true;
        }

        return false;
    }

    /**
     * Updates the settings.
     * @param int $id
     * @param array $data
     * @return bool
     */
    protected function update($id, $data)
    {
        $query = $this->getQueryBuilder()->update($this->table)
            ->where('gallery_id', '=', (int)$id)
            ->fields('data')
            ->values(serialize($data));

        if (false !== $this->db->query($query->build())) {
            return true;
        }

        return false;
    }

    protected function getBy($field, $value)
    {
        $query = $this->getQueryBuilder()->select('*')
            ->from($this->table)
            ->where($field, '=', $value);

        if (null !== $row = $this->db->get_row($query->build())) {
            if (isset($row->data)) {
                $row->data = unserialize($row->data);
            }
        }

        return $row;
    }
}

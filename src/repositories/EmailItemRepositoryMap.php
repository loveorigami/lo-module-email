<?php
namespace lo\modules\email\repositories;

use lo\modules\email\models\EmailItem;

/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 09.01.2017
 * Time: 13:07
 */
class EmailItemRepositoryMap
{
    const DEFAULT_AUTHOR = 1;
    const DEFAULT_CATEGORY = EmailItem::CATEGORY_SUBSCRIBE;

    public $id;
    public $status = EmailItem::STATUS_PUBLISHED;
    public $updater_id = self::DEFAULT_AUTHOR;
    public $author_id;
    public $created_at;
    public $updated_at;
    public $session_id;
    public $name;
    public $email;
    public $cat_id;
    public $date_send;
    public $date_subscribe;
    public $date_unsubscribe;
    public $hash;

    /**
     * PluginDataDto constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        $this->setDefaults();
    }

    /**
     * set defaults values
     */
    protected function setDefaults()
    {
        if (!$this->date_subscribe) {
            $this->date_subscribe = date('Y-m-d');
        }

        if (!$this->hash) {
            $this->hash = md5($this->email);
        }

        if (!$this->author_id) {
            $this->author_id = self::DEFAULT_AUTHOR;
        }

        if (!$this->cat_id) {
            $this->cat_id = self::DEFAULT_CATEGORY;
        }

        if (!$this->session_id) {
            $this->session_id = time();
        }
    }
}
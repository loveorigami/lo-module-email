<?php

namespace lo\modules\email\repositories;

use lo\modules\email\dto\EmailItemDto;
use lo\modules\email\models\EmailItem;

/**
 * Class EmailItemRepository
 * @package lo\modules\email\repositories
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailItemRepository implements EmailItemRepositoryInterface
{
    /**
     * @param $id
     * @return EmailItem
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        if (!$item = EmailItem::findOne($id)) {
            throw new \InvalidArgumentException('Model not found');
        }
        return $item;
    }

    /**
     * @param EmailItem $item
     */
    public function add($item)
    {
        if (!$item->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $item->insert(false);
    }

    /**
     * @param EmailItem $item
     */
    public function save($item)
    {
        if ($item->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $item->update(false);
    }

    /**
     * @param EmailItem $item
     * @return string
     */
    public function getEmail($item = null)
    {
        if (!$item) return false;
        return $item->email;
    }

    /**
     * @param EmailItem $item
     * @return string
     */
    public function getHash($item = null)
    {
        if (!$item) return false;
        return $item->hash;
    }

    /**
     * @param $cat_id
     * @param $session
     * @return EmailItem
     */
    public function findByGroupSession($cat_id, $session)
    {
        $item = EmailItem::find()
            ->where(['cat_id' => $cat_id])
            ->andWhere(['not', ['session_id' => $session]])
            ->published()->limit(1)->one();

        if ($item) {
            $item->session_id = $session;
            $this->save($item);
        }

        return $item;
    }

    /**
     * @param $email
     * @return array|null|\yii\db\ActiveRecord
     */
    public function findByEmail($email)
    {
        $item = EmailItem::find()
            ->where(['email' => $email])->limit(1)->one();

        return $item;
    }

    /**
     * @param array $data
     */
    public function addEmailToCategoryContact(array $data)
    {
        $data['cat_id'] = EmailItem::CATEGORY_CONTACT;
        $this->addEmail($data);
    }

    /**
     * @param $data
     */
    public function addEmail($data)
    {
        $data = (array)new EmailItemDto($data);
        $item = new EmailItem();
        $item->setAttributes($data);
        $this->add($item);
    }

} 
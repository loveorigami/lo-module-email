<?php

namespace lo\modules\email\repositories;

use lo\modules\email\models\EmailItem;

/**
 * Class EmailItemRepository
 * @package lo\modules\email\repositories
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailItemRepository implements EmailItemRepositoryInterface
{
    const CATEGORY_CONTACT = EmailItem::CATEGORY_CONTACT;
    const CATEGORY_ORDER = EmailItem::CATEGORY_ORDER;

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
     */
    public function unsubscribe($item)
    {
        $data = [
            'status' => EmailItem::STATUS_DRAFT
        ];
        $item->setAttributes($data);
        $this->save($item);
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

        /** @var EmailItem $item */
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
     * @param $hash
     * @return mixed
     */
    public function findByHash($hash)
    {
        $item = EmailItem::find()
            ->where(['hash' => $hash])
            ->limit(1)
            ->published()
            ->one();

        return $item;
    }

    /**
     * @param $email
     * @return array|null|\yii\db\ActiveRecord
     */
    public function findBySubscribeEmail($email)
    {
        $item = EmailItem::find()
            ->where(['email' => $email])
            ->limit(1)
            ->published()
            ->one();

        return $item;
    }

    /**
     * @param array $data
     * @return EmailItem
     */
    public function addEmail(array $data)
    {
        $data = (array)new EmailItemRepositoryMap($data);
        $item = new EmailItem();
        $item->setAttributes($data);
        $this->add($item);

        return $item;
    }
}
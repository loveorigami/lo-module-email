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

} 
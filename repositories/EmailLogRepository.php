<?php

namespace lo\modules\email\repositories;

use lo\modules\email\models\EmailLog;

/**
 * Class EmailLogRepository
 * @package lo\modules\email\repositories
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailLogRepository
{
    /**
     * @param $id
     * @return EmailLog
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        if (!$item = EmailLog::findOne($id)) {
            throw new \InvalidArgumentException('Model not found');
        }
        return $item;
    }

    /**
     * @param EmailLog $item
     */
    public function add($item)
    {
        if (!$item->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $item->insert(false);
    }

    /**
     * @param EmailLog $item
     */
    public function save($item)
    {
        if ($item->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $item->update(false);
    }

    /**
     * @param $date
     * @return array|null|\yii\db\ActiveRecord
     */
    public function findByDate($date)
    {
        $item = EmailLog::find()
            ->where(['date' => $date])
            ->limit(1)
            ->one();

        return $item;
    }

    /**
     * @param EmailLog $item
     * @param array $data
     * @return EmailLog
     */
    public function saveLog($item, array $data)
    {
        $data = (array)new EmailLogRepositoryMap($data);

        if (!$item) {
            $item = new EmailLog();
            $item->setAttributes($data);
            $this->add($item);
        } else {
            $item->setAttributes($data);
            $this->save($item);
        }

        return $item;
    }
}
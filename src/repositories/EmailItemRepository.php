<?php

namespace lo\modules\email\repositories;

use lo\core\helpers\DateHelper;
use lo\modules\email\models\EmailItem;
use lo\modules\email\modules\admin\dto\MessageEventDto;
use yii\db\Expression;

/**
 * Class EmailItemRepository
 *
 * @package lo\modules\email\repositories
 * @author  Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailItemRepository
{
    public const CATEGORY_CONTACT = EmailItem::CATEGORY_CONTACT;
    public const CATEGORY_ORDER = EmailItem::CATEGORY_ORDER;

    /**
     * @param $id
     * @return EmailItem
     * @throws \InvalidArgumentException
     */
    public function find($id): EmailItem
    {
        if (!$item = EmailItem::findOne($id)) {
            throw new \InvalidArgumentException('Model not found');
        }

        return $item;
    }

    /**
     * @param EmailItem $item
     * @throws \Throwable
     */
    public function add($item): void
    {
        if (!$item->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $item->insert(false);
    }

    /**
     * @param EmailItem $item
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function save($item): void
    {
        if ($item->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $item->update(false);
    }

    /**
     * @param EmailItem $item
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function unsubscribe($item): void
    {
        $item->status = EmailItem::STATUS_DRAFT;
        $item->date_unsubscribe = DateHelper::nowDate();
        $this->save($item);
    }

    /**
     * @param EmailItem $item
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function unsubscribeAuto($item): void
    {
        $item->status = EmailItem::STATUS_DRAFT;
        $item->cat_id = EmailItem::CATEGORY_AUTO_UNSUBSCRIBE;
        $item->date_unsubscribe = DateHelper::nowDate();
        $this->save($item);
    }

    /**
     * @param EmailItem       $item
     * @param MessageEventDto $msg
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function unsubscribeBounce($item, MessageEventDto $msg): void
    {
        if ($item && $item->status !== EmailItem::STATUS_DRAFT) {
            $item->status = EmailItem::STATUS_DRAFT;
            $item->cat_id = EmailItem::CATEGORY_AUTO_UNSUBSCRIBE;
            $item->date_unsubscribe = DateHelper::dbDate($msg->timestamp);
            $item->sp_timestamp = $msg->timestamp;
            $item->sp_raw_reason = $msg->raw_reason;
            $item->sp_bounce_class = $msg->bounce_class;
            $item->sp_error_code = $msg->error_code;
            $item->sp_transmission_id = $msg->transmission_id;
            $item->sp_type = $msg->type;
            $this->save($item);
        }
    }

    /**
     * @param EmailItem       $item
     * @param MessageEventDto $msg
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function subscribeOpen($item, MessageEventDto $msg): void
    {
        if ($item && $item->status === EmailItem::STATUS_PUBLISHED) {
            $item->sp_timestamp = $msg->timestamp;
            $item->sp_raw_reason = $msg->raw_reason;
            $item->sp_bounce_class = $msg->bounce_class;
            $item->sp_error_code = $msg->error_code;
            $item->sp_transmission_id = $msg->transmission_id;
            $item->sp_type = $msg->type;
            $this->save($item);
        }
    }

    /**
     * @param EmailItem $item
     * @return string
     */
    public function getEmail($item = null): string
    {
        if (!$item) {
            return '';
        }

        return $item->email;
    }

    /**
     * @param EmailItem $item
     * @return string
     */
    public function getHash($item = null): string
    {
        if (!$item) {
            return '';
        }

        return $item->hash;
    }

    /**
     * @param $cat_id
     * @param $session
     * @return EmailItem
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function findByGroupSession($cat_id, $session): EmailItem
    {
        $item = EmailItem::find()
            ->where(['cat_id' => $cat_id])
            ->andWhere(['not', ['session_id' => $session]])
            ->orderBy(['date_send' => SORT_ASC])
            ->published()->limit(1)->one();

        /** @var EmailItem $item */
        if ($item) {
            $item->session_id = $session;
            $item->date_send = DateHelper::nowDate();
            $this->save($item);
        }

        return $item;
    }

    /**
     * @param $cat_id
     * @param $session
     * @param $limit
     * @return array
     */
    public function findEmailsByGroupSession($cat_id, $session, $limit): array
    {
        $items = EmailItem::find()
            ->alias('i')
            ->joinWith(['cat c'])
            ->select([
                'i.*',
                new Expression('`c`.`slug` AS `list_name`'),
                new Expression("'" . date('Y.m.d') . "' AS `date`"),
            ])
            ->where(['i.cat_id' => $cat_id])
            ->andWhere(['not', ['i.session_id' => $session]])
            ->orderBy(['i.date_send' => SORT_ASC])
            ->published()
            ->limit($limit)
            ->indexBy('id')
            ->asArray()
            ->all();

        return $items;
    }

    /**
     * @return array
     */
    public function getSubstitutionDataKeys(): array
    {
        return ['hash', 'list_name', 'date'];
    }

    /**
     * @param $email
     * @return array|null|\yii\db\ActiveRecord
     */
    public function findByEmail($email): ?EmailItem
    {
        $item = EmailItem::find()
            ->where(['email' => $email])
            ->limit(1)
            ->one();

        return $item;
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function findByHash($hash): ?EmailItem
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
    public function findBySubscribeEmail($email): ?EmailItem
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
     * @throws \Throwable
     */
    public function addEmail(array $data): ?EmailItem
    {
        $data = (array)new EmailItemRepositoryMap($data);
        $item = new EmailItem();
        $item->setAttributes($data);
        $item->email = mb_strtolower($item->email);
        $this->add($item);

        return $item;
    }

    /**
     * @param EmailItem $item
     * @param array     $data
     * @return EmailItem
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function updEmail(EmailItem $item, array $data): ?EmailItem
    {
        $item->setAttributes($data);
        $this->save($item);

        return $item;
    }

    /**
     * @param $emails
     * @param $session
     */
    public function sendEmails($emails, $session): void
    {
        if ($emails) {
            $ids = array_keys($emails);
            EmailItem::updateAll([
                'session_id' => $session,
                'date_send' => DateHelper::nowDate(),
            ], ['id' => $ids]);
        }
    }
}

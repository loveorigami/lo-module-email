<?php

namespace lo\modules\email\modules\admin\dto;

use lo\core\helpers\ArrayHelper;

class MessageEventDto
{
    const LABEL_SUCCESS = 'success';
    const LABEL_DANGER = 'danger';

    public $email;

    /**
     * Причина отказа
     * @var string
     */
    public $raw_reason;

    /**
     * тип отказа
     * @var integer
     */
    public $bounce_class;

    /**
     * код ошибки
     * @var integer
     */
    public $error_code;

    /**
     * тип отказа
     * @var string
     */
    public $type;

    public $transmission_id;
    public $timestamp;

    /**
     * @param array $data
     * @return MessageEventDto
     */
    public static function init($data)
    {
        $msg = new self;
        $msg->email = ArrayHelper::getValue($data, 'raw_rcpt_to');
        $msg->raw_reason = ArrayHelper::getValue($data, 'raw_reason');
        $msg->bounce_class = ArrayHelper::getValue($data, 'bounce_class');
        $msg->error_code = ArrayHelper::getValue($data, 'error_code');
        $msg->type = ArrayHelper::getValue($data, 'type');
        $msg->transmission_id = ArrayHelper::getValue($data, 'transmission_id');
        $msg->timestamp = ArrayHelper::getValue($data, 'timestamp');

        return $msg;
    }
} 
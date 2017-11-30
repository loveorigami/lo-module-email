<?php

namespace lo\modules\email\modules\admin\dto;

class CheckDto
{
    const LABEL_SUCCESS = 'success';
    const LABEL_DANGER = 'danger';

    public $email;
    public $text;
    public $label;
    public $status;

    /** @var  string last date send */
    public $lastSend;

    /**
     * @param $lastSend
     * @return CheckDto
     */
    public static function init($lastSend)
    {
        $state = new self;
        $state->label = self::LABEL_SUCCESS;
        $state->text = 'ok';
        $state->status = true;
        $state->lastSend = $lastSend;

        return $state;
    }

    /**
     * @return mixed
     */
    public function isValid()
    {
        return $this->status;
    }

    /**
     * @param $date
     * @return bool
     */
    public function isValidToday($date)
    {
        if ($this->lastSend >= $date) {
            $this->text = "Finish today limit";
            $this->label = self::LABEL_DANGER;
            $this->status = false;
            return false;
        }
        return true;
    }
} 
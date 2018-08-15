<?php

namespace lo\modules\email\modules\admin\dto;

use lo\core\helpers\DateHelper;

class StateDto
{
    protected const LABEL_SUCCESS = 'success';
    protected const LABEL_DANGER = 'danger';

    public $email;
    public $text;
    public $label;
    public $status;
    public $session;
    public $limit;
    public $count;
    public $percent;

    /** @var  string last date send */
    public $lastSend;

    /**
     * @param $session
     * @param $limit
     * @param $count
     * @param $lastSend
     * @return StateDto
     */
    public static function init($session, $limit, $count, $lastSend): StateDto
    {
        $state = new self;
        $state->label = self::LABEL_SUCCESS;
        $state->text = 'ok';
        $state->status = true;
        $state->session = $session;
        $state->limit = $limit;
        $state->count = $count;
        $state->lastSend = $lastSend;
        $state->percent = self::getPercent($state->count, $state->limit);

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
     * @return mixed
     */
    public function isValidEmail()
    {
        if (!$this->email) {
            $this->text = 'Group is empty';
            $this->status = false;

            return false;
        }

        return true;
    }

    /**
     * @param $emails
     * @return bool
     */
    public function isValidCountEmails($emails): bool
    {
        if (!\count($emails)) {
            $this->text = 'Group is empty';
            $this->status = false;

            return false;
        }

        return true;
    }

    /**
     * @param $date
     * @return bool
     */
    public function isValidToday($date): bool
    {
        $days = DateHelper::rangeDays($this->lastSend, $date);
        if (!$days) {
            $this->text = 'Finish today limit';
            $this->label = self::LABEL_DANGER;
            $this->status = false;

            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isValidCount(): bool
    {
        if ($this->count >= $this->limit) {
            $this->text = "Finish today limit $this->limit";
            $this->label = self::LABEL_DANGER;
            $this->status = false;

            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @param $total
     * @return float
     */
    protected static function getPercent($value, $total): float
    {
        if ($total <= 0) {
            return (float)0;
        }
        if ($total < $value) {
            return (float)100;
        }

        return round(($total - ($total - $value)) / $total * 100, 2);
    }

} 

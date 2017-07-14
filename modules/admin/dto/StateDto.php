<?php

namespace lo\modules\email\modules\admin\dto;

class StateDto
{
    const LABEL_SUCCESS = 'success';
    const LABEL_DANGER = 'danger';

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
    public static function init($session, $limit, $count, $lastSend)
    {
        $state = new self;
        $state->label = self::LABEL_SUCCESS;
        $state->text = 'ok';
        $state->status = true;
        $state->session = $session;
        $state->limit = $limit;
        $state->count = $count;
        $state->lastSend = $lastSend;
        $state->percent = self::percent($state->count, $state->limit);

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

    /**
     * @return bool
     */
    public function isValidCount()
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
     * @return float|int
     */
    protected static function percent($value, $total)
    {
        if ($total <= 0) return 0;
        if ($total < $value) return 100;

        return round(($total - ($total - $value)) / $total * 100, 2);
    }

} 
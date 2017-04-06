<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\services;

use lo\modules\email\repositories\EmailItemRepositoryInterface;

class EmailService
{
    private $emailRepository;

    public function __construct(
        EmailItemRepositoryInterface $emailRepository
    )
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param $data
     */
    public function createEmail($data)
    {
        $this->emailRepository->addEmail($data);
    }
}
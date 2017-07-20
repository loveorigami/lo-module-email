<?php
namespace lo\modules\email\modules\admin\services;

use lo\modules\email\repositories\EmailItemRepository;

/**
 * Class ImportService
 * @package lo\modules\email\modules\admin\services
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class ImportService
{
    private $emailRepository;

    public function __construct(
        EmailItemRepository $emailRepository
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
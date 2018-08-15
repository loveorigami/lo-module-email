<?php
namespace lo\modules\email\modules\admin\services;

use lo\modules\email\models\EmailItem;
use lo\modules\email\modules\admin\dto\ImportDto;
use lo\modules\email\repositories\EmailItemRepository;
use yii\helpers\Html;

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
     * @throws \Throwable
     */
    public function createEmail($data): void
    {
        $this->emailRepository->addEmail($data);
    }

    public function createOrUpdate(ImportDto $dto): array
    {
        $data = [
            'email' => $dto->email,
            'cat_id' => $dto->cat_id,
            'status' => $dto->status,
        ];

        $item = $this->emailRepository->findByEmail($dto->email);

        if (!$item) {

            $form = new EmailItem();
            $form->setAttributes($data);

            if ($form->validate()) {
                $this->emailRepository->addEmail($data);
            } else {
                $data['status'] = Html::errorSummary($form);
            }

        } elseif ($item && $item->status !== $dto->status) {
            $this->emailRepository->updEmail($item, $data);
            $data['status'] = $dto->email . ' is updated';
        } else {
            $data['status'] = $dto->email . ' not updated';
        }

        return $data;
    }

}

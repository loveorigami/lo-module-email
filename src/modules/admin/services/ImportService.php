<?php

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\models\EmailItem;
use lo\modules\email\modules\admin\dto\ImportDto;
use lo\modules\email\repositories\EmailItemRepository;
use yii\helpers\Html;

/**
 * Class ImportService
 *
 * @package lo\modules\email\modules\admin\services
 * @author  Lukyanov Andrey <loveorigami@mail.ru>
 */
class ImportService
{
    private $emailRepository;

    public function __construct(
        EmailItemRepository $emailRepository
    ) {
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
        $item = $this->emailRepository->findByEmail($dto->email);

        if (!$item) {

            $data = [
                'email' => $dto->email,
                'cat_id' => $dto->cat_id,
                'status' => $dto->status,
            ];

            $form = new EmailItem();
            $form->setAttributes($data);

            if ($form->validate()) {
                $this->emailRepository->addEmail($data);
            } else {
                $data['status'] = Html::errorSummary($form);
            }
        } else {
            $data['status'] = $this->updItem($item, $dto);
        }

        return $data;
    }

    protected function updItem(EmailItem $item, ImportDto $dto): string
    {
        $upd = false;
        $data = [];
        $mes = $dto->email . ' not updated';

        /**
         * Перемещаем
         */
        if ($dto->is_move && !$item->isHold()) {
            $upd = true;
            $data = [
                'cat_id' => $dto->cat_id,
                'email' => $dto->email,
            ];
            $mes = $dto->email . ' is moved';
        } elseif ($item->status !== $dto->status) {
            $mes = $dto->email . ' is updated';
            $upd = true;
            $data = [
                'email' => $dto->email,
                'status' => $dto->status,
            ];
        }

        if ($upd) {
            $this->emailRepository->updEmail($item, $data);
        }

        return $mes;
    }
}

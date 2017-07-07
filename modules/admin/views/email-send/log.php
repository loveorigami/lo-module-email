<?php
/**
 * @var \lo\modules\email\modules\admin\dto\StateDto $data
 */
?>
<ul>
    <li>Отправлено: <?= $data->count ?> из <?= $data->limit ?></li>
    <li>Еmail: <?= $data->email ?></li>
    <li>Сессия: <?= $data->session ?></li>
    <li>Дата: <?= $data->lastSend ?></li>
    <li><span class="label label-<?= $data->label ?>"><?= $data->text ?></span></li>
</ul>
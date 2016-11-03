<?php
/**
 * @var array $data
 */
?>
<ul>
    <li>Отправлено: <?= $data['count'] ?> из <?= $data['limit'] ?></li>
    <li>Еmail: <?= $data['email'] ?></li>
    <li>Сессия: <?= $data['session'] ?></li>
    <li>Дата: <?= $data['date'] ?></li>
    <li><span class="label label-<?= $data['label'] ?>"><?= $data['text'] ?></span></li>
</ul>
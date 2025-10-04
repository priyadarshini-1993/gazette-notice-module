<?php

use yii\widgets\LinkPager;

$this->registerCssFile('@web/css/notice.css');
?>

<div class="notice-container">
    <h1>Gazette Notices</h1>

    <?php if (!empty($items)): ?>
        <?php foreach ($items as $notice): ?>
            <article class="notice">
                <h2>
                    <a href="<?= $notice['link'][0]['@href'] ?? '#' ?>" target="_blank">
                        <?= htmlspecialchars($notice['title']) ?>
                    </a>
                </h2>
                <time datetime="<?= $notice['published'] ?>">
                    <?= date('j F Y', strtotime($notice['published'])) ?>
                </time>
                <div class="notice-content">
                    <?= $notice['content'] ?>
                </div>
            </article>
        <?php endforeach; ?>
        <div class="pagination-wrapper">
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'options' => ['class' => 'pagination'],
                'linkOptions' => ['class' => 'page-link'],
                'disabledListItemSubTagOptions' => ['class' => 'page-link'],
                'activePageCssClass' => 'active',
            ]) ?>
        </div>

    <?php else: ?>
        <p>No notices found.</p>
    <?php endif; ?>
</div>
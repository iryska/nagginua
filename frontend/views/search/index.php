<?php $this->params['breadcrumbs'] = $breadcrumbs; ?>
<?php $this->params['searchQuery'] = $query; ?>
<?php $news = $provider->getModels(); ?>

<?php if ( ! empty( $news )): ?>
<div class="column-two-third">
    <?php $item = array_shift( $news );
        if ($item = common\models\News::findOne( [ 'id' => $item['id'] ] )):
            ?>
            <div class="outertight m-t-no">

                <div class="badg">
                    <p><a href="<?= $item->getLink(); ?>">Лучшая.</a></p>
                </div>
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="<?= $item->getThumbLink( 'thumbCategory' ); ?>"
                                 alt="<?= \yii\helpers\Html::encode( $item->title ); ?>"/>
                        </li>
                    </ul>
                </div>


                <h6 class="regular"><a
                        href="<?= $item->getLink(); ?>"><?= \yii\helpers\Html::encode( $item->title ); ?></a>
                </h6>
        <span class="meta"><?= Yii::$app->formatter->asDate( $item->created_at,
                "php:" . Yii::$app->params['newsDateFormat'] ); ?>
            <?php if ($categories = $item->getCategoryList()): ?>
                <?php foreach ($categories as $category): ?>
                    \\ <a href="<?= $category->getLink(); ?>"><?= $category->name; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </span>

                <p><?= \yii\helpers\Html::encode( $item->getShort() ); ?></p>

            </div>
        <?php endif; ?>

    <?php $item = array_shift( $news );
        if ($item = common\models\News::findOne( [ 'id' => $item['id'] ] )):?>

            <div class="outertight m-r-no m-t-no">

                <div class="badg">
                    <p><a href="<?= $item->getLink(); ?>">Лучшая.</a></p>
                </div>
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="<?= $item->getThumbLink( 'thumbCategory' ); ?>"
                                 alt="<?= \yii\helpers\Html::encode( $item->title ); ?>"/>
                        </li>
                    </ul>
                </div>

                <h6 class="regular"><a
                        href="<?= $item->getLink(); ?>"><?= \yii\helpers\Html::encode( $item->title ); ?></a>
                </h6>
        <span class="meta"><?= Yii::$app->formatter->asDate( $item->created_at,
                "php:" . Yii::$app->params['newsDateFormat'] ); ?>
            <?php if ($categories = $item->getCategoryList()): ?>
                <?php foreach ($categories as $category): ?>
                    \\ <a href="<?= $category->getLink(); ?>"><?= $category->name; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </span>

                <p><?= \yii\helpers\Html::encode( $item->getShort() ); ?></p>
            </div>
        <?php endif; ?>
    <?php if ( ! empty( $news )): ?>
        <div class="outerwide">
            <ul class="block2">
                <?php foreach ($news as $key => $item): ?>
                    <?php $item = common\models\News::findOne( [ 'id' => $item['id'] ] ); ?>
                    <?php $class = ( $key % 2 == 0 ) ? "" : "m-r-no"; ?>
                    <?= $this->render( '../site/frontBlock/news', [ "item" => $item, "class" => $class ] ) ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="pager">
        <?php $pager = $provider->getPagination(); ?>
        <?php echo \common\components\MLinkPager::widget( [
            'pagination'       => $provider->getPagination(),
            'options'          => [
                'class' => false
            ],
            'prevPageCssClass' => 'first-page',
            'nextPageCssClass' => 'last-page',
            'prevPageLabel'    => '&nbsp;',
            'nextPageLabel'    => '&nbsp;'
        ] );
        ?>
    </div>
    <?php else: ?>
        <h1>Ничего не найдено по запросу: `<?= \yii\helpers\Html::encode( $query ); ?>`</h1>
    <?php endif; ?>

</div>
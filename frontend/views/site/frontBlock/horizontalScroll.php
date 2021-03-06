<div class="column-two-third">
    <h5 class="line">
        <span><?= \yii\helpers\Html::encode( $title ); ?></span>

        <div class="navbar">
            <a id="next2" class="next" href="#"><span></span></a>
            <a id="prev2" class="prev" href="#"><span></span></a>
        </div>
    </h5>

    <div class="outerwide">
        <ul class="wnews" id="carousel2">
            <?php for ($i = 0; $i < 3; $i ++): ?>
                <?php $item = array_shift( $data ); ?>
                <li>
                    <img src="<?= $item->getThumbLink( "thumbCategory" ); ?>"
                         alt="<?= \yii\helpers\Html::encode( $item->title ); ?>" class="alignleft"/>
                    <h6 class="regular"><a
                            href="<?= $item->getLink(); ?>"><?= \yii\helpers\Html::encode( $item->title ); ?></a></h6>
                <span class="meta"><?= Yii::$app->formatter->asDate( $item->created_at,
                        "php:" . Yii::$app->params['newsDateFormat'] ); ?>
                    <?php if ($categories = $item->getCategoryList()): ?>
                        <?php foreach ($categories as $category): ?>
                            \\ <a href="<?= $category->getLink(); ?>"><?= $category->name; ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </span>

                    <p><?= \yii\helpers\Html::encode( $item->getShort() ); ?></p>
                </li>
            <?php endfor; ?>

        </ul>
    </div>

    <div class="outerwide">
        <ul class="block2">
            <?php foreach ($data as $key => $item): ?>
                <?= $this->render( 'news', [ "item" => $item ] ) ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
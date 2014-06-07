<?php

Yii::import('application.models._base.BaseExcludeElements');

class ExcludeElements extends BaseExcludeElements
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return array(
            'source' => array(self::BELONGS_TO, 'Source', 'source_id'),
        );
    }
}
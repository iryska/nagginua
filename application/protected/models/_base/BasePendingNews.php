<?php

/**
 * This is the model base class for the table "pending_news".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PendingNews".
 *
 * Columns in table "pending_news" available as properties of the model,
 * followed by relations of table "pending_news" available as properties of the model.
 *
 * @property integer $id
 * @property integer $source_id
 * @property string $title
 * @property string $content
 * @property string $status
 * @property string $group_hash
 * @property string $created_at
 * @property string $update_at
 *
 * @property Sources $source
 */
abstract class BasePendingNews extends GxActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pending_news';
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'PendingNews|PendingNews', $n);
    }

    public static function representingColumn()
    {
        return 'title';
    }

    public function rules()
    {
        return array(
            array('source_id, title, content, group_hash, created_at', 'required'),
            array('source_id', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 10),
            array('group_hash', 'length', 'max' => 45),
            array('update_at', 'safe'),
            array('status, update_at', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, source_id, title, content, status, group_hash, created_at, update_at', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'source' => array(self::BELONGS_TO, 'Sources', 'source_id'),
        );
    }

    public function pivotModels()
    {
        return array();
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'source_id' => null,
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'group_hash' => Yii::t('app', 'Group Hash'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
            'source' => null,
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('source_id', $this->source_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('group_hash', $this->group_hash, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('update_at', $this->update_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
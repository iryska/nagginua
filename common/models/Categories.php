<?php

    namespace common\models;

    use Yii;

    /**
     * This is the model class for table "categories".
     *
     * @property integer $id
     * @property string $name
     * @property string $slug
     */
    class Categories extends \yii\db\ActiveRecord
    {
    /**
     * @inheritdoc
     */
        public static function tableName()
    {
        return 'categories';
    }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [ [ 'name', 'slug' ], 'required' ],
                [ [ 'name', 'slug' ], 'string', 'max' => 45 ]
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'   => 'ID',
                'name' => 'Name',
                'slug' => 'Slug',
            ];
    }

        public function getLink()
        {
            return '/category/' . $this->slug;
        }
    }
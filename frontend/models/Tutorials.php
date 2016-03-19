<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\mongodb\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for collection "Tutorials".
 *
 * @property \MongoId|string $_id
 * @property mixed $title
 * @property mixed $author
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $category
 * @property mixed $file
 * @property mixed $content
 */
class Tutorials extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['tt', 'Tutorials'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'title',
            'author',
            'created_at',
            'updated_at',
            'category',
            'file',
            'content',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category', 'content'], 'required'],
            [['title', 'author', 'created_at', 'updated_at', 'category', 'file', 'content'], 'safe'],
        ];
    }
    

    //created_at updated_at
    public function behaviors()
    {      
         return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() { return date("Y-m-d h:i:s");}
             ],

//            'arrayField' => [
//                'class' => ArrayAccessFieldBehavior::className(),
//                'fieldNameStorage' => 'file',
//            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category' => 'Category',
            'file' => 'File',
            'content' => 'Content',
        ];
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
   
}


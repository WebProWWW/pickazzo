<?php

namespace models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property int|null $page_id
 * @property string $file
 *
 * @property Page $page
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id'], 'integer'],
            [['file'], 'required'],
            [['file'], 'string', 'max' => 255],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'file' => 'File',
        ];
    }

    /**
     * Gets query for [[Page]].

     * @return yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }
}

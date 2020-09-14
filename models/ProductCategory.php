<?php

namespace models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property int|null $page_id
 * @property string $title
 * @property int|null $image_id
 *
 * @property Image $image
 * @property Page $page
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'image_id'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
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
            'title' => 'Title',
            'image_id' => 'Image ID',
        ];
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}

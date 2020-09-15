<?php

namespace models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $page_id
 * @property string|null $title
 * @property string $author
 * @property string $neuro
 * @property string|null $artikul
 * @property string|null $size
 * @property string|null $description
 * @property int|null $price
 *
 * @property Image[] $images
 * @property Image $image
 * @property Page $page
 * @property string $formatPrice
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'page_id', 'price'], 'integer'],
            [['description'], 'string'],
            [['title', 'artikul', 'size'], 'string', 'max' => 255],
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
            'category_id' => 'Category ID',
            'page_id' => 'Page ID',
            'title' => 'Title',
            'artikul' => 'Artikul',
            'size' => 'Size',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }

    /**
     * @param string|int $id
     * @return Product|null
     */
    public static function findById($id)
    {
        return self::findOne([
            'id' => $id
        ]);
    }

    /**
     *
     * @return yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this
            ->hasMany(ProductImage::class, ['product_id' => 'id'])
        ;
    }

    /**
     *
     * @return yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this
            ->hasMany(Image::class, ['id' => 'image_id'])
            ->via('productImages', function (Query $query) {
                $query->orderBy('order');
            })
        ;
    }

    public function getProductImage()
    {
        return $this
            ->hasMany(ProductImage::class, ['product_id' => 'id'])
            ->orderBy('order');
    }

    /**
     *
     * @return yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this
            ->hasOne(Image::class, ['id' => 'image_id'])
            ->via('productImage')
        ;
    }

    public function getFormatPrice()
    {
        return number_format($this->price, 0, ',', '&nbsp;');
    }

    /**
     *
     * @return yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }

}

<?php

namespace models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $default
 * @property int|null $active
 * @property int|null $order
 * @property string $view
 * @property int|null $menu_enable
 * @property string|null $menu_label
 * @property string $title
 * @property string $alias
 * @property string|null $description
 * @property string|null $keywords
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property array $breadcrumbs
 * @property int $childCount
 *
 * @property Page $parent
 * @property Page[] $childs
 *
 * @property File $file
 * @property File[] $files
 *
 * @property ProductCategory $productCategory
 *
 * @property Product $product
 *
 */
class Page extends ActiveRecord
{
    private $_childCount = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'default', 'active', 'order', 'menu_enable', 'created_at', 'updated_at'], 'integer'],
            [['view', 'title', 'alias'], 'required'],
            [['view', 'menu_label', 'title', 'alias', 'description', 'keywords'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'default' => 'Default',
            'active' => 'Active',
            'order' => 'Order',
            'view' => 'View',
            'menu_enable' => 'In Menu',
            'menu_label' => 'Menu Label',
            'title' => 'Title',
            'alias' => 'Alias',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findByAlias($alias)
    {
        if ($alias === 'index' or $alias === '') {
            return self::findOne([ 'default' => 1 ]);
        }
        return self::findOne([ 'alias' => $alias, 'active' => 1 ]);
    }

    /**
     * @return Page[]
     */
    public static function navItems()
    {
        return self::find()
            ->where([ 'menu_enable' => 1,  'active' => 1 ])
            ->all();
    }

    /**
     * @return int
     */
    public function getChildCount()
    {
        if ($this->_childCount === null) {
            $this->_childCount = count($this->childs);
        }
        return $this->_childCount;
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProductCategory()
    {
        return $this->hasOne(ProductCategory::class, ['page_id' => 'id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['page_id' => 'id']);
    }

//    /**
//     * Gets query for [[Editors]].
//     *
//     * @return yii\db\ActiveQuery
//     */
//    public function getEditors()
//    {
//        return $this->hasMany(Editor::className(), ['page_id' => 'id']);
//    }
//
//    /**
//     * Gets query for [[Faqs]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getFaqs()
//    {
//        return $this->hasMany(Faq::className(), ['page_id' => 'id']);
//    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::class, ['page_id' => 'id']);
    }

//
//    /**
//     * Gets query for [[Files]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getFiles()
//    {
//        return $this->hasMany(File::className(), ['page_id' => 'id']);
//    }
//
//    /**
//     * Gets query for [[Htmls]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getHtmls()
//    {
//        return $this->hasMany(Html::className(), ['page_id' => 'id']);
//    }

    /**
     * Gets query for [[Pages]].
     *
     * @return yii\db\ActiveQuery
     */
    public function getChilds()
    {
        return $this->hasMany(Page::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::class, ['id' => 'parent_id']);
    }

//    /**
//     * Gets query for [[Posts]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getPosts()
//    {
//        return $this->hasMany(Post::className(), ['page_id' => 'id']);
//    }
//
//    /**
//     * Gets query for [[Services]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getServices()
//    {
//        return $this->hasMany(Service::className(), ['page_id' => 'id']);
//    }
}

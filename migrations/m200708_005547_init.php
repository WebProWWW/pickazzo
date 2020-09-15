<?php

use yii\db\Migration;
use yii\db\Exception as ExceptionDataBase;

use components\Access;

/**
 * Class m200708_005547_init
 *
 * @property string[] $tables
 * @property string|null $options
 */
class m200708_005547_init extends Migration
{
    /**
     * @return string[]
     */
    public function getTables()
    {
        return [
            'user',
            'page',
            'product',
            'file',
            'image',
            'product_category',
            'product',
            'user_product',
            'product_image',
            'html',
            'editor',
            'tag',
            'post',
            'post_tag',
            'service',
            'faq',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTables();
        /*
         * USER
         */
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue(Access::STATUS_WAIT),
            'role' => $this->string()->notNull()->defaultValue(Access::ROLE_USER),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'email_confirm_token' => $this->string()->unique(),
            'api_key' => $this->string(32)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'subscribe' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ], $this->options);
        $this->createIndex('idx-user-status', 'user', 'status');
        $this->createIndex('idx-user-auth_key', 'user', 'auth_key');
        $this->createIndex('idx-user-api_key', 'user', 'api_key');
        $this->batchInsert('user', ['username','email','status','role','api_key','auth_key','password_hash','created_at','updated_at'],[[
            /* username         */ 'Админ',
            /* email            */ 'admin@mail.com',
            /* status           */ Access::STATUS_ACTIVE,
            /* role             */ Access::ROLE_ADMIN,
            /* api_key          */ Yii::$app->security->generateRandomString(32),
            /* auth_key         */ Yii::$app->security->generateRandomString(32),
            /* password_hash    */ Yii::$app->security->generatePasswordHash('q00aCqU6'),
            /* created_at       */ time(),
            /* updated_at       */ time(),
        ],[
            /* username         */ 'Покупатель',
            /* email            */ 'user@mail.com',
            /* status           */ Access::STATUS_ACTIVE,
            /* role             */ Access::ROLE_USER,
            /* api_key          */ Yii::$app->security->generateRandomString(32),
            /* auth_key         */ Yii::$app->security->generateRandomString(32),
            /* password_hash    */ Yii::$app->security->generatePasswordHash('123456'),
            /* created_at       */ time(),
            /* updated_at       */ time(),
        ]]);

        /*
         * PAGE
         */
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->null(),
            'default' => $this->tinyInteger()->defaultValue(0),
            'active' => $this->tinyInteger()->defaultValue(1),
            'order' => $this->integer()->defaultValue(0),
            'view' => $this->string()->notNull(),
            'menu_enable' => $this->tinyInteger()->defaultValue(0),
            'menu_label' => $this->string()->null(),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'description' => $this->string()->null(),
            'keywords' => $this->string()->null(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ], $this->options);
        $this->createIndex('idx-page-active', 'page', 'active');
        $this->createIndex('idx-page-order', 'page', 'order');
        $this->createIndex('idx-page-parent_id', 'page', 'parent_id');
        $this->addForeignKey('fk-page-parent', 'page', 'parent_id','page', 'id', 'CASCADE', 'RESTRICT');
        $this->batchInsert('page', ['id','parent_id','default','active','title','menu_enable','menu_label','view','alias','created_at','updated_at'],[
        // О ПРОЕКТЕ - 1
        [
            /* id           */ 1,
            /* parent_id    */ null,
            /* default      */ 1,
            /* active       */ 1,
            /* title        */ 'О проекте',
            /* menu_enable  */ 1,
            /* menu_label   */ 'О проекте',
            /* view         */ 'file',
            /* alias        */ 'glavnaya',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ - 2
        [
            /* id           */ 2,
            /* parent_id    */ null,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Коллекции',
            /* menu_enable  */ 1,
            /* menu_label   */ 'Коллекции',
            /* view         */ 'product-category-list',
            /* alias        */ 'kollektsii',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ДМИТРИЙ МИРОНОВ - 9
        [
            /* id           */ 9,
            /* parent_id    */ 2,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Дмитрий Миронов',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'dmitrij-mironov',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ДМИТРИЙ МИРОНОВ / Trust - 15
        [
            /* id           */ 15,
            /* parent_id    */ 9,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-1',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ДМИТРИЙ МИРОНОВ / Trust - 16
        [
            /* id           */ 16,
            /* parent_id    */ 9,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-2',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ДМИТРИЙ МИРОНОВ / Trust - 17
        [
            /* id           */ 17,
            /* parent_id    */ 9,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-3',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ОКСАНА ДЕВОЧКИНА - 10
        [
            /* id           */ 10,
            /* parent_id    */ 2,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Оксана Девочкина',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'oksana-devochkina',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ОКСАНА ДЕВОЧКИНА / Trust - 18
        [
            /* id           */ 18,
            /* parent_id    */ 10,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-4',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ОКСАНА ДЕВОЧКИНА / Trust - 19
        [
            /* id           */ 19,
            /* parent_id    */ 10,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-5',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ОКСАНА ДЕВОЧКИНА / Trust - 20
        [
            /* id           */ 20,
            /* parent_id    */ 10,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-6',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ЛИЗА ЗЕМСКОВА - 11
        [
            /* id           */ 11,
            /* parent_id    */ 2,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Лиза Земскова',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'liza-zemskova',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ЛИЗА ЗЕМСКОВА / Trust - 21
        [
            /* id           */ 21,
            /* parent_id    */ 11,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-7',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ЛИЗА ЗЕМСКОВА / Trust - 22
        [
            /* id           */ 22,
            /* parent_id    */ 11,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-8',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ЛИЗА ЗЕМСКОВА / Trust - 23
        [
            /* id           */ 23,
            /* parent_id    */ 11,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-9',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ИВАН ИВАНОВ - 12
        [
            /* id           */ 12,
            /* parent_id    */ 2,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Иван Иванов',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'ivan-ivanov',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ИВАН ИВАНОВ / Trust - 24
        [
            /* id           */ 24,
            /* parent_id    */ 12,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-10',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ИВАН ИВАНОВ / Trust - 25
        [
            /* id           */ 25,
            /* parent_id    */ 12,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-11',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / ИВАН ИВАНОВ / Trust - 26
        [
            /* id           */ 26,
            /* parent_id    */ 12,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-12',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АННА САШКЕВИЧ - 13
        [
            /* id           */ 13,
            /* parent_id    */ 2,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Анна Сашкевич',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'anna-sashkevich',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АННА САШКЕВИЧ / Trust - 27
        [
            /* id           */ 27,
            /* parent_id    */ 13,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-13',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АННА САШКЕВИЧ / Trust - 28
        [
            /* id           */ 28,
            /* parent_id    */ 13,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-14',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АННА САШКЕВИЧ / Trust - 29
        [
            /* id           */ 29,
            /* parent_id    */ 13,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-15',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК - 14
        [
            /* id           */ 14,
            /* parent_id    */ 2,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Александр Спок',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'aleksandr-spok',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК / Trust - 30
        [
            /* id           */ 30,
            /* parent_id    */ 14,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-16',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК / Trust - 31
        [
            /* id           */ 31,
            /* parent_id    */ 14,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-17',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК / Trust - 32
        [
            /* id           */ 32,
            /* parent_id    */ 14,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-18',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ 3
        [
            /* id           */ 3,
            /* parent_id    */ null,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Художники',
            /* menu_enable  */ 1,
            /* menu_label   */ 'Художники',
            /* view         */ 'product-category-list',
            /* alias        */ 'hudozhniki',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ДМИТРИЙ МИРОНОВ 33
        [
                /* id           */ 33,
                /* parent_id    */ 3,
                /* default      */ 0,
                /* active       */ 1,
                /* title        */ 'Дмитрий Миронов',
                /* menu_enable  */ 0,
                /* menu_label   */ '',
                /* view         */ 'product-category',
                /* alias        */ 'dmitrij-mironov-h',
                /* created_at   */ time(),
                /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ДМИТРИЙ МИРОНОВ / Trust 34
        [
            /* id           */ 34,
            /* parent_id    */ 33,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-33',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ДМИТРИЙ МИРОНОВ / Trust 35
        [
            /* id           */ 35,
            /* parent_id    */ 33,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-35',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ДМИТРИЙ МИРОНОВ / Trust 36
        [
                /* id           */ 36,
                /* parent_id    */ 33,
                /* default      */ 0,
                /* active       */ 1,
                /* title        */ 'Trust',
                /* menu_enable  */ 0,
                /* menu_label   */ '',
                /* view         */ 'product',
                /* alias        */ 'trust-36',
                /* created_at   */ time(),
                /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ОКСАНА ДЕВОЧКИНА 37
        [
            /* id           */ 37,
            /* parent_id    */ 3,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Оксана Девочкина',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'oksana-devochkina-h',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ОКСАНА ДЕВОЧКИНА / Trust 38
        [
            /* id           */ 38,
            /* parent_id    */ 37,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-38',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ОКСАНА ДЕВОЧКИНА / Trust 39
        [
            /* id           */ 39,
            /* parent_id    */ 37,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-39',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ОКСАНА ДЕВОЧКИНА / Trust 40
        [
            /* id           */ 40,
            /* parent_id    */ 37,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-40',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ЛИЗА ЗЕМСКОВА 41
        [
            /* id           */ 41,
            /* parent_id    */ 3,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Лиза Земскова',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'liza-zemskova-h',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ЛИЗА ЗЕМСКОВА / Trust 42
        [
            /* id           */ 42,
            /* parent_id    */ 41,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-42',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ЛИЗА ЗЕМСКОВА / Trust 43
        [
            /* id           */ 43,
            /* parent_id    */ 41,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-43',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ЛИЗА ЗЕМСКОВА / Trust 44
        [
            /* id           */ 44,
            /* parent_id    */ 41,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-44',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ИВАН ИВАНОВ 45
        [
            /* id           */ 45,
            /* parent_id    */ 3,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Иван Иванов',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'ivan-ivanov-h',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ИВАН ИВАНОВ / Trust 46
        [
            /* id           */ 46,
            /* parent_id    */ 45,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-46',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ИВАН ИВАНОВ / Trust 47
        [
            /* id           */ 47,
            /* parent_id    */ 45,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-47',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / ИВАН ИВАНОВ / Trust 48
        [
            /* id           */ 48,
            /* parent_id    */ 45,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-48',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / АННА САШКЕВИЧ 49
        [
            /* id           */ 49,
            /* parent_id    */ 3,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Анна Сашкевич',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'anna-sashkevich-h',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / АННА САШКЕВИЧ / Trust 50
        [
            /* id           */ 50,
            /* parent_id    */ 49,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-50',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / АННА САШКЕВИЧ / Trust 51
        [
            /* id           */ 51,
            /* parent_id    */ 49,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-51',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ХУДОЖНИКИ / АННА САШКЕВИЧ / Trust 52
        [
            /* id           */ 52,
            /* parent_id    */ 49,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-52',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК - 53
        [
            /* id           */ 53,
            /* parent_id    */ 3,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Александр Спок',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product-category',
            /* alias        */ 'aleksandr-spok-h',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК / Trust - 54
        [
            /* id           */ 54,
            /* parent_id    */ 53,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-54',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК / Trust - 55
        [
            /* id           */ 55,
            /* parent_id    */ 53,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-55',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОЛЛЕКЦИИ / АЛЕКСАНДР СПОК / Trust - 56
        [
            /* id           */ 56,
            /* parent_id    */ 53,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Trust',
            /* menu_enable  */ 0,
            /* menu_label   */ '',
            /* view         */ 'product',
            /* alias        */ 'trust-56',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ПРОДАНО 4
        [
            /* id           */ 4,
            /* parent_id    */ null,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Продано',
            /* menu_enable  */ 1,
            /* menu_label   */ 'Продано',
            /* view         */ 'file',
            /* alias        */ 'prodano',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // ПОДЛИННОСТЬ 5
        [
            /* id           */ 5,
            /* parent_id    */ null,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Подлинность',
            /* menu_enable  */ 1,
            /* menu_label   */ 'Подлинность',
            /* view         */ 'file',
            /* alias        */ 'podlinnost',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // СОТРУДНИЧЕСТВО 6
        [
            /* id           */ 6,
            /* parent_id    */ null,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Сотрудничество',
            /* menu_enable  */ 1,
            /* menu_label   */ 'Сотрудничество',
            /* view         */ 'file',
            /* alias        */ 'sotrudnichestvo',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // БЛОГ 7
        [
            /* id           */ 7,
            /* parent_id    */ null,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Блог',
            /* menu_enable  */ 1,
            /* menu_label   */ 'Блог',
            /* view         */ 'file',
            /* alias        */ 'blog',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ],
        // КОНТАКТЫ 8
        [
            /* id           */ 8,
            /* parent_id    */ null,
            /* default      */ 0,
            /* active       */ 1,
            /* title        */ 'Контакты',
            /* menu_enable  */ 1,
            /* menu_label   */ 'Контакты',
            /* view         */ 'file',
            /* alias        */ 'kontakty',
            /* created_at   */ time(),
            /* updated_at   */ time(),
        ]]);

        /*
         * FILE
         */
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->null(),
            'file' => $this->string()->notNull(),
        ], $this->options);
        $this->createIndex('idx-file-page_id', 'file', 'page_id');
        $this->addForeignKey('fk-file-page', 'file', 'page_id', 'page', 'id','CASCADE','RESTRICT');
        $this->batchInsert('file', ['page_id','file'], [
            [1, 'home.php'],
            [2, 'kollektsii.php'],
            [3, 'hudozhniki.php'],
            [4, 'prodano.php'],
            [5, 'podlinnost.php'],
            [6, 'sotrudnichestvo.php'],
            [7, 'blog.php'],
            [8, 'kontakty.php'],
        ]);

        /*
         * IMAGE
         */
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
        ], $this->options);
        $this->batchInsert('image', ['id','url'], [
            [1, '/img/catalog/demo-1.jpg'],
            [2, '/img/catalog/demo-2.jpg'],
            [3, '/img/catalog/demo-3.jpg'],
            [4, '/img/catalog/demo-4.jpg'],
            [5, '/img/catalog/demo-5.jpg'],
            [6, '/img/catalog/demo-6.jpg'],
            [7, '/img/catalog/demo-7.jpg'],
            [8, '/img/catalog/demo-8.jpg'],
            [9, '/img/catalog/demo-9.jpg'],
        ]);

        /*
         * PRODUCT_CATEGORY
         */
        $this->createTable('product_category', [
            'id'        => $this->primaryKey(),
            'page_id'   => $this->integer()->null(),
            'title'     => $this->string()->notNull(),
            'image_id'  => $this->integer()->null(),
        ], $this->options);
        $this->createIndex('idx-product_category-image_id','product_category', 'image_id');
        $this->addForeignKey('fk-product_category-image', 'product_category', 'image_id', 'image', 'id','CASCADE','RESTRICT');
        $this->createIndex('idx-product_category-page_id','product_category', 'page_id');
        $this->addForeignKey('fk-product_category-page', 'product_category', 'page_id', 'page', 'id','CASCADE','RESTRICT');
        $this->batchInsert('product_category', ['id', 'page_id', 'title', 'image_id'], [[
            /* id           */ 1,
            /* page_id      */ 9,
            /* title        */ 'Дмитрий Миронов',
            /* image_id     */ 1,
        ],[
            /* id           */ 2,
            /* page_id      */ 10,
            /* title        */ 'Оксана Девочкина',
            /* image_id     */ 2,
        ],[
            /* id           */ 3,
            /* page_id      */ 11,
            /* title        */ 'Лиза Земскова',
            /* image_id     */ 3,
        ],[
            /* id           */ 4,
            /* page_id      */ 12,
            /* title        */ 'Иван Иванов',
            /* image_id     */ 4,
        ],[
            /* id           */ 5,
            /* page_id      */ 13,
            /* title        */ 'Анна Сашкевич',
            /* image_id     */ 5,
        ],[
            /* id           */ 6,
            /* page_id      */ 14,
            /* title        */ 'Александр Спок',
            /* image_id     */ 6,
        ],[
            /* id           */ 7,
            /* page_id      */ 33,
            /* title        */ 'Дмитрий Миронов',
            /* image_id     */ 1,
        ],[
            /* id           */ 8,
            /* page_id      */ 37,
            /* title        */ 'Оксана Девочкина',
            /* image_id     */ 2,
        ],[
            /* id           */ 9,
            /* page_id      */ 41,
            /* title        */ 'Лиза Земскова',
            /* image_id     */ 3,
        ],[
            /* id           */ 10,
            /* page_id      */ 45,
            /* title        */ 'Иван Иванов',
            /* image_id     */ 4,
        ],[
            /* id           */ 11,
            /* page_id      */ 49,
            /* title        */ 'Анна Сашкевич',
            /* image_id     */ 5,
        ],[
            /* id           */ 12,
            /* page_id      */ 53,
            /* title        */ 'Александр Спок',
            /* image_id     */ 6,
        ]]);

        /*
         * PRODUCT
         */
        $this->createTable('product', [
            'id'            => $this->primaryKey(),
            'page_id'       => $this->integer()->null(),
            'title'         => $this->string(),
            'author'        => $this->string(),
            'neuro'         => $this->string(),
            'artikul'       => $this->string(),
            'size'          => $this->string(),
            'description'   => $this->longText(),
            'price'         => $this->integer(),
        ], $this->options);
        $this->createIndex('idx-product-page_id','product', 'page_id');
        $this->addForeignKey('fk-product-page', 'product', 'page_id', 'page', 'id','CASCADE','RESTRICT');
        $this->batchInsert('product', ['id','page_id','title','author','neuro','artikul','size','description','price'], [[
            /* id           */ 1,
            /* page_id      */ 15,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00001',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 495000,
        ],[
            /* id           */ 2,
            /* page_id      */ 16,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00002',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 500000,
        ],[
            /* id           */ 3,
            /* page_id      */ 17,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00003',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 510000,
        ],[
            /* id           */ 4,
            /* page_id      */ 18,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00004',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 520000,
        ],[
            /* id           */ 5,
            /* page_id      */ 19,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00005',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 530000,
        ],[
            /* id           */ 6,
            /* page_id      */ 20,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00006',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 540000,
        ],[
            /* id           */ 7,
            /* page_id      */ 21,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00007',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 560000,
        ],[
            /* id           */ 8,
            /* page_id      */ 22,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00008',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 570000,
        ],[
            /* id           */ 9,
            /* page_id      */ 23,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00009',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 580000,
        ],[
            /* id           */ 10,
            /* page_id      */ 24,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00010',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 590000,
        ],[
            /* id           */ 11,
            /* page_id      */ 25,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00011',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 600000,
        ],[
            /* id           */ 12,
            /* page_id      */ 26,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00012',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 610000,
        ],[
            /* id           */ 13,
            /* page_id      */ 27,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00013',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 620000,
        ],[
            /* id           */ 14,
            /* page_id      */ 28,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00014',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 630000,
        ],[
            /* id           */ 15,
            /* page_id      */ 29,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00015',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 640000,
        ],[
            /* id           */ 16,
            /* page_id      */ 30,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00016',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 650000,
        ],[
            /* id           */ 17,
            /* page_id      */ 31,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00017',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 660000,
        ],[
            /* id           */ 18,
            /* page_id      */ 32,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00018',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 670000,
        ],[
            /* id           */ 19,
            /* page_id      */ 35,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00019',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 495000,
        ],[
            /* id           */ 20,
            /* page_id      */ 34,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00020',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 500000,
        ],[
            /* id           */ 21,
            /* page_id      */ 36,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00021',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 510000,
        ],[
            /* id           */ 22,
            /* page_id      */ 38,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00004',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 520000,
        ],[
            /* id           */ 23,
            /* page_id      */ 39,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00023',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 530000,
        ],[
            /* id           */ 24,
            /* page_id      */ 40,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00024',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 540000,
        ],[
            /* id           */ 25,
            /* page_id      */ 42,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00025',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 560000,
        ],[
            /* id           */ 26,
            /* page_id      */ 43,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00026',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 570000,
        ],[
            /* id           */ 27,
            /* page_id      */ 44,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00027',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 580000,
        ],[
            /* id           */ 28,
            /* page_id      */ 46,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00028',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 590000,
        ],[
            /* id           */ 29,
            /* page_id      */ 47,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00029',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 600000,
        ],[
            /* id           */ 30,
            /* page_id      */ 48,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00030',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 610000,
        ],[
            /* id           */ 31,
            /* page_id      */ 50,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00031',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 620000,
        ],[
            /* id           */ 32,
            /* page_id      */ 51,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00032',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 630000,
        ],[
            /* id           */ 33,
            /* page_id      */ 52,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00033',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 640000,
        ],[
            /* id           */ 34,
            /* page_id      */ 54,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00034',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 650000,
        ],[
            /* id           */ 35,
            /* page_id      */ 55,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00035',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 660000,
        ],[
            /* id           */ 36,
            /* page_id      */ 56,
            /* title        */ 'Trust',
            /* author       */ 'Cloud Mone',
            /* neuro        */ 'StarGAN v2',
            /* artikul      */ '00036',
            /* size         */ '4000х4000 px',
            /* description  */ '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            /* price        */ 670000,
        ]]);

        /*
         * ORDER
         */
        $this->createTable('user_product', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $this->options);
        $this->addForeignKey('fk-user_product-product', 'user_product', 'product_id', 'product', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-user_product-user', 'user_product', 'user_id', 'user', 'id', 'CASCADE', 'RESTRICT');

        /*
         * PRODUCT_IMAGE
         */
        $this->createTable('product_image', [
            'id'            => $this->primaryKey(),
            'product_id'    => $this->integer()->notNull(),
            'image_id'      => $this->integer()->notNull(),
            'order'         => $this->integer()->defaultValue(0),
        ], $this->options);
        // $this->addPrimaryKey('pk-product_image', 'product_image', ['product_id', 'image_id']);
        $this->createIndex('idx-product_image-product_id', 'product_image', 'product_id');
        $this->createIndex('idx-product_image-image_id', 'product_image', 'image_id');
        $this->addForeignKey('fk-product_image-product', 'product_image', 'product_id', 'product', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product_image-image', 'product_image', 'image_id', 'image', 'id', 'CASCADE', 'RESTRICT');
        $this->batchInsert('product_image', ['product_id','image_id','order'], [
            [1,1,1],[1,2,2],[1,3,3],[1,4,4],[1,5,5],
            [2,6,1],[2,7,2],[2,8,3],[2,9,4],[2,1,5],
            [3,2,1],[3,3,2],[3,4,3],[3,5,4],[3,6,5],
            [4,7,1],[4,8,2],[4,9,3],[4,1,4],[4,2,5],
            [5,3,1],[5,4,2],[5,5,3],[5,6,4],[5,7,5],
            [6,8,1],[6,9,2],[6,1,3],[6,2,4],[6,3,5],
            [7,4,1],[7,5,2],[7,6,3],[7,7,4],[7,8,5],
            [8,9,1],[8,1,2],[8,2,3],[8,3,4],[8,4,5],
            [9,5,1],[9,6,2],[9,7,3],[9,8,4],[9,9,5],
            [10,1,1],[10,2,2],[10,3,3],[10,4,4],[10,5,5],
            [11,6,1],[11,7,2],[11,8,3],[11,9,4],[11,1,5],
            [12,2,1],[12,3,2],[12,4,3],[12,5,4],[12,6,5],
            [13,7,1],[13,8,2],[13,9,3],[13,1,4],[13,2,5],
            [14,3,1],[14,4,2],[14,5,3],[14,6,4],[14,7,5],
            [15,8,1],[15,9,2],[15,1,3],[15,2,4],[15,3,5],
            [16,4,1],[16,5,2],[16,6,3],[16,7,4],[16,8,5],
            [17,9,1],[17,1,2],[17,2,3],[17,3,4],[17,4,5],
            [18,5,1],[18,6,2],[18,7,3],[18,8,4],[18,9,5],
            [19,1,1],[19,2,2],[19,3,3],[19,4,4],[19,5,5],
            [20,6,1],[20,7,2],[20,8,3],[20,9,4],[20,1,5],
            [21,2,1],[21,3,2],[21,4,3],[21,5,4],[21,6,5],
            [22,7,1],[22,8,2],[22,9,3],[22,1,4],[22,2,5],
            [23,3,1],[23,4,2],[23,5,3],[23,6,4],[23,7,5],
            [24,8,1],[24,9,2],[24,1,3],[24,2,4],[24,3,5],
            [25,4,1],[25,5,2],[25,6,3],[25,7,4],[25,8,5],
            [26,9,1],[26,1,2],[26,2,3],[26,3,4],[26,4,5],
            [27,5,1],[27,6,2],[27,7,3],[27,8,4],[27,9,5],
            [28,1,1],[28,2,2],[28,3,3],[28,4,4],[28,5,5],
            [29,6,1],[29,7,2],[29,8,3],[29,9,4],[29,1,5],
            [30,2,1],[30,3,2],[30,4,3],[30,5,4],[30,6,5],
            [31,7,1],[31,8,2],[31,9,3],[31,1,4],[31,2,5],
            [32,3,1],[32,4,2],[32,5,3],[32,6,4],[32,7,5],
            [33,8,1],[33,9,2],[33,1,3],[33,2,4],[33,3,5],
            [34,4,1],[34,5,2],[34,6,3],[34,7,4],[34,8,5],
            [35,9,1],[35,1,2],[35,2,3],[35,3,4],[35,4,5],
            [36,5,1],[36,6,2],[36,7,3],[36,8,4],[36,9,5],
        ]);

        /*
         * HTML
         */
        $this->createTable('html', [
            'id'        => $this->primaryKey(),
            'page_id'   => $this->integer()->null(),
            'content'   => $this->longText(),
        ], $this->options);
        $this->createIndex('idx-html-page_id', 'html', 'page_id');
        $this->addForeignKey('fk-html-page', 'html', 'page_id', 'page', 'id','CASCADE','RESTRICT');
        /*
         * EDITOR
         */
        $this->createTable('editor', [
            'id'        => $this->primaryKey(),
            'page_id'   => $this->integer()->null(),
            'content'   => $this->longText(),
        ], $this->options);
        $this->createIndex('idx-editor-page_id', 'editor', 'page_id');
        $this->addForeignKey('fk-editor-page', 'editor', 'page_id', 'page', 'id','CASCADE','RESTRICT');

        /*
         * TAG
         */
        $this->createTable('tag', [
            'id'        => $this->primaryKey(),
            'name'      => $this->string()->notNull(),
        ], $this->options);
        $this->createIndex('idx-tag-name', 'tag', 'name');

        /*
         * POST
         */
        $this->createTable('post', [
            'id'            => $this->primaryKey(),
            'page_id'       => $this->integer()->null(),
            'views'         => $this->integer()->null(),
            'title'         => $this->string()->notNull(),
            'description'   => $this->text()->null(),
            'img'           => $this->string()->null(),
            'content'       => $this->longText()->null()
        ], $this->options);
        $this->createIndex('idx-post-page_id', 'post', 'page_id');
        $this->addForeignKey('fk-post-page', 'post', 'page_id', 'page', 'id','CASCADE','RESTRICT');

        /*
         * POST_TAG
         */
        $this->createTable('post_tag', [
            'post_id'   => $this->integer()->notNull(),
            'tag_id'    => $this->integer()->notNull(),
        ], $this->options);
        $this->addPrimaryKey('pk-post_tag', 'post_tag', ['post_id', 'tag_id']);
        $this->createIndex('idx-post_tag-post_id', 'post_tag', 'post_id');
        $this->createIndex('idx-post_tag-tag_id', 'post_tag', 'tag_id');
        $this->addForeignKey('fk-post_tag-post', 'post_tag', 'post_id', 'post', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-post_tag-tag', 'post_tag', 'tag_id', 'tag', 'id', 'CASCADE', 'RESTRICT');

        /*
         * FAQ
         */
        $this->createTable('faq', [
            'id'        => $this->primaryKey(),
            'page_id'   => $this->integer()->null(),
            'title'     => $this->string()->notNull(),
            'content'   => $this->longText()->null(),
        ], $this->options);
        $this->createIndex('idx-faq-page_id', 'faq', 'page_id');
        $this->addForeignKey('fk-faq-page', 'faq', 'page_id', 'page', 'id','CASCADE','RESTRICT');
        /*
         * SERVICE
         */
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->null(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'img' => $this->string()->null(),
            'content' => $this->longText()->null(),
            'price' => $this->string()->null(),
        ], $this->options);
        $this->createIndex('idx-service-page_id', 'service', 'page_id');
        $this->addForeignKey('fk-service-page', 'service', 'page_id', 'page', 'id','CASCADE','RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTables();
    }

    /**
     * @return yii\db\ColumnSchemaBuilder
     */
    public function longText()
    {
        return $this->db->schema->createColumnSchemaBuilder('LONGTEXT');
    }

    /**
     * @return string
     */
    private function dropTables()
    {
        $db = $this->db;
        try {
            $db->createCommand('SET foreign_key_checks = 0')->execute();
            foreach ($this->tables as $table) {
                $tableName = $db->tablePrefix . $table;
                if ($db->getTableSchema($tableName, true) !== null) {
                    $this->dropTable($tableName);
                }
            }
            $db->createCommand('SET foreign_key_checks = 1')->execute();
            return 'done: drop all tables';
        } catch (ExceptionDataBase $exception) {
            return 'error: ' . $exception->getMessage();
        }
    }

    /**
     * @return string|null
     */
    public function getOptions()
    {
        if ($this->db->driverName === 'mysql') {
            return 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        return null;
    }
}

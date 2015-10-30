<?php

namespace voskobovich\mandrill\migrations;

use voskobovich\base\db\pgsql\Schema;
use yii\db\Migration;


/**
 * Class create_table_mail
 * @package voskobovich\mandrill\migrations
 */
class create_table_mandrill_template extends Migration
{
    private $_tableName = '{{%mod_mandrill_template}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => Schema::TYPE_PK,
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'template_slug' => Schema::TYPE_STRING . ' NULL',
            'from_email' => Schema::TYPE_STRING,
            'from_name' => Schema::TYPE_STRING,
            'bcc_email' => Schema::TYPE_STRING,
            'subject' => Schema::TYPE_STRING,
            'background_color' => Schema::TYPE_STRING . '(7)',
            'background_url' => Schema::TYPE_STRING,
            'logo_url' => Schema::TYPE_STRING,
            'header' => Schema::TYPE_TEXT,
            'footer' => Schema::TYPE_TEXT,
            'is_default' => Schema::TYPE_BOOLEAN,
        ], $tableOptions);

        $this->createIndex('mail_slug_idx', $this->_tableName, 'slug', true);
    }

    public function safeDown()
    {
        $this->dropTable($this->_tableName);
    }
}

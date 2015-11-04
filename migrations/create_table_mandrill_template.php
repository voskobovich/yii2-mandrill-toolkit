<?php

namespace voskobovich\mandrill\migrations;

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
            'id' => $this->primaryKey(),
            'slug' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'template_slug' => $this->string(),
            'from_email' => $this->string(),
            'from_name' => $this->string(),
            'bcc_email' => $this->string(),
            'subject' => $this->string(),
            'background_color' => $this->string(7),
            'background_url' => $this->string(),
            'logo_url' => $this->string(),
            'header' => $this->text(),
            'footer' => $this->text(),
            'is_default' => $this->boolean(),
        ], $tableOptions);

        $this->createIndex('mail_slug_idx', $this->_tableName, 'slug', true);
    }

    public function safeDown()
    {
        $this->dropTable($this->_tableName);
    }
}

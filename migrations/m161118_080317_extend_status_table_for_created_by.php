<?php

use yii\db\Schema;
use yii\db\Migration;

class m161118_080317_extend_status_table_for_created_by extends Migration
{
    public function up()
    {
	$this->addColumn('{{%status}}','created_by',Schema::TYPE_INTEGER.' NOT NULL');
    $this->addForeignKey('fk_status_created_by', '{{%status}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        echo "m161118_080317_extend_status_table_for_created_by cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

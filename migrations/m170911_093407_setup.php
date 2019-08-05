<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m170911_093407_setup
 */
class m170911_093407_setup extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING . ' NOT NULL',
            'last_name' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'personal_code' => Schema::TYPE_BIGINT . ' NOT NULL',
            'phone' => Schema::TYPE_BIGINT . ' NOT NULL',
            'active' => Schema::TYPE_BOOLEAN,
            'dead' => Schema::TYPE_BOOLEAN,
            'lang' => Schema::TYPE_STRING
        ]);

        $this->createTable('loan', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'amount' => 'NUMERIC( 10, 2 ) NOT NULL',
            'interest' => 'NUMERIC( 10, 2 ) NOT NULL',
            'duration' => Schema::TYPE_INTEGER . ' NOT NULL',
            'start_date' => Schema::TYPE_DATE . ' NOT NULL',
            'end_date' => Schema::TYPE_DATE . ' NOT NULL',
            'campaign' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_BOOLEAN
        ]);

        $this->addForeignKey('user_loan_fk', 'loan', 'user_id', 'user', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_loan_fk', 'loan');
        $this->dropTable('user');
        $this->dropTable('loan');
    }
}

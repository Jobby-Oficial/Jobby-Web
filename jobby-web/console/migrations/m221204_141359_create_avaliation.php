<?php

use yii\db\Migration;

/**
 * Class m211204_141359_create_avaliation
 */
class m221204_141359_create_avaliation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%avaliation}}', [
            'id' => $this->primaryKey(),
            'avaliation' => $this->decimal(11,1)->notNull(),
            'service_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_avaliation_service', 'avaliation', 'service_id', 'service', 'id');
        $this->addForeignKey('FK_avaliation_user', 'avaliation', 'user_id', 'user', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_avaliation_service', 'avaliation');
        $this->dropForeignKey('FK_avaliation_user', 'avaliation');
        $this->dropTable('{{%avaliation}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211204_141359_create_avaliation cannot be reverted.\n";

        return false;
    }
    */
}

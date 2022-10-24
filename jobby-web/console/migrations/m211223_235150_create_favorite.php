<?php

use yii\db\Migration;

/**
 * Class m211223_235150_create_favorite
 */
class m211223_235150_create_favorite extends Migration
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

        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_favorite_service', 'favorite', 'service_id', 'service', 'id');
        $this->addForeignKey('FK_favorite_user', 'favorite', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_favorite_service', 'favorite');
        $this->dropForeignKey('FK_favorite_user', 'user');
        $this->dropTable('{{%favorite}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211223_235150_create_favorite cannot be reverted.\n";

        return false;
    }
    */
}

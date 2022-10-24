<?php

use yii\db\Migration;

/**
 * Class m211116_113107_init_service
 */
class m211116_113107_create_service extends Migration
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

        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->decimal(11,2)->notNull(),
            'rating_average' => $this->decimal(11,2)->null(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_service_user', 'service', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_service_user', 'service');
        $this->dropTable('{{%service}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211116_113107_init_service cannot be reverted.\n";

        return false;
    }
    */
}

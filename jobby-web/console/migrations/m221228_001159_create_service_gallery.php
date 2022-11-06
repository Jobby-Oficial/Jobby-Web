<?php

use yii\db\Migration;

/**
 * Class m211228_001159_create_service_gallery
 */
class m221228_001159_create_service_gallery extends Migration
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

        $this->createTable('{{%service_gallery}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'service_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_service_gallery_service', 'service_gallery', 'service_id', 'service', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_service_gallery_service', 'service_gallery');
        $this->dropTable('{{%service_gallery}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211228_001159_create_service_gallery cannot be reverted.\n";

        return false;
    }
    */
}

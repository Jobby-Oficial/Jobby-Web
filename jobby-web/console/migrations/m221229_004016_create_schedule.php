<?php

use yii\db\Migration;

/**
 * Class m211229_004016_create_schedule
 */
class m221229_004016_create_schedule extends Migration
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

        $this->createTable('{{%schedule}}', [
            'id' => $this->primaryKey(),
            'service_date' => $this->date()->notNull(),
            'service_time' => $this->time()->notNull(),
            'note' => $this->text()->null(),
            'payment' => $this->boolean()->notNull()->defaultValue(false),
            'schedule_status' => $this->boolean()->null(),
            'schedule_status_note' => $this->text()->null(),
            'price' => $this->decimal(11,2)->null(),
            'job_status_id' => $this->integer()->notNull()->defaultValue(1),
            'service_id' => $this->integer()->notNull(),
            'professional_id' => $this->integer()->notNull(),
            'client_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_job_status_schedule', 'schedule', 'job_status_id', 'job_status', 'id');
        $this->addForeignKey('FK_service_schedule', 'schedule', 'service_id', 'service', 'id');
        $this->addForeignKey('FK_professional_schedule', 'schedule', 'professional_id', 'user', 'id');
        $this->addForeignKey('FK_client_schedule', 'schedule', 'client_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_job_status_schedule', 'schedule');
        $this->dropForeignKey('FK_service_schedule', 'schedule');
        $this->dropForeignKey('FK_professional_schedule', 'schedule');
        $this->dropForeignKey('FK_client_schedule', 'schedule');
        $this->dropTable('{{%schedule}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211229_004016_create_schedule cannot be reverted.\n";

        return false;
    }
    */
}

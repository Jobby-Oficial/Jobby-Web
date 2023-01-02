<?php

use yii\db\Migration;

/**
 * Class m211229_003928_create_job_status
 */
class m211229_003928_create_job_status extends Migration
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

        $this->createTable('{{%job_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%job_status}}',array(
            'name' => 'Esperando Aprovação',
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));

        $this->insert('{{%job_status}}',array(
            'name' => 'Não Começou',
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));

        $this->insert('{{%job_status}}',array(
            'name' => 'Concluído',
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job_status}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211229_003928_create_job_status cannot be reverted.\n";

        return false;
    }
    */
}

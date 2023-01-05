<?php

use yii\db\Migration;

/**
 * Class m211116_113107_init_service
 */
class m221116_113107_create_service extends Migration
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

        /*$this->insert('{{%service}}',array(
            'category' => 'Educação',
            'name' => 'Aulas de explicações de Matemática',
            'description' => 'Aulas visam a compreensão dos temas tratados com os alunos. Objectivo de melhorar as capacidades individuais dos estudantes para que possam atingir uma boa classificação durante a escolaridade em que diversos temas serão trabalhados. Será realizado o apoio nas diversas matérias e a elaboração da motivação do aluno e posteriormente ultrapassar dificuldades. O aluno será capaz de melhorar as suas notas bem como ganhar autonomia e conseguir ultrapassar obstáculos. Serão colocados os recursos disponíveis para a aquisição dos conhecimentos do aluno.',
            'price' => '10.00',
            'rating_average' => '0.00',
            'user_id' => '5',
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));*/
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

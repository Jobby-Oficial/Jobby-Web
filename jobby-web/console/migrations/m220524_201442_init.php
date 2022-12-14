<?php

use yii\db\Migration;

class m220524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull()->defaultValue('/assets/img/user-profile.svg'),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'phone' => $this->integer()->notNull()->unique(),
            'genre' => $this->char()->notNull(),
            'birth' => $this->date()->notNull(),
            'country' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'morada' => $this->string()->notNull(),
            'biography' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'plan_start_date' => $this->date()->notNull(),
            'plan_end_date' => $this->date()->null(),
            'highlight_date_end' => $this->date()->null(),
            'plan_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_user_plan', 'user', 'plan_id', 'plan', 'id');

        $this->insert('{{%user}}',array(
            'username' => 'guilherme',
            'email' => 'guilherme@gmail.com',
            'name' => 'Guilherme Cruz',
            'phone' => '927632646',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Lourinh??',
            'morada' => 'Rua Vale Bravo N??1',
            'biography' => 'Teste Teste Teste Teste Teste Teste',
            'auth_key' => '-5wg3Yy8DwgLORe0hQn-ZHW4AO8-wuB8',
            'password_hash' => '$2y$13$C/U4mLskLHm/BfgVDvs04OvcZl7enwxE2g17TJz1MR4HlpKUdDIT.',
            'plan_start_date' => date('Y-m-d'),
            'plan_id' => 1,
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));

        $this->insert('{{%user}}',array(
            'username' => 'admin',
            'email' => 'admin@admin.pt',
            'name' => 'Admin',
            'phone' => '927632640',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Torres Vedras',
            'morada' => 'Rua da escola n??20, torres vedras',
            'biography' => 'dsdsdsds',
            'auth_key' => '-5wg3Yy8DwgLORe0hQn-ZHW4AO8-wuB8',
            'password_hash' => '$2y$13$C/U4mLskLHm/BfgVDvs04OvcZl7enwxE2g17TJz1MR4HlpKUdDIT.',
            'plan_start_date' => date('Y-m-d'),
            'plan_id' => 1,
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));

        /*$this->insert('{{%user}}',array(
            'username' => 'marketeer',
            'email' => 'marketeer@marketeer.pt',
            'name' => 'Marketeer',
            'phone' => '927632635',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Torres Vedras',
            'morada' => 'Rua da escola n??20, torres vedras',
            'biography' => 'dsdsdsds',
            'auth_key' => '-5wg3Yy8DwgLORe0hQn-ZHW4AO8-wuB8',
            'password_hash' => '$2y$13$C/U4mLskLHm/BfgVDvs04OvcZl7enwxE2g17TJz1MR4HlpKUdDIT.',
            'plan_start_date' => date('Y-m-d'),
            'plan_id' => 1,
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));*/

        $this->insert('{{%user}}',array(
            'username' => 'professional',
            'email' => 'professional@professional.pt',
            'name' => 'Professional',
            'phone' => '927632630',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Torres Vedras',
            'morada' => 'Rua da escola n??20, torres vedras',
            'biography' => 'dsdsdsds',
            'auth_key' => '-5wg3Yy8DwgLORe0hQn-ZHW4AO8-wuB8',
            'password_hash' => '$2y$13$C/U4mLskLHm/BfgVDvs04OvcZl7enwxE2g17TJz1MR4HlpKUdDIT.',
            'plan_start_date' => date('Y-m-d'),
            'plan_id' => 1,
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));

        $this->insert('{{%user}}',array(
            'username' => 'customer',
            'email' => 'customer@customer.pt',
            'name' => 'Customer',
            'phone' => '927632625',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Torres Vedras',
            'morada' => 'Rua da escola n??20, torres vedras',
            'biography' => 'dsdsdsds',
            'auth_key' => '-5wg3Yy8DwgLORe0hQn-ZHW4AO8-wuB8',
            'password_hash' => '$2y$13$C/U4mLskLHm/BfgVDvs04OvcZl7enwxE2g17TJz1MR4HlpKUdDIT.',
            'plan_start_date' => date('Y-m-d'),
            'plan_id' => 1,
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));

        $this->insert('{{%user}}',array(
            'username' => 'teste',
            'email' => 'teste@example.com',
            'name' => 'Teste',
            'phone' => '957498725',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Torres Vedras',
            'morada' => 'Morada Teste',
            'biography' => 'Biografia Teste',
            'auth_key' => '-5wg3Yy8DwgLORe0hQn-ZHW4AO8-wuB8',
            'password_hash' => '$2y$13$C/U4mLskLHm/BfgVDvs04OvcZl7enwxE2g17TJz1MR4HlpKUdDIT.',
            'plan_start_date' => date('Y-m-d'),
            'plan_id' => 1,
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ));
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_plan', 'user');
        $this->dropTable('{{%user}}');
    }
}

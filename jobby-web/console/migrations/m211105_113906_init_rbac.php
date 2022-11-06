<?php

use yii\db\Migration;

/**
 * Class m211105_113906_init_rbac
 */
class m211105_113906_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $auth = \Yii::$app->authManager;

        // add "createPost" permission
        $backofficeaccess = $auth->createPermission('backoffice');
        $backofficeaccess->description = 'Acesso ao Backoffice';
        $auth->add($backofficeaccess);

        $createServiceBackoffice = $auth->createPermission('createServiceBackoffice');
        $createServiceBackoffice->description = 'Criar Serviço no Backoffice';
        $auth->add($createServiceBackoffice);

        $updateServiceBackoffice = $auth->createPermission('updateServiceBackoffice');
        $updateServiceBackoffice->description = 'Atualizar Serviço no Backoffice';
        $auth->add($updateServiceBackoffice);

        $deleteServiceBackoffice = $auth->createPermission('deleteServiceBackoffice');
        $deleteServiceBackoffice->description = 'Apagar Serviço no Backoffice';
        $auth->add($deleteServiceBackoffice);

        $jobProfile = $auth->createPermission('jobProfile');
        $jobProfile->description = 'Acesso ao Serviço e Trabalhos no Frontoffice';
        $auth->add($jobProfile);

        /*// add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);*/

        // add "author" role and give this role the "createPost" permission
        $consumer = $auth->createRole('consumer');
        $auth->add($consumer);
//        $auth->addChild($author, $createPost);

        // add "author" role and give this role the "createPost" permission
        $professional = $auth->createRole('professional');
        $auth->add($professional);
        $auth->addChild($professional, $jobProfile);
//        $auth->addChild($author, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $backofficeaccess);
        $auth->addChild($admin, $jobProfile);
        //$auth->addChild($admin, $author);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $developer = $auth->createRole('developer');
        $auth->add($developer);
        $auth->addChild($developer, $admin);
        $auth->addChild($developer, $createServiceBackoffice);
        $auth->addChild($developer, $updateServiceBackoffice);
        $auth->addChild($developer, $deleteServiceBackoffice);
        $auth->addChild($developer, $jobProfile);
        //$auth->addChild($developer, $backofficeaccess);
        //$auth->addChild($admin, $author);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $marketeer = $auth->createRole('marketeer');
        $auth->add($marketeer);
        $auth->addChild($marketeer, $backofficeaccess);
        $auth->addChild($marketeer, $jobProfile);
        /*$auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);*/

        $auth->assign($developer, 1);
        $auth->assign($admin, 2);
        $auth->assign($marketeer, 3);
        $auth->assign($professional, 4);
        $auth->assign($consumer, 5); 

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        /*$auth->assign($admin, 1);
        $auth->assign($consumer, 2);
        $auth->assign($professional, 3);
        $auth->assign($developer, 4);
        $auth->assign($marketeer, 5);*/
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211105_113906_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}

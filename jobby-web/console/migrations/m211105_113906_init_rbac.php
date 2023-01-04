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


        /* --------------------------------------------------
                          User no Backoffice
        -------------------------------------------------- */

        // Add "Index User no Backoffice" permission
        $indexUserBackoffice = $auth->createPermission('indexUserBackoffice');
        $indexUserBackoffice->description = 'Index User no Backoffice';
        $auth->add($indexUserBackoffice);

        // Add "View User no Backoffice" permission
        $viewUserBackoffice = $auth->createPermission('viewUserBackoffice');
        $viewUserBackoffice->description = 'View User no Backoffice';
        $auth->add($viewUserBackoffice);

        // Add "Criar User no Backoffice" permission
        $createUserBackoffice = $auth->createPermission('createUserBackoffice');
        $createUserBackoffice->description = 'Criar User no Backoffice';
        $auth->add($createUserBackoffice);

        // Add "Atualizar User no Backoffice" permission
        $updateUserBackoffice = $auth->createPermission('updateUserBackoffice');
        $updateUserBackoffice->description = 'Atualizar User no Backoffice';
        $auth->add($updateUserBackoffice);

        // Add "Apagar User no Backoffice" permission
        $deleteUserBackoffice = $auth->createPermission('deleteUserBackoffice');
        $deleteUserBackoffice->description = 'Apagar User no Backoffice';
        $auth->add($deleteUserBackoffice);

        /* ----------------------------------------------- */


        /* --------------------------------------------------
                        Service no Backoffice
        -------------------------------------------------- */

        // Add "Index Service no Backoffice" permission
        $indexServiceBackoffice = $auth->createPermission('indexServiceBackoffice');
        $indexServiceBackoffice->description = 'Index Service no Backoffice';
        $auth->add($indexServiceBackoffice);

        // Add "View Service no Backoffice" permission
        $viewServiceBackoffice = $auth->createPermission('viewServiceBackoffice');
        $viewServiceBackoffice->description = 'View Serviço no Backoffice';
        $auth->add($viewServiceBackoffice);

        // Add "Criar Service no Backoffice" permission
        $createServiceBackoffice = $auth->createPermission('createServiceBackoffice');
        $createServiceBackoffice->description = 'Criar Serviço no Backoffice';
        $auth->add($createServiceBackoffice);

        // Add "Atualizar Service no Backoffice" permission
        $updateServiceBackoffice = $auth->createPermission('updateServiceBackoffice');
        $updateServiceBackoffice->description = 'Atualizar Serviço no Backoffice';
        $auth->add($updateServiceBackoffice);

        // Add "Apagar Service no Backoffice" permission
        $deleteServiceBackoffice = $auth->createPermission('deleteServiceBackoffice');
        $deleteServiceBackoffice->description = 'Apagar Serviço no Backoffice';
        $auth->add($deleteServiceBackoffice);

        /* ----------------------------------------------- */


        /* --------------------------------------------------
                   Status do Serviço no Backoffice
        -------------------------------------------------- */

        // Add "Index Status do Serviço no Backoffice" permission
        $indexJobStatusBackoffice = $auth->createPermission('indexJobStatusBackoffice');
        $indexJobStatusBackoffice->description = 'Index JobStatus no Backoffice';
        $auth->add($indexJobStatusBackoffice);

        // Add "View Status do Serviço no Backoffice" permission
        $viewJobStatusBackoffice = $auth->createPermission('viewJobStatusBackoffice');
        $viewJobStatusBackoffice->description = 'View JobStatus no Backoffice';
        $auth->add($viewJobStatusBackoffice);

        // Add "Criar Status do Serviço no Backoffice" permission
        $createJobStatusBackoffice = $auth->createPermission('createJobStatusBackoffice');
        $createJobStatusBackoffice->description = 'Criar JobStatus no Backoffice';
        $auth->add($createJobStatusBackoffice);

        // Add "Atualizar Status do Serviço no Backoffice" permission
        $updateJobStatusBackoffice = $auth->createPermission('updateJobStatusBackoffice');
        $updateJobStatusBackoffice->description = 'Atualizar JobStatus no Backoffice';
        $auth->add($updateJobStatusBackoffice);

        // Add "Apagar Status do Serviço no Backoffice" permission
        $deleteJobStatusBackoffice = $auth->createPermission('deleteJobStatusBackoffice');
        $deleteJobStatusBackoffice->description = 'Apagar JobStatus no Backoffice';
        $auth->add($deleteJobStatusBackoffice);

        /* ----------------------------------------------- */


        /* --------------------------------------------------
                        Planos no Backoffice
        -------------------------------------------------- */

        // Add "Index Planos no Backoffice" permission
        $indexPlanBackoffice = $auth->createPermission('indexPlanBackoffice');
        $indexPlanBackoffice->description = 'Index Plan no Backoffice';
        $auth->add($indexPlanBackoffice);

        // Add "View Planos no Backoffice" permission
        $viewPlanBackoffice = $auth->createPermission('viewPlanBackoffice');
        $viewPlanBackoffice->description = 'View Plan no Backoffice';
        $auth->add($viewPlanBackoffice);

        // Add "Criar Planos no Backoffice" permission
        $createPlanBackoffice = $auth->createPermission('createPlanBackoffice');
        $createPlanBackoffice->description = 'Criar Plan no Backoffice';
        $auth->add($createPlanBackoffice);

        // Add "Atualizar Planos no Backoffice" permission
        $updatePlanBackoffice = $auth->createPermission('updatePlanBackoffice');
        $updatePlanBackoffice->description = 'Atualizar Plan no Backoffice';
        $auth->add($updatePlanBackoffice);

        // Add "Apagar Planos no Backoffice" permission
        $deletePlanBackoffice = $auth->createPermission('deletePlanBackoffice');
        $deletePlanBackoffice->description = 'Apagar Plan no Backoffice';
        $auth->add($deletePlanBackoffice);

        /* ----------------------------------------------- */


        /* --------------------------------------------------
                        Denúncias no Backoffice
        -------------------------------------------------- */

        // Add "Index Denúncias no Backoffice" permission
        $indexReportBackoffice = $auth->createPermission('indexReportBackoffice');
        $indexReportBackoffice->description = 'Index Report no Backoffice';
        $auth->add($indexReportBackoffice);

        // Add "View Denúncias no Backoffice" permission
        $viewReportBackoffice = $auth->createPermission('viewReportBackoffice');
        $viewReportBackoffice->description = 'View Report no Backoffice';
        $auth->add($viewReportBackoffice);

        // Add "Criar Denúncias no Backoffice" permission
        $createReportBackoffice = $auth->createPermission('createReportBackoffice');
        $createReportBackoffice->description = 'Criar Report no Backoffice';
        $auth->add($createReportBackoffice);

        // Add "Atualizar Denúncias no Backoffice" permission
        $updateReportBackoffice = $auth->createPermission('updateReportBackoffice');
        $updateReportBackoffice->description = 'Atualizar Report no Backoffice';
        $auth->add($updateReportBackoffice);

        // Add "Apagar Denúncias no Backoffice" permission
        $deleteReportBackoffice = $auth->createPermission('deleteReportBackoffice');
        $deleteReportBackoffice->description = 'Apagar Report no Backoffice';
        $auth->add($deleteReportBackoffice);

        /* ----------------------------------------------- */


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
        //$auth->addChild($author, $createPost);

        // add "author" role and give this role the "createPost" permission
        $professional = $auth->createRole('professional');
        $auth->add($professional);
        $auth->addChild($professional, $jobProfile);
        //$auth->addChild($author, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $developer = $auth->createRole('developer');
        $auth->add($developer);
        // Geral Permissions
        $auth->addChild($developer, $backofficeaccess);
        $auth->addChild($developer, $jobProfile);
        // User Permission
        $auth->addChild($developer, $indexUserBackoffice);
        $auth->addChild($developer, $viewUserBackoffice);
        $auth->addChild($developer, $updateUserBackoffice);
        // Service Permission
        $auth->addChild($developer, $indexServiceBackoffice);
        $auth->addChild($developer, $viewServiceBackoffice);
        $auth->addChild($developer, $createServiceBackoffice);
        $auth->addChild($developer, $updateServiceBackoffice);
        $auth->addChild($developer, $deleteServiceBackoffice);
        // JobStatus Permission
        $auth->addChild($developer, $indexJobStatusBackoffice);
        $auth->addChild($developer, $viewJobStatusBackoffice);
        $auth->addChild($developer, $createJobStatusBackoffice);
        $auth->addChild($developer, $updateJobStatusBackoffice);
        $auth->addChild($developer, $deleteJobStatusBackoffice);
        // Report Permission
        $auth->addChild($developer, $indexReportBackoffice);
        $auth->addChild($developer, $viewReportBackoffice);
        $auth->addChild($developer, $createReportBackoffice);
        $auth->addChild($developer, $updateReportBackoffice);
        $auth->addChild($developer, $deleteReportBackoffice);
        //$auth->addChild($developer, $backofficeaccess);
        //$auth->addChild($admin, $author);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        // Geral Permissions
        $auth->addChild($admin, $backofficeaccess);
        $auth->addChild($admin, $jobProfile);
        // User Permission
        $auth->addChild($admin, $indexUserBackoffice);
        $auth->addChild($admin, $viewUserBackoffice);
        $auth->addChild($admin, $createUserBackoffice);
        $auth->addChild($admin, $updateUserBackoffice);
        $auth->addChild($admin, $deleteUserBackoffice);
        // Service Permission
        $auth->addChild($admin, $indexServiceBackoffice);
        $auth->addChild($admin, $viewServiceBackoffice);
        $auth->addChild($admin, $createServiceBackoffice);
        $auth->addChild($admin, $updateServiceBackoffice);
        $auth->addChild($admin, $deleteServiceBackoffice);
        // JobStatus Permission
        $auth->addChild($admin, $indexJobStatusBackoffice);
        $auth->addChild($admin, $viewJobStatusBackoffice);
        $auth->addChild($admin, $createJobStatusBackoffice);
        $auth->addChild($admin, $updateJobStatusBackoffice);
        $auth->addChild($admin, $deleteJobStatusBackoffice);
        // Plan Permission
        $auth->addChild($admin, $indexPlanBackoffice);
        $auth->addChild($admin, $viewPlanBackoffice);
        $auth->addChild($admin, $createPlanBackoffice);
        $auth->addChild($admin, $updatePlanBackoffice);
        $auth->addChild($admin, $deletePlanBackoffice);
        // Report Permission
        $auth->addChild($admin, $indexReportBackoffice);
        $auth->addChild($admin, $viewReportBackoffice);
        $auth->addChild($admin, $createReportBackoffice);
        $auth->addChild($admin, $updateReportBackoffice);
        $auth->addChild($admin, $deleteReportBackoffice);
        //$auth->addChild($admin, $developer);
        //$auth->addChild($admin, $author);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        //$marketeer = $auth->createRole('marketeer');
        //$auth->add($marketeer);
        //$auth->addChild($marketeer, $backofficeaccess);
        //$auth->addChild($marketeer, $jobProfile);
        /*$auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);*/

        $auth->assign($developer, 1);
        $auth->assign($admin, 2);
        //$auth->assign($marketeer, 3);
        $auth->assign($professional, 3);
        $auth->assign($consumer, 4);
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

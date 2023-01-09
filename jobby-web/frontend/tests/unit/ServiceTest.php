<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use common\models\Service;

class ServiceTest extends \Codeception\Test\Unit
{
    //protected UnitTester $tester;

    use Codeception\Specify;

    /** @specify */
    private $user;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    public function testServiceValidation()
    {
        $this->service = new Service();

        $this->service->category = null;
        $this->assertFalse($this->service->validate(['category']));

        $this->service->category = 'Categoria Teste';
        $this->assertTrue($this->service->validate(['category']));

        $this->service->name = null;
        $this->assertFalse($this->service->validate(['name']));

        $this->service->name = 'Serviço Teste';
        $this->assertTrue($this->service->validate(['name']));

        $this->service->description = null;
        $this->assertFalse($this->service->validate(['description']));

        $this->service->description = 'Descrição Teste';
        $this->assertTrue($this->service->validate(['description']));

        $this->service->price = null;
        $this->assertFalse($this->service->validate(['price']));

        $this->service->price = 10.00;
        $this->assertTrue($this->service->validate(['price']));

        $this->service->rating_average = null;
        $this->assertTrue($this->service->validate(['rating_average']));

        $this->service->rating_average = 0.0;
        $this->assertTrue($this->service->validate(['rating_average']));

        $this->service->rating_average = 3.0;
        $this->assertTrue($this->service->validate(['rating_average']));

        $this->service->user_id = null;
        $this->assertFalse($this->service->validate(['user_id']));

        $this->service->user_id = 1;
        $this->assertTrue($this->service->validate(['user_id']));

        $this->service->created_at = null;
        $this->assertTrue($this->service->validate(['created_at']));

        $this->service->created_at = '1673496989';
        $this->assertTrue($this->service->validate(['created_at']));

        $this->service->updated_at = null;
        $this->assertTrue($this->service->validate(['updated_at']));

        $this->service->updated_at = '1673496989';
        $this->assertTrue($this->service->validate(['updated_at']));
    }

    function testIntegrationServiceValidation()
    {
        /* ╔═════════════════════════════╗ */
        /* ║     Create Service Test     ║ */
        /* ╚═════════════════════════════╝ */

        $service = new Service();
        $service->category = 'Categoria Teste1000';
        $service->name = 'Serviço Teste1000';
        $service->description = 'Descrição Teste1000';
        $service->price = 1000.00;
        $service->rating_average = 1.0;
        $service->user_id = 1;
        $service->save();
        $this->assertEquals('Serviço Teste1000', $service->name);
        verify($service->name)->equals('Serviço Teste1000');

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════════╗ */
        /* ║     Assert Create Service Test     ║ */
        /* ╚════════════════════════════════════╝ */

        $this->assertNotEmpty($service);
        $this->assertNotEmpty($service->category);
        $this->assertNotEmpty($service->name);
        $this->assertNotEmpty($service->description);
        $this->assertNotEmpty($service->price);
        $this->assertNotEmpty($service->rating_average);
        $this->assertNotEmpty($service->user_id);

        $this->assertEquals('Categoria Teste1000', $service->category);
        $this->assertEquals('Serviço Teste1000', $service->name);
        $this->assertEquals('Descrição Teste1000', $service->description);
        $this->assertEquals(1000.00, $service->price);
        $this->assertEquals(1.0, $service->rating_average);
        $this->assertEquals(1, $service->user_id);

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════════╗ */
        /* ║     Verify Create Service Test     ║ */
        /* ╚════════════════════════════════════╝ */

        verify($service)->notEmpty();
        verify($service->category)->notEmpty();
        verify($service->name)->notEmpty();
        verify($service->description)->notEmpty();
        verify($service->price)->notEmpty();
        verify($service->rating_average)->notEmpty();
        verify($service->user_id)->notEmpty();

        verify($service->category)->equals('Categoria Teste1000');
        verify($service->name)->equals('Serviço Teste1000');
        verify($service->description)->equals('Descrição Teste1000');
        verify($service->price)->equals(1000.00);
        verify($service->rating_average)->equals(1.0);
        verify($service->user_id)->equals(1);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════╗ */
        /* ║     Update Service Test     ║ */
        /* ╚═════════════════════════════╝ */

        $service->category = 'Categoria Teste2000';
        $service->name = 'Serviço Teste2000';
        $service->description = 'Descrição Teste2000';
        $service->price = 2000.00;
        $service->rating_average = 2.0;
        $service->user_id = 2;
        $service->save();
        $this->assertEquals('Serviço Teste2000', $service->name);
        verify($service->name)->equals('Serviço Teste2000');

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════════╗ */
        /* ║     Assert Update Service Test     ║ */
        /* ╚════════════════════════════════════╝ */

        $this->assertNotEmpty($service);
        $this->assertNotEmpty($service->category);
        $this->assertNotEmpty($service->name);
        $this->assertNotEmpty($service->description);
        $this->assertNotEmpty($service->price);
        $this->assertNotEmpty($service->rating_average);
        $this->assertNotEmpty($service->user_id);

        $this->assertEquals('Categoria Teste2000', $service->category);
        $this->assertEquals('Serviço Teste2000', $service->name);
        $this->assertEquals('Descrição Teste2000', $service->description);
        $this->assertEquals(2000.00, $service->price);
        $this->assertEquals(2.0, $service->rating_average);
        $this->assertEquals(2, $service->user_id);

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════════╗ */
        /* ║     Verify Update Service Test     ║ */
        /* ╚════════════════════════════════════╝ */

        verify($service)->notEmpty();
        verify($service->category)->notEmpty();
        verify($service->name)->notEmpty();
        verify($service->description)->notEmpty();
        verify($service->price)->notEmpty();
        verify($service->rating_average)->notEmpty();
        verify($service->user_id)->notEmpty();

        verify($service->category)->equals('Categoria Teste2000');
        verify($service->name)->equals('Serviço Teste2000');
        verify($service->description)->equals('Descrição Teste2000');
        verify($service->price)->equals(2000.00);
        verify($service->rating_average)->equals(2.0);
        verify($service->user_id)->equals(2);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════╗ */
        /* ║     Delete Service Test     ║ */
        /* ╚═════════════════════════════╝ */

        $service = Service::findOne($service->id);
        $service->delete();

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════════════════╗ */
        /* ║     Assert and Verify Delete Service Test     ║ */
        /* ╚═══════════════════════════════════════════════╝ */

        $findService = Service::find()->where(['id' => $service->id])->count();
        $this->assertEquals(0, $findService);
        verify($findService)->equals(0);

        /* ***** End of Section ***** */
    }

    function testDbService()
    {
        $modelService = Service::find()->all();
        $modelServiceCount = Service::find()->count();

        if ($modelServiceCount > 0) {
            $radom = rand(0,$modelServiceCount - 1);
            $user_id = $modelService[$radom]->user_id;

            if (isset($modelService)) {
                $this->tester->seeInDatabase('service', ['user_id' => $user_id]);
                $this->tester->dontSeeRecord(Service::class, ['user_id' => 1000]);
                $this->tester->grabColumnFromDatabase('service', 'id', array('user_id' => $user_id));
                $this->tester->updateInDatabase('service', array('user_id' => 1000), array('user_id' => 1000));
            }
        }
    }
}

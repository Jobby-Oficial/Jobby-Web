<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use common\models\Plan;

class PlanTest extends \Codeception\Test\Unit
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

    public function testPlanValidation()
    {
        $this->plan = new Plan();

        $this->plan->name = null;
        $this->assertFalse($this->plan->validate(['name']));

        $this->plan->name = 'teste';
        $this->assertTrue($this->plan->validate(['name']));

        $this->plan->name = 'vip';
        $this->assertTrue($this->plan->validate(['name']));

        $this->plan->description = null;
        $this->assertFalse($this->plan->validate(['description']));

        $this->plan->description = 'Descrição Teste';
        $this->assertTrue($this->plan->validate(['description']));

        $this->plan->price = null;
        $this->assertFalse($this->plan->validate(['price']));

        $this->plan->price = 3.00;
        $this->assertTrue($this->plan->validate(['price']));

        $this->plan->num_service = null;
        $this->assertFalse($this->plan->validate(['num_service']));

        $this->plan->num_service = 3;
        $this->assertTrue($this->plan->validate(['num_service']));

        $this->plan->num_highlight = null;
        $this->assertFalse($this->plan->validate(['num_highlight']));

        $this->plan->num_highlight = 2;
        $this->assertTrue($this->plan->validate(['num_highlight']));

        $this->plan->created_at = null;
        $this->assertTrue($this->plan->validate(['created_at']));

        $this->plan->created_at = '1673496989';
        $this->assertTrue($this->plan->validate(['created_at']));

        $this->plan->updated_at = null;
        $this->assertTrue($this->plan->validate(['updated_at']));

        $this->plan->updated_at = '1673496989';
        $this->assertTrue($this->plan->validate(['updated_at']));
    }

    function testIntegrationPlanValidation()
    {
        /* ╔══════════════════════════╗ */
        /* ║     Create Plan Test     ║ */
        /* ╚══════════════════════════╝ */

        $plan = new Plan();
        //$report->id = 1000;
        $plan->name = 'Teste1000';
        $plan->description = 'Descrição Teste1000';
        $plan->price = 1000.00;
        $plan->num_service = 1000;
        $plan->num_highlight = 1000;
        $plan->save();
        $this->assertEquals('Teste1000', $plan->name);
        verify($plan->name)->equals('Teste1000');

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Assert Create Plan Test     ║ */
        /* ╚═════════════════════════════════╝ */

        $this->assertNotEmpty($plan);
        $this->assertNotEmpty($plan->name);
        $this->assertNotEmpty($plan->description);
        $this->assertNotEmpty($plan->price);
        $this->assertNotEmpty($plan->num_service);
        $this->assertNotEmpty($plan->num_highlight);

        $this->assertEquals('Teste1000', $plan->name);
        $this->assertEquals('Descrição Teste1000', $plan->description);
        $this->assertEquals(1000.00, $plan->price);
        $this->assertEquals(1000, $plan->num_service);
        $this->assertEquals(1000, $plan->num_highlight);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Verify Create Plan Test     ║ */
        /* ╚═════════════════════════════════╝ */

        verify($plan)->notEmpty();
        verify($plan->name)->notEmpty();
        verify($plan->description)->notEmpty();
        verify($plan->price)->notEmpty();
        verify($plan->num_service)->notEmpty();
        verify($plan->num_highlight)->notEmpty();

        verify($plan->name)->equals('Teste1000');
        verify($plan->description)->equals('Descrição Teste1000');
        verify($plan->price)->equals(1000.00);
        verify($plan->num_service)->equals(1000);
        verify($plan->num_highlight)->equals(1000);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════╗ */
        /* ║     Update Plan Test     ║ */
        /* ╚══════════════════════════╝ */

        $plan->name = 'Teste2000';
        $plan->description = 'Descrição Teste2000';
        $plan->price = 2000.00;
        $plan->num_service = 2000;
        $plan->num_highlight = 2000;
        $plan->save();
        $this->assertEquals('Teste2000', $plan->name);
        verify($plan->name)->equals('Teste2000');

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Assert Update Plan Test     ║ */
        /* ╚═════════════════════════════════╝ */

        $this->assertNotEmpty($plan);
        $this->assertNotEmpty($plan->name);
        $this->assertNotEmpty($plan->description);
        $this->assertNotEmpty($plan->price);
        $this->assertNotEmpty($plan->num_service);
        $this->assertNotEmpty($plan->num_highlight);

        $this->assertEquals('Teste2000', $plan->name);
        $this->assertEquals('Descrição Teste2000', $plan->description);
        $this->assertEquals(2000.00, $plan->price);
        $this->assertEquals(2000, $plan->num_service);
        $this->assertEquals(2000, $plan->num_highlight);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Verify Update Plan Test     ║ */
        /* ╚═════════════════════════════════╝ */

        verify($plan)->notEmpty();
        verify($plan->name)->notEmpty();
        verify($plan->description)->notEmpty();
        verify($plan->price)->notEmpty();
        verify($plan->num_service)->notEmpty();
        verify($plan->num_highlight)->notEmpty();

        verify($plan->name)->equals('Teste2000');
        verify($plan->description)->equals('Descrição Teste2000');
        verify($plan->price)->equals(2000.00);
        verify($plan->num_service)->equals(2000);
        verify($plan->num_highlight)->equals(2000);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════╗ */
        /* ║     Delete Plan Test     ║ */
        /* ╚══════════════════════════╝ */

        $plan = Plan::findOne($plan->id);
        $plan->delete();

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════════════════╗ */
        /* ║     Assert and Verify Delete Plan Test     ║ */
        /* ╚════════════════════════════════════════════╝ */

        $findPlan = Plan::find()->where(['id' => $plan->id])->count();
        $this->assertEquals(0, $findPlan);
        verify($findPlan)->equals(0);

        /* ***** End of Section ***** */
    }

    function testDbPlan()
    {
        $modelPlan = Plan::find()->all();
        $modelPlanCount = Plan::find()->count();
        $radom = rand(0,$modelPlanCount - 1);
        $name = $modelPlan[$radom]->name;

        if (isset($modelPlan)) {
            $this->tester->seeInDatabase('plan', ['name' => $name]);
            $this->tester->dontSeeRecord(Plan::class, ['name' => 'Plano Teste']);
            $this->tester->grabColumnFromDatabase('plan', 'id', array('name' => $name));
            $this->tester->updateInDatabase('plan', array('name' => 'Plano Teste'), array('name' => 'Plano Teste'));
        }
    }
}

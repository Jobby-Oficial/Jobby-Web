<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use common\models\Avaliation;

class AvaliationTest extends \Codeception\Test\Unit
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

    public function testAvaliationValidation()
    {
        $this->avaliation = new Avaliation();

        $this->avaliation->service_id = null;
        $this->assertFalse($this->avaliation->validate(['service_id']));

        $this->avaliation->service_id = 5;
        $this->assertFalse($this->avaliation->validate(['service_id']));

        $this->avaliation->user_id = null;
        $this->assertFalse($this->avaliation->validate(['user_id']));

        $this->avaliation->user_id = 1;
        $this->assertTrue($this->avaliation->validate(['user_id']));

        $this->avaliation->created_at = null;
        $this->assertTrue($this->avaliation->validate(['created_at']));

        $this->avaliation->created_at = '1673496989';
        $this->assertTrue($this->avaliation->validate(['created_at']));

        $this->avaliation->updated_at = null;
        $this->assertTrue($this->avaliation->validate(['updated_at']));

        $this->avaliation->updated_at = '1673496989';
        $this->assertTrue($this->avaliation->validate(['updated_at']));
    }

    function testIntegrationAvaliationValidation()
    {
        /* ╔════════════════════════════════╗ */
        /* ║     Create Avaliation Test     ║ */
        /* ╚════════════════════════════════╝ */

        $avaliation = new Avaliation();
        $avaliation->id = 1000;
        $avaliation->service_id = 1001;
        $avaliation->user_id = 1002;
        $avaliation->save();
        $this->assertEquals(1001, $avaliation->service_id);
        verify($avaliation->service_id)->equals(1001);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════════╗ */
        /* ║     Assert Create Avaliation Test     ║ */
        /* ╚═══════════════════════════════════════╝ */

        $this->assertNotEmpty($avaliation);
        $this->assertNotEmpty($avaliation->service_id);
        $this->assertNotEmpty($avaliation->user_id);

        $this->assertEquals('1001', $avaliation->service_id);
        $this->assertEquals('1002', $avaliation->user_id);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════════╗ */
        /* ║     Verify Create Avaliation Test     ║ */
        /* ╚═══════════════════════════════════════╝ */

        verify($avaliation)->notEmpty();
        verify($avaliation->service_id)->notEmpty();
        verify($avaliation->user_id)->notEmpty();

        verify($avaliation->service_id)->equals('1001');
        verify($avaliation->user_id)->equals('1002');

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════╗ */
        /* ║     Update Avaliation Test     ║ */
        /* ╚════════════════════════════════╝ */

        $avaliation->service_id = 2001;
        $avaliation->user_id = 2002;
        $avaliation->save();
        $this->assertEquals(2001, $avaliation->service_id);
        verify($avaliation->service_id)->equals(2001);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════════╗ */
        /* ║     Assert Update Avaliation Test     ║ */
        /* ╚═══════════════════════════════════════╝ */

        $this->assertNotEmpty($avaliation);
        $this->assertNotEmpty($avaliation->service_id);
        $this->assertNotEmpty($avaliation->user_id);

        $this->assertEquals('2001', $avaliation->service_id);
        $this->assertEquals('2002', $avaliation->user_id);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════════╗ */
        /* ║     Verify Update Avaliation Test     ║ */
        /* ╚═══════════════════════════════════════╝ */

        verify($avaliation)->notEmpty();
        verify($avaliation->service_id)->notEmpty();
        verify($avaliation->user_id)->notEmpty();

        verify($avaliation->service_id)->equals('2001');
        verify($avaliation->user_id)->equals('2002');

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════╗ */
        /* ║     Delete Avaliation Test     ║ */
        /* ╚════════════════════════════════╝ */

        $avaliation->delete();

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════════════════════════╗ */
        /* ║     Assert and Verify Delete Avaliation Test     ║ */
        /* ╚══════════════════════════════════════════════════╝ */

        $findAvaliation = Avaliation::find()->where(['id' => $avaliation->id])->count();
        $this->assertEquals(0, $findAvaliation);
        verify($findAvaliation)->equals(0);

        /* ***** End of Section ***** */
    }

    function testDbAvaliation()
    {
        $modelAvaliation = Avaliation::find()->all();
        $modelAvaliationCount = Avaliation::find()->count();
        $radom = rand(0,$modelAvaliationCount - 1);
        $service_id = $modelAvaliation[$radom]->service_id;

        if (isset($modelAvaliation)) {
            $this->tester->seeInDatabase('avaliation', ['service_id' => $service_id]);
            $this->tester->dontSeeRecord(Avaliation::class, ['service_id' => 1000]);
            $this->tester->grabColumnFromDatabase('avaliation', 'id', array('service_id' => $service_id));
            $this->tester->updateInDatabase('avaliation', array('service_id' => $service_id), array('service_id' => $service_id));
        }
    }
}

<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use common\models\Report;

class ReportTest extends \Codeception\Test\Unit
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

    public function testReportValidation()
    {
        $this->report = new Report();

        $this->report->name = null;
        $this->assertFalse($this->report->validate(['name']));

        $this->report->name = 'Teste';
        $this->assertTrue($this->report->validate(['name']));

        $this->report->description = null;
        $this->assertFalse($this->report->validate(['description']));

        $this->report->description = 'Descrição Teste';
        $this->assertTrue($this->report->validate(['description']));

        $this->report->user_id = null;
        $this->assertFalse($this->report->validate(['user_id']));

        $this->report->user_id = 1;
        $this->assertTrue($this->report->validate(['user_id']));

        $this->report->created_at = null;
        $this->assertTrue($this->report->validate(['created_at']));

        $this->report->created_at = '1673496989';
        $this->assertTrue($this->report->validate(['created_at']));

        $this->report->updated_at = null;
        $this->assertTrue($this->report->validate(['updated_at']));

        $this->report->updated_at = '1673496989';
        $this->assertTrue($this->report->validate(['updated_at']));
    }

    function testIntegrationReportValidation()
    {
        /* ╔════════════════════════════╗ */
        /* ║     Create Report Test     ║ */
        /* ╚════════════════════════════╝ */

        $report = new Report();
        //$report->id = 1000;
        $report->name = 'Teste1000';
        $report->description = 'Descrição Teste1000';
        $report->user_id = 1000;
        $report->save();
        $this->assertEquals(1000, $report->user_id);
        verify($report->user_id)->equals(1000);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════╗ */
        /* ║     Assert Create Report Test     ║ */
        /* ╚═══════════════════════════════════╝ */

        $this->assertNotEmpty($report);
        $this->assertNotEmpty($report->name);
        $this->assertNotEmpty($report->description);
        $this->assertNotEmpty($report->user_id);

        $this->assertEquals('Teste1000', $report->name);
        $this->assertEquals('Descrição Teste1000', $report->description);
        $this->assertEquals('1000', $report->user_id);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════╗ */
        /* ║     Verify Create Report Test     ║ */
        /* ╚═══════════════════════════════════╝ */

        verify($report)->notEmpty();
        verify($report->name)->notEmpty();
        verify($report->description)->notEmpty();
        verify($report->user_id)->notEmpty();

        verify($report->name)->equals('Teste1000');
        verify($report->description)->equals('Descrição Teste1000');
        verify($report->user_id)->equals('1000');

        /* ***** End of Section ***** */

        /* ╔════════════════════════════╗ */
        /* ║     Update Report Test     ║ */
        /* ╚════════════════════════════╝ */

        $report->name = 'Teste2000';
        $report->description = 'Descrição Teste2000';
        $report->user_id = 2000;
        $report->save();
        $this->assertEquals(2000, $report->user_id);
        verify($report->user_id)->equals(2000);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════╗ */
        /* ║     Assert Update Report Test     ║ */
        /* ╚═══════════════════════════════════╝ */

        $this->assertNotEmpty($report);
        $this->assertNotEmpty($report->name);
        $this->assertNotEmpty($report->description);
        $this->assertNotEmpty($report->user_id);

        $this->assertEquals('Teste2000', $report->name);
        $this->assertEquals('Descrição Teste2000', $report->description);
        $this->assertEquals('2000', $report->user_id);

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════╗ */
        /* ║     Verify Update Report Test     ║ */
        /* ╚═══════════════════════════════════╝ */

        verify($report)->notEmpty();
        verify($report->name)->notEmpty();
        verify($report->description)->notEmpty();
        verify($report->user_id)->notEmpty();

        verify($report->name)->equals('Teste2000');
        verify($report->description)->equals('Descrição Teste2000');
        verify($report->user_id)->equals('2000');

        /* ***** End of Section ***** */

        /* ╔════════════════════════════╗ */
        /* ║     Delete Report Test     ║ */
        /* ╚════════════════════════════╝ */

        $report->delete();

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════════════════════╗ */
        /* ║     Assert and Verify Delete Report Test     ║ */
        /* ╚══════════════════════════════════════════════╝ */

        $findReport = Report::find()->where(['id' => $report->id])->count();
        $this->assertEquals(0, $findReport);
        verify($findReport)->equals(0);

        /* ***** End of Section ***** */
    }

    function testDbReport()
    {
        $modelReport = Report::find()->all();
        $modelReportCount = Report::find()->count();

        if ($modelReportCount > 0) {
            $radom = rand(0,$modelReportCount - 1);
            $user_id = $modelReport[$radom]->user_id;

            if (isset($modelReport)) {
                $this->tester->seeInDatabase('report', ['user_id' => $user_id]);
                $this->tester->dontSeeRecord(Report::class, ['user_id' => 1000]);
                $this->tester->grabColumnFromDatabase('report', 'id', array('user_id' => $user_id));
                $this->tester->updateInDatabase('report', array('user_id' => 1000), array('user_id' => 1000));
            }
        }
    }
}

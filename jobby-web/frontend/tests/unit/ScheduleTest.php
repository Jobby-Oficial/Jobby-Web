<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use common\models\Schedule;

class ScheduleTest extends \Codeception\Test\Unit
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

    public function testScheduleValidation()
    {
        $this->schedule = new Schedule();

        $this->schedule->service_date = null;
        $this->assertFalse($this->schedule->validate(['service_date']));

        $this->schedule->service_date = '2008-10-03';
        $this->assertTrue($this->schedule->validate(['service_date']));

        $this->schedule->service_time = null;
        $this->assertFalse($this->schedule->validate(['service_time']));

        $this->schedule->service_time = '22:59:52';
        $this->assertTrue($this->schedule->validate(['service_time']));

        $this->schedule->note = null;
        $this->assertFalse($this->schedule->validate(['note']));

        $this->schedule->note = 'Nota Teste';
        $this->assertTrue($this->schedule->validate(['note']));

        $this->schedule->payment = null;
        $this->assertTrue($this->schedule->validate(['payment']));

        $this->schedule->payment = 0;
        $this->assertTrue($this->schedule->validate(['payment']));

        $this->schedule->payment = 1;
        $this->assertTrue($this->schedule->validate(['payment']));

        $this->schedule->schedule_status = null;
        $this->assertTrue($this->schedule->validate(['schedule_status']));

        $this->schedule->schedule_status = 0;
        $this->assertTrue($this->schedule->validate(['schedule_status']));

        $this->schedule->schedule_status = 1;
        $this->assertTrue($this->schedule->validate(['schedule_status']));

        $this->schedule->schedule_status_note = null;
        $this->assertTrue($this->schedule->validate(['schedule_status_note']));

        $this->schedule->schedule_status_note = 'Nota Cancelar Teste';
        $this->assertTrue($this->schedule->validate(['schedule_status_note']));

        $this->schedule->price = null;
        $this->assertFalse($this->schedule->validate(['price']));

        $this->schedule->price = 10.00;
        $this->assertTrue($this->schedule->validate(['price']));

        $this->schedule->job_status_id = null;
        $this->assertTrue($this->schedule->validate(['job_status_id']));

        $this->schedule->job_status_id = 1;
        $this->assertTrue($this->schedule->validate(['job_status_id']));

        $this->schedule->service_id = null;
        $this->assertFalse($this->schedule->validate(['service_id']));

        $this->schedule->service_id = 1;
        $this->assertTrue($this->schedule->validate(['service_id']));

        $this->schedule->professional_id = null;
        $this->assertFalse($this->schedule->validate(['professional_id']));

        $this->schedule->professional_id = 1;
        $this->assertTrue($this->schedule->validate(['professional_id']));

        $this->schedule->client_id = null;
        $this->assertFalse($this->schedule->validate(['client_id']));

        $this->schedule->client_id = 1;
        $this->assertTrue($this->schedule->validate(['client_id']));

        $this->schedule->created_at = null;
        $this->assertTrue($this->schedule->validate(['created_at']));

        $this->schedule->created_at = '1673496989';
        $this->assertTrue($this->schedule->validate(['created_at']));

        $this->schedule->updated_at = null;
        $this->assertTrue($this->schedule->validate(['updated_at']));

        $this->schedule->updated_at = '1673496989';
        $this->assertTrue($this->schedule->validate(['updated_at']));
    }

    function testIntegrationScheduleValidation()
    {
        /* ╔══════════════════════════════╗ */
        /* ║     Create Schedule Test     ║ */
        /* ╚══════════════════════════════╝ */

        $schedule = new Schedule();
        $schedule->service_date = '2023-02-06';
        $schedule->service_time = '17:27:11';
        $schedule->note = 'Nota Teste1000';
        $schedule->payment = 0;
        $schedule->schedule_status = 0;
        $schedule->schedule_status_note = 'Nota Cancelar Teste1000';
        $schedule->price = 1000.00;
        $schedule->job_status_id = 1000;
        $schedule->service_id = 1000;
        $schedule->professional_id = 1000;
        $schedule->client_id = 1000;
        $schedule->save();
        $this->assertEquals('Nota Teste1000', $schedule->note);
        verify($schedule->note)->equals('Nota Teste1000');

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Assert Create Schedule Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        $this->assertNotEmpty($schedule);
        $this->assertNotEmpty($schedule->service_date);
        $this->assertNotEmpty($schedule->service_time);
        $this->assertNotEmpty($schedule->note);
        $this->assertNotEmpty($schedule->schedule_status_note);
        $this->assertNotEmpty($schedule->price);
        $this->assertNotEmpty($schedule->job_status_id);
        $this->assertNotEmpty($schedule->service_id);
        $this->assertNotEmpty($schedule->professional_id);
        $this->assertNotEmpty($schedule->client_id);

        $this->assertEquals('2023-02-06', $schedule->service_date);
        $this->assertEquals('17:27:11', $schedule->service_time);
        $this->assertEquals('Nota Teste1000', $schedule->note);
        $this->assertEquals(0, $schedule->payment);
        $this->assertEquals(0, $schedule->schedule_status);
        $this->assertEquals('Nota Cancelar Teste1000', $schedule->schedule_status_note);
        $this->assertEquals(1000.00, $schedule->price);
        $this->assertEquals(1000, $schedule->job_status_id);
        $this->assertEquals(1000, $schedule->service_id);
        $this->assertEquals(1000, $schedule->professional_id);
        $this->assertEquals(1000, $schedule->client_id);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Create Schedule Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        verify($schedule)->notEmpty();
        verify($schedule->service_date)->notEmpty();
        verify($schedule->service_time)->notEmpty();
        verify($schedule->note)->notEmpty();
        verify($schedule->schedule_status_note)->notEmpty();
        verify($schedule->price)->notEmpty();
        verify($schedule->job_status_id)->notEmpty();
        verify($schedule->service_id)->notEmpty();
        verify($schedule->professional_id)->notEmpty();
        verify($schedule->client_id)->notEmpty();

        verify($schedule->service_date)->equals('2023-02-06');
        verify($schedule->service_time)->equals('17:27:11');
        verify($schedule->note)->equals('Nota Teste1000');
        verify($schedule->payment)->equals(0);
        verify($schedule->schedule_status)->equals(0);
        verify($schedule->schedule_status_note)->equals('Nota Cancelar Teste1000');
        verify($schedule->price)->equals(1000.00);
        verify($schedule->job_status_id)->equals(1000);
        verify($schedule->service_id)->equals(1000);
        verify($schedule->professional_id)->equals(1000);
        verify($schedule->client_id)->equals(1000);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════╗ */
        /* ║     Update Schedule Test     ║ */
        /* ╚══════════════════════════════╝ */

        $schedule->service_date = '2023-02-07';
        $schedule->service_time = '20:07:06';
        $schedule->note = 'Nota Teste2000';
        $schedule->payment = 1;
        $schedule->schedule_status = 1;
        $schedule->schedule_status_note = 'Nota Cancelar Teste2000';
        $schedule->price = 2000.00;
        $schedule->job_status_id = 2000;
        $schedule->service_id = 2000;
        $schedule->professional_id = 2000;
        $schedule->client_id = 2000;
        $schedule->save();
        $this->assertEquals('Nota Teste2000', $schedule->note);
        verify($schedule->note)->equals('Nota Teste2000');

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Assert Update Schedule Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        $this->assertNotEmpty($schedule);
        $this->assertNotEmpty($schedule->service_date);
        $this->assertNotEmpty($schedule->service_time);
        $this->assertNotEmpty($schedule->note);
        $this->assertNotEmpty($schedule->payment);
        $this->assertNotEmpty($schedule->schedule_status);
        $this->assertNotEmpty($schedule->schedule_status_note);
        $this->assertNotEmpty($schedule->price);
        $this->assertNotEmpty($schedule->job_status_id);
        $this->assertNotEmpty($schedule->service_id);
        $this->assertNotEmpty($schedule->professional_id);
        $this->assertNotEmpty($schedule->client_id);

        $this->assertEquals('2023-02-07', $schedule->service_date);
        $this->assertEquals('20:07:06', $schedule->service_time);
        $this->assertEquals('Nota Teste2000', $schedule->note);
        $this->assertEquals(1, $schedule->payment);
        $this->assertEquals(1, $schedule->schedule_status);
        $this->assertEquals('Nota Cancelar Teste2000', $schedule->schedule_status_note);
        $this->assertEquals(2000.00, $schedule->price);
        $this->assertEquals(2000, $schedule->job_status_id);
        $this->assertEquals(2000, $schedule->service_id);
        $this->assertEquals(2000, $schedule->professional_id);
        $this->assertEquals(2000, $schedule->client_id);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Update Schedule Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        verify($schedule)->notEmpty();
        verify($schedule->service_date)->notEmpty();
        verify($schedule->service_time)->notEmpty();
        verify($schedule->note)->notEmpty();
        verify($schedule->payment)->notEmpty();
        verify($schedule->schedule_status)->notEmpty();
        verify($schedule->schedule_status_note)->notEmpty();
        verify($schedule->price)->notEmpty();
        verify($schedule->job_status_id)->notEmpty();
        verify($schedule->service_id)->notEmpty();
        verify($schedule->professional_id)->notEmpty();
        verify($schedule->client_id)->notEmpty();

        verify($schedule->service_date)->equals('2023-02-07');
        verify($schedule->service_time)->equals('20:07:06');
        verify($schedule->note)->equals('Nota Teste2000');
        verify($schedule->payment)->equals(1);
        verify($schedule->schedule_status)->equals(1);
        verify($schedule->schedule_status_note)->equals('Nota Cancelar Teste2000');
        verify($schedule->price)->equals(2000.00);
        verify($schedule->job_status_id)->equals(2000);
        verify($schedule->service_id)->equals(2000);
        verify($schedule->professional_id)->equals(2000);
        verify($schedule->client_id)->equals(2000);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════╗ */
        /* ║     Delete Schedule Test     ║ */
        /* ╚══════════════════════════════╝ */

        $schedule->delete();

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════════════════════╗ */
        /* ║     Assert and Verify Delete Schedule Test     ║ */
        /* ╚════════════════════════════════════════════════╝ */

        $findSchedule = Schedule::find()->where(['id' => $schedule->id])->count();
        $this->assertEquals(0, $findSchedule);
        verify($findSchedule)->equals(0);

        /* ***** End of Section ***** */
    }

    function testDbSchedule()
    {
        $modelSchedule = Schedule::find()->all();
        $modelScheduleCount = Schedule::find()->count();

        if ($modelScheduleCount > 0) {
            $radom = rand(0,$modelScheduleCount - 1);
            $note = $modelSchedule[$radom]->note;

            if (isset($modelSchedule)) {
                $this->tester->seeInDatabase('schedule', ['note' => $note]);
                $this->tester->dontSeeRecord(Schedule::class, ['note' => 'Nota Teste']);
                $this->tester->grabColumnFromDatabase('schedule', 'id', array('note' => $note));
                $this->tester->updateInDatabase('schedule', array('note' => 'Nota Teste'), array('note' => 'Nota Teste'));
            }
        }
    }
}

<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use common\models\JobStatus;

class JobStatusTest extends \Codeception\Test\Unit
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

    public function testJobStatusValidation()
    {
        $this->jobSatus = new JobStatus();

        $this->jobSatus->name = null;
        $this->assertFalse($this->jobSatus->validate(['name']));

        $this->jobSatus->name = 'Teste';
        $this->assertTrue($this->jobSatus->validate(['name']));

        $this->jobSatus->name = 'Concluído';
        $this->assertTrue($this->jobSatus->validate(['name']));

        $this->jobSatus->created_at = null;
        $this->assertTrue($this->jobSatus->validate(['created_at']));

        $this->jobSatus->created_at = '1673496989';
        $this->assertTrue($this->jobSatus->validate(['created_at']));

        $this->jobSatus->updated_at = null;
        $this->assertTrue($this->jobSatus->validate(['updated_at']));

        $this->jobSatus->updated_at = '1673496989';
        $this->assertTrue($this->jobSatus->validate(['updated_at']));
    }

    function testIntegrationJobStatusValidation()
    {
        /* ╔═══════════════════════════════╗ */
        /* ║     Create JobStatus Test     ║ */
        /* ╚═══════════════════════════════╝ */

        $jobsSatus = new JobStatus();
        //$report->id = 1000;
        $jobsSatus->name = 'Teste1000';
        $jobsSatus->save();
        $this->assertEquals('Teste1000', $jobsSatus->name);
        verify($jobsSatus->name)->equals('Teste1000');

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════════════╗ */
        /* ║     Assert Create JobStatus Test     ║ */
        /* ╚══════════════════════════════════════╝ */

        $this->assertNotEmpty($jobsSatus);
        $this->assertNotEmpty($jobsSatus->name);

        $this->assertEquals('Teste1000', $jobsSatus->name);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════════════╗ */
        /* ║     Verify Create JobStatus Test     ║ */
        /* ╚══════════════════════════════════════╝ */

        verify($jobsSatus)->notEmpty();
        verify($jobsSatus->name)->notEmpty();

        verify($jobsSatus->name)->equals('Teste1000');

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════╗ */
        /* ║     Update JobStatus Test     ║ */
        /* ╚═══════════════════════════════╝ */

        $jobsSatus->name = 'Teste2000';
        $jobsSatus->save();
        $this->assertEquals('Teste2000', $jobsSatus->name);
        verify($jobsSatus->name)->equals('Teste2000');

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════════════╗ */
        /* ║     Assert Update JobStatus Test     ║ */
        /* ╚══════════════════════════════════════╝ */

        $this->assertNotEmpty($jobsSatus);
        $this->assertNotEmpty($jobsSatus->name);

        $this->assertEquals('Teste2000', $jobsSatus->name);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════════════╗ */
        /* ║     Verify Update JobStatus Test     ║ */
        /* ╚══════════════════════════════════════╝ */

        verify($jobsSatus)->notEmpty();
        verify($jobsSatus->name)->notEmpty();

        verify($jobsSatus->name)->equals('Teste2000');

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════╗ */
        /* ║     Delete JobStatus Test     ║ */
        /* ╚═══════════════════════════════╝ */

        $jobsSatus = JobStatus::findOne($jobsSatus->id);
        $jobsSatus->delete();

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════════════════╗ */
        /* ║     Assert and Verify Delete JobStatus Test     ║ */
        /* ╚═════════════════════════════════════════════════╝ */

        $findJobsSatus = JobStatus::find()->where(['id' => $jobsSatus->id])->count();
        $this->assertEquals(0, $findJobsSatus);
        verify($findJobsSatus)->equals(0);

        /* ***** End of Section ***** */
    }

    function testDbJobStatus()
    {
        $this->tester->seeInDatabase('job_status', ['id' => 4]);
        $this->tester->dontSeeRecord(JobStatus::class, ['name' => 'Teste']);
        $this->tester->grabColumnFromDatabase('job_status', 'id', array('name' => 'Concluído'));
        $this->tester->updateInDatabase('job_status', array('name' => 'Teste'), array('name' => 'Teste'));
    }
}

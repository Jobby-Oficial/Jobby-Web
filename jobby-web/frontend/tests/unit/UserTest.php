<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;
use common\models\User;

class UserTest extends \Codeception\Test\Unit
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

    protected function _after()
    {
    }

    public function testUserValidation()
    {
        $this->user = new User();

        $this->specify("image is required", function() {
            $this->user->image = null;
            $this->assertTrue($this->user->validate(['image']));
        });

        $this->specify("image is ok", function() {
            $this->user->image = 'teste.jpg';
            $this->assertTrue($this->user->validate(['image']));
        });

        $this->specify("username is required", function() {
            $this->user->username = null;
            $this->assertFalse($this->user->validate(['username']));
        });

        $this->specify("username is unique", function() {
            $this->user->username = 'guilherme';
            $this->assertFalse($this->user->validate(['username']));
        });

        $this->specify("username is ok", function() {
            $this->user->username = 'teste1000';
            $this->assertTrue($this->user->validate(['username']));
        });

        $this->specify("email is required", function() {
            $this->user->email = null;
            $this->assertFalse($this->user->validate(['email']));
        });

        $this->specify("email is unique", function() {
            $this->user->email = 'guilherme@gmail.com';
            $this->assertFalse($this->user->validate(['email']));
        });

        $this->specify("email is ok", function() {
            $this->user->email = 'teste1000@teste.pt';
            $this->assertTrue($this->user->validate(['email']));
        });

        $this->specify("name is required", function() {
            $this->user->name = null;
            $this->assertFalse($this->user->validate(['name']));
        });

        $this->specify("name is ok", function() {
            $this->user->name = 'Guilherme Cruz';
            $this->assertTrue($this->user->validate(['name']));
        });

        $this->specify("phone is required", function() {
            $this->user->phone = null;
            $this->assertFalse($this->user->validate(['phone']));
        });

        $this->specify("phone is unique", function() {
            $this->user->phone = '927632646';
            $this->assertFalse($this->user->validate(['phone']));
        });

        $this->specify("phone is ok", function() {
            $this->user->phone = '927321123';
            $this->assertTrue($this->user->validate(['phone']));
        });

        $this->specify("genre is required", function() {
            $this->user->genre = null;
            $this->assertFalse($this->user->validate(['genre']));
        });

        $this->specify("genre is ok", function() {
            $this->user->genre = 'm';
            $this->assertTrue($this->user->validate(['genre']));
        });

        $this->specify("birth is required", function() {
            $this->user->birth = null;
            $this->assertFalse($this->user->validate(['birth']));
        });

        $this->specify("birth is ok", function() {
            $this->user->birth = '2008-10-03';
            $this->assertTrue($this->user->validate(['birth']));
        });

        $this->specify("country is required", function() {
            $this->user->country = null;
            $this->assertFalse($this->user->validate(['country']));
        });

        $this->specify("country is ok", function() {
            $this->user->country = 'Portugal';
            $this->assertTrue($this->user->validate(['country']));
        });

        $this->specify("city is required", function() {
            $this->user->city = null;
            $this->assertFalse($this->user->validate(['city']));
        });

        $this->specify("city is ok", function() {
            $this->user->city = 'Torres Vedras';
            $this->assertTrue($this->user->validate(['city']));
        });

        $this->specify("morada is required", function() {
            $this->user->morada = null;
            $this->assertFalse($this->user->validate(['morada']));
        });

        $this->specify("morada is ok", function() {
            $this->user->morada = 'teste1000';
            $this->assertTrue($this->user->validate(['morada']));
        });

        $this->specify("biography is required", function() {
            $this->user->biography = null;
            $this->assertFalse($this->user->validate(['biography']));
        });

        $this->specify("biography is ok", function() {
            $this->user->biography = 'teste1000';
            $this->assertTrue($this->user->validate(['biography']));
        });

        $this->specify("status is required", function() {
            $this->user->status = null;
            $this->assertFalse($this->user->validate(['status']));
        });

        $this->specify("status is ok", function() {
            $this->user->status = 10;
            $this->assertTrue($this->user->validate(['status']));
        });

        $this->specify("password is required", function() {
            $this->user->password = null;
            $this->assertFalse($this->user->validate(['password']));
        });

        $this->specify("password is ok", function() {
            $this->user->password = "teste1234";
            $this->user->password_repeat = "teste";
            $this->assertNotEquals($this->user->password, $this->user->password_repeat);
        });

        $this->specify("password is ok", function() {
            $this->user->password = 'teste1234';
            $this->assertTrue($this->user->validate(['password']));
        });

        $this->specify("plan_start_date is required", function() {
            $this->user->plan_start_date = null;
            $this->assertFalse($this->user->validate(['plan_start_date']));
        });

        $this->specify("plan_start_date is ok", function() {
            $this->user->plan_start_date = "2008-10-03";
            $this->assertTrue($this->user->validate(['plan_start_date']));
        });

        $this->specify("plan_end_date is required", function() {
            $this->user->plan_end_date = null;
            $this->assertTrue($this->user->validate(['plan_end_date']));
        });

        $this->specify("plan_end_date is ok", function() {
            $this->user->plan_end_date = "2008-10-03 22:59:52";
            $this->assertTrue($this->user->validate(['plan_end_date']));
        });

        $this->specify("highlight_date_end is required", function() {
            $this->user->highlight_date_end = null;
            $this->assertTrue($this->user->validate(['highlight_date_end']));
        });

        $this->specify("highlight_date_end is ok", function() {
            $this->user->highlight_date_end = "2008-10-03 22:59:52";
            $this->assertTrue($this->user->validate(['highlight_date_end']));
        });

        $this->specify("plan_id is required", function() {
            $this->user->plan_id = null;
            $this->assertFalse($this->user->validate(['plan_id']));
        });

        $this->specify("plan_id is ok", function() {
            $this->user->plan_id = 1;
            $this->assertTrue($this->user->validate(['plan_id']));
        });

        $this->specify("typeUser is required", function() {
            $this->user->typeUser = null;
            $this->assertFalse($this->user->validate(['typeUser']));
        });

        $this->specify("typeUser is ok", function() {
            $this->user->typeUser = 1;
            $this->assertTrue($this->user->validate(['typeUser']));
        });

        $this->specify("created_at is required", function() {
            $this->user->created_at = null;
            $this->assertTrue($this->user->validate(['created_at']));
        });

        $this->specify("created_at is ok", function() {
            $this->user->created_at = '1673496989';
            $this->assertTrue($this->user->validate(['created_at']));
        });

        $this->specify("updated_at is required", function() {
            $this->user->updated_at = null;
            $this->assertTrue($this->user->validate(['updated_at']));
        });

        $this->specify("updated_at is ok", function() {
            $this->user->updated_at = '1673496989';
            $this->assertTrue($this->user->validate(['updated_at']));
        });
    }

    function testSavingUser()
    {
        $user = new User();
        $user->username = 'teste1000';
        $user->email = 'teste1000@teste.pt';
        $user->name = 'Teste User';
        $user->phone = 927123321;
        $user->genre = 'm';
        $user->birth = date('Y-m-d');
        $user->country = 'Portugal';
        $user->city = 'Lisboa';
        $user->morada = 'teste';
        $user->biography = 'teste';
        $user->status = 10;
        $user->generateAuthKey();
        $user->password_hash = "teste1234";
        $user->password = "teste1234";
        $user->password_repeat = "teste1234";
        $user->plan_start_date = date('Y-m-d');
        $user->plan_id = 1;
        $user->typeUser = 1;
        $user->save();
        $this->assertEquals('teste1000', $user->username);
        verify($user->username)->equals('teste1000');
    }

    function testDbUser()
    {
        $this->tester->seeInDatabase('user', ['username' => 'teste']);
        $this->tester->dontSeeRecord(User::class, ['name' => 'miles']);
        $this->tester->grabColumnFromDatabase('user', 'email', array('username' => 'teste'));
        $this->tester->updateInDatabase('user', array('email' => 'teste1000@teste.pt'), array('email' => 'teste1000@teste.pt'));
    }
}

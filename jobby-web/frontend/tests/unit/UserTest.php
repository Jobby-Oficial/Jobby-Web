<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;
//use \Tests\Support\UnitTester;
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

        $this->user->image = null;
        $this->assertTrue($this->user->validate(['image']));

        $this->user->image = 'teste.jpg';
        $this->assertTrue($this->user->validate(['image']));

        $this->user->username = null;
        $this->assertFalse($this->user->validate(['username']));

        $this->user->username = 'guilherme';
        $this->assertFalse($this->user->validate(['username']));

        $this->user->username = 'teste1000';
        $this->assertTrue($this->user->validate(['username']));

        $this->user->email = null;
        $this->assertFalse($this->user->validate(['email']));

        $this->user->email = 'guilherme@gmail.com';
        $this->assertFalse($this->user->validate(['email']));

        $this->user->email = 'teste1000@teste.pt';
        $this->assertTrue($this->user->validate(['email']));

        $this->user->name = null;
        $this->assertFalse($this->user->validate(['name']));

        $this->user->name = 'Guilherme Cruz';
        $this->assertTrue($this->user->validate(['name']));

        $this->user->phone = null;
        $this->assertFalse($this->user->validate(['phone']));

        $this->user->phone = '927632646';
        $this->assertFalse($this->user->validate(['phone']));

        $this->user->phone = '927321123';
        $this->assertTrue($this->user->validate(['phone']));

        $this->user->genre = null;
        $this->assertFalse($this->user->validate(['genre']));

        $this->user->genre = 'm';
        $this->assertTrue($this->user->validate(['genre']));

        $this->user->birth = null;
        $this->assertFalse($this->user->validate(['birth']));

        $this->user->birth = '2008-10-03';
        $this->assertTrue($this->user->validate(['birth']));

        $this->user->country = null;
        $this->assertFalse($this->user->validate(['country']));

        $this->user->country = 'Portugal';
        $this->assertTrue($this->user->validate(['country']));

        $this->user->city = null;
        $this->assertFalse($this->user->validate(['city']));

        $this->user->city = 'Torres Vedras';
        $this->assertTrue($this->user->validate(['city']));

        $this->user->morada = null;
        $this->assertFalse($this->user->validate(['morada']));

        $this->user->morada = 'teste1000';
        $this->assertTrue($this->user->validate(['morada']));

        $this->user->biography = null;
        $this->assertFalse($this->user->validate(['biography']));

        $this->user->biography = 'teste1000';
        $this->assertTrue($this->user->validate(['biography']));

        $this->user->status = null;
        $this->assertFalse($this->user->validate(['status']));

        $this->user->status = 10;
        $this->assertTrue($this->user->validate(['status']));

        $this->user->password = null;
        $this->assertFalse($this->user->validate(['password']));

        $this->user->password = "teste1234";
        $this->user->password_repeat = "teste";
        $this->assertNotEquals($this->user->password, $this->user->password_repeat);

        $this->user->password = 'teste1234';
        $this->assertTrue($this->user->validate(['password']));

        $this->user->plan_start_date = null;
        $this->assertFalse($this->user->validate(['plan_start_date']));

        $this->user->plan_start_date = "2008-10-03";
        $this->assertTrue($this->user->validate(['plan_start_date']));

        $this->user->plan_end_date = null;
        $this->assertTrue($this->user->validate(['plan_end_date']));

        $this->user->plan_end_date = "2008-10-03 22:59:52";
        $this->assertTrue($this->user->validate(['plan_end_date']));

        $this->user->highlight_date_end = null;
        $this->assertTrue($this->user->validate(['highlight_date_end']));

        $this->user->highlight_date_end = "2008-10-03 22:59:52";
        $this->assertTrue($this->user->validate(['highlight_date_end']));

        $this->user->plan_id = null;
        $this->assertFalse($this->user->validate(['plan_id']));

        $this->user->plan_id = 1;
        $this->assertTrue($this->user->validate(['plan_id']));

        $this->user->typeUser = null;
        $this->assertFalse($this->user->validate(['typeUser']));

        $this->user->typeUser = 1;
        $this->assertTrue($this->user->validate(['typeUser']));

        $this->user->created_at = null;
        $this->assertTrue($this->user->validate(['created_at']));

        $this->user->created_at = '1673496989';
        $this->assertTrue($this->user->validate(['created_at']));

        $this->user->updated_at = null;
        $this->assertTrue($this->user->validate(['updated_at']));

        $this->user->updated_at = '1673496989';
        $this->assertTrue($this->user->validate(['updated_at']));
    }

    function testIntegrationUserValidation()
    {
        /* ╔══════════════════════════╗ */
        /* ║     Create User Test     ║ */
        /* ╚══════════════════════════╝ */

        $user = new User();
        $user->username = 'teste1000';
        $user->email = 'teste1000@teste.pt';
        $user->name = 'Teste1000';
        $user->phone = 911111111;
        $user->genre = 'm';
        $user->birth = '2000-01-28';
        $user->country = 'Portugal';
        $user->city = 'Lisboa';
        $user->morada = 'Morada Teste1000';
        $user->biography = 'Biografia Teste1000';
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

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Verify Create User Test     ║ */
        /* ╚═════════════════════════════════╝ */

        $this->assertNotEmpty($user);
        $this->assertNotEmpty($user->username);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->phone);
        $this->assertNotEmpty($user->genre);
        $this->assertNotEmpty($user->birth);
        $this->assertNotEmpty($user->country);
        $this->assertNotEmpty($user->city);
        $this->assertNotEmpty($user->morada);
        $this->assertNotEmpty($user->biography);
        $this->assertNotEmpty($user->status);
        $this->assertNotEmpty($user->auth_key);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEmpty($user->password);
        $this->assertNotEmpty($user->password_repeat);
        $this->assertNotEmpty($user->plan_start_date);
        $this->assertNotEmpty($user->plan_id);
        $this->assertNotEmpty($user->typeUser);

        $this->assertEquals('teste1000', $user->username);
        $this->assertEquals('teste1000@teste.pt', $user->email);
        $this->assertEquals('Teste1000', $user->name);
        $this->assertEquals('911111111', $user->phone);
        $this->assertEquals('m', $user->genre);
        $this->assertEquals('2000-01-28', $user->birth);
        $this->assertEquals('Portugal', $user->country);
        $this->assertEquals('Lisboa', $user->city);
        $this->assertEquals('Morada Teste1000', $user->morada);
        $this->assertEquals('Biografia Teste1000', $user->biography);
        $this->assertEquals('10', $user->status);
        $this->assertEquals('teste1234', $user->password_hash);
        $this->assertEquals('teste1234', $user->password);
        $this->assertEquals('teste1234', $user->password_repeat);
        $this->assertEquals(date('Y-m-d'), $user->plan_start_date);
        $this->assertEquals('1', $user->plan_id);
        $this->assertEquals('1', $user->typeUser);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════╗ */
        /* ║     Update User Test     ║ */
        /* ╚══════════════════════════╝ */

        $user->username = 'teste2000';
        $user->email = 'teste2000@teste.pt';
        $user->name = 'Teste2000';
        $user->phone = 922222222;
        $user->genre = 'f';
        $user->birth = '2000-01-27';
        $user->country = 'Italy';
        $user->city = 'Acquaro';
        $user->morada = 'Morada Teste2000';
        $user->biography = 'Biografia Teste2000';
        $user->save();
        $this->assertEquals('teste2000', $user->username);
        verify($user->username)->equals('teste2000');

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Verify Update User Test     ║ */
        /* ╚═════════════════════════════════╝ */

        $this->assertNotEmpty($user);
        $this->assertNotEmpty($user->username);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->phone);
        $this->assertNotEmpty($user->genre);
        $this->assertNotEmpty($user->birth);
        $this->assertNotEmpty($user->country);
        $this->assertNotEmpty($user->city);
        $this->assertNotEmpty($user->morada);
        $this->assertNotEmpty($user->biography);

        $this->assertEquals('teste2000', $user->username);
        $this->assertEquals('teste2000@teste.pt', $user->email);
        $this->assertEquals('Teste2000', $user->name);
        $this->assertEquals('922222222', $user->phone);
        $this->assertEquals('f', $user->genre);
        $this->assertEquals('2000-01-27', $user->birth);
        $this->assertEquals('Italy', $user->country);
        $this->assertEquals('Acquaro', $user->city);
        $this->assertEquals('Morada Teste2000', $user->morada);
        $this->assertEquals('Biografia Teste2000', $user->biography);

        /* ***** End of Section ***** */
    }

    public function testVerifyIntegrationUserValidation()
    {
        /* ╔══════════════════════════╗ */
        /* ║     Create User Test     ║ */
        /* ╚══════════════════════════╝ */

        $user = new User();

        $user->attributes = [
            'username' => 'teste3000',
            'email' => 'teste3000@teste.pt',
            'name' => 'Teste3000',
            'phone' => '933333333',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Lourinhã',
            'morada' => 'Morada Teste3000',
            'biography' => 'Biografia Teste3000',
            'status' => 10,
            'auth_key' => $user->generateAuthKey(),
            'password_hash' => 'teste1234',
            'password' => 'teste1234',
            'password_repeat' => 'teste1234',
            'plan_start_date' => date('Y-m-d'),
            'plan_id' => 1,
            'typeUser' => 1,
            'created_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')),
            'updated_at' => \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'))
        ];

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Verify Create User Test     ║ */
        /* ╚═════════════════════════════════╝ */

        verify($user)->notEmpty();
        verify($user->username)->notEmpty();
        verify($user->email)->notEmpty();
        verify($user->name)->notEmpty();
        verify($user->phone)->notEmpty();
        verify($user->genre)->notEmpty();
        verify($user->birth)->notEmpty();
        verify($user->country)->notEmpty();
        verify($user->city)->notEmpty();
        verify($user->morada)->notEmpty();
        verify($user->biography)->notEmpty();

        verify($user->username)->equals('teste3000');
        verify($user->email)->equals('teste3000@teste.pt');
        verify($user->name)->equals('Teste3000');
        verify($user->phone)->equals('933333333');
        verify($user->genre)->equals('m');
        verify($user->birth)->equals('2000-01-28');
        verify($user->country)->equals('Portugal');
        verify($user->city)->equals('Lourinhã');
        verify($user->morada)->equals('Morada Teste3000');
        verify($user->biography)->equals('Biografia Teste3000');

        /* ***** End of Section ***** */

        /* ╔══════════════════════════╗ */
        /* ║     Update User Test     ║ */
        /* ╚══════════════════════════╝ */

        $user->attributes = [
            'username' => 'teste4000',
            'email' => 'teste4000@teste.pt',
            'name' => 'Teste4000',
            'phone' => '944444444',
            'genre' => 'f',
            'birth' => '2000-01-27',
            'country' => 'Germany',
            'city' => 'Berlin',
            'morada' => 'Morada Teste4000',
            'biography' => 'Biografia Teste4000'
        ];

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Verify Update User Test     ║ */
        /* ╚═════════════════════════════════╝ */

        verify($user)->notEmpty();
        verify($user->username)->notEmpty();
        verify($user->email)->notEmpty();
        verify($user->name)->notEmpty();
        verify($user->phone)->notEmpty();
        verify($user->genre)->notEmpty();
        verify($user->birth)->notEmpty();
        verify($user->country)->notEmpty();
        verify($user->city)->notEmpty();
        verify($user->morada)->notEmpty();
        verify($user->biography)->notEmpty();

        verify($user->username)->equals('teste4000');
        verify($user->email)->equals('teste4000@teste.pt');
        verify($user->name)->equals('Teste4000');
        verify($user->phone)->equals('944444444');
        verify($user->genre)->equals('f');
        verify($user->birth)->equals('2000-01-27');
        verify($user->country)->equals('Germany');
        verify($user->city)->equals('Berlin');
        verify($user->morada)->equals('Morada Teste4000');
        verify($user->biography)->equals('Biografia Teste4000');

        /* ***** End of Section ***** */
    }

    function testDbUser()
    {
        $this->tester->seeInDatabase('user', ['username' => 'teste']);
        $this->tester->dontSeeRecord(User::class, ['name' => 'testeteste']);
        $this->tester->grabColumnFromDatabase('user', 'email', array('username' => 'teste'));
        $this->tester->updateInDatabase('user', array('email' => 'teste1000@teste.pt'), array('email' => 'teste1000@teste.pt'));
    }
}

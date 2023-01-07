<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use frontend\models\SignupForm;

class SignupTest extends \Codeception\Test\Unit
{
    use Codeception\Specify;

    //protected UnitTester $tester;

    /** @specify */
    private $signup;

    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    public function testSignupValidation()
    {
        $this->signup = new SignupForm();

        $this->signup->username = null;
        $this->assertFalse($this->signup->validate(['username']));

        $this->signup->username = 'guilherme';
        $this->assertFalse($this->signup->validate(['username']));

        $this->signup->username = 'teste1000';
        $this->assertTrue($this->signup->validate(['username']));

        $this->signup->email = null;
        $this->assertFalse($this->signup->validate(['email']));

        $this->signup->email = 'guilherme@gmail.com';
        $this->assertFalse($this->signup->validate(['email']));

        $this->signup->email = 'teste1000@teste.pt';
        $this->assertTrue($this->signup->validate(['email']));

        $this->signup->name = null;
        $this->assertFalse($this->signup->validate(['name']));

        $this->signup->name = 'Guilherme Cruz';
        $this->assertTrue($this->signup->validate(['name']));

        $this->signup->phone = null;
        $this->assertFalse($this->signup->validate(['phone']));

        $this->signup->phone = '927632646';
        $this->assertFalse($this->signup->validate(['phone']));

        $this->signup->phone = '927321123';
        $this->assertTrue($this->signup->validate(['phone']));

        $this->signup->genre = null;
        $this->assertFalse($this->signup->validate(['genre']));

        $this->signup->genre = 'm';
        $this->assertTrue($this->signup->validate(['genre']));

        $this->signup->birth = null;
        $this->assertFalse($this->signup->validate(['birth']));

        $this->signup->birth = '2000-01-28';
        $this->assertTrue($this->signup->validate(['birth']));

        $this->signup->country = null;
        $this->assertFalse($this->signup->validate(['country']));

        $this->signup->country = 'Portugal';
        $this->assertTrue($this->signup->validate(['country']));

        $this->signup->city = null;
        $this->assertFalse($this->signup->validate(['city']));

        $this->signup->city = 'Torres Vedras';
        $this->assertTrue($this->signup->validate(['city']));

        $this->signup->morada = null;
        $this->assertFalse($this->signup->validate(['morada']));

        $this->signup->morada = 'teste1000';
        $this->assertTrue($this->signup->validate(['morada']));

        $this->signup->typeUser = null;
        $this->assertFalse($this->signup->validate(['typeUser']));

        $this->signup->typeUser = 1;
        $this->assertTrue($this->signup->validate(['typeUser']));

        $this->signup->biography = null;
        $this->assertFalse($this->signup->validate(['biography']));

        $this->signup->biography = 'teste1000';
        $this->assertTrue($this->signup->validate(['biography']));

        $this->signup->password_hash = null;
        $this->assertFalse($this->signup->validate(['password_hash']));

        $this->signup->password_hash = "teste1234";
        $this->signup->password_repeat = "teste";
        $this->assertNotEquals($this->signup->password_hash, $this->signup->password_repeat);

        $this->signup->password_hash = 'teste1234';
        $this->assertTrue($this->signup->validate(['password_hash']));
    }

    function testIntegrationSignupValidation()
    {
        /* ╔════════════════════════════╗ */
        /* ║     Create Signup Test     ║ */
        /* ╚════════════════════════════╝ */

        $signup = new SignupForm();
        $signup->username = 'teste1000';
        $signup->email = 'teste1000@teste.pt';
        //$signup->name = 'Teste1000';
        $signup->phone = 911111111;
        $signup->genre = 'm';
        $signup->birth = '2000-01-28';
        $signup->country = 'Portugal';
        $signup->city = 'Lisboa';
        $signup->morada = 'Morada Teste1000';
        $signup->biography = 'Biografia Teste1000';
        $signup->password_hash = "teste1234";
        $signup->password_repeat = "teste1234";
        $signup->typeUser = 1;
        $signup->signup();
        $this->assertEquals('teste1000', $signup->username);
        verify($signup->username)->equals('teste1000');

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════╗ */
        /* ║     Verify Create Signup Test     ║ */
        /* ╚═══════════════════════════════════╝ */

        $this->assertNotEmpty($signup);
        $this->assertNotEmpty($signup->username);
        $this->assertNotEmpty($signup->email);
        //$this->assertNotEmpty($signup->name);
        $this->assertNotEmpty($signup->phone);
        $this->assertNotEmpty($signup->genre);
        $this->assertNotEmpty($signup->birth);
        $this->assertNotEmpty($signup->country);
        $this->assertNotEmpty($signup->city);
        $this->assertNotEmpty($signup->morada);
        $this->assertNotEmpty($signup->biography);
        $this->assertNotEmpty($signup->password_hash);
        $this->assertNotEmpty($signup->password_repeat);
        $this->assertNotEmpty($signup->typeUser);

        $this->assertEquals('teste1000', $signup->username);
        $this->assertEquals('teste1000@teste.pt', $signup->email);
        //$this->assertEquals('Teste1000', $signup->name);
        $this->assertEquals('911111111', $signup->phone);
        $this->assertEquals('m', $signup->genre);
        $this->assertEquals('2000-01-28', $signup->birth);
        $this->assertEquals('Portugal', $signup->country);
        $this->assertEquals('Lisboa', $signup->city);
        $this->assertEquals('Morada Teste1000', $signup->morada);
        $this->assertEquals('Biografia Teste1000', $signup->biography);
        $this->assertEquals('teste1234', $signup->password_hash);
        $this->assertEquals('teste1234', $signup->password_repeat);
        $this->assertEquals('1', $signup->typeUser);

        /* ***** End of Section ***** */

        /* ╔════════════════════════════╗ */
        /* ║     Update Signup Test     ║ */
        /* ╚════════════════════════════╝ */

        $signup->username = 'teste2000';
        $signup->email = 'teste2000@teste.pt';
        //$signup->name = 'Teste2000';
        $signup->phone = 922222222;
        $signup->genre = 'f';
        $signup->birth = '2000-01-27';
        $signup->country = 'Germany';
        $signup->city = 'Berlin';
        $signup->morada = 'Morada Teste2000';
        $signup->biography = 'Biografia Teste2000';
        $signup->signup();
        $this->assertEquals('teste2000', $signup->username);
        verify($signup->username)->equals('teste2000');

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════╗ */
        /* ║     Verify Update User Test     ║ */
        /* ╚═════════════════════════════════╝ */

        $this->assertNotEmpty($signup);
        $this->assertNotEmpty($signup->username);
        $this->assertNotEmpty($signup->email);
        //$this->assertNotEmpty($signup->name);
        $this->assertNotEmpty($signup->phone);
        $this->assertNotEmpty($signup->genre);
        $this->assertNotEmpty($signup->birth);
        $this->assertNotEmpty($signup->country);
        $this->assertNotEmpty($signup->city);
        $this->assertNotEmpty($signup->morada);
        $this->assertNotEmpty($signup->biography);

        $this->assertEquals('teste2000', $signup->username);
        $this->assertEquals('teste2000@teste.pt', $signup->email);
        //$this->assertEquals('Teste2000', $signup->name);
        $this->assertEquals('922222222', $signup->phone);
        $this->assertEquals('f', $signup->genre);
        $this->assertEquals('2000-01-27', $signup->birth);
        $this->assertEquals('Germany', $signup->country);
        $this->assertEquals('Berlin', $signup->city);
        $this->assertEquals('Morada Teste2000', $signup->morada);
        $this->assertEquals('Biografia Teste2000', $signup->biography);

        /* ***** End of Section ***** */
    }

    function testVerifyIntegrationSignupValidation()
    {
        /* ╔════════════════════════════╗ */
        /* ║     Create Signup Test     ║ */
        /* ╚════════════════════════════╝ */

        $signup = new SignupForm();

        $signup->attributes = [
            'username' => 'teste3000',
            'email' => 'teste3000@teste.pt',
            //'name' => 'Teste3000',
            'phone' => '933333333',
            'genre' => 'm',
            'birth' => '2000-01-28',
            'country' => 'Portugal',
            'city' => 'Lisboa',
            'morada' => 'Morada Teste3000',
            'biography' => 'Biografia Teste3000',
            'password_hash' => 'teste1234',
            'password_repeat' => 'teste1234',
            'typeUser' => 1,
        ];

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════╗ */
        /* ║     Verify Create Signup Test     ║ */
        /* ╚═══════════════════════════════════╝ */

        verify($signup)->notEmpty();
        verify($signup->username)->notEmpty();
        verify($signup->email)->notEmpty();
        //verify($signup->name)->notEmpty();
        verify($signup->phone)->notEmpty();
        verify($signup->genre)->notEmpty();
        verify($signup->birth)->notEmpty();
        verify($signup->country)->notEmpty();
        verify($signup->city)->notEmpty();
        verify($signup->morada)->notEmpty();
        verify($signup->biography)->notEmpty();

        verify($signup->username)->equals('teste3000');
        verify($signup->email)->equals('teste3000@teste.pt');
        //verify($signup->name)->equals('Teste3000');
        verify($signup->phone)->equals('933333333');
        verify($signup->genre)->equals('m');
        verify($signup->birth)->equals('2000-01-28');
        verify($signup->country)->equals('Portugal');
        verify($signup->city)->equals('Lisboa');
        verify($signup->morada)->equals('Morada Teste3000');
        verify($signup->biography)->equals('Biografia Teste3000');

        /* ***** End of Section ***** */

        /* ╔════════════════════════════╗ */
        /* ║     Update Signup Test     ║ */
        /* ╚════════════════════════════╝ */

        $signup->attributes = [
            'username' => 'teste4000',
            'email' => 'teste4000@teste.pt',
            //'name' => 'Teste4000',
            'phone' => '944444444',
            'genre' => 'f',
            'birth' => '2000-01-27',
            'country' => 'Germany',
            'city' => 'Berlin',
            'morada' => 'Morada Teste4000',
            'biography' => 'Biografia Teste4000',
        ];

        /* ***** End of Section ***** */

        /* ╔═══════════════════════════════════╗ */
        /* ║     Verify Update Signup Test     ║ */
        /* ╚═══════════════════════════════════╝ */

        verify($signup)->notEmpty();
        verify($signup->username)->notEmpty();
        verify($signup->email)->notEmpty();
        //verify($signup->name)->notEmpty();
        verify($signup->phone)->notEmpty();
        verify($signup->genre)->notEmpty();
        verify($signup->birth)->notEmpty();
        verify($signup->country)->notEmpty();
        verify($signup->city)->notEmpty();
        verify($signup->morada)->notEmpty();
        verify($signup->biography)->notEmpty();

        verify($signup->username)->equals('teste4000');
        verify($signup->email)->equals('teste4000@teste.pt');
        //verify($signup->name)->equals('Teste4000');
        verify($signup->phone)->equals('944444444');
        verify($signup->genre)->equals('f');
        verify($signup->birth)->equals('2000-01-27');
        verify($signup->country)->equals('Germany');
        verify($signup->city)->equals('Berlin');
        verify($signup->morada)->equals('Morada Teste4000');
        verify($signup->biography)->equals('Biografia Teste4000');

        /* ***** End of Section ***** */
    }
}

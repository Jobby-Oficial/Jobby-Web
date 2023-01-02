<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    /*public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }*/

    /**
     * @param FunctionalTester $I
     */

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->seeCurrentUrlEquals('/login');
        $I->seeResponseCodeIs(200);
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Incorrect username or password.');
    }

    public function checkInactiveAccount(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('test.test', 'Test1234'));
        $I->seeValidationError('Incorrect username or password');
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('guilherme', 'teste1234'));
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }

    public function tryToLogin(FunctionalTester $I)
    {
        $I->wantTo('Login');
        $I->seeInCurrentUrl('/login');
        $I->see('Username');
        $I->see('Password');
        $I->fillField('LoginForm[username]', 'teste');
        $I->fillField('LoginForm[password]', 'teste1234');
        $I->seeInField('LoginForm[username]', 'teste');
        $I->seeInField('LoginForm[password]', 'teste1234');
        $I->see('Entrar');
        $I->click('Entrar');
        $I->seeInCurrentUrl('/');
    }

    public function loginUser(FunctionalTester $I)
    {
        $I->wantTo('Login');
        $I->amOnRoute('/site/login');
        $I->fillField('Username', 'teste');
        $I->fillField('Password', 'teste1234');
        $I->seeInField('LoginForm[username]', 'teste');
        $I->seeInField('LoginForm[password]', 'teste1234');
        $I->click('login-button');
        $I->dontSeeLink('Login');
        $I->seeInCurrentUrl('/');
    }
}

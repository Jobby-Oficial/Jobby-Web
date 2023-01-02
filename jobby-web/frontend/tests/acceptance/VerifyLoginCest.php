<?php


namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;

class VerifyLoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->seeInCurrentUrl('site/login');
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Verify Login');
        $I->fillField('LoginForm[username]', 'teste');
        $I->fillField('LoginForm[password]', 'teste1234');
        $I->seeInField('LoginForm[username]', 'teste');
        $I->seeInField('LoginForm[password]', 'teste1234');
        $I->seeLink('Entrar');
        $I->click('login-button');
        $I->wait(2);
        $I->seeInCurrentUrl('/');
        $I->waitForText('teste', 30);
        $I->seeElement('.nav');
        $I->see('teste', '.nav');
    }
}

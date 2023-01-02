<?php


namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;

class VerifyServiceCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeInCurrentUrl('/');
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Verify Service');
        $I->seeElement('.nav');
        $I->seeLink('Explorar Serviços');
        $I->see('Explorar Serviços', '.nav');
        $I->click('Explorar Serviços');
        $I->seeInCurrentUrl('/services');
        $I->see('Serviços');
    }
}

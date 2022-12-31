<?php


namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;

class VerifyHomeCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeInCurrentUrl('/');
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Verify Home');
        $I->seeElement('.nav');
        $I->seeElement('.footer');
        $I->seeElement('.wave-section');
        $I->seeElement('.presentation-section');
        $I->seeElement('.card-section');
        $I->seeElement('.testimonials-section');
        $I->seeElement('.software-section');
        $I->seeElement('.about-section');
        $I->seeLink('Explorar Serviços');
        $I->see('Explorar Serviços', '.nav');
        $I->see('Encontra o serviço que procuras', '.wave-section');
        $I->see('Melhor Site de Serviços do Mundo!', '.presentation-section');
        $I->see('Descomplique em 3 passos', '.card-section');
        $I->see('Testemunhos', '.testimonials-section');
        $I->see('Plataforma JOBBY', '.software-section');
        $I->see('Sobre Nós', '.about-section');
        $I->see('© Jobby', '.footer');
        $I->see('Privacidade', '.footer');
        $I->see('Termos', '.footer');
        $I->see('Suporte', '.footer');
    }
}

<?php


namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;

class VerifySupportCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/support');
        $I->seeInCurrentUrl('/support');
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Verify Suporte');
        $I->see('Contacte-nos');
        $I->fillField('email', 'teste@email.com');
        $I->selectOption('assunto','Sugestões');
        $I->fillField('mensagem', 'Mensagem Teste');
        $I->see('Enviar Menssagem!', '.bubbly-button');
        $I->click('Enviar Menssagem!');
        $I->waitForElement('#w4-success-0', 30);
        $I->see('Mensagem enviada com sucesso!');
    }
}

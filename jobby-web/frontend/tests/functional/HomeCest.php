<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
    }

    public function tryToHome(FunctionalTester $I)
    {
        $I->wantTo('Home');
        $I->seeLink('Entrar');
        $I->click('Entrar');
        $I->fillField('LoginForm[username]', 'teste');
        $I->fillField('LoginForm[password]', 'teste1234');
        $I->seeLink('Entrar');
        $I->click('Entrar');
        $I->seeElement('.nav');
        $I->seeInCurrentUrl('/');
    }

    public function tryToPrivacidade(FunctionalTester $I)
    {
        $I->wantTo('Privacidade');
        $I->see('Privacidade', '.footer');
        $I->seeLink('Privacidade');
        $I->click('Privacidade');
        $I->seeInCurrentUrl('/privacy');
        $I->seeElement('.nav');
        $I->seeElement('.footer');
        $I->seeLink('Explorar Serviços');
        $I->see('Política de Privacidade');
        $I->see('Compromisso do Usuário');
        $I->see('Mais informações');
        $I->see('© Jobby', '.footer');
        $I->see('Privacidade', '.footer');
        $I->see('Termos', '.footer');
        $I->see('Suporte', '.footer');
    }

    public function tryToTermos(FunctionalTester $I)
    {
        $I->wantTo('Termos');
        $I->see('Termos', '.footer');
        $I->seeLink('Termos');
        $I->click('Termos');
        $I->seeInCurrentUrl('/terms');
        $I->seeElement('.nav');
        $I->seeElement('.footer');
        $I->seeLink('Explorar Serviços');
        $I->see('Termos');
        $I->see('Uso de Licença');
        $I->see('Isenção de responsabilidade');
        $I->see('Limitações');
        $I->see('Precisão dos materiais');
        $I->see('Links');
        $I->see('Modificações');
        $I->see('Lei aplicável');
        $I->see('© Jobby', '.footer');
        $I->see('Privacidade', '.footer');
        $I->see('Termos', '.footer');
        $I->see('Suporte', '.footer');
    }

    public function tryToSuporte(FunctionalTester $I)
    {
        $I->wantTo('Suporte');
        $I->see('Suporte', '.footer');
        $I->seeLink('Suporte');
        $I->click('Suporte');
        $I->seeInCurrentUrl('/support');
        $I->seeElement('.nav');
        $I->seeElement('.footer');
        $I->seeLink('Explorar Serviços');
        $I->see('Contacte-nos');
        $I->see('Detalhes do Contacto');
        $I->see('Telefone');
        $I->see('Email');
        $I->see('Morada');
        $I->see('© Jobby', '.footer');
        $I->see('Privacidade', '.footer');
        $I->see('Termos', '.footer');
        $I->see('Suporte', '.footer');
    }
}
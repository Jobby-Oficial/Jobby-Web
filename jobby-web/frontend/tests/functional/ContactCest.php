<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class ContactCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/support');
        $I->seeCurrentUrlEquals('/support');
    }

    public function tryToContact(FunctionalTester $I)
    {
        $I->wantTo('Contacte-nos');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->see('Suporte', '.footer');
        $I->seeLink('Suporte');
        $I->click('Suporte');
        $I->seeInCurrentUrl('/support');
        $I->see('Contacte-nos');
        $I->fillField('email', 'teste@email.com');
        $I->selectOption('assunto','Sugestões');
        $I->fillField('mensagem', 'Mensagem Teste');
        $I->seeInField('email', 'teste@email.com');
        $I->seeInField('assunto','Sugestões');
        $I->seeInField('mensagem', 'Mensagem Teste');
        $I->see('Enviar Menssagem!', '.bubbly-button');
    }

    public function checkContact(FunctionalTester $I)
    {
        /*$I->see('Suporte', '.footer');
        $I->seeLink('Suporte');
        $I->click('Suporte');
        $I->seeInCurrentUrl('/support');*/
        $I->see('Contacte-nos', 'h2');
    }

    public function checkContactSubmitNoData(FunctionalTester $I)
    {
        $I->fillField('email', '');
        $I->fillField('mensagem', '');
        $I->seeInField('email', '');
        $I->seeInField('mensagem', '');
        //$I->submitForm('#contact-form', []);
        //$I->see('Contacte-nos', 'h2');
        //$I->seeValidationError('Name cannot be blank');
        //$I->seeValidationError('Email cannot be blank');
        //$I->seeValidationError('Subject cannot be blank');
        //$I->seeValidationError('Body cannot be blank');
        //$I->seeValidationError('The verification code is incorrect');
    }

    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I)
    {
        /*$I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);*/
        $I->fillField('email', 'teste@email.com');
        $I->selectOption('assunto','Sugestões');
        $I->fillField('mensagem', 'Mensagem Teste');
        $I->seeInField('email', 'teste@email.com');
        $I->seeInField('assunto','Sugestões');
        $I->seeInField('mensagem', 'Mensagem Teste');
        $I->dontSeeValidationError('Email cannot be blank');
        $I->dontSeeValidationError('Subject cannot be blank');
        $I->dontSeeValidationError('Menssage cannot be blank');
    }

    public function checkContactSubmitCorrectData(FunctionalTester $I)
    {
        /*$I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeEmailIsSent();
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');*/
    }
}

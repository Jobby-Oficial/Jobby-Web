<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Criar uma Conta', 'h1');
        $I->see('Insere os teus dados pessoais e começa a jornada connosco.');
        $I->see('Preencha todos os campos para se Registar:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Name cannot be blank.');
        $I->seeValidationError('Phone cannot be blank.');
        $I->seeValidationError('Birth cannot be blank.');
        $I->seeValidationError('Country cannot be blank.');
        $I->seeValidationError('City cannot be blank.');
        $I->seeValidationError('Morada cannot be blank.');
        $I->seeValidationError('Biography cannot be blank.');
        $I->seeValidationError('Password Hash cannot be blank.');
        $I->seeValidationError('Password Repeat cannot be blank.');
    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[username]' => 'teste',
            'SignupForm[email]' => 'ttttt',
            'SignupForm[name]' => 'Teste',
            'SignupForm[phone]' => '9157894523',
            'SignupForm[genre]' => 'Masculino',
            'SignupForm[birth]' => '2000-01-28',
            'SignupForm[country]' => 'Portugal',
            'SignupForm[city]' => 'Lisboa',
            'SignupForm[morada]' => 'Morada Teste',
            'SignupForm[typeUser]' => 'Cliente',
            'SignupForm[biography]' => 'Biografia Teste',
            'SignupForm[password_hash]'  => 'teste_password',
            'SignupForm[password_repeat]'  => 'teste_password',
        ]
        );
        $I->dontSee('Username cannot be blank.', '.invalid-feedback');
        $I->dontSee('Name cannot be blank.', '.invalid-feedback');
        $I->dontSee('Phone cannot be blank.', '.invalid-feedback');
        $I->dontSee('Genre cannot be blank.', '.invalid-feedback');
        $I->dontSee('Birth cannot be blank.', '.invalid-feedback');
        $I->dontSee('Country cannot be blank.', '.invalid-feedback');
        $I->dontSee('City cannot be blank.', '.invalid-feedback');
        $I->dontSee('Morada cannot be blank.', '.invalid-feedback');
        $I->dontSee('TypeUser cannot be blank.', '.invalid-feedback');
        $I->dontSee('Biography cannot be blank.', '.invalid-feedback');
        $I->dontSee('Password Hash cannot be blank.', '.invalid-feedback');
        $I->dontSee('Password Repeat cannot be blank.', '.invalid-feedback');
        $I->see('Email is not a valid email address.', '.invalid-feedback');
    }

    public function signupWithNotEqualPassword(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[username]' => 'teste',
                'SignupForm[email]' => 'ttttt',
                'SignupForm[name]' => 'Teste',
                'SignupForm[phone]' => '9157894523',
                'SignupForm[genre]' => 'Masculino',
                'SignupForm[birth]' => '2000-01-28',
                'SignupForm[country]' => 'Portugal',
                'SignupForm[city]' => 'Lisboa',
                'SignupForm[morada]' => 'Morada Teste',
                'SignupForm[typeUser]' => 'Cliente',
                'SignupForm[biography]' => 'Biografia Teste',
                'SignupForm[password_hash]'  => 'teste_password',
                'SignupForm[password_repeat]'  => 'teste_repeat',
            ]
        );
        $I->dontSee('Username cannot be blank.', '.invalid-feedback');
        $I->dontSee('Email cannot be blank.', '.invalid-feedback');
        $I->dontSee('Name cannot be blank.', '.invalid-feedback');
        $I->dontSee('Phone cannot be blank.', '.invalid-feedback');
        $I->dontSee('Genre cannot be blank.', '.invalid-feedback');
        $I->dontSee('Birth cannot be blank.', '.invalid-feedback');
        $I->dontSee('Country cannot be blank.', '.invalid-feedback');
        $I->dontSee('City cannot be blank.', '.invalid-feedback');
        $I->dontSee('Morada cannot be blank.', '.invalid-feedback');
        $I->dontSee('TypeUser cannot be blank.', '.invalid-feedback');
        $I->dontSee('Biography cannot be blank.', '.invalid-feedback');
        $I->dontSee('Password Hash cannot be blank.', '.invalid-feedback');
        $I->dontSee('Password Repeat cannot be blank.', '.invalid-feedback');
        $I->see('As Palavras-passe não Combinam', '.invalid-feedback');
    }

    /*public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'teste',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[name]' => 'Teste',
            'SignupForm[phone]' => '9157894523',
            'SignupForm[genre]' => 'Masculino',
            'SignupForm[birth]' => '2000-01-28',
            'SignupForm[country]' => 'Portugal',
            'SignupForm[city]' => 'Lisboa',
            'SignupForm[morada]' => 'Morada Teste',
            'SignupForm[typeUser]' => 'Cliente',
            'SignupForm[biography]' => 'Biografia Teste',
            'SignupForm[password_hash]'  => 'teste_password',
            //'SignupForm[password_repeat]'  => 'teste_password',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'teste',
            'email' => 'teste.email@example.com',
            //'status' => \common\models\User::STATUS_INACTIVE
        ]);

        //$I->seeEmailIsSent();
        //$I->see('Thank you for registration. Please check your inbox for verification email.');
    }*/
}

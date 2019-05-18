<?php
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriver;

include "TelaPainelControle.php";

class TelaLogin
{

    private $navegador;

    private $button_login;

    private $input_email;

    private $input_senha;

    public function __construct(WebDriver $navegador)
    {
        $this->navegador = $navegador;
        $this->input_email = $this->navegador->findElement(WebDriverBy::cssSelector('input[type="text"]'));
        $this->input_senha = $this->navegador->findElement(WebDriverBy::cssSelector('input[type="password"]'));
        $this->button_login = $this->navegador->findElement(WebDriverBy::id('login-button'));
    }

    public function logar()
    {
        $this->button_login->click();
        return new TelaPainelControle($this->navegador);
    }

    public function preencherDados($email, $password)
    {
        $this->input_email->sendKeys($email);
        $this->input_senha->sendKeys($password);

        return $this;
    }
}

?>
<?php

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ConfiguracaoNotificacao
{
    private $navegador;
    private $input_notify_product;
    private $button_save;

    public $msgGravar;


    public function __construct($navegador)
    {
        $this->navegador = $navegador;
        $this->input_notify_product =  $this->navegador
            ->findElement(WebDriverBy::xPath('//input[@name="notify-product-news:email"]/..'));

        $this->button_save = $this->navegador
            ->findElement(WebDriverBy::id('notifications_save'));
    }

    public function alterarNotificaProdutosEmail()
    {
        $this->input_notify_product->click();

        return $this;
    }

    public function gravarAlteracoes()
    {
        $this->button_save->click();
        //VALIDAR MSG
        $wait = new WebDriverWait($this->navegador, 10, 500);
        $toast = WebDriverBy::xPath('//div[@class="alert alert-success"]/ul/li');
        $element =WebDriverExpectedCondition::visibilityOfElementLocated($toast);
        $wait->until($element);
        $text = $this->navegador->findElement($toast)->getText();
        $this->mensagem_retorno = $text;

        $this->msgGravar = $text;

        return $this;
    }
}

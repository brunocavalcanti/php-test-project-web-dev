<?php

use Facebook\WebDriver\WebDriverBy;

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
        $this->msgGravar = $this->navegador
            ->findElement(WebDriverBy::xPath('//div[@class="alert alert-success"]/ul/li'))
            ->getText();

        return $this;
    }
}

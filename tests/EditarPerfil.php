<?php
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;

class EditarPerfil
{

    private $navegador;

    private $combo_genero;

    private $button_save_profile;

    public $mensagem_retorno;

    public function __construct($navegador)
    {
        $this->navegador = $navegador;
        $this->combo_genero = new WebDriverSelect($this->navegador->findElement(WebDriverBy::id('profile_gender')));
        $this->button_save_profile = $this->navegador->findElement(WebDriverBy::id('profile_save_profile'));
    }

    public function trocarGenero($genero)
    {
        $this->combo_genero->selectByValue($genero);
        return $this;
    }

    public function gravarAlteracoes()
    {
        $this->button_save_profile->click();
        $this->mensagem_retorno = $this->navegador->findElement(WebDriverBy::xPath('//div[@class="alert alert-success"]/p'))->getText();
        return $this;
    }
}

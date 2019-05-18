<?php
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

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
        //VALIDAR MSG
        $wait = new WebDriverWait($this->navegador, 10, 500);
        $toast = WebDriverBy::xPath('//div[@class="alert alert-success"]/p');
        $element =WebDriverExpectedCondition::visibilityOfElementLocated($toast);
        $wait->until($element);
        $text = $this->navegador->findElement($toast)->getText();
        $this->mensagem_retorno = $text;
        return $this;
    }
}

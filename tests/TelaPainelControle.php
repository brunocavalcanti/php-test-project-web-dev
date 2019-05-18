<?php

use Facebook\WebDriver\WebDriverBy;

include "EditarPerfil.php";
include "ConfiguracaoNotificacao.php";

class TelaPainelControle {
    protected $navegador;

    public function __construct($navegador){
        $this->navegador = $navegador;
    }

    public function acessaEditarPerfil(){
        $this->navegador
             ->findElement(WebDriverBy::id('btn-edit-profile'))
             ->Click();

        return new EditarPerfil($this->navegador);
    }

    public function acessarConfigNotificacoes(){
        $this->navegador
             ->findElement(WebDriverby::xPath('//div[@class="sidebar"]/ul/li[@id="submenu-item-notification-settings"]/a'))
             ->Click();

        return new ConfiguracaoNotificacao($this->navegador);
    }
}

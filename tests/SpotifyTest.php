<?php
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

include "TelaLogin.php";
require_once "TelaPainelControle.php";
require_once "EditarPerfil.php";

class TestesEmail extends TestCase
{
    private $navegador;

    public static function dataTestAlteraNotificacaoProdutosEmail()
    {
        return [
            'teste1' => ['testesautomatizados1@gmail.com', 'teste123', 'Notificações salvas'],
            'teste2' => ['testesautomatizados1@gmail.com', 'teste123', 'Notificações salvas'],
            'teste3' => ['testesautomatizados1@gmail.com', 'teste123', 'Notificações salvas']
        ];
    }

    public static function dataTestAlteraGenero()
    {
        return [
            'teste1' => ['testesautomatizados1@gmail.com', 'teste123', 'female', 'Perfil salvo'],
            'teste2' => ['testesautomatizados1@gmail.com', 'teste123', 'male', 'Perfil salvo'],
            'teste3' => ['testesautomatizados1@gmail.com', 'teste123', 'neutral', 'Perfil salvo']
        ];
    }

    protected function setUp(): void
    {
        $this->navegador = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());
        $this->navegador->get('https://accounts.spotify.com/pt-BR/login/?continue=https:%2F%2Fwww.spotify.com%2Fbr%2Faccount%2Foverview%2F&_locale=pt-BR');
        $this->navegador->manage()->window()->maximize();
        $this->navegador->manage()->timeouts()->implicitlyWait(2);
    }

    protected function tearDown(): void
    {
        $this->navegador->quit();
    }

    /**
     * @dataProvider dataTestAlteraGenero
     */
    public function testAlteraGenero($email, $senha, $genero, $mensagem)
    {
        $paginaLogin = new TelaLogin($this->navegador);
        $editarPerfil = $paginaLogin->preencherDados($email, $senha)
            ->logar()
            ->acessaEditarPerfil()
            ->trocarGenero($genero)
            ->gravarAlteracoes();

        $this->assertEquals($mensagem, $editarPerfil->mensagem_retorno);
        $this->navegador->takeScreenshot("evidencies/testAlteraGenero.jpg");
    }

    /**
     * @dataProvider dataTestAlteraNotificacaoProdutosEmail
     */
    public function testAlteraNotificacaoProdutosEmail($email, $senha, $mensagem)
    {

        $paginaLogin = new TelaLogin($this->navegador);
        $configNotif = $paginaLogin->preencherDados($email, $senha)
            ->logar()
            ->acessarConfigNotificacoes()
            ->alterarNotificaProdutosEmail()
            ->gravarAlteracoes();

        $this->assertEquals($mensagem, $configNotif->msgGravar);
        $this->navegador->takeScreenshot("evidencies/testAlteraNotificacaoProdutosEmail.jpg");
    }
}

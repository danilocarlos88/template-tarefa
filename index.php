<?php

require_once './lib/Page.php';


class IndexPage extends \Frontpage\Page {

    public function __construct() {
        parent::__construct();
        $this->currentPage = "index";
    }

    public function index() {

        ob_start();
        echo $this->banners();
        include 'home/home.php';
        return ob_get_clean();
    }

    private function banners() {
        $dados_banner = self::getDataset('banners');

        ob_start();
        include 'home/banners.php';
        return ob_get_clean();
    }

    private function destaques() {
        $dados = $this->getDataset('veiculos');

        ob_start();
        include 'inc/_ofertas_loop.php';
        return ob_get_clean();
    }

    private function carros() {

    }

}

$page = new IndexPage();
$page->send_html();

<?php

namespace Frontpage;

//require_once dirname(dirname(__FILE__)) . '/lua4auto/lua4auto/boot_web.php';
require_once dirname(__FILE__) . '/Pager.php';
require_once dirname(__FILE__) . '/Breadcrumb.php';

class Page {

    public $currentPage = 'index';
    public $veiculo = null;
    public $page_header = null;
    public $root_rel = null;
    public $site_url = null;
    public $bread = null;
    public $title_suffix = null;

    /**
     * Lista de lojas
     * @var array
     */
    protected $globalLojas = array();
    protected $globalMarcas = array();
    protected $equipe = array();
    protected $customVars;

    /**
     * Loja principal (primeira da lista)
     * @var array
     */
    protected $mainLoja = array();

    public function __construct() {
        $this->setConfig();

        $this->getLojas();
        $this->getEquipe();
        $this->root_rel = '/template-tarefa/';
        $this->bread = new \Breadcrumb(" > ", $this->root_rel);
        $this->site_url = '/';
    }

    public function head() {
        $description = '';
        $keywords = '';
        
        $dados_lojas = $this->mainLoja;

        ob_start();
        include 'layout/_tags.php';
        return ob_get_clean();
    }

    public function header() {
        $dados_lojas = $this->mainLoja;

        ob_start();
        include 'layout/_header.php';
        return ob_get_clean();
    }

    public function pageHeader($form = true) {

        ob_start();
        include 'layout/_page_header.php';
        return ob_get_clean();
    }

    public function menu($header = false) {

        ob_start();
        include 'inc/_menu.php';
        return ob_get_clean();
    }


    public function footer() {
        $dados_lojas = $this->mainLoja;

        ob_start();
        include 'layout/_footer.php';
        //include 'block/_modais.php';
        include 'layout/_js.php';
        return ob_get_clean();
    }

    public function estoqueScript() {
        ob_start();
        include 'estoque/_estoqueScript.php';
        return ob_get_clean();
    }

    public function internaScript() {
        ob_start();
        include 'estoque/_internaScript.php';
        return ob_get_clean();
    }

    public function scripts() {
        ob_start();
        include 'layout/_scripts.php';
        return ob_get_clean();
    }

    public function send_html() {
        ob_start();
        include 'layout.php';
        $html = ob_get_clean();
        header('Content-type: text/html; charset=utf-8');
        echo $html;
        die;
    }

    public function content() {
        $op = isset($_GET['op']) ? $_GET['op'] : null;
        if ($op) {
            try {
                $method = new ReflectionMethod($this, $op);
                if ($method->isPrivate()) {
                    header('Location: ' . $this->_link->index());
                    die;
                }
            } catch (Exception $exc) {
                
            }
        }

        if (method_exists($this, $op)) {
            $method = $this->$op();
        } else {
            $method = $this->index();
        }
        return $method;
    }

    /**
     * Retorna texto para <title>
     * 
     * @return string
     */
    protected function getTitle() {
        $retorno = $this->mainLoja['descricao'];
        if (!empty($this->title_suffix)) {
            $retorno .= ' :: ' . $this->title_suffix;
        } elseif (!empty($this->mainLoja['slogan'])) {
            $retorno .= ' - ' . $this->mainLoja['slogan'];
        }

        return $retorno;
    }

    private function metaTags() {
        $facebookImage = '';
        
        $theme_color = '#ffffff';

        $metaDescription = '';

        ob_start();
        include 'layout/_metatags.php';
        return ob_get_clean();
    }

    private function getLojas() {
        
        $this->globalLojas = self::getDataset('lojas');
        $this->mainLoja = array_shift($this->globalLojas);
    }

    public function getEquipe() {

        $this->equipe = [];
    }

    public function thumbMarcas() {
        ob_start();
        include 'block/thumbmarcas.php';
        return ob_get_clean();
    }

    protected function modais() {
        ob_start();
        include 'block/_modais.php';
        return ob_get_clean();
    }

    private function setConfig() {
        $include_path = get_include_path();
        set_include_path(
                $include_path . PATH_SEPARATOR .
                dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'templates' . PATH_SEPARATOR
        );
    }
    
    public static function getDataset($name){
        return json_decode(
                file_get_contents(
                        dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'dataset' . DIRECTORY_SEPARATOR . $name . '.json'
                        )
                , true);
    }

}

<nav>
    <ul class="menu <?= isset($header) && $header ? 'js-menu' : ''; ?>">
        <li><a href="<?= $this->root_rel ?>">Início</a></li>
        <li><a href="<?= $this->root_rel ?>estoque/">Estoque</a></li>
        <li><a href="<?= $this->root_rel ?>quem-somos/">Quem somos</a></li>
        <li><a href="<?= $this->root_rel ?>fale-conosco/">Fale conosco</a></li>
    </ul>
</nav>
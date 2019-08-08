<form class="main-busca" action="<?= $this->root_rel ?>estoque/" method="get">
    <input class="main-busca__input" type="text" placeholder="Digite marca ou modelo" name="txt_busca" value="<?= isset($_GET['txt_busca']) && !empty($_GET['txt_busca']) ? $_GET['txt_busca'] : ''; ?>">
    <input class="main-busca__submit" type="submit">
</form>

<form class="main-busca main-busca--mobile" action="<?= $this->root_rel ?>estoque/" method="get">
    <input class="main-busca__input" type="text" placeholder="Encontre seu carro seminovo" name="txt_busca" value="<?= isset($_GET['txt_busca']) && !empty($_GET['txt_busca']) ? $_GET['txt_busca'] : ''; ?>">
    <input class="main-busca__submit" type="submit">
</form>

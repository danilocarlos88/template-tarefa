<div class="page-header">
  <div class="container">
  	<div class="col-1-2">
    	<h1><?=$this->page_header; ?></h1>
	</div>
	<?php if($form): ?>
		<div class="col-1-2 cont-busca">
		    <form class="busca-header" action="<?= \Lua4Auto\Libs\Config::$l4a_site_dirname ?>estoque/" method="get">
		      <input class="main-busca__input" type="text" name="txt_busca" placeholder="Busque aqui seu carro" />
		      <input class="main-busca__submit" type="submit">
		    </form>
		</div>
	<?php endif; ?>
  </div>
</div>
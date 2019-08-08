  <div class="container">
	<h1 class="section-title section-title--busca-seminovo">Encontre seu carro</h1>
	<?php require("inc/_search_simple.php"); ?>
  </div>

  <div class="container">
      
	<h1 class="section-title">Carros em Destaque</h1>
	
	  <div class="row grid-default car-showcase car-showcase--bordered">
		<?php echo $this->destaques() ?>
	  </div>
	  
  </div>

  <div class="container">
	
	  <div class="row grid-default car-showcase">
		<?php echo $this->carros() ?>
	  </div>
	  

	<div class="row">
	  <a href="<?= $this->root_rel ?>estoque/" class="btn-showroom-more"><span>Ver estoque</span><i class="icon-plus"></i></a>
	</div>

	<?php require_once('inc/_main_links.php') ?>

  </div>
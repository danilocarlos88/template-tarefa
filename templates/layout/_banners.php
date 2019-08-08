<section class="hero">
		<div class="main-slider-desktop">
		  <ul class="main-slider js-main-slider">
			<?php
			$b = new Banners();
			ob_start();
			$b->busca(0, date('Y-m-d'));
			$dados_banner = json_decode(ob_get_clean(), true);
			foreach($dados_banner as $banner){
			  ?>
				<?php if(!empty($banner['url'])): ?>
				<li>
				  <a 
					class="slide btn-banner-click" 
					href="<?php echo $banner['url'] ?>" 
					<?php if($banner['nova_pagina']) { echo 'target="_blank"'; } ?> 
					data-id_banner="<?php echo $banner['id_banner'] ?>"
				  >
					<img src="<?= $banner['arquivo']; ?>" alt="<?= $banner['titulo']; ?>" />
				  </a>
				</li>

				<?php elseif($banner['id_assunto'] || $banner['id_seminovo']): ?>
				<li>
				  <a 
					class="slide btn-banner-click" 
					href="#ligamos-para-voce" 
					data-id_banner="<?php echo $banner['id_banner'] ?>" 
					data-id_assunto="<?php echo f($banner, 'id_assunto') ?>" 
					data-id_seminovo="<?php echo f($banner, 'id_seminovo') ?>"
				  >
					<img src="<?= $banner['arquivo']; ?>" alt="<?= $banner['titulo']; ?>" />
				  </a>
				</li>

				<?php else: ?>
				<li>
				  <div 
					class="slide btn-banner-click" 
					data-id_banner="<?php echo $banner['id_banner'] ?>"
				  >
					<img src="<?= $banner['arquivo']; ?>" alt="<?= $banner['titulo']; ?>" />
				  </div>
				</li>

				<?php endif; ?>
				<?php
				}
				?>
		  </ul><!-- main-slider-desktop -->
		</div>

		<div class="main-slider-mobile">
		  <ul class="main-slider js-main-slider">
			<?php
			$b = new Banners();
			ob_start();
			$b->busca(0, date('Y-m-d'));
			$dados_banner = json_decode(ob_get_clean(), true);
			foreach($dados_banner as $banner){
			  ?>
				<?php if(!empty($banner['url'])): ?>
				<li>
				  <a 
					class="slide btn-banner-click" 
					href="<?php echo $banner['url'] ?>" 
					<?php if($banner['nova_pagina']) { echo 'target="_blank"'; } ?> 
					data-id_banner="<?php echo $banner['id_banner'] ?>"
				  >
					<img src="<?= $banner['arquivo_mobile']; ?>" alt="<?= $banner['titulo']; ?>" />
				  </a>
				</li>

				<?php elseif($banner['id_assunto'] || $banner['id_seminovo']): ?>
				<li>
				  <a 
					class="slide btn-banner-click" 
					href="#ligamos-para-voce" 
					data-id_banner="<?php echo $banner['id_banner'] ?>" 
					data-id_assunto="<?php echo f($banner, 'id_assunto') ?>" 
					data-id_seminovo="<?php echo f($banner, 'id_seminovo') ?>"
				  >
					<img src="<?= $banner['arquivo_mobile']; ?>" alt="<?= $banner['titulo']; ?>" />
				  </a>
				</li>

				<?php else: ?>
				<li>
				  <div 
					class="slide btn-banner-click" 
					data-id_banner="<?php echo $banner['id_banner'] ?>"
				  >
					<img src="<?= $banner['arquivo_mobile']; ?>" alt="<?= $banner['titulo']; ?>" />
				  </div>
				</li>

				<?php endif; ?>
				<?php
				}
				?>
		  </ul>
		</div>
	  </section>
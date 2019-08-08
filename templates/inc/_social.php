<?php
foreach($dados_lojas as $loja){
	
	if(!empty($loja['facebook'])){
		?>
			<li><a href="<?= $loja['facebook']; ?>" class="facebook" target="_blank">Facebook</a></li>
		<?php
	}
	
	if(!empty($loja['instagram'])){
		?>
			<li><a href="<?= $loja['instagram']; ?>" class="instagram" target="_blank">Instagram</a></li>
		<?php
	}
	
	if(!empty($loja['twitter'])){
		?>
			<li><a href="<?= $loja['twitter']; ?>" class="twitter">Twitter</a></li>
		<?php
	}
	
	if(!empty($loja['youtube'])){
		?>
			<li><a href="<?= $loja['youtube']; ?>" class="youtube">YouTube</a></li>
		<?php
	}
}
?>
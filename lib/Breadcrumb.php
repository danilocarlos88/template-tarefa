<?php

class Breadcrumb {

	public $level = 0;
	public $erro = false;
	private $divider = '';

	public function __construct($divider, $path = '/') {
		$_SESSION['crumbs'][0] = array('label' => 'Início', 'url' => $path);
		$this->divider = $divider;
	}

	public function get_divider() {
		if ($this->divider == '') {
			return '/';
		} else {
			return $this->divider;
		}
	}

	/**
	 * 
	 * @param string $label
	 * @param string $url
	 * @param int $level
	 */
	public function addCrumb($label, $url, $level) {
		if ($level == 0) {
			$this->erro = true;
		} else {
			$this->level = $level;
			$_SESSION['crumbs'][$level] = array('label' => $label, 'url' => $url);
		}
	}

	/**
	 * retorna URL da posição dada
	 * 
	 * @param int $position
	 * @return boolean false on fail / url on success
	 */
	public function getPosition($position) {
		if (!is_numeric($position)) {
			return false;
		}
		return $_SESSION['crumbs'][$position]['url'];
	}

	public function render() {
		ob_start();
		echo '<ol class="breadcrumb-list" itemscope itemtype="http://schema.org/BreadcrumbList">';
		for ($i = 0; $i <= $this->level; $i++) {
			if ($i == $this->level) {
				?>
					<li itemprop="itemListElement" itemscope
      					itemtype="http://schema.org/ListItem">
						<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="javascript:void(0);">
	       					<span itemprop="name"><?php echo $_SESSION['crumbs'][$i]['label']; ?></span>
	       				</a>
						<meta itemprop="position" content="<?=$i?>" />
					</li>
				<?php
			} else {
				?>
					<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
						<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="<?php echo $_SESSION['crumbs'][$i]['url']; ?>">
							<span itemprop="name"><?php echo $_SESSION['crumbs'][$i]['label']; ?></span>
						</a> 
						<meta itemprop="position" content="<?=$i?>" />
					</li>
					<span class="divider"><?php echo $this->get_divider(); ?></span>

				<?php
			}
		} 
		echo "</ol>";
		return ob_get_clean();
	}

}

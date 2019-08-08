
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $this->getTitle() ?></title>

<meta name="description" content="<?= (!empty($this->mainLoja['slogan']) ? " - " . $this->mainLoja['slogan'] : $this->mainLoja['descricao']); ?>">
<meta name="keywords" content="auto, veiculos, carro, seminovos">
<meta name="viewport" content="width=device-width, initial-scale=1">



<link rel="apple-touch-icon" sizes="57x57" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= $this->root_rel; ?>img/_icons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="<?= $this->root_rel; ?>img/_icons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?= $this->root_rel; ?>img/_icons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="<?= $this->root_rel; ?>img/_icons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?= $this->root_rel; ?>img/_icons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?= $this->root_rel; ?>img/_icons/manifest.json">
<link rel="mask-icon" href="<?= $this->root_rel; ?>img/_icons/safari-pinned-tab.svg" color="#000000">
<link rel="shortcut icon" href="<?= $this->root_rel; ?>img/_icons/favicon.ico">
<meta name="apple-mobile-web-app-title" content="<?= $this->mainLoja['descricao'] ?>">
<meta name="application-name" content="<?= $this->mainLoja['descricao'] ?>">
<meta name="msapplication-TileColor" content="<?= $theme_color ?>">
<meta name="msapplication-TileImage" content="<?= $this->root_rel; ?>img/_icons/mstile-144x144.png">
<meta name="msapplication-config" content="<?= $this->root_rel; ?>img/_icons/browserconfig.xml">
<meta name="theme-color" content="<?= $theme_color ?>">


<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700">
<link rel="stylesheet" href="<?= $this->root_rel; ?>css/app.css">


<!--[if lt IE 9]>
	<script src="<?= $this->root_rel; ?>js/dev/html5shiv.min.js"></script>
<![endif]-->

<!--[if IE]>
    <link rel="stylesheet" href="<?= $this->root_rel; ?>css/all-ie-only.css">
<![endif]-->

<!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="<?= $this->root_rel; ?>css/ie8.css">
<![endif]-->

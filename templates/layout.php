<?php
// $content é o conteúdo central das páginas (ex: /templates/estoque/lista.php)
$content = $this->content();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?= $this->head(); ?>
    </head>
    <body>
        <?= $this->header(); ?>

        <?= $content; ?>

        <?= $this->footer() ?>


    </body>
</html>
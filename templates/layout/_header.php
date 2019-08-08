<header class="header">
    <div class="header__top">
        <div class="container">
            <ul class="contacts">
                <?php
                $loja = $this->mainLoja;
                ?>
                <li class="phone">
                    <i class="fa fa-phone"></i>
                    <a href="tel:0<?= preg_replace('/\D/', '', $loja['telefone_' . $i]); ?>">
                        <?= !empty($loja['telefone_1_descricao']) ? '<span class="name">' . $loja['telefone_1_descricao'] . ':</span> ' : ''; ?>
                        <?= str_replace(")", " ", str_replace("(", "", $loja['telefone_1'])); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <?php
            if (!empty($this->mainLoja['logo_site_topo'])) {
                $dados_logo = $this->root_rel . "lua4auto/public/uploads/lojas/" . $this->mainLoja['logo_site_topo'];
                ?>
                <a href="<?= $this->root_rel ?>" class="logo"><img src="<?= $dados_logo; ?>" alt="<?= $this->mainLoja['descricao']; ?>" /></a>
                <?php
            }
            ?>

            <?php
            echo $this->menu(true);
            ?>

            <ul class="social-medias">
                <?php
                if (!empty($loja['facebook'])) {
                    ?>
                    <li><a class="facebook" href="<?= $loja['facebook']; ?>" title="Curta nossa página no Facebook" target="_blank"><span></span></a></li>
                    <?php
                }

                if (!empty($loja['instagram'])) {
                    ?>
                    <li><a class="instagram" href="<?= $loja['instagram']; ?>" title="Siga nosso perfil no Instagram" target="_blank"><span></span></a></li>
                    <?php
                }
                if (!empty($loja['twitter'])) {
                    ?>
                    <li><a class="twitter" href="<?= $loja['twitter']; ?>" title="Siga-nos no Twitter" target="_blank"><span></span></a></li>
                    <?php
                }

                if (!empty($loja['youtube'])) {
                    ?>
                    <li><a class="youtube" href="<?= $loja['youtube']; ?>" title="Inscreva-se no nosso canal no YouTube" target="_blank"><span></span></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</header>

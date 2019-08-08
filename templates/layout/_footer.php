
<footer class="footer">
    <div class="container">
        <div class="row footer-menu">
            <div class="col-2-3">
                <?php
                    $header = false;
                    echo $this->menu();
                ?>
            </div>
            <div class="col-1-3">
                <div class="header__contact">
                    <a href="#ligamos-para-voce" class="btn-medium btn-main-color">Ligamos pra você</a>
                </div>
            </div>
        </div>

        <div class="row footer__contact">
          <?php
          $loja = json_decode(file_get_contents(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'dataset/lojas.json'))[0];
          
          $div_whatsapp = "";
            ?>
            <div class="col-1-3">
              <p>
                <?= $loja['logradouro'].(!empty($loja['numero']) ? ", ".$loja['numero'] : "").(!empty($loja['complemento']) ? " - ".$loja['complemento']."." : "").(!empty($loja['bairro']) ? " - ".$loja['bairro'] : "").(!empty($loja['cidade']) ? " - ".$loja['cidade'] : "").(!empty($loja['estado']) ? "/".$loja['estado'] : ""); ?><br>
                <?php
                if(!empty($loja['horario_semana']) || !empty($loja['horario_fds'])){
                  echo("Horários: ".$loja['horario_semana']);
                  if(!empty($loja['horario_semana']) && !empty($loja['horario_fds'])){
                    echo(" / ");
                  }
                  echo($loja['horario_fds']);
                }
                ?>
              </p>
            </div>
            <?php

          echo($div_whatsapp);
          ?>
        </div>

        <?php 
            $map = $this->mainLoja['custom_map'];
            $show_map = false;
            if(!empty($map)){
                echo $map;
                $show_map = true;
            }else{ 
        ?>
            <div id="map">
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-1-1">
            <ul class="contact-list">
                <li>
                    <?= !empty($loja['telefone_1_descricao']) ? '<span class="name">'.$loja['telefone_1_descricao'].':</span> ' : ''; ?>
                    <b>
                        <a href="tel:0<?= preg_replace('/\D/', '', $loja['telefone_1']); ?>">
                            <?= str_replace(")", " ", str_replace("(", "", $loja['telefone_1'])); ?>
                        </a>
                    </b>
                </li>
            </ul>
          </div>
        </div>

    </div>
</footer>

<div class="assinatura">
    <div class="container">
        <a href="http://lua4.com/" target="_blank" class="logo-lua4">
            <img src="<?= $this->root_rel ?>img/logo-lua4.svg" alt="Lua4auto">
        </a>
    </div>
</div>

<div class="loading-wrapper">
    <div class="loading-content">
        <div class="loading-img"><img src="<?php echo $this->root_rel ?>img/loading-horizontal.gif" alt=""></div>
        <div class="loading-info">Aguarde, carregando...</div>
    </div>
</div>

<section class="hero">
    <div class="main-slider-desktop">
        <ul class="main-slider js-main-slider">
            <?php
            foreach ($dados_banner as $banner) {
                ?>
                <?php if (!empty($banner['url'])) { ?>
                    <li>
                        <a class="slide" href="<?php echo $banner['url'] ?>">
                            <img src="<?= $banner['arquivo']; ?>" alt="<?= $banner['titulo']; ?>" />
                        </a>
                    </li>

                    <?php
                }
            }
            ?>
        </ul><!-- main-slider-desktop -->
    </div>

</section>
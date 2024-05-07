<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Portfolio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
</head>
<body>
  <div class="fundoEscuro"></div>
  <div class="menu__btn-wrapper">
    <div class="menu__btn">
      <span></span>
    </div> 
  </div>
  <main class="columns js-scroll" id="sobre">
    <div class="sidebar">
      <div class="sidebar__conteudo">
        <div class="icone">
          <img src="<?php the_field2('foto'); ?>" alt="">
        </div>
        <nav>
          <?php
            $args = array(
              'menu' => 'principal',
              'container' => false
            );
            wp_nav_menu( $args );
          ?>
		    </nav>
      </div>
    </div>
    <div class="columns__right">
      <section>
        <div class="title">
          <h1 class="title__t1"><?php the_field2('texto1'); ?></h1>
          <span class="title__t2"><?php the_field2('texto2'); ?></span>
          <p class="title__t3"><?php the_field2('texto3'); ?></p>
          <p class="text">
            <?php the_field2('descricao'); ?>
          </p>
        </div>
      </section>
  
      <section class="projetos js-scroll" id="projetos" >
        <h2 class="portfolio__t1">Projetos</h2>
        <?php
          $projetos = get_field2('projetos');
          if(isset($projetos)) { foreach($projetos as $projeto) {
          ?>
          <div class="projeto__item">
            <div class="projetos__video-wrapper">
              <div class="projetos__video">
                <iframe src="<?php echo $projeto['video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"  allowfullscreen></iframe>
              </div>
            </div>

            <h3 class="projetos__t2"><?php echo $projeto['nome']; ?></h3>
            <p class="projetos__t3">
              <?php echo $projeto['descricao']; ?>
            </p>
            <div class="projetos__links">
              <a href="<?php echo $projeto['site']; ?>" target="_blank">Site</a>
              <a href="<?php echo $projeto['repositorio']; ?>" target="_blank">Repositório</a>
            </div>
          </div>
        <?php } } ?>
      </section>

      <section class="contato js-scroll" id="contato">
        <h2 class="portfolio__t1">Contatos</h2>
        <div class="contato__icons">
        <?php
          $contatos = get_field2('contatos');
          if(isset($projetos)) { foreach($contatos as $contato) {
          ?>
          <div class="contato__box">
            <a href="<?php echo $contato['link']?>" class="contato__link">
              <div class="contato__img">
                <img src="<?php echo $contato['icone']?>" alt="">
              </div>
              <span class="contato__title"><?php echo $contato['rotulo']?></span>
              <span class="contato__text"><?php echo $contato['info']?></span>
            </a>
          </div>
        <?php } } ?>
        </div>
      </section>
    </div>
  </main>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/script.js"></script>  
</body>
</html>

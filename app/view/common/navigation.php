<nav class="flex items-center justify-between h-24  shadow-2xl mt-5">

  <div class="w-full block flex-grow flex items-center h-full  ">
    <div class="text-sm h-full nav-links xl:w-3/4 lg:w-3/4 md:w-2/3 flex justify-between items-center lg:mr-auto pr-2 ">
      <a href="<?=$vars['baseUrl']?>loc=recipe&action=list" class="<?= ($_GET['loc']=='recipe')?'active':''; ?> ml-2 text-lg text-center nav-button block  lg:inline-block lg:mt-0 text-teal-lighter hover:text-white">
        Recettes
      </a>
      <a href="<?=$vars['baseUrl']?>loc=article&action=list" class="<?= ($_GET['loc']=='article')?'active':''; ?> text-lg text-center nav-button block lg:inline-block lg:mt-0 text-teal-lighter text-white ">
      <i class="fas fa-utensils"></i> Articles
      </a>
      <a href="<?=$vars['baseUrl']?>loc=user&action=list" class="<?= ($_GET['loc']=='user')?'active':''; ?> text-lg text-center nav-button block  lg:inline-block lg:mt-0 text-teal-lighter hover:text-white">
        Utilisateurs
      </a>
      <a href="#responsive-header" class="<?= ($_GET['loc']=='statics')?'active':''; ?> mr-2 text-lg text-center nav-button block lg:inline-block lg:mt-0 text-white">
      <i class="far fa-chart-bar"></i> Statistiques
      </a>
    </div>
    <div class="xl:w-1/5 lg:w-1/5 md:w-1/3">
     <label for="" class="text-muted sm:ml-2 "> <i class="far fa-user-circle"></i>  <?=$vars['loggedInUser']->getFirstName();?> Luther</label>
     <a href="<?=$vars['baseUrl']?>loc=user&action=logout" class="ml-5 mr-3"> <i class="fas fa-sign-out-alt"></i>Deconnexion</a>
    </div>
  </div>
</nav>
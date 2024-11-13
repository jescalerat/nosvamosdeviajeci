<nav class="navbar navbar-expand-sm   navbar-dark bg-dark fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('') ?>"><?= $inicio ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('rutas') ?>"><?= $rutas ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('municipios') ?>"><?= $municipios ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('contacta') ?>"><?= $contacta ?></a>
              </li>
          </ul>
          <div class="social-part">
              <a href="<?= site_url('cambioidioma/cambio/es') ?>">
                <img src="<?= base_url('') ?>css/images/es_lang.gif" width="20" height="20" alt="Español">
              </a>
              <a href="<?= site_url('cambioidioma/cambio/en') ?>">
                <img src="<?= base_url('') ?>css/images/en_lang.gif" width="20" height="20" alt="English">
              </a>
              <a href="<?= site_url('cambioidioma/cambio/ca') ?>">
                <img src="<?= base_url('') ?>css/images/ca_lang.gif" width="20" height="20" alt="Català">
              </a>
          </div>
        </div>
      </nav>
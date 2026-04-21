<?php $this->extend('layouts/main') ?>

<?php $this->section('content') ?>

<?php
// Shortcuts to keep the template readable
$nav      = $content['nav']      ?? [];
$hero     = $content['hero']     ?? [];
$signup   = $content['signup']   ?? [];
$form     = $signup['form']      ?? [];
$cs       = $signup['coming_soon'] ?? [];
$features = $content['features'] ?? [];
$about    = $content['about']    ?? [];
$why          = $content['why']          ?? [];
$early_access  = $content['early_access']  ?? [];
$beta_signup   = $content['beta_signup']   ?? [];
$beta_form     = $beta_signup['form']      ?? [];
?>

<!-- =========================================================
     PAGE OVERLAY WRAPPER — navbar + both sections share a
     positioning context so RIGHT-SIDE.png can span all three
     ========================================================= -->
<div class="page-overlay-wrapper">

<!-- =========================================================
     NAVIGATION
     ========================================================= -->
<header role="banner">
    <nav class="navbar navbar-expand-lg site-nav" aria-label="Main navigation">
        <div class="container-fluid ps-0 pe-4">

            <!-- Brand / Logo -->
            <a class="navbar-brand" href="/" aria-label="IronSoftware – go to homepage">
                <img src="<?= base_url('assets/images/NAV-LOGO.png') ?>"
                     alt="<?= esc($nav['logo_alt'] ?? 'IronSoftware') ?>"
                     class="nav-logo"
                     loading="eager">
            </a>

            <!-- Mobile toggle -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#siteNavbar"
                    aria-controls="siteNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav links -->
            <div class="collapse navbar-collapse" id="siteNavbar">
                <ul class="navbar-nav ms-5 align-items-lg-center gap-lg-4" role="list">
                    <?php foreach ($nav['links'] ?? [] as $link): ?>
                        <?php if (! empty($link['dropdown'])): ?>
                            <li class="nav-item dropdown" role="listitem">
                                <a class="nav-link dropdown-toggle"
                                   href="<?= esc($link['url']) ?>"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false">
                                    <?= esc($link['label']) ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                    <li><a class="dropdown-item" href="https://ironsoftware.com/csharp/pdf/">IronPDF</a></li>
                                    <li><a class="dropdown-item" href="https://ironsoftware.com/csharp/ocr/">IronOCR</a></li>
                                    <li><a class="dropdown-item" href="https://ironsoftware.com/csharp/barcode/">IronBarcode</a></li>
                                    <li><a class="dropdown-item" href="https://ironsoftware.com/csharp/excel/">IronXL</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item" role="listitem">
                                <a class="nav-link" href="<?= esc($link['url']) ?>">
                                    <?= esc($link['label']) ?>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container -->
    </nav>
</header>

<main id="main-content">

    <!-- =========================================================
         SECTIONS WRAPPER — hero + signup share a positioning context
         so RIGHT-SIDE.png can span both sections as an overlay
         ========================================================= -->
    <div class="sections-hero-wrapper">

    <!-- =========================================================
         SECTION 1 — HERO
         ========================================================= -->
    <section class="section-hero" aria-labelledby="hero-heading">
        <div class="container hero-container">
            <div class="row align-items-center gy-5">

                <!-- Left: Text content -->
                <div class="col-lg-7">
                    <div class="hero-content-wrap">

                        <!-- IronPDF for C++ branding mark -->
                        <img src="<?= base_url('assets/images/LOGO.svg') ?>"
                             alt="<?= esc($hero['logo_alt'] ?? 'IronPDF for C++') ?>"
                             class="hero-logo"
                             width="232" height="40"
                             loading="eager">

                        <!-- Eyebrow line -->
                        <p class="hero-eyebrow">
                            <?= esc($hero['eyebrow'] ?? '') ?>
                        </p>

                        <!-- Primary heading -->
                        <h1 class="hero-title" id="hero-heading">
                            <?= esc($hero['heading'] ?? '') ?>
                        </h1>

                        <!-- Product name sub-heading -->
                        <p class="hero-subheading" aria-label="<?= esc($hero['subheading'] ?? '') ?>">
                            <?= esc($hero['subheading'] ?? '') ?>
                        </p>

                        <!-- Status badge -->
                        <span class="hero-status-badge" aria-label="Status: <?= esc($hero['status'] ?? '') ?>">
                            <?= esc($hero['status'] ?? '') ?>
                        </span>

                    </div>
                </div>

            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>


    <!-- =========================================================
         SECTION 2 — SIGN-UP / EARLY ACCESS
         ========================================================= -->
    <section class="section-signup" aria-labelledby="signup-heading">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-xl-7">

                    <!-- Headings -->
                    <h2 class="signup-heading" id="signup-heading">
                        <?= esc($signup['heading'] ?? '') ?>
                    </h2>
                    <p class="signup-subheading">
                        <?= esc($signup['subheading'] ?? '') ?>
                    </p>

                    <!-- Sign-up form -->
                    <form action="<?= site_url(esc($form['action'] ?? 'signup')) ?>"
                          method="post"
                          class="signup-form mt-4"
                          novalidate
                          aria-label="Early access sign-up form">

                        <?= csrf_field() ?>

                        <div class="signup-form-group" role="group" aria-label="Email sign-up">
                            <label for="signup-email" class="visually-hidden">
                                Email address
                            </label>
                            <input type="email"
                                   id="signup-email"
                                   name="email"
                                   class="signup-email-input"
                                   placeholder="<?= esc($form['email_placeholder'] ?? 'Enter email address') ?>"
                                   autocomplete="email"
                                   required
                                   aria-required="true"
                                   aria-describedby="email-hint">
                            <button type="submit" class="btn-signup">
                                <?= esc($form['button_text'] ?? 'Sign up now') ?>
                                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                            </button>
                        </div>

                        <?php if (! empty($flash['success'])): ?>
                            <div class="alert-site alert-success-site" role="alert" id="js-flash-msg">
                                <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
                                <?= esc($flash['success']) ?>
                                <button type="button" class="btn-close-alert" aria-label="Dismiss alert">&times;</button>
                            </div>
                        <?php elseif (! empty($flash['error'])): ?>
                            <div class="alert-site alert-error-site" role="alert" id="js-flash-msg">
                                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                                <?= esc($flash['error']) ?>
                                <button type="button" class="btn-close-alert" aria-label="Dismiss alert">&times;</button>
                            </div>
                        <?php endif ?>

                        <p id="email-hint" class="visually-hidden">
                            Enter your email address to receive early access to this beta programme.
                        </p>

                    </form>

                    <!-- Coming Soon row -->
                    <div class="coming-soon-row mt-3" role="note" aria-label="Also coming soon">
                        <span class="badge-coming-soon">
                            <?= esc($cs['badge'] ?? '# Coming Soon') ?>
                        </span>
                        <span class="coming-soon-text">
                            <?= esc($cs['prefix'] ?? '') ?>
                            <?php
                            $platforms = $cs['platforms'] ?? [];
                            foreach ($platforms as $i => $platform):
                                $sep = ($i < count($platforms) - 1) ? ' <span class="coming-soon-sep" aria-hidden="true">|</span> ' : '';
                            ?>
                                <a href="<?= esc($platform['url']) ?>"
                                   class="coming-soon-platform"
                                   aria-label="<?= esc($platform['name']) ?> beta programme">
                                    <?= esc($platform['name']) ?>
                                </a><?= $sep ?>
                            <?php endforeach ?>
                        </span>
                    </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>

    </div><!-- /.sections-hero-wrapper -->

    <!-- =========================================================
         SECTION 3 — FEATURES HIGHLIGHTS
         ========================================================= -->
    <section class="section-features" aria-labelledby="features-heading">
        <div class="container">
            <div class="features-inner">

                <!-- Title + badge -->
                <div class="features-title-wrap">
                    <span class="features-title" id="features-heading">
                        <?= esc($features['title'] ?? 'IronPDF for C++') ?>
                    </span>
                    <img src="<?= base_url('assets/images/badge.png') ?>"
                         alt="<?= esc($features['badge_alt'] ?? 'Coming Soon') ?>"
                         class="features-badge"
                         loading="lazy">
                </div>

                <!-- Feature items -->
                <ul class="features-list" role="list" aria-label="Key features">
                    <?php foreach ($features['items'] ?? [] as $i => $item): ?>
                        <?php if ($i > 0): ?>
                            <li class="features-sep" aria-hidden="true">|</li>
                        <?php endif ?>
                        <li class="features-item">
                            <span class="features-hash" aria-hidden="true">#</span>
                            <?= esc($item) ?>
                        </li>
                    <?php endforeach ?>
                </ul>

            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 4 — ABOUT / BODY COPY
         ========================================================= -->
    <section id="about" class="section-about" aria-label="About IronPDF for C++">
        <div class="container">
            <div class="about-inner">
                <?php foreach ($about['paragraphs'] ?? [] as $para): ?>
                    <?php
                        // Replace {strong}...{/strong} placeholders with <strong> tags
                        $html = esc($para['text'] ?? '');
                        $html = str_replace('{strong}',  '<strong>', $html);
                        $html = str_replace('{/strong}', '</strong>', $html);
                    ?>
                    <p class="about-text"><?= $html ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 5 — WHY C++ PDF LIBRARY
         ========================================================= -->
    <section class="section-why" aria-labelledby="why-heading">
        <div class="container">
            <div class="why-inner">

                <!-- Left: icon -->
                <div class="why-icon-wrap" aria-hidden="true">
                    <img src="<?= base_url('assets/images/HTMLtoPDFicon.svg') ?>"
                         alt="<?= esc($why['icon_alt'] ?? 'HTML to PDF conversion icon') ?>"
                         class="why-icon"
                         loading="lazy">
                </div>

                <!-- Right: text -->
                <div class="why-content">
                    <h2 class="why-heading" id="why-heading">
                        <?= esc($why['heading_plain'] ?? 'Why make a ') ?><span class="why-heading-highlight"><?= esc($why['heading_highlight'] ?? 'C++ PDF Library') ?></span>
                    </h2>
                    <?php foreach ($why['paragraphs'] ?? [] as $para): ?>
                        <p class="why-text"><?= esc($para) ?></p>
                    <?php endforeach ?>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 6 — EARLY ACCESS PRODUCTS
         ========================================================= -->
    <section id="products" class="section-early-access" aria-labelledby="early-access-heading">
        <div class="container">
            <div class="early-access-inner">

                <h2 class="early-access-heading" id="early-access-heading">
                    <?= esc($early_access['heading_plain'] ?? 'Early Access to ') ?><span class="early-access-heading-highlight"><?= esc($early_access['heading_highlight'] ?? 'C++ PDF Library') ?></span>
                </h2>

                <p class="early-access-body">
                    <?= esc($early_access['body'] ?? '') ?>
                </p>

                <!-- Product cards -->
                <div class="early-access-cards" role="list" aria-label="Available products">
                    <?php foreach ($early_access['products'] ?? [] as $product): ?>
                        <div class="ea-card" role="listitem">
                            <span class="ea-badge<?= ! empty($product['badge_released']) ? ' ea-badge--released' : '' ?>">
                                <?= esc($product['badge']) ?>
                            </span>
                            <div class="ea-product-info">
                                <span class="ea-product-name-row"><span class="ea-product-name"><?= esc($product['name']) ?></span><span class="ea-product-pdf">PDF</span></span>
                                <span class="ea-product-subtitle"><?= esc($product['subtitle']) ?></span>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 7 — BETA SIGN-UP CTA
         ========================================================= -->
    <section class="section-beta-signup" aria-labelledby="beta-signup-heading">
        <div class="container">
            <div class="beta-signup-inner">

                <h2 class="beta-signup-heading" id="beta-signup-heading">
                    <?= esc($beta_signup['heading_plain'] ?? 'Sign up to our ') ?><span class="beta-signup-heading-highlight"><?= esc($beta_signup['heading_highlight'] ?? 'Beta Program') ?></span>
                </h2>

                <form action="<?= site_url(esc($beta_form['action'] ?? 'signup')) ?>"
                      method="post"
                      class="signup-form beta-signup-form mt-4"
                      novalidate
                      aria-label="Beta programme sign-up form">

                    <?= csrf_field() ?>

                    <div class="signup-form-group" role="group" aria-label="Email sign-up">
                        <label for="beta-email" class="visually-hidden">
                            Email address
                        </label>
                        <input type="email"
                               id="beta-email"
                               name="email"
                               class="signup-email-input"
                               placeholder="<?= esc($beta_form['email_placeholder'] ?? 'Enter email adress') ?>"
                               autocomplete="email"
                               required
                               aria-required="true"
                               aria-describedby="beta-email-hint">
                        <button type="submit" class="btn-signup">
                            <?= esc($beta_form['button_text'] ?? 'Sign up now') ?>
                            <i class="bi bi-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>

                    <p id="beta-email-hint" class="visually-hidden">
                        Enter your email address to sign up for the Beta Program.
                    </p>

                </form>

            </div>
        </div>
    </section>

</main>

    <!-- Right-side image: spans navbar + hero + signup via page-overlay-wrapper -->
    <img src="<?= base_url('assets/images/RIGHT-SIDE.png') ?>"
         alt=""
         class="hero-right-image"
         width="600" height="500"
         aria-hidden="true"
         loading="eager">

</div><!-- /.page-overlay-wrapper -->

<?php $this->endSection() ?>

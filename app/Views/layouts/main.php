<!DOCTYPE html>
<html lang="<?= esc($content['site']['lang'] ?? 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($content['site']['description'] ?? '') ?>">

    <!-- Open Graph / Social sharing -->
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="<?= esc($title ?? 'IronPDF for C++') ?>">
    <meta property="og:description" content="<?= esc($content['site']['description'] ?? '') ?>">

    <title><?= esc($title ?? 'IronPDF for C++') ?></title>


    <!-- Bootstrap 5.3 CSS (latest) -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS (loaded last to allow clean overrides) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <?= $this->renderSection('styles') ?>
</head>
<body>

    <!-- Skip to main content (keyboard accessibility) -->
    <a class="skip-link" href="#main-content">Skip to main content</a>

    <?= $this->renderSection('content') ?>

    <!-- Bootstrap 5.3 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous" defer></script>

    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/main.js') ?>" defer></script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>

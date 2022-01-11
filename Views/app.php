<!DOCTYPE html>
<html id="preload" class="preload" lang="<?= APP_LANGUAGE ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="<?= !empty($meta) ? $meta : '' ?>" />
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="<?= SITE_URL ?>/css/material-design-icons.min.css" rel="stylesheet">
    <link href="<?= SITE_URL ?>/css/vuetify.min.css" rel="stylesheet">
    <link href="<?= SITE_URL ?>/css/app.min.css" rel="stylesheet">
    <?php if (!empty($data['styles'])): ?>
    <?php foreach ($data['styles'] as $style): ?>
    <?php if (isset($style['external']) AND $style['external']): ?>
    <link href="<?= $style['url']; ?>" rel="stylesheet">
    <?php else: ?>
    <link
        href="<?= SITE_URL ?>/assets/css/<?= $style['name'] ?>.css<?= !empty($style['version']) ? "?v={$style['version']}" : '' ?>"
        rel="stylesheet">

    <?php endif ?>

    <?php endforeach ?>
    <?php endif ?>
</head>

<body class="body-preload">
    <?= new Controller\Template('parts/preloader') ?>
    <div id="app-container">
        <!-- Sizes your content based upon application components -->
        <v-app class="preloading" light>
            <!-- Provides the application the proper gutter -->
            <?php if ($data['header']): ?>
            <?= new Controller\Template('parts/header') ?>
            <?php endif ?>
            <?php if ($data['admin_header']) : ?>
            <?= new Controller\Template('admin/parts/header') ?>
            <?php endif ?>
            <v-content class="bg-white" tag="main">
                <v-container class="p" fluid>
                    <?= $content; ?>
                </v-container fluid>
            </v-content>
            <?php if ($data['footer']): ?>
            <?= new Controller\Template('parts/footer') ?>
            <?php endif ?>

        </v-app>
    </div>
    <script src="<?= SITE_URL ?>/js/preload.js"></script>
    <?php if (DEV_ENV) : ?>
    <script src="<?= SITE_URL ?>/js/vue.js"></script>
    <?php else: ?>
    <script src="<?= SITE_URL ?>/js/vue.pmin.js"></script>
    <?PHP endif ?>

    <script src="<?= SITE_URL ?>/js/components/vuetify.min.js?v=1.0.0"></script>
    <script src="<?= SITE_URL ?>/js/components/vue-resource.min.js"></script>
    <script src="<?= SITE_URL ?>/js/Classes/Http.min.js"></script>
    <script src="<?= SITE_URL ?>/js/theme.js"></script>
    <script src="<?= SITE_URL ?>/js/setup.js"></script>
    <?php if (!empty($data['scripts'])): ?>
    <?php foreach ($data['scripts'] as $script): ?>
    <?php if (isset($script['external']) && $script['external']): ?>

    <script src="<?= $script['name']; ?>" <?php if (isset($data['props'])) echo $data['props'] ?>></script>

    <?php else: ?>

    <script
        src="<?= SITE_URL ?>/assets/js/<?= $script['name']; ?>.js<?= !empty($script['version']) ? "?v={$script['version']}" : '' ?>">
    </script>

    <?php endif ?>

    <?php endforeach ?>

    <?php else: ?>
    <script src="<?= SITE_URL ?>/js/main.js"></script>
    <?php endif ?>

</body>

</html>
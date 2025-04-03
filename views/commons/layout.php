<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <meta name="description" content="<?= $description ?>">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="<?= ROOT ?>/public/css/<?= $style ?>">
    </head>
    <body>
        <?= $content ?>
        <script src="<?= ROOT ?>/public/javascript/<?= $js ?>"></script>
    </body>
</html>
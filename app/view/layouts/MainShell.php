<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DeepState</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script type="module" src="<?= get_template_directory_uri(); ?>/assets/js/main.js"></script>
    <?php if (!empty($page_styles)): ?>
        <?php foreach ($page_styles as $style): ?>
            <link rel="stylesheet" href="<?php echo esc_url($style); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    

    <div class="wrapper">
        <?php include get_template_directory() . '/app/view/partials/header.php'; ?>
        <?php include get_template_directory() . '/app/view/partials/sidebar.php'; ?>
        <main class="content">
            <?php echo $content; ?>
        </main>
    </div>

    <?php include get_template_directory() . '/app/view/partials/footer.php'; ?>
</body>
</html>
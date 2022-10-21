<?php
/*
 * Template is just html to extends many times as is needed
 * $title (overrideable variable - to fill the correct title in each page)
 * $content (overrideable variable - to fill the correct content in each page)
 */
?>


<!DOCTYPE HTML PUBLIC>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200;400;700&display=swap" rel="stylesheet">
    <title>
        <?php echo (isset($title) ? $title : 'index') ?>
    </title>
    <style>
        .font-source-code-pro {
            font-family: 'Source Code Pro', monospace;
        }
    </style>
</head>
<body>
<div id="main" class="min-h-screen bg-gray-200 p-8">
    <!-- content -->
    <?php
    echo(isset($content) ? $content : '<h1>The view should override `$content` value</h1>');
    ?>
</div>
</body>
</html>
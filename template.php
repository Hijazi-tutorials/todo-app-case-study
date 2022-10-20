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
    <title>
        <?php echo (isset($title) ? $title : 'index') ?>
    </title>
</head>
<body>
<div id="main" class="h-screen bg-gray-200 p-8">
    <!-- content -->
    <?php
    echo(isset($content) ? $content : '<h1>The view should override `$content` value</h1>');
    ?>
</div>
</body>
</html>
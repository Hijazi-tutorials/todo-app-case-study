<?php
require_once '../utils/buffer_session_init.php';
$completedItems = $_SESSION['items']['completed'];
?>

<div>
    <h3 class="text-3xl">
        What did you achieve so far
        <span>(Completed items)</span>
    </h3>
    <div>
        <?php if (! sizeof($completedItems)) { ?>
            <h4 class="text-2xl">
                Poor! you did not have any completed items
            </h4>
        <?php  } ?>
        <ul>
            <?php foreach ($completedItems as $item) { ?>
            <li>
                <?php echo $item['title'] ?>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>


<?php
require_once '../utils/handle_render_template.php';


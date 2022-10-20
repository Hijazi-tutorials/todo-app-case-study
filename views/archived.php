<?php
require_once '../utils/buffer_session_init.php';
$deletedItems = $_SESSION['items']['deleted'];
?>

    <div>
        <h3 class="text-3xl">
            What did you achieve so far
            <span>(Completed items)</span>
        </h3>
        <div>
            <?php if (! sizeof($deletedItems)) { ?>
                <h4 class="text-2xl">
                    No archived items!
                </h4>
            <?php  } ?>
            <ul>
                <?php foreach ($deletedItems as $item) { ?>
                    <li>
                        <?php echo $item['title'] ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>


<?php
require_once '../utils/handle_render_template.php';


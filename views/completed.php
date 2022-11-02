<?php
require_once '../utils/buffer_session_init.php';
?>

<div class="bg-gray-100 space-y-12 py-10 rounded-2xl">
    <div>
        <h3 class="text-3xl text-center font-source-code-pro">
            Completed items
        </h3>
        <?php if ($_SESSION['redirect_message'] ?? false) { ?>
            <div class="bg-green-500 my-8 py-4 font-source-code-pro text-lg text-white text-center">
                <?php
                echo $_SESSION['redirect_message'];
                unset($_SESSION['redirect_message']);
                ?>
            </div>
        <?php } ?>
    </div>
    <!-- completed item element -->
    <div class="container mx-auto">
        <?php
        $i = 1;
        foreach ($completedItems as $completedItem) { ?>
            <div class="bg-white my-4 max-w-sm mx-auto rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer">
                <?php
                    $itemId = $completedItem['id'];
                    $itemTitle = $completedItem['title'];
                    $itemDescription = $completedItem['description'];
                    $completedAt = $completedItem['completed_at'];
                ?>
                <div class="h-20 bg-green-500 flex items-center justify-start gap-3">
                    <h1 class="text-white ml-4 border-2 py-2 px-4 rounded-full">
                        <?php echo $i++; ?>
                    </h1>
                    <p class="mr-20 text-white text-lg">
                        <?php echo $itemTitle; ?>
                    </p>
                </div>

                <div class="flex items-center px-4 gap-3">
                    <form method="POST" action="../actions/assign_item_as_uncompleted.php" id="completed-item-<?php echo $itemId ?>" class='my-0'>
                        <input hidden name="item_id" value="<?php echo $itemId ?>"/>
                        <input type="checkbox" onclick="document.getElementById('completed-item-<?php echo $itemId ?>').submit()"
                               checked class='h-6 w-6 bg-white checked:scale-75 transition-all duration-200 peer'/>
                    </form>
                    <p class="py-6 text-lg tracking-wide gap-2 text-green-800">
                        <?php echo $itemDescription ?>
                    </p>
                </div>

                <form action="../actions/assign_item_as_deleted.php" method="POST">
                    <input hidden name="item_id" value="<?php echo  $itemId ?>" />
                    <input hidden name="delete_from" value="completed-list" />
                    <button type="submit"
                            class="text-sm bg-red-500 text-white px-3 py-2 mx-4 rounded hover:bg-white hover:text-red-500 duration-500">
                        Delete
                    </button>
                </form>

                <div class="flex justify-between px-5 my-4 text-sm text-gray-600">
                    <p>Completed at</p>
                    <p>
                        <?php echo $completedAt ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
require_once '../utils/handle_render_template.php';
?>


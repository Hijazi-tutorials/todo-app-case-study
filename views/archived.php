<?php
require_once '../utils/buffer_session_init.php';
require_once '../constants/AppLists.php';
?>

<div class="bg-gray-100 space-y-12 py-10 rounded-2xl">
    <div>
        <h3 class="text-3xl text-center font-source-code-pro">
            Archived items
        </h3>
        <?php if ($_SESSION['redirect_message'] ?? false) { ?>
            <div class="bg-red-500 my-8 py-4 font-source-code-pro text-lg text-white text-center">
                <?php
                echo $_SESSION['redirect_message'];
                unset($_SESSION['redirect_message']);
                ?>
            </div>
        <?php } ?>
    </div>
    <div class="container mx-auto">
        <?php
        $i = 1;
        ?>
        <?php foreach ($deletedItems as $deletedItem) { ?>
            <?php
            $id = $deletedItem['id'];
            $title = $deletedItem['title'];
            $description = $deletedItem['description'];
            $deleted_at = $deletedItem['deleted_at'];
            $deleted_from = $deletedItem['deleted_from'];
            ?>
            <div class="bg-white my-4 max-w-sm mx-auto rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer">
                <div class="h-20 bg-red-500 flex items-center justify-start gap-3">
                    <h1 class="text-white ml-4 border-2 py-2 px-4 rounded-full">
                        <?php echo $i++ ?>
                    </h1>
                    <p class="mr-20 text-white text-lg">
                        <?php echo $title ?>
                    </p>
                </div>

                <p class="py-6 text-lg tracking-wide px-4 flex items-center gap-2 text-red-800">
                    <?php echo $description ?>
                </p>

                <div>
                    <!-- if it's deleted from completed page -->
                    <?php if ($deleted_from == AppLists::TODO) { ?>
                        <form action="../actions/recover_item.php" method="POST">
                            <!-- {$id} -->
                            <input hidden name="item_id" value="<?php echo $id ?>">
                            <input hidden name="recover_to" value="todo-list"/>
                            <button type="submit"
                                    class="text-sm bg-purple-500 text-white px-3 py-2 mx-4 rounded hover:bg-white hover:text-purple-500 duration-500">
                                Recover
                            </button>
                        </form>
                    <?php } ?>
                    <!-- if it's deleted from to.do page -->
                    <?php if ($deleted_from == AppLists::COMPLETED) { ?>
                        <form action="../actions/recover_item.php" method="POST" id="archived-item-{$id}">
                            <!-- {$id} -->
                            <input hidden name="item_id" value="<?php echo $id ?>">
                            <input hidden name="recover_to" value="completed-list"/>
                            <button class="text-sm bg-green-500 text-white px-3 py-2 mx-4 rounded hover:bg-white hover:text-green-500 duration-500">
                                Recover
                            </button>
                        </form>
                    <?php } ?>
                </div>
                <!-- <hr > -->
                <div class="flex justify-between px-5 mb-2 text-sm text-gray-600">
                    <p>Deleted at</p>
                    <p>
                        <?php echo $deleted_at ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
require_once '../utils/handle_render_template.php';
?>


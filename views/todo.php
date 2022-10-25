<?php
require_once '../utils/buffer_session_init.php';
?>

<div class="bg-gray-100 space-y-12 py-10 rounded-2xl">
    <div>
        <h3 class="text-3xl text-center font-source-code-pro"> Todo items </h3>
        <?php if ($_SESSION['redirect_message'] ?? false) { ?>
            <div class="bg-purple-500 my-8 py-4 font-source-code-pro text-lg text-white text-center">
                <?php
                echo $_SESSION['redirect_message'];
                unset($_SESSION['redirect_message']);
                ?>
            </div>
        <?php } ?>
    </div>
    <!-- to-do item element -->
    <div class="container flex justify-center gap-16">
        <div class="w-80 border-r border-r-2 pr-4 border-purple-500">
            <form action="../actions/create_todo_item.php" method="POST">
                <div class="mb-6">
                    <label for="title"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                    <input type="text" id="title" name="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="i have to .." required="">
                </div>
                <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                    <input type="text" id="description" name="description"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="i have to more details" required="">
                </div>
                <button type="submit"
                        class="text-white bg-purple-500 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
            </form>
        </div>
        <div>
            <?php $i = 1; ?>
            <?php foreach ($todoItems as $todoItem) { ?>
                <?php
                $itemId = $todoItem['id'];
                $itemTitle = $todoItem['title'];
                $itemDescription = $todoItem['description'];
                $itemCreatedAt = $todoItem['created_at'];
                ?>
                <div class="w-80 mb-6">
                    <div class="bg-white max-w-sm mx-auto rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer">
                        <div class="h-20 bg-purple-500 flex items-center justify-start gap-3">
                            <h1 class="text-white ml-4 border-2 py-2 px-4 rounded-full">
                                <?php echo $i++; ?>
                            </h1>
                            <p class="mr-20 text-white text-lg">
                                <?php echo $itemTitle; ?>
                            </p>
                        </div>
                        <form action="../actions/assign_item_as_completed.php" method="POST"
                              id="todo-item-<?php echo $itemId; ?>"
                              class="my-0 flex items-center px-4 gap-3">
                                <span class=''>
                                  <input hidden name="item_id" value="<?php echo $itemId; ?>">
                                  <input type="checkbox"
                                         onclick="document.getElementById('todo-item-<?php echo $itemId; ?>').submit()"
                                         class='h-6 w-6 bg-white checked:scale-75 transition-all duration-200 peer'/>
                                </span>
                            <p class="py-6 text-lg tracking-wide gap-2 text-purple-800">
                                <?php echo $itemDescription; ?>
                            </p>
                        </form>
                        <form action="" method="">
                            <input hidden name="todo-item" value="<?php echo $itemId; ?>">
                            <button type="submit"
                                    class="text-sm bg-red-500 text-white px-3 py-2 mx-4 rounded hover:bg-white hover:text-red-500 duration-500">
                                Delete
                            </button>
                        </form>
                        <div class="flex justify-between px-5 my-4 text-sm text-gray-600">
                            <p>Created at</p>
                            <p>
                                <?php echo $itemCreatedAt; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
require_once '../utils/handle_render_template.php';
?>

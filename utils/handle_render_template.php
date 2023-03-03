<?php
/*
 * [FILE DOCUMENT]
 * to gain the expected behavior
 * before extend this script
 * content (including PHP & HTML & ..) should be after extend/import this script `utils/buffer_session_init.php`
 */

$includedFiles = get_included_files();
$requiredFile = __DIR__ . "/buffer_session_init.php";

if (! in_array($requiredFile, $includedFiles)) {
    throw new Exception('[BAD USAGE] to use `handle_render_template` util correctly, you have to include (import) `buffer_session_init.php` at the top of your file.');
}

$content = ob_get_contents();
// turn off & clean output buffering
ob_end_clean();
// all stuff is ready to render
require_once __DIR__ . '/../template.php';
<?php
/*
 * [FILE DOCUMENT]
 * to gain the expected behavior
 * before extend this script
 * content (including PHP & HTML & ..) should be after extend/import this script `utils/buffer_session_init.php`
 */

$includedFilesStr = join("", get_included_files());
// throw exception if `buffer_session_init.php` isn't imported/extended
if (! strpos($includedFilesStr, 'buffer_session_init.php')) {
    throw new Exception('You cant import this script without first import `buffer_session_init.php`');
}

$content = ob_get_contents();
// turn off & clean output buffering
ob_end_clean();
// all stuff is ready to render
require_once __DIR__ . '/../template.php';
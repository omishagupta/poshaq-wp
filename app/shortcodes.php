<?php namespace poshaq;

use poshaq\Controllers\ShortcodeController;

/** @var \Herbert\Framework\Shortcode $shortcode */

if(!function_exists('pshq_get_content')) {
    function pshq_get_content() {
        return get_content_ID();
    }
}

$shortcode->add('poshaq', function() {
    return (new ShortcodeController)->embed();
});
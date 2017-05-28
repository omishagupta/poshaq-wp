<?php

namespace poshaq\Controllers;

class ShortcodeController {

    public function embed()
    {
        return (string)\get_the_ID();
    }

}
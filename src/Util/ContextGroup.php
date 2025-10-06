<?php

namespace App\Util;

enum ContextGroup: string {
    const MOD_INDEX = 'context_mod_index';
    const MOD_FILE_INDEX = 'context_mod_file_index';
    const SEARCH = 'search';
}

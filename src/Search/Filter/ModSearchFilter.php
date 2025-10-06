<?php

namespace App\Search\Filter;

use App\Entity\ModSide;

class ModSearchFilter {
    public ?string $query = null;
    public ?array $categories = [];
    public ?array $loaders = [];
    public ?array $gameVersions = [];
    public ?ModSide $side = null;
}

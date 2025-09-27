<?php

namespace App\Entity;

enum ModLoader: string
{
    case LOADER_FORGE = "loader_forge";
    case LOADER_FABRIC = "loader_fabric";
    case LOADER_QUILT = "loader_quilt";
    case LOADER_NEOFORGE = "loader_neoforge";
}

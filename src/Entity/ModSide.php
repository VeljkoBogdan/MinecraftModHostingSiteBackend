<?php

namespace App\Entity;

enum ModSide: string
{
    case SIDE_CLIENT = "side_client";
    case SIDE_SERVER = "side_server";
    case SIDE_BOTH = 'side_both';
}

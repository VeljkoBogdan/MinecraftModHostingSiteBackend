<?php

namespace App\Entity;

enum UserRole: string {
    case ROLE_ADMIN = 'role_admin';
    case ROLE_EDITOR = 'role_editor';
    case ROLE_SUBSCRIBER = 'role_subscriber';
    case ROLE_GUEST = 'role_guest';
}

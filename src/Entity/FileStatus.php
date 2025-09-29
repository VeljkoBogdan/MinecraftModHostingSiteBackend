<?php

namespace App\Entity;

enum FileStatus: string {

    case DISABLED = 'status_disabled';
    case WAITING_APPROVAL = 'status_waiting_approval';
    case APPROVED = 'status_approved';
}

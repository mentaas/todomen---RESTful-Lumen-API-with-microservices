<?php

namespace App\Enums;

abstract class WorkspaceInvitationStatus extends BasicEnum
{
    const Pending = 0;
    const Accepted = 1;
    const Refused = 2;
}


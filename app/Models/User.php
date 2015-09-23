<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;
use Fenos\Notifynder\Notifable;

class User extends CartalystUser
{
    use Notifable;
}
<?php

namespace App\FLA\Common\Model;

use App\FLA\Core\AbstractModel;

class User extends AbstractModel
{

    protected $table = 't_user';
    protected $primaryKey = 'user_id';

}
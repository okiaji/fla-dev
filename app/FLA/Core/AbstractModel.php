<?php

namespace App\FLA\Core;
use App\FLA\Core\Util\DateUtil;
use Illuminate\Database\Eloquent\Model;

class AbstractModel extends model
{
    public $timestamps = true;
    protected $dateFormat = 'YmdHis';
    const CREATED_AT = 'create_datetime';
    const UPDATED_AT = 'update_datetime';

    public function add(array $options = []){
        parent::save($options);
        return parent::getAttributes();
    }

    public function edit(array $options = []){
        $this->timestamps = false;
        parent::setAttribute("version", parent::getAttribute("version")+1);
        parent::setAttribute(self::UPDATED_AT, DateUtil::currentDatetime());
        parent::save($options);
        return parent::getAttributes();
    }

    public static function getTableName(){
        return with(new static)->getTable();
    }

}
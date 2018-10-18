<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const STATE_UNSTART=0;
    const STATE_START=1;
    const STATE_OTHER=2;
    //
    protected $table='projects';
    public $timestamps=true;
    protected function asDateTime($value)
    {
        return $value;
    }
    public function fromDateTime($value)
    {
        return empty($value) ? $value : date('Y-m-d H-i-s');
    }

    public function state($ind=null)
    {
        $arr=[
            self::STATE_UNSTART=>'未启动',
            self::STATE_START=>'已启动',
            self::STATE_OTHER=>'其他',
        ];
        if($ind!==null){
            return array_key_exists($ind,$arr)?$arr[$ind]:$arr[self::STATE_OTHER];
        }
        return $arr;
    }
}

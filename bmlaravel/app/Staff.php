<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/2
 * Time: 15:39
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    const SEX_UN=10;
    const  SEX_BOY=20;
    const  SEX_GIRL=30;

    protected $table='staff';
    public $timestamps=true;
    protected function asDateTime($value)
    {
        return $value;
    }
    public function fromDateTime($value)
    {
        return empty($value) ? $value : date('Y-m-d H-i-s');
    }

    public function sex($ind=null){
        $arr=[
            self::SEX_UN => '未知',
            self::SEX_BOY=>'男',
            self::SEX_GIRL=>'女',
        ];
        if($ind!==null){
            return array_key_exists($ind,$arr)?$arr[$ind]:$arr[self::SEX_UN];
        }
        return $arr;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/4
 * Time: 17:16
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table='record';
    public $timestamps=true;
    protected function asDateTime($value)
    {
        return $value;
    }
    public function fromDateTime($value)
    {
        return empty($value) ? $value : date('Y-m-d H-i-s');
    }
}
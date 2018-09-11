<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/6
 * Time: 12:48
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table='project';
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
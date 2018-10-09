<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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
}

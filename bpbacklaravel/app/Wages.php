<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wages extends Model
{
    //
    protected $table='wages';
    public $timestamps=true;
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    protected function asDateTime($value)
    {
        return $value;
    }
    public function fromDateTime($value)
    {
        return empty($value) ? $value : date('Y-m-d H-i-s');
    }
}

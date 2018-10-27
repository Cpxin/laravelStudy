<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    protected $table='records';
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

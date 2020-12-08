<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CarparkLog extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'carpark_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'time_in',
        'time_out',
        'price',
        'carplate_id',
        'location_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function carplate()
    {
        return $this->belongsTo(VehicleManagement::class, 'carplate_id');
    }

    public function location()
    {
        return $this->belongsTo(CarparkLocation::class, 'location_id');
    }
}

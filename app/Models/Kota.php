<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'kota';

    public $orderable = [
        'id',
        'provinsi.nama',
        'nama',
    ];

    public $filterable = [
        'id',
        'provinsi.nama',
        'nama',
    ];

    protected $fillable = [
        'provinsi_id',
        'nama',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

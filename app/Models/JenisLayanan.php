<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisLayanan extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Auditable;

    public $table = 'jenis_layanans';

    public $orderable = [
        'id',
        'nama',
        'deskripsi',
        'biaya',
        'pelayanan_online',
    ];

    public $filterable = [
        'id',
        'nama',
        'deskripsi',
        'biaya',
        'syarat_layanan.nama',
    ];

    protected $casts = [
        'pelayanan_online' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'deskripsi',
        'biaya',
        'pelayanan_online',
    ];

    public function syaratLayanan()
    {
        return $this->belongsToMany(SyaratLayanan::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontak extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Auditable;

    public const JENIS_KONTAK_SELECT = [
        '0' => 'Alamat',
        '1' => 'Kantor',
        '2' => 'Pelayanan',
        '3' => 'Sosial Media',
    ];

    public $table = 'kontaks';

    public $orderable = [
        'id',
        'nama',
        'kontak',
        'jenis_kontak',
    ];

    public $filterable = [
        'id',
        'nama',
        'kontak',
        'jenis_kontak',
    ];

    protected $fillable = [
        'nama',
        'kontak',
        'jenis_kontak',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getJenisKontakLabelAttribute($value)
    {
        return static::JENIS_KONTAK_SELECT[$this->jenis_kontak] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('project.datetime_format'));
    }
}

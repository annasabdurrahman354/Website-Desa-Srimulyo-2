<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pelayanan extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public const RATING_RADIO = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
    ];

    public const STATUS_SELECT = [
        'Terkirim'   => 'Terkirim',
        'Verifikasi' => 'Verifikasi',
        'Revisi'     => 'Revisi',
        'Selesai'    => 'Selesai',
        'Dibatalkan'    => 'Dibatalkan',
    ];

    public $table = 'pelayanans';

    public static $search = [
        'kode',
    ];

    public $orderable = [
        'id',
        'pemohon.name',
        'pemohon.nomor_telepon',
        'jenis_layanan.nama',
        'jenis_layanan.pelayanan_online',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
        'status',
        'rating',
        'penilaian_pemohon',
    ];

    public $filterable = [
        'id',
        'pemohon.name',
        'pemohon.nomor_telepon',
        'jenis_layanan.nama',
        'jenis_layanan.pelayanan_online',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
        'status',
        'rating',
        'penilaian_pemohon',
    ];

    public $filterable_user = [
        'jenis_layanan.nama',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
    ];

    protected $appends = [
        'berkas_hasil',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pemohon_id',
        'jenis_layanan_id',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
        'status',
        'rating',
        'penilaian_pemohon',
    ];

    public function pemohon()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class);
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    public function getBerkasHasilAttribute()
    {
        return $this->getMedia('pelayanan_berkas_hasil')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getRatingLabelAttribute($value)
    {
        return static::RATING_RADIO[$this->rating] ?? null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setDeletedAtAttribute($value)
    {
        $this->attributes['deleted_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

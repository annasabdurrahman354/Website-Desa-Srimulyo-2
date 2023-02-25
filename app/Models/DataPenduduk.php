<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DataPenduduk extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public $table = 'data_penduduks';

    public static $search = [
        'judul',
    ];

    public $filterable = [
        'id',
        'judul',
        'slug',
        'tahun_pembaruan',
        'deskripsi',
    ];

    public $orderable = [
        'id',
        'judul',
        'slug',
        'tahun_pembaruan',
        'deskripsi',
        'is_grafik',
        'is_tabel',
        'is_aktif',
    ];

    protected $appends = [
        'berkas_data',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_grafik' => 'boolean',
        'is_tabel'  => 'boolean',
        'is_aktif'  => 'boolean',
    ];

    protected $fillable = [
        'judul',
        'slug',
        'tahun_pembaruan',
        'deskripsi',
        'is_grafik',
        'is_tabel',
        'is_aktif',
    ];

    public function getBerkasDataAttribute()
    {
        return $this->getMedia('data_penduduk_berkas_data')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getBerkasDataTypeAttribute()
    {
        
        return pathinfo($this->getMedia('data_penduduk_berkas_data')[0]->file_name, PATHINFO_EXTENSION);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function syncMediaName(){
        foreach($this->getMedia('data_penduduk_berkas_data') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }
}

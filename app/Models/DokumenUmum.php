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
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DokumenUmum extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public $table = 'dokumen_umums';

    public static $search = [
        'judul',
    ];

    public $filterable = [
        'id',
        'judul',
        'slug',
        'tahun_terbit',
        'deskripsi',
    ];

    public $orderable = [
        'id',
        'judul',
        'slug',
        'tahun_terbit',
        'deskripsi',
        'is_aktif',
    ];

    protected $appends = [
        'berkas_dokumen',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'judul',
        'slug',
        'tahun_terbit',
        'deskripsi',
        'is_aktif',
    ];

    public function getBerkasDokumenAttribute()
    {
        return $this->getMedia('dokumen_umum_berkas_dokumen')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function syncMediaName(){
        foreach($this->getMedia('dokumen_umum_berkas_dokumen') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }
}

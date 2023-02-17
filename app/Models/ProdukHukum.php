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

class ProdukHukum extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public const JENIS_SELECT = [
        'Peraturan Desa'                       => 'Peraturan Desa',
        'Peraturan Bersama Kepala Desa'        => 'Peraturan Bersama Kepala Desa',
        'Peraturan Kepala Desa'                => 'Peraturan Kepala Desa',
        'Peraturan Badan Permusyawaratan Desa' => 'Peraturan Badan Permusyawaratan Desa',
        'Keputusan Kepala Desa'                => 'Keputusan Kepala Desa',
        'Keputusan Badan Permusyawaratan Desa' => 'Keputusan Badan Permusyawaratan Desa',
    ];

    public $table = 'produk_hukums';

    public static $search = [
        'judul',
        'jenis',
    ];

    public $filterable = [
        'id',
        'judul',
        'slug',
        'jenis',
        'tahun',
    ];

    public $orderable = [
        'id',
        'judul',
        'slug',
        'jenis',
        'tahun',
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
        'jenis',
        'tahun',
        'is_aktif',
    ];

    public function getJenisLabelAttribute($value)
    {
        return static::JENIS_SELECT[$this->jenis] ?? null;
    }

    public function getBerkasDokumenAttribute()
    {
        return $this->getMedia('produk_hukum_berkas_dokumen')->map(function ($item) {
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
        foreach($this->getMedia('produk_hukum_berkas_dokumen') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }
}

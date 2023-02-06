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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Produk extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public $table = 'produks';

    public static $search = [
        'nama',
    ];

    public $filterable = [
        'id',
        'umkm.nama_umkm',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'satuan.satuan',
        'kategori.kategori',
    ];

    public $orderable = [
        'id',
        'umkm.nama_umkm',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'satuan.satuan',
        'kategori.kategori',
        'is_tersedia',
        'is_tampilkan',
    ];

    protected $appends = [
        'foto',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_tersedia'  => 'boolean',
        'is_tampilkan' => 'boolean',
    ];

    protected $fillable = [
        'umkm_id',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'satuan_id',
        'kategori_id',
        'is_tersedia',
        'is_tampilkan',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
            ->width($thumbnailWidth)
            ->height($thumbnailHeight)
            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
            ->width($thumbnailPreviewWidth)
            ->height($thumbnailPreviewHeight)
            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function getFotoAttribute()
    {
        return $this->getMedia('produk_foto')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function satuan()
    {
        return $this->belongsTo(SatuanProduk::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

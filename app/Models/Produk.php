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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('umkm_carousel')
            ->useFallbackUrl('/image/img-fallback-4.3.png')
            ->useFallbackPath(public_path('/image/img-fallback-4.3.png'));
    }

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

    public function getHargaRupiah()
    {
        $hasil_rupiah = number_format($this->harga,2,',','.');
	    return $hasil_rupiah;
    }

    public function getUrlTanyaTersediaAttribute()
    {
        if($this->umkm->pemilik_id || $this->umkm->nomor_telepon){
            $telepon = substr($this->umkm->nomor_telepon ?? $this->umkm->pemilik->nomor_telepon, 1);
            $nama = urlencode($this->nama);
            return "https://api.whatsapp.com/send?phone=62".$telepon."&text=Halo%2C%20saya%20menemukan%20produk%20.$nama.%20di%20situs%20web%20Desa%20Srimulyo.%20Apakah%20produk%20tersebut%20sudah%20tersedia%3F";
        }
        else{
            return '';
        }
    }

    public function getUrlBeliAttribute()
    {
        if($this->umkm->pemilik_id || $this->umkm->nomor_telepon){
            $telepon = substr($this->umkm->nomor_telepon ?? $this->umkm->pemilik->nomor_telepon, 1);
            $nama = urlencode($this->nama_umkm);
            return "https://api.whatsapp.com/send?phone=62".$telepon."&text=Halo%2C%20saya%20ingin%20membeli%20produk%20".$nama."%20milik%20UMKM%20".$this->umkm->nama_umkm."%20di%20situs%20web%20Desa%20Srimulyo.%20Apakah%20produk%20tersebut%20masih%20tersedia%3F";
        }
        else{
            return '';
        }
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
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
        return $date->format(config('project.datetime_format'));
    }

    public function syncMediaName(){
        foreach($this->getMedia('produk_foto') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }
}

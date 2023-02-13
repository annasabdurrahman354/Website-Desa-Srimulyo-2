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
use Illuminate\Support\Str;

class Umkm extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public $table = 'umkms';

    public static $search = [
        'nama_umkm',
    ];

    public $filterable = [
        'id',
        'pemilik.name',
        'pemilik.nik',
        'nama_umkm',
        'slug',
        'deskripsi',
        'nomor_telepon',
        'alamat',
        'latitude',
        'longitude',
        'waktu_keterlihatan',
        'kategori.kategori',
    ];

    public $orderable = [
        'id',
        'pemilik.name',
        'pemilik.nik',
        'nama_umkm',
        'slug',
        'deskripsi',
        'nomor_telepon',
        'alamat',
        'latitude',
        'longitude',
        'waktu_keterlihatan',
        'kategori.kategori',
        'is_aktif',
        'is_terverifikasi',
    ];

    protected $appends = [
        'carousel',
    ];

    protected $casts = [
        'is_aktif'         => 'boolean',
        'is_terverifikasi' => 'boolean',
    ];

    protected $dates = [
        'waktu_keterlihatan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pemilik_id',
        'nama_umkm',
        'slug',
        'deskripsi',
        'nomor_telepon',
        'alamat',
        'latitude',
        'longitude',
        'waktu_keterlihatan',
        'kategori_id',
        'is_aktif',
        'is_terverifikasi',
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

    public function pemilik()
    {
        return $this->belongsTo(User::class);
    }

    public function getCarouselAttribute()
    {
        return $this->getMedia('umkm_carousel')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getWaktuKeterlihatanAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setWaktuKeterlihatanAttribute($value)
    {
        $this->attributes['waktu_keterlihatan'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriUmkm::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function syncMediaName(){
        foreach($this->getMedia('umkm_carousel') as $media){
            $media->file_name = Str::slug($this->nama_umkm). '_' .'carousel-umkm'. '_' . $media->id . '.' . $media->extension;
            $media->save();
        }
    }
}

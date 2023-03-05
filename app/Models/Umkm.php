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

    public function pemilik()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriUmkm::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('umkm_carousel')
            ->useFallbackUrl('/image/img-fallback-2.1.png')
            ->useFallbackPath(public_path('/image/img-fallback-2.1.png'));
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

    public function getUrlArahAttribute()
    {
        return "https://www.google.com/maps/dir/?api=1&destination=".$this->latitude.",".$this->longitude;
    }

    public function getUrlHubungiAttribute()
    {
        if($this->pemilik_id || $this->nomor_telepon){
            $telepon = substr($this->nomor_telepon ?? $this->pemilik->nomor_telepon, 1);
            $nama = urlencode($this->nama_umkm);
            return "https://api.whatsapp.com/send?phone=62".$telepon."&text=Halo%2C%20saya%20menemukan%20".$nama."%20dari%20situs%20web%20Desa%20Srimulyo%20%F0%9F%A4%97.%20";
        }
        else{
            return '';
        }
    }

    public function getIconAttribute(){
        switch($this->kategori->kategori){
            case 'Batu Bata':
                return 'cube';
                break;
            case 'Rumah Makan':
                return 'utensils';
                break;
            case 'Toko Kelontong':
                return 'store-alt';
                break;
            case 'Toko Pakaian':
                return 'tshirt';
                break;
            case 'Toko Peralatan Rumah':
                return 'briefcase';
                break;
            case 'Toko Elektronik':
                return 'plug';
                break;
            case 'Toserba':
                return 'store';
                break;
            case 'Supermarket':
                return 'shopping-cart';
                break;
            case 'Pom Bensin':
                return 'gas-pump';
                break;
            case 'Jasa':
                return 'house-user';
                break;
            default:
                return 'map-marker';
        }
    }

    public function getColorAttribute(){
        switch($this->kategori->kategori){
            case 'Batu Bata':
                return 'darkred';
                break;
            case 'Rumah Makan':
                return 'orange';
                break;
            case 'Toko Kelontong':
                return '#FAEBD7';
                break;
            case 'Toko Pakaian':
                return 'yellow';
                break;
            case 'Toko Peralatan Rumah':
                return 'blue';
                break;
            case 'Toko Elektronik':
                return 'purple';
                break;
            case 'Toserba':
                return '#00FFFF';
                break;
            case 'Supermarket':
                return '#6495ED';
                break;
            case 'Pom Bensin':
                return 'red';
                break;
            case 'Jasa':
                return 'green';
                break;
            default:
                return '#FFD700';
        }
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('project.datetime_format'));
    }

    public function syncMediaName(){
        foreach($this->getMedia('umkm_carousel') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }

    protected static function booted() {
        static::created(function ($umkm) {
            $userAlert = new UserAlert;
            $notification =  getNotificationMessage('admin_umkm_verifikasi', auth()->user(), $umkm);
            $userAlert->message = $notification['message'];
            $userAlert->link = $notification['link'];
            $userAlert->save();
            $userAlert->users()->sync(User::admins()->get());
        });
    }
}

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
use Illuminate\Support\Str;

class Artikel extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public $table = 'artikels';

    public static $search = [
        'judul',
    ];

    public $filterable = [
        'id',
        'judul',
        'slug',
        'penulis.name',
        'rangkuman',
        'konten',
        'jumlah_pembaca',
        'kategori.kategori',
    ];

    public $orderable = [
        'id',
        'judul',
        'slug',
        'penulis.name',
        'rangkuman',
        'konten',
        'jumlah_pembaca',
        'kategori.kategori',
        'is_diterbitkan',
    ];

    protected $appends = [
        'gambar',
    ];

    protected $casts = [
        'is_diterbitkan' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'judul',
        'slug',
        'penulis_id',
        'rangkuman',
        'konten',
        'jumlah_pembaca',
        'kategori_id',
        'is_diterbitkan',
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

    public function getGambarAttribute()
    {
        return $this->getMedia('artikel_gambar')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function penulis()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function syncMediaName(){
        foreach($this->getMedia('artikel_gambar') as $media){
            $media->file_name = Str::slug($this->judul). '_' . 'gambar-artikel' . '_' . $media->id . '.' . $media->extension;
            $media->save();
        }
    }
}

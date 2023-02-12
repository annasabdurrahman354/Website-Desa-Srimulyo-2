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

class Carousel extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public $table = 'carousels';

    public $filterable = [
        'id',
        'judul',
        'link_tujuan',
    ];

    public $orderable = [
        'id',
        'judul',
        'link_tujuan',
        'is_aktif',
    ];

    protected $appends = [
        'gambar',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    protected $fillable = [
        'judul',
        'link_tujuan',
        'is_aktif',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('carousel_gambar')
            ->useDisk('public')
            ->useDirectory(function (Media $media) {
                return 'carousel' . '/' . $this->id . '/' . 'gambar' . '/' .  $media->id;
            })
            ->useFileName(function (Media $media) {
                return  Str::slug($this->judul). '_' . 'gambar' . '_' . $media->id . '.' . $media->extension;
            });
    }

    public function getGambarAttribute()
    {
        return $this->getMedia('carousel_gambar')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

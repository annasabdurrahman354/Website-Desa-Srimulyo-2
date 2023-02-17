<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    function b64toUrl ( $data )
    {
        // Create blank dom object
        $dom = new \DOMDocument();

        // Load data in the dom object
        $dom->loadHTML($data);

        // Searching for the img tag
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $image) {
            
            //Getting the value of src attribuite of img
            $raw = $image->getAttribute('src');

            /* If src tag has value data:image
            * than it is upload from device in
            * base64 format                  
            */
            if (preg_match('/data:image/', $raw)) {
                $name = uniqid();

                preg_match('/data:image\/(?<mime>.*?)\;/', $raw, $groups);
                $mimetype = $groups['mime'];
                $filepath = 'artikel/'. $this->id . '/gambar/' . $name . '.' . $mimetype;
                    
                // Convert base64 data to the image again    
                $img = Image::make($raw)->encode($mimetype, 100);

                // Store the image in disk    
                Storage::put($filepath, $img);

                // Remove old src attribute value    
                $image->removeAttribute('src');
                    
                // Set new src attribute value as a url that gives image in response.    
                $image->setAttribute('src', '/images/' . $filepath);
            }
        }

        return $dom->saveHTML();
    }

    public function syncMediaName(){
        foreach($this->getMedia('artikel_gambar') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }
}

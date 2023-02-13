<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\InteractsWithMedia;

class SyaratLayanan extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public const JENIS_BERKAS_SELECT = [
        'Dokumen' => 'Dokumen',
        'Foto'    => 'Foto',
        'Teks'    => 'Teks',
    ];

    public $table = 'syarat_layanans';

    public $orderable = [
        'id',
        'nama',
        'jenis_berkas',
        'deskripsi',
    ];

    public $filterable = [
        'id',
        'nama',
        'jenis_berkas',
        'deskripsi',
    ];

    protected $appends = [
        'berkas_formulir',
    ];

    protected $fillable = [
        'nama',
        'jenis_berkas',
        'deskripsi',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getJenisBerkasLabelAttribute($value)
    {
        return static::JENIS_BERKAS_SELECT[$this->jenis_berkas] ?? null;
    }

    public function getBerkasFormulirAttribute()
    {
        return $this->getMedia('syarat_layanan_berkas_formulir')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function jenisLayanan()
    {
        return $this->belongsToMany(JenisLayanan::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function syncMediaName(){
        foreach($this->getMedia('syarat_layanan_berkas_formulir') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }
}

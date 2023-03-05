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


class BerkasPelayanan extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public const STATUS_RADIO = [
        'Verifikasi' => 'Verifikasi',
        'Revisi'     => 'Revisi',
        'Diterima'   => 'Diterima',
    ];

    public $table = 'berkas_pelayanans';

    public $orderable = [
        'id',
        'pelayanan.kode',
        'syarat_layanan.nama',
        'syarat_layanan.jenis_berkas',
        'teks_syarat',
        'status',
        'catatan_reviewer',
    ];

    public $filterable = [
        'id',
        'pelayanan.kode',
        'syarat_layanan.nama',
        'syarat_layanan.jenis_berkas',
        'teks_syarat',
        'status',
        'catatan_reviewer',
    ];

    protected $appends = [
        'berkas_syarat',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pelayanan_id',
        'syarat_layanan_id',
        'teks_syarat',
        'status',
        'catatan_reviewer',
    ];

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class);
    }

    public function syaratLayanan()
    {
        return $this->belongsTo(SyaratLayanan::class);
    }
    
    public function getBerkasSyaratAttribute()
    {
        return $this->getMedia('berkas_pelayanan_berkas_syarat')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_RADIO[$this->status] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('project.datetime_format'));
    }

    public function syncMediaName(){
        foreach($this->getMedia('berkas_pelayanan_berkas_syarat') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }

    protected static function booted() {
        static::updated(function ($berkasPelayanan) {
            $pelayanan = $berkasPelayanan->pelayanan;
            if($pelayanan){
                if(!$pelayanan->isBerkasRevisi() && !$pelayanan->isPelayananSelesai() && !$pelayanan->isPelayananTerkirim()){
                    $pelayanan->status = 'Verifikasi';
                    $pelayanan->save();
                }
                elseif($pelayanan->isBerkasRevisi() && !$pelayanan->isPelayananSelesai() && !$pelayanan->isPelayananTerkirim()){
                    $pelayanan->status = 'Revisi';
                    $pelayanan->save();
                }
                if($pelayanan->berkas_hasil->isNotEmpty() || $pelayanan->catatan_reviewer){
                    $pelayanan->status = 'Selesai';
                    $pelayanan->save();
                } 
                $pelayanan->updateLatestJenisBerkasPelayananStatusDiterima();
            }
        });
    }
}

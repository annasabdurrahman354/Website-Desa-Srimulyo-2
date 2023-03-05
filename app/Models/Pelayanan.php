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
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pelayanan extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;

    public const RATING_RADIO = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
    ];

    public const STATUS_SELECT = [
        'Terkirim'   => 'Terkirim',
        'Verifikasi' => 'Verifikasi',
        'Revisi'     => 'Revisi',
        'Selesai'    => 'Selesai',
        'Dibatalkan'    => 'Dibatalkan',
    ];

    public const STATUS_SELECT_DITERIMA = [
        'Verifikasi' => 'Verifikasi',
        'Selesai'    => 'Selesai',
    ];

    public $table = 'pelayanans';

    public static $search = [
        'kode',
    ];

    public $orderable = [
        'id',
        'pemohon.name',
        'pemohon.nomor_telepon',
        'jenis_layanan.nama',
        'jenis_layanan.pelayanan_online',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
        'status',
        'rating',
        'penilaian_pemohon',
    ];

    public $filterable = [
        'id',
        'pemohon.name',
        'pemohon.nomor_telepon',
        'jenis_layanan.nama',
        'jenis_layanan.pelayanan_online',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
        'status',
        'rating',
        'penilaian_pemohon',
    ];

    public $filterable_user = [
        'jenis_layanan.nama',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
    ];

    protected $appends = [
        'berkas_hasil',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pemohon_id',
        'jenis_layanan_id',
        'kode',
        'catatan_pemohon',
        'catatan_reviewer',
        'status',
        'rating',
        'penilaian_pemohon',
    ];

    public function pemohon()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class);
    }

    public function berkasPelayanan()
    {
        return $this->hasMany(BerkasPelayanan::class);
    }
    
    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    public function getBerkasHasilAttribute()
    {
        return $this->getMedia('pelayanan_berkas_hasil')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getRatingLabelAttribute($value)
    {
        return static::RATING_RADIO[$this->rating] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('project.datetime_format'));
    }

    function isBerkasRevisi(){
        $latestBerkas = $this->berkasPelayanan->groupBy('syarat_layanan_id')->map(function ($berkas) {
            return $berkas->sortByDesc('created_at')->first();
        });

        if ($latestBerkas->contains(function ($berkas) {
            return $berkas->status === 'Revisi';
        })) {
            return true;
        }
        else{
            return false;
        }
    }

    function isAllBerkasDiterima(){
        $latestBerkas = $this->berkasPelayanan->groupBy('syarat_layanan_id')->map(function ($berkas) {
            return $berkas->sortByDesc('created_at')->first();
        });

        foreach ($latestBerkas as $model) {
            if ($model->status != 'Diterima') {
                return false;
            }
        }
        return true;
    }

    function isBerkasMenunggu(){
        $latestBerkas = $this->berkasPelayanan->groupBy('syarat_layanan_id')->map(function ($berkas) {
            return $berkas->sortByDesc('created_at')->first();
        });

        if ($latestBerkas->contains(function ($berkas) {
            return $berkas->status === 'Verifikasi' || $berkas->status === 'Diterima';
        })) {
            return true;
        }
        else{
            return false;
        }
    }

    function isPelayananTerkirim(){
        if ($this->status_label == "Terkirim") {
            return true;
        }
        else{
            return false;
        }
    }

    function isPelayananSelesai(){
        if ($this->status_label == "Selesai" || $this->status_label == "Dibatalkan") {
            return true;
        }
        else{
            return false;
        }
    }

    public function isLatestBerkasPelayananRevisi($syarat_layanan_id)
    {
        $latest_berkas_syarat = $this->berkasPelayanan()
            ->where('syarat_layanan_id', $syarat_layanan_id)
            ->orderBy('created_at', 'desc')
            ->first();

        return $latest_berkas_syarat->status == 'Revisi';
    }

    function updateLatestJenisBerkasPelayananStatusDiterima()
    {
        if ($this->status_label != 'Selesai') {
            return;
        }

        $groups = $this->berkasPelayanan
            ->groupBy('syarat_layanan_id')
            ->map(function ($group) {
                return $group->sortByDesc('created_at')->first();
            });

        foreach ($groups as $berkasPelayanan) {
            $berkasPelayanan->status = 'Diterima';
            $berkasPelayanan->save();
        }
    }

    public function berkasPelayananByType()
    {
        $berkas = $this->berkasPelayanan()->get();
        $grouped = $berkas->groupBy('syarat_layanan_id');
        $result = [];
        foreach ($grouped as $type => $berkasOfType) {
            $sorted = $berkasOfType->sortByDesc('created_at');
            $status = $sorted->first()->status;
            $perlu_revisi = $sorted->first()->status === 'Revisi' ? true : false;
            $result[] = [
                'jenis' => $type,
                'nama' => SyaratLayanan::where('id', $type)->first()->nama,
                'jenis_berkas' => SyaratLayanan::where('id', $type)->first()->jenis_berkas_label,
                'status' =>  $status,
                'perlu_revisi' => $perlu_revisi,
                'berkas' => $sorted->values()->all()
            ];
        }
        return $result;
    }
    
    public function hasSyaratLayanan($syarat_layanan_id)
    {
        $syarat_layanans = $this->jenisLayanan->syaratLayanan->pluck('id');
        return $syarat_layanans->contains($syarat_layanan_id);
    }

    function generateCode() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = 'PM-';
    
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        $randomString .= '-';
    
        for ($i = 0; $i < 3; $i++) {
            $randomString .= rand(0, 9);
        }
    
        $this->kode = $randomString;
    }    

    public function syncMediaName(){
        foreach($this->getMedia('pelayanan_berkas_hasil') as $media){
            $media->file_name = getMediaFilename($this, $media);
            $media->save();
        }
    }
}

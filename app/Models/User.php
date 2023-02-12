<?php

namespace App\Models;

use \DateTimeInterface;
use App\Models\UserAlert;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class User extends Authenticatable implements HasLocalePreference, HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use Notifiable;
    use SoftDeletes;
    use InteractsWithMedia;

    public const JENIS_KELAMIN_RADIO = [
        'Laki-laki' => 'Laki-laki',
        'Perempuan' => 'Perempuan',
    ];

    public $table = 'users';

    public static $search = [
        'name',
        'nik',
        'nomor_telepon',
    ];

    public $orderable = [
        'id',
        'name',
        'nik',
        'nomor_telepon',
        'jenis_kelamin',
        'tempat_lahir.nama',
        'tanggal_lahir',
        'alamat',
        'email',
        'email_verified_at',
        'locale',
    ];

    public $filterable = [
        'id',
        'name',
        'nik',
        'nomor_telepon',
        'jenis_kelamin',
        'tempat_lahir.nama',
        'tanggal_lahir',
        'alamat',
        'email',
        'email_verified_at',
        'roles.title',
        'locale',
    ];

    protected $appends = [
        'foto_profil',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'tanggal_lahir',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'nik',
        'nomor_telepon',
        'jenis_kelamin',
        'tempat_lahir_id',
        'tanggal_lahir',
        'alamat',
        'email',
        'password',
        'locale',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('title', 'Admin')->exists();
    }

    public function scopeAdmins()
    {
        return $this->whereHas('roles', fn ($q) => $q->where('title', 'Admin'));
    }

    public function alerts()
    {
        return $this->belongsToMany(UserAlert::class)->withPivot('seen_at');
    }

    public function preferredLocale()
    {
        return $this->locale;
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

    public function getFotoProfilAttribute()
    {
        return $this->getMedia('user_foto_profil')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getJenisKelaminLabelAttribute($value)
    {
        return static::JENIS_KELAMIN_RADIO[$this->jenis_kelamin] ?? null;
    }

    public function tempatLahir()
    {
        return $this->belongsTo(Kota::class);
    }

    public function getTanggalLahirAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function syncMediaName(){
        foreach( $this->getMedia('user_foto_profil') as $media){
            $media->file_name = Str::slug($this->name). '_' .'foto-profil-user'. '_' . $media->id . '.' . $media->extension;
            $media->save();
        }
    }

    protected static function booted() {
        static::retrieved (function ($model) {
            $model->syncMediaName();
        });
    }
}

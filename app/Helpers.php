<?php

use App\Models\UserAlert;
use Illuminate\Support\Str;


if(! function_exists('getMediaFilename')) {
    function getMediaFilename($model, $media){
        switch($media->collection_name){
            case 'aparatur_desa_foto':
                return 'Foto-aparatur' . '_' . Str::slug($model->nama). '_' . $media->id . '.' . $media->extension;
                break;
            case 'artikel_gambar':
                return 'Gambar-artikel' . '_' . Str::slug($model->judul). '_' . $media->id . '.' . $media->extension;
                break;
            case 'berkas_pelayanan_berkas_syarat':
                return 'Berkas-syarat'. '_' . Str::slug($model->syaratLayanan->nama) . '_' .  $media->id . '.' . $media->extension;
                break;
            case 'carousel_gambar':
                return 'Gambar-carousel' . '_' . Str::slug($model->judul). '_' . $media->id . '.' . $media->extension;
                break;
            case 'data_penduduk_berkas_data':
                return 'Berkas-data-penduduk' . '_' . Str::slug($model->judul). '_' . $media->id . '.' . $media->extension;
                break;
            case 'dokumen_umum_berkas_dokumen':
                return 'Berkas-dokumen-umum' . '_' . Str::slug($model->judul). '_' . $media->id . '.' . $media->extension;
                break;
            case 'pelayanan_berkas_hasil':
                return 'Berkas-pelayanan'. '_' . Str::slug($model->jenisLayanan->nama) . '_' .  $media->id . '.' . $media->extension;
                break;
            case 'produk_foto':
                return 'Foto-produk'. '_' . Str::slug($model->nama). '_' .$media->id . '.' .$media->extension;
                break;
            case 'produk_hukum_berkas_dokumen':
                return 'Berkas-produk-hukum' . '_' . Str::slug($model->judul)  . '_' . $media->id . '.' . $media->extension;
                break;
            case 'syarat_layanan_berkas_formulir':
                return 'Berkas-formulir'. '_' . Str::slug($model->nama) . '_'  . $media->id . '.' . $media->extension;
                break;
            case 'umkm_carousel':
                return 'Carousel-umkm'. '_' . Str::slug($model->nama_umkm) . '_' . $media->id . '.' . $media->extension;
                break;
            case 'user_foto_profil':
                return 'Foto-profil-user' . '_' . Str::slug($model->name) . '_' . $media->id . '.' . $media->extension;;
                break;
            default:
                return Str::slug($media->file_name) . '_' . $media->id . '.' . $media->extension;
        }
    }
}

if(! function_exists('getNotificationJson')) {
    function getNotificationJson($type, $model)
    {
        return $json = [
            
        ];
    }
}

if(! function_exists('getNotificationMessage')) {
    function getNotificationMessage($type, $userTarget, $model){
        $message = "";
        $link = "";
        switch($type){
            case 'admin_pelayanan_baru': //
                $message = "<span class=\"font-semibold text-gray-900 dark:text-white\">{$userTarget->name}</span> mengajukan permintaan layanan {$model->jenisLayanan->nama} baru dengan kode <span class=\"font-semibold text-blue-600 underline dark:text-white\">#{$model->kode}</span>.";
                $link = route('admin.pelayanans.review', ['pelayanan' => $model->id], false);
                return array('message' => $message, 'link' => $link);
                break;
            case 'admin_syaratPelayanan_revisi': //
                $message = "<span class=\"font-semibold text-gray-900 dark:text-white\">{$userTarget->name}</span> telah merevisi berkas pelayanan {$model->syaratLayanan->nama} pada layanan <span class=\"font-semibold text-blue-600 underline dark:text-white\">#{$model->pelayanan->kode}</span>.";
                $link = route('admin.pelayanans.review', ['pelayanan' => $model->pelayanan->id], false);
                return array('message' => $message, 'link' => $link);
                break;
            case 'admin_umkm_verifikasi': //
                $message = "<span class=\"font-semibold text-gray-900 dark:text-white\">$userTarget->name</span> telah mendaftarkan UMKM baru <span class=\"font-semibold text-blue-600 underline dark:text-white\">$model->nama_umkm</span> yang memerlukan verifikasi!";
                $link = route('admin.umkms.show', $model->id, false);
                return array('message' => $message, 'link' => $link);
                break;
            case 'user_syaratPelayanan_revisi': //
                $message = "Berkas pelayanan {$model->syaratLayanan->nama} pada ajuan pelayanan <span class=\"font-semibold text-blue-600 underline dark:text-white\">#{$model->pelayanan->kode}</span> memerlukan revisi!";
                $link = route('user.pelayanan.show', $model->pelayanan->id, false);
                return array('message' => $message, 'link' => $link);
                break;
            case 'user_syaratPelayanan_diterima': //
                $message = "Berkas pelayanan {$model->syaratLayanan->nama} pada ajuan pelayanan <span class=\"font-semibold text-blue-600 underline dark:text-white\">#{$model->pelayanan->kode}</span> telah diterima!";
                $link = route('user.pelayanan.show', $model->pelayanan->id, false);
                return array('message' => $message, 'link' => $link);
                break;
            case 'user_pelayanan_selesai_offline': //
                $message = "Pelayanan {$model->jenisLayanan->nama} Anda dengan kode <span class=\"font-semibold text-blue-600 underline dark:text-white\">#{$model->kode}</span> telah selesai diproses. Silahkan baca instruksi di catatan untuk pengambilan.";
                $link = route('user.pelayanan.show', $model->id, false);
                return array('message' => $message, 'link' => $link);
                break;
            case 'user_pelayanan_selesai_online': //
                $message = "Pelayanan {$model->jenisLayanan->nama} Anda dengan kode <span class=\"font-semibold text-blue-600 underline dark:text-white\">#{$model->kode}</span> telah selesai diproses. Silahkan unduh berkas yang terlampir!";
                $link = route('user.pelayanan.show', $model->id, false);
                return array('message' => $message, 'link' => $link);
                break;
            case 'user_umkm_verifikasi': //
                $message = "UMKM <span class=\"font-semibold text-blue-600 underline dark:text-white\">{$model->nama_umkm}</span> Anda telah terverifikasi.";
                $link = route('user.usaha.index', false);
                return array('message' => $message, 'link' => $link);
                break;
            default:
                return array('message' => 'Notifikasi baru telah dibuat!', 'link' => "#");;
        }
    }
}

if(! function_exists('setNotificationSeen')) {
    function setNotificationSeen($alert)
    {
        $alert = UserAlert::where('id', $alert->id)->firstOrFail();
        $alert->pivot->seen_at = now();
        $alert->save();
    }
}

if(! function_exists('getHargaRupiah')) {
    function getHargaRupiah($harga)
    {
        $hasil_rupiah = number_format($harga,2,',','.');
        return $hasil_rupiah;
    }
}
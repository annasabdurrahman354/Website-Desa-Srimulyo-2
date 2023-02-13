<?php

use Illuminate\Support\Str;

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
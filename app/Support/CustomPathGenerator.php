<?php

namespace App\Support;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        switch ($media->collection_name) {
                case 'aparatur_desa_foto':
                return 'aparatur_desa' . '/' . $media->model->id . '/' . 'foto' . '/' .  $media->id;;
                break;
            case 'artikel_gambar':
                return 'artikel' . '/' . $media->model->id . '/' . 'gambar' . '/' .  $media->id;
                break;
            case 'berkas_pelayanan_berkas_syarat':
                return 'pelayanan' . '/' . $media->model->pelayanan->id . '/' . 'berkas_pelayanan' . '/' . $media->model->id . '/' . 'berkas_syarat' . '/' . $media->id;
                break;
            default:
                return 'posts/' . $media->id;
          }
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}
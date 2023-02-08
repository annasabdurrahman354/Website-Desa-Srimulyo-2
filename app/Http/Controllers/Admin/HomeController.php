<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Grafik Pelayanan Online',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Pelayanan',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'w-full xl:w-6/12',
            'entries_number'        => '5',
            'translation_key'       => 'pelayanan',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Jumlah UMKM Terdaftar',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Umkm',
            'group_by_field'        => 'waktu_keterlihatan',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'w-full lg:w-6/12 xl:w-3/12',
            'entries_number'        => '5',
            'translation_key'       => 'umkm',
        ];

        $settings2['total_number'] = 0;
        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where($settings2['filter_field'], '>=',
                now()->subDays($settings2['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Jumlah Produk UMKM',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Produk',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'w-full lg:w-6/12 xl:w-3/12',
            'entries_number'        => '5',
            'translation_key'       => 'produk',
        ];

        $settings3['total_number'] = 0;
        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Data Pelayanan Terbaru',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Pelayanan',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'w-full',
            'entries_number'        => '10',
            'fields'                => [
                'id'              => '',
                'pemohon'         => 'name',
                'jenis_layanan'   => 'nama',
                'kode'            => '',
                'created_at'      => '',
                'status'          => '',
                'catatan_pemohon' => '',
            ],
            'translation_key' => 'pelayanan',
        ];

        $settings4['data'] = [];
        if (class_exists($settings4['model'])) {
            $settings4['data'] = $settings4['model']::latest()
                ->take($settings4['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings4)) {
            $settings4['fields'] = [];
        }

        $settings5 = [
            'chart_title'           => 'Data Unggahan Syarat Pelayanan Terbaru',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\BerkasPelayanan',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'w-full',
            'entries_number'        => '10',
            'fields'                => [
                'id'               => '',
                'pelayanan'        => 'kode',
                'syarat_layanan'   => 'nama',
                'teks_syarat'      => '',
                'berkas_syarat'    => '',
                'status'           => '',
                'catatan_reviewer' => '',
                'updated_at'       => '',
            ],
            'translation_key' => 'berkasPelayanan',
        ];

        $settings5['data'] = [];
        if (class_exists($settings5['model'])) {
            $settings5['data'] = $settings5['model']::latest()
                ->take($settings5['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings5)) {
            $settings5['fields'] = [];
        }

        $settings6 = [
            'chart_title'           => 'Data UMKM Terbaru',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Umkm',
            'group_by_field'        => 'waktu_keterlihatan',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'w-full',
            'entries_number'        => '5',
            'fields'                => [
                'id'               => '',
                'pemilik'          => 'name',
                'nama_umkm'        => '',
                'nomor_telepon'    => '',
                'alamat'           => '',
                'is_terverifikasi' => '',
                'created_at'       => '',
                'kategori'         => 'kategori',
            ],
            'translation_key' => 'umkm',
        ];

        $settings6['data'] = [];
        if (class_exists($settings6['model'])) {
            $settings6['data'] = $settings6['model']::latest()
                ->take($settings6['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings6)) {
            $settings6['fields'] = [];
        }

        $settings7 = [
            'chart_title'           => 'Data Kotak Saran',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\KotakSaran',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'w-full',
            'entries_number'        => '5',
            'fields'                => [
                'id'            => '',
                'pengirim'      => '',
                'nomor_telepon' => '',
                'isi'           => '',
                'created_at'    => '',
            ],
            'translation_key' => 'kotakSaran',
        ];

        $settings7['data'] = [];
        if (class_exists($settings7['model'])) {
            $settings7['data'] = $settings7['model']::latest()
                ->take($settings7['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings7)) {
            $settings7['fields'] = [];
        }

        return view('admin.home', compact('chart1', 'settings2', 'settings3', 'settings4', 'settings5', 'settings6', 'settings7'));
    }
}

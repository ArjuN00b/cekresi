<?php
// ==========================================
// KELOMPOK 3 - LOGIKA/FUNGSI API CEK RESI
// ==========================================

require_once __DIR__ . '/config.php';

/**
 * Melacak paket berdasarkan nomor resi dan kurir
 * 
 * @param string $resi Nomor resi pengiriman
 * @param string $kurir Kode kurir (jne, jnt, sicepat, dll)
 * @return array Array berisi status pencarian
 */
function lacakPaket($resi, $kurir) {
    $resi = trim($resi);
    $kurir = trim($kurir);

    if (empty($resi) || empty($kurir)) {
        return [
            'success' => false,
            'data' => null,
            'error' => 'Nomor resi dan kurir wajib diisi!'
        ];
    }

    // Parameter API
    $parameter = http_build_query([
        'api_key' => BINDERBYTE_API_KEY,
        'courier' => $kurir,
        'awb'     => $resi,
        'number'  => $resi
    ]);

    // URL API
    $url = "https://api.binderbyte.com/v1/track?" . $parameter;

    // Pengaturan koneksi
    $pengaturan = [
        "http" => [
            "timeout" => 15,
            "ignore_errors" => true
        ]
    ];

    $konteks = stream_context_create($pengaturan);

    // Ambil data API
    $response = @file_get_contents($url, false, $konteks);

    if ($response === false) {
        return [
            'success' => false,
            'data' => null,
            'error' => 'Gagal menghubungi server API BinderByte.'
        ];
    }

    // Decode JSON menjadi array PHP
    $dataResi = json_decode($response, true);

    // Evaluasi hasil respon dari API
    if (isset($dataResi['status']) && $dataResi['status'] == 200) {
        return [
            'success' => true,
            'data' => $dataResi['data'],
            'error' => ''
        ];
    } else {
        $errorMsg = isset($dataResi['message']) ? $dataResi['message'] : "Data resi tidak ditemukan.";
        return [
            'success' => false,
            'data' => null,
            'error' => $errorMsg
        ];
    }
}

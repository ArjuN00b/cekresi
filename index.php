<?php
// ==========================================
// KELOMPOK 3 - UTAMA CEK RESI
// ==========================================

require_once __DIR__ . '/tracker.php';

// Variabel awal
$hasilPencarian = null;
$pesanError = '';
$resiInput = '';
$kurirInput = '';

// Mengecek apakah form sudah disubmit
if (isset($_GET['resi']) && isset($_GET['kurir'])) {
    $resiInput = $_GET['resi'];
    $kurirInput = $_GET['kurir'];

    // Lakukan pelacakan paket
    $hasil = lacakPaket($resiInput, $kurirInput);

    if ($hasil['success']) {
        $hasilPencarian = $hasil['data'];
    } else {
        $pesanError = $hasil['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok 3 - Pelacak Paket API</title>
    <!-- Import stylesheet eksternal -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <h1>Sistem Pelacakan Paket</h1>
            <p>Pemrograman Web A 2526</p>
            <div class="badge">Kelompok 3</div>
        </div>

        <!-- FORM -->
        <form method="GET">
            <div class="form-group">
                <label>Nomor Resi</label>
                <input
                    type="text"
                    name="resi"
                    value="<?php echo htmlspecialchars($resiInput); ?>"
                    placeholder="Masukkan nomor resi..."
                    required>
            </div>

            <div class="form-group">
                <label>Pilih Kurir</label>
                <select name="kurir" required>
                    <option value="">-- Pilih Kurir --</option>
                    <option value="jne" <?php echo ($kurirInput == 'jne') ? 'selected' : ''; ?>>JNE</option>
                    <option value="jnt" <?php echo ($kurirInput == 'jnt') ? 'selected' : ''; ?>>J&T</option>
                    <option value="sicepat" <?php echo ($kurirInput == 'sicepat') ? 'selected' : ''; ?>>SiCepat</option>
                    <option value="anteraja" <?php echo ($kurirInput == 'anteraja') ? 'selected' : ''; ?>>AnterAja</option>
                    <option value="tiki" <?php echo ($kurirInput == 'tiki') ? 'selected' : ''; ?>>TIKI</option>
                    <option value="pos" <?php echo ($kurirInput == 'pos') ? 'selected' : ''; ?>>POS Indonesia</option>
                    <option value="spx" <?php echo ($kurirInput == 'spx') ? 'selected' : ''; ?>>SPX</option>
                </select>
            </div>

            <button type="submit">
                Lacak Paket
            </button>
        </form>

        <?php if ($pesanError || $hasilPencarian): ?>
            <hr>
        <?php endif; ?>

        <!-- ERROR -->
        <?php if ($pesanError): ?>
            <div class="error">
                <strong>Gagal:</strong> <?php echo htmlspecialchars($pesanError); ?>
            </div>
        <?php endif; ?>

        <!-- HASIL -->
        <?php if ($hasilPencarian): ?>
            <div class="success-box">
                <h2>Informasi Pengiriman</h2>
                <p>
                    <span>Status</span>
                    <strong><?php echo htmlspecialchars($hasilPencarian['summary']['status'] ?? '-'); ?></strong>
                </p>
                <p>
                    <span>Kurir</span>
                    <strong><?php echo htmlspecialchars($hasilPencarian['summary']['courier'] ?? '-'); ?></strong>
                </p>
                <p>
                    <span>Penerima</span>
                    <strong><?php echo htmlspecialchars($hasilPencarian['detail']['receiver'] ?? '-'); ?></strong>
                </p>
                <p>
                    <span>Nomor Resi</span>
                    <strong><?php echo htmlspecialchars($hasilPencarian['summary']['awb'] ?? '-'); ?></strong>
                </p>
            </div>

            <!-- TABEL -->
            <h2>Riwayat Pengiriman</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($hasilPencarian['history']) && is_array($hasilPencarian['history'])): ?>
                        <?php foreach ($hasilPencarian['history'] as $log): ?>
                            <tr>
                                <td style="white-space: nowrap;">
                                    <?php echo htmlspecialchars($log['date'] ?? '-'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($log['desc'] ?? '-'); ?>
                                </td>
                                <td>
                                    <?php echo !empty($log['location']) ? htmlspecialchars($log['location']) : '-'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada riwayat pengiriman.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- FOOTER -->
        <div class="footer">
            © Kelompok 3 - Sistem API JSON Pelacakan Paket
        </div>

    </div>

</body>

</html>
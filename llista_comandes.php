<?php
session_start();

// Control d'accés: només clients autenticats
if (!isset($_SESSION['tipus']) || !isset($_SESSION['usuari'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['tipus'] !== 'Client') {
    header('Location: login.php');
    exit();
}

require_once('/var/www/html/daw2_grup8_pj6php/fpdf/fpdf.php');

$nom_usuari = $_SESSION['usuari'];
$directori_comandes = '/var/www/html/daw2_grup8_pj6php/botiga/comandes_copia';

$comandes = [];
$error = '';

// Si es demana veure una comanda específica en PDF
if (isset($_GET['fitxer'])) {
    $nom_fitxer = basename($_GET['fitxer']);
    $ruta_comanda = $directori_comandes . '/' . $nom_fitxer;
    
    if (file_exists($ruta_comanda)) {
        // Verificar que la comanda pertany a aquest client
        $contingut = file_get_contents($ruta_comanda);
        if (strpos($contingut, $nom_usuari) !== false) {
            try {
                $pdf = new FPDF();
                $pdf->AddPage();
                
                // Título
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Cell(0, 20, 'Detall de la Comanda', 0, 1, 'C');
                $pdf->Ln(10);
                
                // Contingut de la comanda
                $pdf->SetFont('Arial','',11);
                $linies = explode("\n", $contingut);
                foreach ($linies as $linia) {
                    $pdf->Cell(0, 8, $linia, 0, 1);
                }
                
                // Afegir espai abans de l'enllaç
                $pdf->Ln(15);
                
                // Crear URL absoluta per al retorn
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
                $host = $_SERVER['HTTP_HOST'];
                $url_retorn = $protocol . '://' . $host . '/daw2_grup8_pj6php/botiga/compra/app/llista_comandes.php';
                
                // Afegir text amb enllaç al PDF
                $pdf->SetFont('Arial', 'U', 12);
                $pdf->Cell(0, 10, 'Tornar a la llista: ' . $url_retorn, 0, 1, 'L');
                
                // Restaurar font per al pie de pàgina
                $pdf->Ln(10);
                $pdf->SetFont('Arial','I',10);
                $pdf->Cell(0, 10, 'Data de generacio: ' . date('d/m/Y H:i:s'), 0, 1, 'L');
                $pdf->Cell(0, 10, 'Pagina ' . $pdf->PageNo(), 0, 1, 'C');
                
                // Salida del PDF
                $pdf->Output('I', 'comanda_' . $nom_fitxer . '.pdf');
                exit();
                
            } catch (Exception $e) {
                $error = 'Error en generar el PDF: ' . $e->getMessage();
            }
        } else {
            $error = 'Aquesta comanda no pertany al teu compte.';
        }
    } else {
        $error = 'No s\'ha trobat la comanda.';
    }
}

// Llistar totes les comandes del client
if (is_dir($directori_comandes)) {
    $fitxers = scandir($directori_comandes);
    foreach ($fitxers as $fitxer) {
        if ($fitxer !== '.' && $fitxer !== '..' && is_file($directori_comandes . '/' . $fitxer)) {
            $contingut = file_get_contents($directori_comandes . '/' . $fitxer);
            // Verificar que la comanda pertany a aquest client
            if (strpos($contingut, $nom_usuari) !== false) {
                $nom_sense_ext = pathinfo($fitxer, PATHINFO_FILENAME);
                $parts = explode('_', $nom_sense_ext);
                $data = isset($parts[0]) ? $parts[0] : '';
                $hash = isset($parts[1]) ? $parts[1] : '';
                
                $comandes[] = [
                    'nom_fitxer' => $fitxer,
                    'data' => $data,
                    'hash' => $hash,
                    'data_modificacio' => date('d/m/Y H:i:s', filemtime($directori_comandes . '/' . $fitxer))
                ];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista de comandes</title>
    <link rel="stylesheet" href="../../../css/style.css" />
</head>
<body>
<div class="capcalera">
    <div class="esquerra">
        Client
    </div>
    <div class="dreta">
        <div class="dropdown">
            <button class="dropbtn"><?php echo htmlspecialchars($nom_usuari); ?> ▼</button>
            <div class="dropdown-content">
                <a href="/daw2_grup8_pj6php/botiga/compra/app/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="container container-large">
    <h2>📦 Les Meves Comandes</h2>
    
    <?php if ($error): ?>
        <div class="missatge_error">
            <strong>⚠️ Error:</strong><br>
            <?= $error ?>
        </div>
    <?php endif; ?>
    
    <?php if (empty($comandes)): ?>
        <div class="missatge_info">
            No tens cap comanda encara.
        </div>
    <?php else: ?>
        <p>Total de comandes: <strong><?= count($comandes) ?></strong></p>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hash</th>
                    <th>Nom del fitxer</th>
                    <th>Data modificació</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comandes as $comanda): ?>
                <tr>
                    <td><?= htmlspecialchars($comanda['data']) ?></td>
                    <td><code><?= htmlspecialchars($comanda['hash']) ?></code></td>
                    <td><?= htmlspecialchars($comanda['nom_fitxer']) ?></td>
                    <td><?= htmlspecialchars($comanda['data_modificacio']) ?></td>
                    <td>
                        <a href="/daw2_grup8_pj6php/botiga/compra/app/llista_comandes.php?fitxer=<?= urlencode($comanda['nom_fitxer']) ?>" class="btn btn-primary">Veure PDF</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <a href="/daw2_grup8_pj6php/botiga/compra/app/dashboard.php" class="enllac-tornada">← Tornar al Dashboard</a>
</div>
</body>
</html>
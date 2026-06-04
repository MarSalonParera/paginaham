<?php
session_start();
// Control d'accés: només clients autenticats
if (!isset($_SESSION['tipus']) || !isset($_SESSION['usuari'])) {
    header('Location: login.php');
    exit();
}

if (($_SESSION['tipus'] ?? '') !== 'Client') {
    header('Location: login.php');
    exit();
}

$nom_usuari = $_SESSION['usuari'];
$fitxer_cistella = '/var/www/html/daw2_grup8_pj6php/botiga/compra/area_clients/' . $nom_usuari . '/cistella';
$fitxer_productes = '/var/www/html/daw2_grup8_pj6php/botiga/productes_copia/productes_copia';

$missatge = '';
$error = '';
$cistella = [];
$productes_disponibles = [];

// Carregar productes disponibles
if (file_exists($fitxer_productes)) {
    $linies = file($fitxer_productes, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linies as $linia) {
        $linia = trim($linia);
        if (empty($linia)) continue;
        $parts = explode('|', $linia);
        if (count($parts) >= 3) {
            $productes_disponibles[] = [
                'id' => trim($parts[0]),
                'nom' => trim($parts[1]),
                'preu' => trim($parts[2])
            ];
        }
    }
}

// Carregar cistella si existeix
if (file_exists($fitxer_cistella)) {
    $contingut = file_get_contents($fitxer_cistella);
    $linies = explode("\n", trim($contingut));
    foreach ($linies as $linia) {
        $linia = trim($linia);
        if (empty($linia)) continue;
        $parts = explode('|', $linia);
        if (count($parts) >= 2) {
            $cistella[trim($parts[0])] = (int)trim($parts[1]);
        }
    }
}

// Processar accions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['desar_cistella'])) {
        // Desar cistella
        $cistella_nova = [];
        foreach ($productes_disponibles as $producte) {
            $quantitat = (int)($_POST['quantitat_' . $producte['id']] ?? 0);
            if ($quantitat > 0) {
                $cistella_nova[$producte['id']] = $quantitat;
            }
        }
        
        $contingut_cistella = '';
        foreach ($cistella_nova as $id => $quantitat) {
            $contingut_cistella .= $id . '|' . $quantitat . "\n";
        }
        
        // Assegurar que la carpeta per-usuari existeix abans d'escriure
        $dir_usuari = dirname($fitxer_cistella);
        if (!is_dir($dir_usuari)) {
            if (!mkdir($dir_usuari, 0755, true)) {
                $error = "Error en desar la cistella: no s'ha pogut crear la carpeta d'usuari.";
            }
        }

        if ($error === '') {
            $escrit = @file_put_contents($fitxer_cistella, $contingut_cistella, LOCK_EX);
            if ($escrit !== false) {
                $cistella = $cistella_nova;
                $missatge = "Cistella desada correctament!";
            } else {
                $error = "Error en desar la cistella.";
            }
        }
    } elseif (isset($_POST['esborrar_cistella'])) {
        // Esborrar cistella
        if (file_exists($fitxer_cistella)) {
            unlink($fitxer_cistella);
        }
        $cistella = [];
        $missatge = "Cistella esborrada correctament!";
    } elseif (isset($_POST['continuar'])) {
        // Continuar a resum
        if (empty($cistella)) {
            $error = "La cistella està buida. Has d'afegir productes abans de continuar.";
        } else {
            header('Location: resum_cistella.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Gestió de la cistella</title>
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
    <h2>🛒 Gestió de la Cistella</h2>
    
    <?php if ($missatge): ?>
        <div class="missatge_ok"><?= $missatge ?></div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="missatge_error"><?= $error ?></div>
    <?php endif; ?>
    
    <?php if (empty($productes_disponibles)): ?>
        <div class="missatge_info">
            No hi ha productes disponibles a la botiga.
        </div>
    <?php else: ?>
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Nom del producte</th>
                        <th>Preu unitari</th>
                        <th>Quantitat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productes_disponibles as $producte): ?>
                    <tr>
                        <td><?= htmlspecialchars($producte['id']) ?></td>
                        <td><?= htmlspecialchars($producte['nom']) ?></td>
                        <td><?= number_format((float)$producte['preu'], 2, ',', '.') ?> €</td>
                        <td>
                            <input type="number" 
                                   name="quantitat_<?= htmlspecialchars($producte['id']) ?>" 
                                   value="<?= isset($cistella[$producte['id']]) ? $cistella[$producte['id']] : 0 ?>"
                                   min="0" 
                                   style="width: 80px; padding: 8px;">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div style="margin-top: 30px; display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" name="desar_cistella" class="btn btn-primary">💾 Desar cistella</button>
                <button type="submit" name="esborrar_cistella" class="btn btn-danger">🗑️ Esborrar cistella</button>
                <button type="submit" name="continuar" class="btn btn-primary">➡️ Continuar a resum</button>
                <a href="/daw2_grup8_pj6php/botiga/compra/app/dashboard.php" class="btn btn-secondary">← Tornar al Dashboard</a>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
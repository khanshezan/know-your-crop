<?php
// ---------------- Backend Functions ----------------
function loadDataset($filename)
{
    $rows = array_map('str_getcsv', file($filename));
    $header = array_shift($rows);

    $normalized = array_map(function ($h) {
        return strtolower(trim(str_replace([" ", "-", "Value"], "_", $h)));
    }, $header);

    $data = [];
    foreach ($rows as $row) {
        $rowAssoc = [];
        foreach ($normalized as $i => $key) {
            $rowAssoc[$key] = $row[$i] ?? null;
        }
        $data[] = $rowAssoc;
    }
    return $data;
}

function recommendCrops($N, $P, $K, $pH, $soilType, $dataset)
{
    $scores = [];

    foreach ($dataset as $row) {
        $cropVariety = ($row['crop'] ?? "Unknown") . " (" . ($row['variety'] ?? "General") . ")";
        $nVal = floatval($row['nitrogen'] ?? $row['n'] ?? 0);
        $pVal = floatval($row['phosphorus'] ?? $row['p'] ?? 0);
        $kVal = floatval($row['potassium'] ?? $row['k'] ?? 0);
        $phVal = floatval($row['ph'] ?? 7);
        $soil = strtolower(trim($row['soil_type'] ?? ""));

        $score = 0;
        $score -= abs($N - $nVal);
        $score -= abs($P - $pVal);
        $score -= abs($K - $kVal);
        $score -= abs($pH - $phVal) * 5;

        if (strtolower($soilType) === $soil) {
            $score += 50;
        }

        $scores[] = ["crop" => $cropVariety, "score" => $score];
    }

    usort($scores, fn($a, $b) => $b['score'] <=> $a['score']);

    $top = [];
    foreach ($scores as $s) {
        if (!in_array($s['crop'], array_column($top, 'crop'))) {
            $top[] = $s;
        }
        if (count($top) >= 3)
            break;
    }
    return $top;
}

// ---------------- Handle Form ----------------
$recommendations = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $N = floatval($_POST['N']);
    $P = floatval($_POST['P']);
    $K = floatval($_POST['K']);
    $pH = floatval($_POST['pH']);
    $soilType = $_POST['soilType'];

    $dataset = loadDataset("sensor_Crop_Dataset.csv");
    $recommendations = recommendCrops($N, $P, $K, $pH, $soilType, $dataset);

    // ✅ Redirect to same page with results in query string
    session_start();
    $_SESSION['recommendations'] = $recommendations;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Load recommendations if redirected
session_start();
if (isset($_SESSION['recommendations'])) {
    $recommendations = $_SESSION['recommendations'];
    unset($_SESSION['recommendations']); // clear after showing once
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NPK Calculator</title>
    <link rel="icon" type="image/svg+xml" href="images/logo.svg">
    <link rel="stylesheet" href="calc.css">
</head>

<body>

    <div class="off-screen-menu">
        <ul>
            <a href="index.php"><li>Home</li></a>
            <a href="map.php"><li>District-Based Recommendation</li></a>
            <a href="calc.php"><li>NPK Calculator</li></a>
            <a href="index.php #page3"><li>About</li></a>
        </ul>
    </div>
    <div id="nav" class="nav">
        <a href="index.php">
            <img src="images/logo.svg" alt="" />
        </a>
        <div class="ham-menu" id="menu-icon">
            <span></span><span></span><span></span>
        </div>
        <div class="nav-links" id="navbar-links">
            <p><a href="index.php">Home</a></p>
            <p><a href="map.php">District-Based Recommendation</a></p>
            <p><a href="calc.php">NPK Calculator</a></p>
            <p><a href="index.php #page3">About</a></p>
            <!--<div class="search-box">
            <input type="text" placeholder="Search..." />
            <button type="submit">🔍</button>
          </div> -->
        </div>
    </div>


    <div class="container">



        <h1>🌱 NPK Calculator</h1>

        <form method="POST">
            <label for="N">Nitrogen (N)</label>
            <input type="number" id="N" name="N" step="any" required />

            <label for="P">Phosphorus (P)</label>
            <input type="number" id="P" name="P" step="any" required />

            <label for="K">Potassium (K)</label>
            <input type="number" id="K" name="K" step="any" required />

            <label for="pH">Soil pH</label>
            <input type="number" id="pH" name="pH" step="any" required />

            <label for="soilType">Soil Type</label>
            <select id="soilType" name="soilType" required>
                <option value="">Select Soil</option>
                <option value="Sandy">Sandy</option>
                <option value="Loamy">Loamy</option>
                <option value="Silt">Silt</option>
                <option value="Clay">Clay</option>
                <option value="Saline">Saline</option>
                <option value="Black">Black</option>
                <option value="Peaty">Peaty</option>
                <option value="Red">Red</option>
            </select>

            <button type="submit">Recommend Crops</button>
        </form>

        <?php if (!empty($recommendations)): ?>
            <div class="results">
                <h2>Top 3 Recommendations 🌾</h2>
                <ul>
                    <?php foreach ($recommendations as $rec): ?>
                        <li><b><?= htmlspecialchars($rec['crop']) ?></b></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <script src="calc.js"></script>
</body>

</html>
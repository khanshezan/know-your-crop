<?php
// Handle AJAX request first
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['district'])) {
  $district = $_POST['district'];

  $file = fopen("Maharashtra_Crop_Data.csv", "r");
  $header = fgetcsv($file); // skip header row
  $result = null;

  while (($row = fgetcsv($file)) !== FALSE) {
    if (strcasecmp(trim($row[0]), trim($district)) == 0) {
      $result = array(
        "district" => $row[0],
        "soil" => $row[1],
        "climate" => $row[2],
        "major" => $row[3],
        "recommend" => $row[4]
      );
      break;
    }
  }
  fclose($file);

  echo json_encode($result ?: ["error" => "No data found for $district"]);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>District Based Recommendation</title>
  <link rel="icon" type="image/svg+xml" href="images/logo.svg">
  <link rel="stylesheet" href="map.css">
</head>

<body>
  <!-- nav bar -->
  <div class="off-screen-menu">
    <ul>
      <a href="index.php">
        <li>Home</li>
      </a>
      <a href="map.php">
        <li>District-Based Recommendation</li>
      </a>
      <a href="calc.php">
        <li>NPK Calculator</li>
      </a>
      <a href="index.php #page3">
        <li>About</li>
      </a>
    </ul>
  </div>
  <div id="nav" class="nav">
    <a href="index.php"><img src="images/logo.svg" alt="logo" /></a>
    <div class="ham-menu" id="menu-icon"><span></span><span></span><span></span></div>
    <div class="nav-links" id="navbar-links">
      <p><a href="index.php">Home</a></p>
      <p><a href="map.php">District-Based Recommendation</a></p>
      <p><a href="calc.php">NPK Calculator</a></p>
      <p><a href="index.php #page3">About</a></p>
    </div>
  </div>

  <div class="hero-section">
    <h1>District-Based Crop Recommendation</h1>
    <p>Find the best crops for your district based on local climate and soil conditions.</p>
  </div>

  <div class="container">
    <h2>Select Your Location</h2>
    <form id="cropForm">
      <label for="state">Select State:</label>
      <select id="state" required>
        <option value="">--Select State--</option>
        <option value="Maharashtra">Maharashtra</option>
      </select>

      <label for="district">Select District:</label>
      <select id="district" name="district" required>
        <option value="">--Select District--</option>
        <option value="Ahilyanagar (Ahmednagar)">Ahilyanagar (Ahmednagar)</option>
        <option value="Akola">Akola</option>
        <option value="Amravati">Amravati</option>
        <option value="Beed">Beed</option>
        <option value="Bhandara">Bhandara</option>
        <option value="Buldhana">Buldhana</option>
        <option value="Chandrapur">Chandrapur</option>
        <option value="Chhatrapati Sambhajinagar (Aurangabad)">Chhatrapati Sambhajinagar (Aurangabad)</option>
        <option value="Dharashiv (Osmanabad)">Dharashiv (Osmanabad)</option>
        <option value="Dhule">Dhule</option>
        <option value="Gadchiroli">Gadchiroli</option>
        <option value="Gondia">Gondia</option>
        <option value="Hingoli">Hingoli</option>
        <option value="Jalgaon">Jalgaon</option>
        <option value="Jalna">Jalna</option>
        <option value="Kolhapur">Kolhapur</option>
        <option value="Latur">Latur</option>
        <option value="Mumbai City">Mumbai City</option>
        <option value="Mumbai Suburban">Mumbai Suburban</option>
        <option value="Nagpur">Nagpur</option>
        <option value="Nanded">Nanded</option>
        <option value="Nandurbar">Nandurbar</option>
        <option value="Nashik">Nashik</option>
        <option value="Palghar">Palghar</option>
        <option value="Parbhani">Parbhani</option>
        <option value="Pune">Pune</option>
        <option value="Raigad">Raigad</option>
        <option value="Ratnagiri">Ratnagiri</option>
        <option value="Sangli">Sangli</option>
        <option value="Satara">Satara</option>
        <option value="Sindhudurg">Sindhudurg</option>
        <option value="Solapur">Solapur</option>
        <option value="Thane">Thane</option>
        <option value="Wardha">Wardha</option>
        <option value="Washim">Washim</option>
        <option value="Yavatmal">Yavatmal</option>
      </select>

      <button type="submit">Get Recommendation</button>
      <div class="loader" id="loader"></div>
    </form>
  </div>

  <!-- Modal -->
  <div class="modal" id="resultModal">
    <div class="modal-content">
      <h3>Crop Recommendation Result</h3>
      <div class="details" id="resultDetails"></div>
      <button class="close-btn" onclick="closeModal()">Close</button>
    </div>
  </div>

  <script src="map.js"></script>
</body>

</html>
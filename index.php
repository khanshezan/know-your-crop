<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Know Your Crop</title>
  <link rel="icon" type="image/svg+xml" href="images/logo.svg">
  <link rel="stylesheet" type="text/css" href="style.css">

  <script>
    if (performance.getEntriesByType("navigation")[0].type === "reload") {
      // Redirect to same page as a new navigation
      window.location.replace(window.location.origin + window.location.pathname);
    }
  </script>

</head>

<body>
  <main>

    <div class="hero" id="hero">
      <div id="video-container" class="video-container">
        <video autoplay muted loop>
          <source src="videos/rice-crop.mp4" type="video/mp4" />
        </video>
      </div>

      <div id="nav" class="nav">
        <a href="index.php">
          <img src="images/logo.svg" alt="" />
        </a>

        <navbar>
          <p><a href="index.php">Home</a></p>
          <p><a href="map.php">District-Based Recommendation</a></p>
          <p><a href="calc.php">NPK Calculator</a></p>
          <p><a href="#page3">About</a></p>
        </navbar>
      </div>

      <div class="p1header">
        <h1><span>Your</span> <span>Land,</span></h1>
        <h1><span>Your</span> <span>Weather,</span></h1>
        <h1><span>Your</span> <span>Market-</span></h1>
        <p><span>Our Smart Crop Choice.</span></p>
      </div>
      <div class="logo">
        <div class="char anim-out">
          <h1>K</h1>
        </div>
        <div class="char anim-out">
          <h1>n</h1>
        </div>
        <div class="char anim-out">
          <h1>o</h1>
        </div>
        <div class="char anim-out">
          <h1>w</h1>
        </div>
        <div class="char anim-out">
          <h1>Y</h1>
        </div>
        <div class="char anim-out">
          <h1>o</h1>
        </div>
        <div class="char anim-out">
          <h1>u</h1>
        </div>
        <div class="char anim-out">
          <h1>r</h1>
        </div>
        <div class="char anim-out">
          <h1>C</h1>
        </div>
        <div class="char anim-out">
          <h1>r</h1>
        </div>
        <div class="char anim-out">
          <h1>o</h1>
        </div>
        <div class="char anim-out">
          <h1>p</h1>
        </div>
        <div class="char anim-out">
          <h1>.</h1>
        </div>
      </div>
    </div>
    <div class="page2">
      <div class="stack-area">
        <div class="left">
          <div class="title">Our Features</div>
          <div class="sub-title">
            Discover powerful tools designed for farmers - from a smart NPK
            calculator that recommends best crop just by knowing the soil nutrients, to an interactive map
            where you can select your district and instantly get the best crop
            suggestions for your land.
            <br />
            <a href="#page3"><button>See More Details</button></a>
          </div>
        </div>
        <div class="right">
          <div class="card">
            <div class="sub">Soil Suitability</div>
            <div class="content">
              Find crops best suited for your soil type and conditions
            </div>
          </div>
          <div class="card">
            <div class="sub">Farmer-Friendly</div>
            <div class="content">
              Easy to use, accessible from anywhere, anytime
            </div>
          </div>
          <div class="card">
            <div class="sub">Smart NPK Calculator</div>
            <div class="content">
              Balance soil nutrients (N, P, K) for healthier crops and better
              yield
            </div>
          </div>
          <div class="card">
            <div class="sub">District Based Recommendtaion</div>
            <div class="content">
              Pick your district to get instant, region-based crop suggestions
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="scroller">
      <div class="scroller-item">
        <h4>Find</h4>
        <h4>The</h4>
        <h4>Best</h4>
        <h4>Crop</h4>
        <h4>For</h4>
        <h4>You</h4>
        <h4></h4>
        <h4></h4>
        <h4></h4>
      </div>
      <div class="scroller-item">
        <h4>Find</h4>
        <h4>The</h4>
        <h4>Best</h4>
        <h4>Crop</h4>
        <h4>For</h4>
        <h4>You</h4>
        <h4></h4>
        <h4></h4>
        <h4></h4>
      </div>
      <div class="scroller-item">
        <h4>Find</h4>
        <h4>The</h4>
        <h4>Best</h4>
        <h4>Crop</h4>
        <h4>For</h4>
        <h4>You</h4>
        <h4></h4>
        <h4></h4>
        <h4></h4>
      </div>


    </div>
    <div id="page3" class="about">

      <div class="p3container">

        <div class="p3card">
          <img src="images/npk.png" alt="Card Image">
          <div class="p3content">


            <h3>NPK Calculator</h3>

            <p>Enter your soil's Nitrogen (N), Phosphorus (P), and Potassium (K) levels,
              along with soil pH range and type.
              Our system analyzes this data to recommend the most suitable crops
              for your soil conditions.</p>

            <a href="calc.php">Try now</a>

          </div>
        </div>

        <div class="p3card">
          <img src="images/maha-map.jpg" alt="Card Image">
          <div class="p3content">

            <h3>Crop Suitability Map</h3>

            <p>Select your district to discover recommended crops based on soil
              conditions, climate, and market trends.</p>

            <a href="#">Try now</a>

          </div>
        </div>

      </div>

    </div>

  </main>

  <footer>
    <div class="bottom-bar">
      <p>&copy; 2025 Know Your Crop . All rights reserved</p>
      <p><a href="">Privacy Policy</a> | <a href="">Terms and Condition</a></p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.27/bundled/lenis.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.2/vanilla-tilt.min.js"></script>
  <script type="module" src="./script.js"></script>
</body>

</html>
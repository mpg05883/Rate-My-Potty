<?php 
    // require db credentials
    require "../config/config.php";

    // connect to MySQL
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // if there's a connection error:
    if ($mysqli->connect_errno) {
        // print error
        echo $mysqli->connect_error;
        
        // exit program
        exit();
    }

    // define charset
    $mysqli->set_charset('utf8');

    // write SQL cmd to get building id, abbreviation, 
    $sql_marker_info = "SELECT building_id, abbreviation, longitude, latitude
                        FROM buildings;";

    // query SQL cmd
    $results_marker_info  = $mysqli->query($sql_marker_info );
	
    /* if the SQL cmd returns an error:
        - print the error  
        - close db connection
        - exit program
    */
    if (!$results_marker_info) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    // close db connection
	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- self-made stylesheets -->
    <link rel="stylesheet" href="../styles/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- awesome font-->
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>

    <!-- mapbox map -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.js"></script>
    
    <!-- title -->
    <title>Rate My Potty | Home</title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <!-- <style>
        .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }
    </style> -->
</head>
<body>
    <!-- mapbox-gl-geocoder plugin -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

    <!-- include header -->
    <?php include '../components/header.php'; ?>
    <main>
        <!-- hero img container -->
        <div class="container-fluid" id="hero-img-container">
            <div id="hero-img">
            </div>
        </div>

        <!-- parent container's container -->
        <div class="row justify-content-center container-fluid" id="grandparent-container">
            <!-- container for the rest of the page -->
            <div class="col-6" id="parent-container">
                <!-- mission section -->
                <div class="py-4 text-center container-fluid" id="mission-container">
                    <!-- mission header -->
                    <h1 class="pt-4 animate__animated animate__fadeInUp" id="mission-header">Our Mission</h1>
                    
                    <!-- mission statement -->
                    <p class="lh-lg animate__animated animate__fadeInUp" id="mission-statement">
                        Welcome to Rate My Potty! We empower students to conquer the porcelain throne through the 
                        power of peer review. No more bathroom roulette! Unmask hidden gems and expose hygiene horrors 
                        with reviews from real people and insider tips to guide you to the cleanest, most comfortable stalls of USC. 
                    </p>

                    <!-- mission-item-row -->
                    <div class="p-2 row justify-content-center container-fluid animate__animated animate__fadeInUp animate__slower" id="mission-item-row">
                        <div class="col-sm-12 col-md-6 col-lg-4 hover-enlarge">
                            <i class="fa-solid fa-hand-sparkles fa-2xl"></i>
                            <p class="p-2 mission-item-text">Find clean bathrooms</p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 hover-enlarge">
                            <i class="fa-solid fa-map-location-dot fa-2xl"></i>
                            <p class="p-2 mission-item-text">Search bathrooms by location</p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 hover-enlarge">
                            <i class="fa-solid fa-thumbs-up fa-2xl"></i>
                            <p class="p-2 mission-item-text">Reviews from real students</p>
                        </div>
                    </div>

                    <!-- review btn -->
                    <button onclick="location.href = '../pages/upload_form.php'" type="button" class="rounded-4 btn fw-medium animate__animated animate__fadeInUp animate__slower" id="review-btn">
                        <i class="fa-solid fa-pen-to-square fa-sm pe-1" style="color: #000000;"></i>
                        <span id="review-btn-text">Write a review</span>
                    </button>
                </div>

                <!-- map container -->
                <div class="rounded-5 my-4 py-4 animate__animated animate__fadeInUp container-fluid" id="map">
                <script>
                    // API token
                    mapboxgl.accessToken = 'pk.eyJ1IjoibXBnZWUiLCJhIjoiY2xwb3k1ZTFjMHJseDJpcTRiZXFlcGwzaiJ9.xT9UpvZS1bB_T8WmRKS1vQ';
                    
                    // init map object
                    const map = new mapboxgl.Map({
                        container: 'map', // container's id
                        style: 'mapbox://styles/mapbox/streets-v12', // style
                        center: [-118.28567677747262, 34.02181012760304], // starting position [lng, lat]
                        zoom: 15.9 // starting zoom
                    });

                    // add search bar to map
                    map.addControl(
                        new MapboxGeocoder({
                            accessToken: mapboxgl.accessToken,
                            mapboxgl: mapboxgl
                        })
                    );
                    // create the popup
                    // on each pop up, include
                    /*
                    building abbreviation
                    rating
                    anchor tag to bathrom.php
                    */
                    const popup = new mapboxgl.Popup({ offset: 25 }).setText(
                    'Construction on the Washington Monument began in 1848.'
                    );
                    
                    // create DOM element for the marker
                    const el = document.createElement('div');
                    el.id = 'marker';s

                    // Create a default Marker and add it to the map.
                    const marker1 = new mapboxgl.Marker({color: '#017075', scale: 0.6})
                        .setLngLat([-118.28952532067683, 34.019544759288905])
                        .setPopup(popup) // sets a popup on this marker
                        .addTo(map);
                </script>
                </div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.html'; ?>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
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

    // while we can read rows from db:
    while ($row_marker_info = $results_marker_info->fetch_assoc()) {        
        // init associative array where each index holds an array of [building_id, abbreviation, lng, lat]
        $marker_info[] = [
            'building_id' => $row_marker_info['building_id'],
            'abbreviation' => $row_marker_info['abbreviation'],
            'longitude' => number_format($row_marker_info['longitude'], 7, '.', ''),
            'latitude' => number_format($row_marker_info['latitude'], 7, '.', ''),
        ]; 
    }

    // echo '<pre>', var_dump($marker_info), '</pre>';

    // format marker info as JSON
    $json_marker_info = json_encode($marker_info);

    // if building id is null:
    if (is_null($_GET['building_id'])) {
        // set building id to 0
        $building_id = 0;
    }
    // else - set building it to $_GET['building_id']
    else {
        $building_id = $_GET['building_id'];
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
                            <p class="p-2 mission-item-text">Search for bathrooms by location</p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 hover-enlarge">
                            <i class="fa-solid fa-thumbs-up fa-2xl"></i>
                            <p class="p-2 mission-item-text">Reviews from real USC students</p>
                        </div>
                    </div>

                    <!-- review btn -->
                    <button onclick="location.href = '../pages/review_form.php?building_id=<?php echo $building_id; ?>'" type="button" class="rounded-4 btn fw-medium animate__animated animate__fadeInUp animate__slower" id="review-btn">
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

                        // init JSON object using data read in from db
                        const markerData = <?php echo $json_marker_info ?>;
                        
                        // for each building:
                        for (let i = 0; i < Object.keys(markerData).length; i++) {
                            // save index
                            let index = i;

                            // save building id, abbreviation, lng, and lat
                            let building_id = markerData[i.toString()]['building_id'];
                            let abbreviation = markerData[index.toString()]['abbreviation'];
                            let longitude = markerData[index.toString()]['longitude'];
                            let latitude = markerData[index.toString()]['latitude'];

                            console.log(longitude);

                            // const bathroomPopUpLink = "<a class=\"dropdown-item fw-medium\" href=\"../pages/bathroom.php?building_id=\<?php echo $row_marker_info['building_id'] ?>\">\<?php echo $row_marker_info['abbreviation']; ?> </a>";
                                        
                            // init new popup
                            const popup = new mapboxgl.Popup({ offset: 25 }).setText(abbreviation);

                            // create DOM element for the marker
                            const el = document.createElement('div');
                            el.id = building_id;

                            // create default marker and add it to the map.
                            const marker1 = new mapboxgl.Marker({color: '#017075', scale: 0.75})
                                .setLngLat([parseFloat(longitude), parseFloat(latitude)])
                                .setPopup(popup) // sets a popup on this marker
                                .addTo(map);                            
                        }
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
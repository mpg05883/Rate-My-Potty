<?php
    // define function to print # of starts:
    function printStars($rating) {    
        if (round($rating) == 0) {
            echo "<span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>";
        }
        else if (round($rating) == 1) {
            echo "<span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>";
        }
        else if (round($rating)== 2) {
            echo "<span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>";
        }
        else if (round($rating) == 3) {
            echo "<span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star\"></span>
            <span class=\"fa fa-star\"></span>";
        }
        else if (round($rating) == 4) {
            echo "<span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star\"></span>";
        }
        else {
            echo "<span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>
            <span class=\"fa fa-star checked\"></span>";
        }
    }

    // require db credentials
    require "../config/config.php";

    // connect to MySQL
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    /* if there's a connection error:
        - print error
        - exit program 
    */
    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;        
        exit();
    }

    // define charset
    $mysqli->set_charset('utf8');

    // save building id from $_GET
    $building_id = $_GET['building_id'];

    //* get filepaths to photos for this building
    // SQL cmd to get non null filepaths for this building
    $sql_filepaths = "SELECT filepath
                        FROM reviews
                        WHERE filepath IS NOT NULL 
                        AND building_id = " . $building_id . ";";
    
    // query SQL cmd
    $results_filepaths = $mysqli->query($sql_filepaths);

    // if there's an error with querying the SQL cmd:
    if (!$results_filepaths) {
        // print error
        echo $mysqli->error;

        // close connection to db
        $mysqli->close();

        // exit program
        exit();
    }

    // store filepaths in an array
    $filepaths = $results_filepaths->fetch_all();

    //* get building info (name, abbreviation, address, lng, and lat)
    // SQL cmd to get name, abbreviation, address, lng, and lat for current building
    $sql_building_info = "SELECT name, abbreviation, address, longitude, latitude
                        FROM buildings
                        WHERE building_id = " . $building_id . ";";

    // query SQL cmd
    $results_building_info = $mysqli->query($sql_building_info);

    // if there's an error with querying the SQL cmd:
    if (!$results_building_info ) {
        // print error
        echo $mysqli->error;

        // close connection to db
		$mysqli->close();

        // exit program
		exit();
    }

    // get associative array of building info
    $building_info = $results_building_info->fetch_assoc();

    // save values from associative array
    $name = $building_info["name"];
    $abbreviation = $building_info["abbreviation"];
    $address = $building_info["address"];
    $longitude = number_format($building_info["longitude"], 7, '.', '');
    $latitude = number_format($building_info["latitude"], 7, '.', '');

    //* get opening and closing hours for each day of the week
    // SQL cmd to get building's opening and closing hours
    $sql_hours = "SELECT 
                    time_format(mon_open, '%h %i %p') as mon_open,
                    time_format(mon_close, '%h %i %p') as mon_close,
                    time_format(tues_open, '%h %i %p') as tues_open,
                    time_format(tues_close, '%h %i %p') as tues_close,
                    time_format(wed_open, '%h %i %p') as wed_open,
                    time_format(wed_close, '%h %i %p') as wed_close,
                    time_format(thurs_open, '%h %i %p') as thurs_open,
                    time_format(thurs_close, '%h %i %p') as thurs_close,
                    time_format(fri_open, '%h %i %p') as fri_open,
                    time_format(fri_close, '%h %i %p') as fri_close,
                    time_format(sat_open, '%h %i %p') as sat_open,
                    time_format(sat_close, '%h %i %p') as sat_close,
                    time_format(sun_open, '%h %i %p') as sun_open,
                    time_format(sun_close, '%h %i %p') as sun_close
                FROM hours
                WHERE building_id = " . $building_id . ";";

    // query SQL cmd
    $results_hours = $mysqli->query($sql_hours);

    // if there's an error with querying the SQL cmd:
    if (!$results_building_info ) {
        // print error
        echo $mysqli->error;

        // close connection to db
        $mysqli->close();

        // exit program
        exit();
    }
    
    // get associative array of opening and closing hours
    $hours = $results_hours->fetch_assoc();

    // save values from associative array
    $mon_open = $hours['mon_open'];
    $mon_close = $hours['mon_close'];
    $tues_open = $hours['tues_open'];
    $tues_close = $hours['tues_close'];
    $wed_open = $hours['wed_open'];
    $wed_close = $hours['wed_close'];
    $thurs_open = $hours['thurs_open'];
    $thurs_close = $hours['thurs_close'];
    $fri_open = $hours['fri_open'];
    $fri_close = $hours['fri_close'];
    $sat_open = $hours['sat_open'];
    $sat_close = $hours['sat_close'];
    $sun_open = $hours['sun_open'];
    $sun_close = $hours['sun_close'];

    //* get building's amenities
    // SQL cmd to get amenities
    $sql_amenities = "SELECT *
                    FROM amenities
                    WHERE building_id = " . $building_id . ";";

    // query SQL cmd
    $results_amenities = $mysqli->query($sql_amenities);

    // if there's an error with querying the SQL cmd:
    if (!$results_amenities) {
        // print error
        echo $mysqli->error;

        // close connection to db
        $mysqli->close();

        // exit program
        exit();
    }

    // get associative array
    $amenities = $results_amenities->fetch_assoc();

    // save vals from associative array
    $all_genders = $amenities['all_genders'];
    $paper_towels = $amenities['paper_towels'];
    $hand_dryer = $amenities['hand_dryer'];
    $water_fountain = $amenities['water_fountain'];
    $single_occupancy = $amenities['single_occupancy'];
    $multiple_occupancy = $amenities['multiple_occupancy'];
    $feminine_products = $amenities['feminine_products'];
    $shower = $amenities['shower'];
    $ply = $amenities['ply'];

    //* get this building's reviews
    // SQL cmd to get review id, first name, last name, rating, and comments for this building
    $sql_reviews = "SELECT review_id, first_name, last_name, rating, comments
                    FROM reviews
                    WHERE building_id = " . $building_id . ";";

    // query SQL cmd
    $results_reviews = $mysqli->query($sql_reviews);

    // if there's an error with querying the SQL cmd:
    if (!$results_reviews) {
        // print error
        echo $mysqli->error;

        // close connection to db
        $mysqli->close();

        // exit program
        exit();
    }

    // save all reviews 
    $reviews = $results_reviews->fetch_all();

    // count # of reviews for this building
    $sql_number_of_reviews = "SELECT COUNT(*) as count
                            FROM reviews
                            WHERE building_id = " . $building_id . ";";

    // query sql cmd
    $results_number_of_reviews = $mysqli->query($sql_number_of_reviews);

    // if there's an error with querying the SQL cmd:
    if (!$results_number_of_reviews) {
        // print error
        echo $mysqli->error;

        // close connection to db
        $mysqli->close();

        // exit program
        exit();
    }

    // turn result into associative array
    $row_number_of_reviews = $results_number_of_reviews->fetch_assoc();

    // save # of reviews from associative array
    $number_of_reviews = $row_number_of_reviews['count'];
        
    // sum all ratings for this building
    $sql_sum_of_reviews = "SELECT SUM(rating) as sum
                            FROM reviews
                            WHERE building_id = " . $building_id . ";";

    // query
    $results_sum_of_reviews = $mysqli->query($sql_sum_of_reviews);
    
    // if there's an error with querying the SQL cmd:
    if (!$results_sum_of_reviews) {
        // print error
        echo $mysqli->error;

        // close connection to db
        $mysqli->close();

        // exit program
        exit();
    }

    // turn result into associative array
    $row_sum_of_reviews = $results_sum_of_reviews->fetch_assoc();

    // save # of reviews from associative array
    $sum_of_reviews = $row_sum_of_reviews ['sum'];

    // calculate average rating:
    // prevent divide by 0 error
    if (count($reviews) == 0) {
        $average_rating = 0;
    }
    else {
        $average_rating = $sum_of_reviews / $number_of_reviews;
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
    <link rel="stylesheet" href="../styles/bathroom.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- awesome font-->
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>

    <!-- mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.js"></script>
    
    <!-- title -->
    <title>Rate My Potty | <?php echo $abbreviation ?></title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>
<body>
    <!-- include header -->
    <?php include '../components/header.php'; ?>
    <main>
        <!-- carousel container -->
        <div class="bg-light container-fluid" id="carousel-container">
            <div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <!-- if there's 0 images, display placeholder -->
                    <?php if (count($filepaths) == 0) : ?>
                        <!-- item -->
                        <div class="carousel-item active">
                            <div class="carousel-img-container">
                                <img src="../img/placeholder.webp" class="carousel-img d-block w-100" alt="placeholder">
                            </div>
                        </div>

                    <!-- else, display all images for this building -->
                    <?php else : ?>
                        <?php foreach ($filepaths as $key => $val) : ?>
                            <div class="carousel-item active">
                                <div class="carousel-img-container">
                                    <img src="<?php echo($val[0]); ?>" class="carousel-img d-block w-100" alt="<?php echo($val[0]); ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <!-- left carousel button -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <!-- right carousel button -->
                <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
        </div>

        <!-- container to center the rest of the page -->
        <div class="row justify-content-center container-fluid" id="center-container">
            
            <!-- container to make rest of page narrower -->
            <div class="col-8 my-4" id="narrow-container">

                <!-- container for name, rating, address, and review button -->
                <div class="mt-4 mb-2 animate__animated animate__fadeInUp row" id="name-rating-address-container">
                    <!-- building name -->
                    <h1 id="building-name">
                        <?php echo $name . " (" . $abbreviation . ")" ?>
                    </h1>
        
                    <!-- rating -->
                    <div class="" id="rating-container">
                        <?php echo printStars($average_rating); ?>
                        <span class="ps-2 fw-medium fs-5"><?php echo sprintf("%0.1f", $average_rating) ?></span>
                        <span class="ps-1 fw-medium fs-5 text-nowrap"><?php echo " (" . $number_of_reviews . " reviews)"?></span>
                    </div>
                </div>
                
                <!-- review btn - DONT put in a div -->
                <button class="mb-2 rounded-3 btn fw-medium animate__animated animate__fadeInUp animate__slower" onclick="location.href = '../pages/review_form.php?building_id=<?php echo $building_id; ?>'" type="button" id="review-btn">
                    <i class="fa-solid fa-pen-to-square fa-sm pe-1" style="color: #000000;"></i>
                    <span id="review-btn-text">Write a review</span>
                </button>
                
                <!-- container for map, hours, and amenities -->
                <div class="my-4 row justify-content-between align-items-start animate__animated animate__fadeInUp animate__slow" id="map-hours-and-amenities-container">
                    
                    <!-- container for address and map -->
                    <div class="col-sm-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp container-fluid" id="map-address-container">
            
                        <!-- address -->
                        <p class="text-center fw-normal" id="address">
                            <?php echo $address . ", Los Angeles, CA 90089" ?>
                        </p>

                        <!-- map -->
                        <div class="rounded-4" id="map">
                            <script>
                                // API token
                                mapboxgl.accessToken = 'pk.eyJ1IjoibXBnZWUiLCJhIjoiY2xwb3k1ZTFjMHJseDJpcTRiZXFlcGwzaiJ9.xT9UpvZS1bB_T8WmRKS1vQ';
                                // init map object
                                const map = new mapboxgl.Map({
                                    container: 'map', // container's id
                                    style: 'mapbox://styles/mapbox/streets-v12', // style
                                    center: [<?php echo $longitude ?>, <?php echo $latitude ?>], // starting position [lng, lat]
                                    zoom: 16 // starting zoom
                                });
                                // init new popup
                            const popup = new mapboxgl.Popup({ offset: 25 });
                            // create DOM element for the marker
                            const el = document.createElement('div');
                            el.id = <?php echo $building_id ?>;
                                // create default marker and add it to the map.
                                const marker1 = new mapboxgl.Marker({color: '#017075', scale: 0.75})
                                        .setLngLat([<?php echo $longitude ?>, <?php echo $latitude ?>])
                                        .setPopup(popup) // sets a popup on this marker
                                        .addTo(map);
                            </script>
                        </div>
                    </div>
                
                    <!-- hours -->
                    <div class="mt-sm-4 text-center my-md-0 py-2-lg col-sm-12 col-md-6 col-lg-4" id="hours-container">
                        <h2 class="" id="hours-header">Hours</h2>
                        <table class="py-4" id="hours-table">
                            <tr id="monday-row">
                                <td class="day-of-the-week">Mon</td>
                                <td class="text-nowrap"><?php echo $mon_open . " - " . $mon_close?></td>
                            </tr>
                            <tr id="tuesday-row">
                                <td class="day-of-the-week">Tues</td>
                                <td class="text-nowrap"><?php echo $tues_open . " - " . $tues_close; ?></td>
                            </tr>
                            <tr id="wednesday-row">
                                <td class="day-of-the-week">Wed</td>
                                <td class="text-nowrap"><?php echo $wed_open . " - " . $wed_close; ?></td>
                            </tr>
                            <tr id="thursday-row">
                                <td class="day-of-the-week">Thurs</td>
                                <td class="text-nowrap"><?php echo $thurs_open . " - " . $thurs_close; ?></td>
                            </tr>
                            <tr id="friday-row">
                                <td class="day-of-the-week">Fri</td>
                                <td class="text-nowrap"><?php echo $fri_open . " - " . $fri_close; ?></td>
                            </tr>
                            <tr id="saturday-row">
                                <td class="day-of-the-week">Sat</td>
                                <td class="text-nowrap"><?php echo $sat_open . " - " . $sat_close; ?></td>
                            </tr>
                            <tr id="sunday-row">
                                <td class="day-of-the-week">Sun</td>
                                <td class="text-nowrap"><?php echo $sun_open . " - " . $sun_close; ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- amenities container container -->
                    <div class="mt-sm-4 mt-lg-0 text-center my-2-md py-2-md col-sm-12 col-md-6 col-lg-5" id="amenities-container-container">
                        <h2 class="pb-3" id="amenities-header">Amenities</h2>
                        <div class="" id="amenities-container">
                            <div class="row">
                                <!-- if an amenity IS avalible, display it -->
                                <?php 
                                    if ($all_genders) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-person-half-dress fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">All genders option</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($paper_towels) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-box-tissue fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Paper towels</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($hand_dryer) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-wind fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Hand dryer</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($water_fountain) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-glass-water fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Water fountain nearby</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($single_occupancy) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-person fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Single occupancy</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($multiple_occupancy) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-people-group fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Multiple occupancy</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($feminine_products) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-venus fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Feminine Products</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($shower) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-bath fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Shower nearby</p>
                                        </div>';
                                    }
                                ?>
                                <?php 
                                    if ($ply > 1) {
                                        echo '<div class="hover-enlarge col-6 col-md-4 col-lg-3">
                                        <i class="fa-solid fa-2 fa-2xl"></i>
                                        <p class="pt-2 text-wrap fw-medium">Two-ply</p>
                                        </div>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- reviews-container -->
                <div class="row mt-2 mt-4-lg animate__animated animate__fadeInUp animate__slow" id="reviews-container">
                    <!-- reviews header -->
                    <h2 class="pt-2" id="reviews-header">Reviews</h2>
                        <?php if (sizeof($reviews) == 0) : ?>
                            <p>No reviews</p>
                        <?php else : ?>
                            <!-- review-container -->
                            <?php foreach ($reviews as $key => $val) : ?>
                            <div class="bg-light my-3 p-4 rounded-4 review-container">
                                <div class="p-3 user-info-container">
                                    <i class="fa-solid fa-user fa-2xl"></i>
                                    <span class="px-4 fw-semibold fs-5"><?php echo $val[1] . " " . $val[2]; ?></span>
                                </div>
                                <div class="py-2 d-block">
                                    <?php printStars($val[3]); ?>
                                </div>
                                <p class="user-review"><?php echo $val[4]; ?></p>
                                <div class="button-container">
                                    <button onclick="location.href = '../pages/edit_review_form.php?review_id=<?php echo $val[0]; ?>'" type="button" class="btn btn-secondary me-2">Edit</button>
                                    <button onclick="location.href = '../pages/delete_review_confirmation.php?review_id=<?php echo $val[0]; ?>'" type="button" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.html'; ?>
    <!-- include js script tags at end of body -->
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- <script src="../script/bathroom.js"></script> -->
</body>
</html>
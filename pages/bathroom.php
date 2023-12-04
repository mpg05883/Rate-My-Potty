<?php
    // start session
    session_start();

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

    // get building abbreviation
    // echo $_GET['building'];

    // // SQL cmd to get all building abbreviations in alphabetical order 
    // $sql_building_abbreviations = "SELECT building_abbreviation
    //                                 FROM buildings
    //                                 ORDER BY building_abbreviation ASC;";

    // // query SQL cmd
    // $results_building_abbreviations = $mysqli->query($sql_building_abbreviations);

    // // if there's an error with querying the SQL cmd:
    // if (!$results_building_abbreviations) {
    //     // print error
    //     echo $mysqli->error;

    //     // close connection to db
	// 	$mysqli->close();

    //     // exit program
	// 	exit();
    // }

    // close db connection
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link bootstrap above stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/bathroom.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>
    <title>Rate My Potty</title>
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

                    <!-- item -->
                    <div class="carousel-item active">
                        <div class="carousel-img-container">
                            <img src="../img/lyon.jpg" class="carousel-img d-block w-100" alt="./img/test.jpg">
                        </div>
                    </div>

                    <!-- item -->
                    <div class="carousel-item">
                        <div class="carousel-img-container">
                            <img src="../img/rth.jpg" class="carousel-img d-block w-100" alt="./img/test.jpg">
                        </div>
                    </div>

                    <!-- item -->
                    <div class="carousel-item">
                        <div class="carousel-img-container">
                            <img src="../img/leavey.jpg" class="carousel-img d-block w-100" alt="./img/test.jpg">
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- container-container for text content -->
        <div class="p-5 row justify-content-center container-fluid" id="text-content-container-container">
            <!-- container for text content -->
            <div class="col-8" id="text-content-container">

                <!-- container for name, rating, address, and review button -->
                <div class="pb-4 animate__animated animate__fadeInUp row" id="name-rating-address-container">
                    <!-- building name -->
                    <h1 id="building-name">Science & Engineering Library (SSC)</h1>
        
                    <!-- rating -->
                    <div class="" id="rating-container">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="ps-3 fw-medium fs-5">3.5</span>
                        <span class="fw-medium fs-5 text-nowrap">(900 reviews)</span>
                    </div>
                    
                    <!-- address -->
                    <span class="" id="address">
                        910 Bloom Walk, Los Angeles, CA 90089
                    </span>
                </div>
                
                <!-- review btn -- DONT put in a div -->
                <button onclick="location.href = '../pages/upload_form.php'" type="button" class="btn fw-medium animate__animated animate__fadeInUp animate__slower" id="review-btn">
                    <i class="fa-solid fa-pen-to-square fa-sm pe-1" style="color: #000000;"></i>
                    Write a review
                </button>
                
                <!-- container for hours and amenities -->
                <div class="py-4 row animate__animated animate__fadeInUp animate__slow" id="hours-and-amenities-container">
                    <!-- hours -->
                    <div class=" col-sm-12 col-md-6 col-lg-3" id="hours-container">
                        <h2 id="hours-header">Hours</h2>
                        <table class="py-4" id="hours-table">
                            <tr id="monday-row">
                                <td class="day-of-the-week">Mon</td>
                                <td class="text-nowrap">Open 24 hours</td>
                            </tr>
                            <tr id="tuesday-row">
                                <td class="day-of-the-week">Tues</td>
                                <td class="text-nowrap">Open 24 hours</td>
                            </tr>
                            <tr id="wednesday-row">
                                <td class="day-of-the-week">Wed</td>
                                <td class="text-nowrap">Open 24 hours</td>
                            </tr>
                            <tr id="thursday-row">
                                <td class="day-of-the-week">Thurs</td>
                                <td class="text-nowrap">Open 24 hours</td>
                            </tr>
                            <tr id="friday-row">
                                <td class="day-of-the-week">Fri</td>
                                <td class="text-nowrap">Open 24 hours</td>
                            </tr>
                            <tr id="saturday-row">
                                <td class="day-of-the-week">Sat</td>
                                <td class="text-nowrap">Open 24 hours</td>
                            </tr>
                            <tr id="sunday-row">
                                <td class="day-of-the-week">Sun</td>
                                <td class="text-nowrap">Open 24 hours</td>
                            </tr>
                        </table>
                    </div>

                    <!-- amenities container container -->
                    <div class=" pt-4 pt-md-0 col-sm-12 col-md-6 col-lg-9" id="amenities-container-container">
                        <h2 id="amenities-header">Amenities</h2>
                        <div class="" id="amenities-container">
                            <div class="row">
                                <!-- if an amenity is not avalible, set display to none -->
                                <div class="hover-enlarge py-3 col-6 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-person-half-dress fa-2xl"></i>
                                    <span class="text-wrap fw-medium">All genders option</span>
                                </div>
                                <div class="hover-enlarge py-3 col-6 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-box-tissue fa-2xl"></i>
                                    <span class="text-wrap fw-medium">Paper towels</span>
                                </div>
                                <div class="hover-enlarge py-3 col-6 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-wind fa-2xl"></i>
                                    <span class="text-wrap fw-medium">Hand dryer</span>
                                </div>
                                <div class="hover-enlarge py-3 col-6 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-glass-water fa-2xl"></i>
                                    <span class="text-wrap fw-medium">Water fountain nearby</span>
                                </div>
                                <div class="hover-enlarge py-3 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-person fa-2xl"></i>
                                    <span class="text-wrap fw-medium">Single occupancy</span>
                                </div>
                                <div class="hover-enlarge py-3 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-people-group fa-2xl"></i>
                                    <span class="text-wrap fw-medium">Multiple occupancy</span>
                                </div>
                                <div class="hover-enlarge py-3 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-venus fa-2xl"></i>
                                    <span class="text-wrap fw-medium">Feminine Products</span>
                                </div>
                                <div class="hover-enlarge py-3 col-md-4 col-lg-3">
                                    <i class="pe-2 fa-solid fa-bath fa-2xl"></i>
                                    <span class="text-wrap fw-medium">Shower neaby</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- reviews-container -->
                <div class="row pt-4 animate__animated animate__fadeInUp animate__slow" id="reviews-container">
                    <!-- reviews header -->
                    <h2 class="" id="reviews-header">Reviews</h2>

                    <!-- review-container -->
                    <div class="bg-light my-3 p-4 rounded-5 review-container">
                        <div class="p-3 user-info-container">
                            <i class="fa-solid fa-user fa-2xl"></i>
                            <span class="px-4 fw-semibold fs-5">Mike Gee</span>
                        </div>
                        <div class="py-2 d-block" id="rating-container">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <p class="user-review">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem obcaecati voluptatum temporibus reprehenderit aspernatur consequuntur ex deleniti, consequatur modi quasi facere totam! Sit non, inventore, magnam culpa molestiae illo ullam tempore labore quos ducimus iste, quis nisi? Placeat soluta sunt, eum, fuga pariatur, voluptates ipsum consectetur saepe cum recusandae nulla?</p>
                    </div>

                    <!-- review-container -->
                    <div class="bg-light my-3 p-4 rounded-5 review-container">
                        <div class="p-3 user-info-container">
                            <i class="fa-solid fa-user fa-2xl"></i>
                            <span class="px-4 fw-semibold fs-5">Mike Gee</span>
                        </div>
                        <div class="py-2 d-block" id="rating-container">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <p class="user-review">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem obcaecati voluptatum temporibus reprehenderit aspernatur consequuntur ex deleniti, consequatur modi quasi facere totam! Sit non, inventore, magnam culpa molestiae illo ullam tempore labore quos ducimus iste, quis nisi? Placeat soluta sunt, eum, fuga pariatur, voluptates ipsum consectetur saepe cum recusandae nulla?</p>
                    </div>

                    <!-- review-container -->
                    <div class="bg-light my-3 p-4 rounded-5 review-container">
                        <div class="p-3 user-info-container">
                            <i class="fa-solid fa-user fa-2xl"></i>
                            <span class="px-4 fw-semibold fs-5">Mike Gee</span>
                        </div>
                        <div class="py-2 d-block" id="rating-container">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <p class="user-review">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem obcaecati voluptatum temporibus reprehenderit aspernatur consequuntur ex deleniti, consequatur modi quasi facere totam! Sit non, inventore, magnam culpa molestiae illo ullam tempore labore quos ducimus iste, quis nisi? Placeat soluta sunt, eum, fuga pariatur, voluptates ipsum consectetur saepe cum recusandae nulla?</p>
                    </div>
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
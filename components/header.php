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

    // SQL cmd to get all building abbreviations and building ids in alphabetical order 
    $sql_header_abbreviations_ids = "SELECT abbreviation, building_id
                            FROM buildings
                            ORDER BY abbreviation ASC;";

    // query SQL cmd
    $results_header_abbreviations_ids = $mysqli->query($sql_header_abbreviations_ids);

    // if there's an error with querying the SQL cmd:
    if (!$results_header_abbreviations_ids) {
        // print error
        echo $mysqli->error;

        // close connection to db
		$mysqli->close();

        // exit program
		exit();
    }

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
<header>
    <!-- navbar-expand determines when navbar will stack vertically instead of horizontally -->
    <nav class="p-4 navbar-expand-sm navbar-dark navbar">
        <div class="container-fluid" id="navbar-container">
            <!-- logo/link to home page -->
            <!-- animate__animated animate__fadeIn animate__slower -->
            <a class="navbar-brand " href="../pages/home.php" aria-current="page">
                <img class="d-inline-block px-1" src="../img/logo.png" alt="logo" width="65rem">
            </a>

            <!-- create button to toggle navbar when screen size is sm -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- container for navbar elements that'll collapse when screen size is sm -->
            <div class="collapse navbar-collapse" id="navbar">
                <div class="navbar-nav">
                    <!-- home page -->
                    <a class="px-2 nav-link rounded-3 fw-medium" aria-current="page" href="../pages/home.php" style="color: aliceblue;">
                        Home
                    </a>
                    
                    <!-- about page -->
                    <!-- <a class="px-2 nav-link rounded-3" aria-current="page" href="../pages/about.html">About</a> -->

                    <!-- buildings drop down menu -->
                    <div class="nav-item dropdown">
                        <a class="px-2 nav-link dropdown-toggle rounded-3 fw-medium" href="#" role="button" data-bs-toggle="dropdown" style="color: aliceblue;" aria-expanded="false">
                            Buildings
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                                while ( $row_abbreviations_ids = $results_header_abbreviations_ids ->fetch_assoc() ) :
                            ?>
                            <li>
                                <a class="dropdown-item fw-medium" href="../pages/bathroom.php?building_id=<?php echo $row_abbreviations_ids['building_id']; ?>">
                                    <?php
                                        echo $row_abbreviations_ids['abbreviation'];
                                    ?>
                                </a>
                            </li>
                            <?php
                                endwhile;
                            ?>
                        </ul>
                    </div>
                    
                    <!-- write a review button -->
                    <a class="px-2 nav-link rounded-3 fw-medium" aria-current="page" href="../pages/add_review_form.php?building_id=<?php echo $building_id; ?>" style="color: aliceblue;">Write a Review</a>
                </div>
            </div>
        </div>
    </nav>
</header>

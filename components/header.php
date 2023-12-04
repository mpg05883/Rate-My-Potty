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

    // SQL cmd to get all building abbreviations in alphabetical order 
    $sql_abbreviations = "SELECT abbreviation
                                    FROM buildings
                                    ORDER BY abbreviation ASC;";

    // query SQL cmd
    $results_abbreviations = $mysqli->query($sql_abbreviations);

    // if there's an error with querying the SQL cmd:
    if (!$results_abbreviations) {
        // print error
        echo $mysqli->error;

        // close connection to db
		$mysqli->close();

        // exit program
		exit();
    }

    // close db connection
    $mysqli->close();
?>

<header>
    <!-- navbar-expand - determines when navbar will stack vertically instead of horizontally -->
    <nav class="navbar-dark navbar navbar-expand-sm p-4">
        <div class="container-fluid">
            <a class="hover-enlarge navbar-brand animate__animated animate__fadeIn animate__slower" href="../pages/home.php" aria-current="page">
                <img class="d-inline-block px-1" src="../img/logo.png" alt="logo" width="65rem">
            </a>

            <!-- use navbar toggler to create a drop down menu when screen size is sm -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- div nav bar options -->
            <div class="collapse navbar-collapse" id="navBar">
                <ul class="navbar-nav">
                    <a class="px-2 nav-link rounded-3 fw-medium" aria-current="page" href="../pages/home.php" style="color: aliceblue;">Home</a>
                    
                    <!-- about -->
                    <!-- <a class="px-2 nav-link rounded-3" aria-current="page" href="../pages/about.html">About</a> -->

                    <!-- buildings -->
                    <div class="nav-item dropdown">
                        <a class="px-2 nav-link dropdown-toggle rounded-3 fw-medium" href="#" role="button" data-bs-toggle="dropdown" style="color: aliceblue;" aria-expanded="false">
                            Buildings
                        </a>

                        <ul class="dropdown-menu">
                            <?php
                                while ( $row = $results_abbreviations->fetch_assoc() ) :
                            ?>
                            <li>
                                <a class="dropdown-item fw-medium" href="../pages/bathroom.php?building=<?php echo $row['abbreviation'] ?>">
                                    <?php
                                        echo $row['abbreviation'];
                                    ?>
                                </a>
                            </li>
                            <?php
                                endwhile;
                            ?>
                        </ul>
                    </div>
                    
                    <!-- write a review button -->
                    <a class="px-2 nav-link rounded-3 fw-medium" aria-current="page" href="../pages/upload_form.php" style="color: aliceblue;">Write a Review</a>
                </ul>
            </div>
        </div>
    </nav>
</header>

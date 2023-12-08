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

    // save review id
    $review_id = $_GET["review_id"];

    // define charset
    $mysqli->set_charset('utf8');

    // SQL cmd to get review info
    $sql_get_review_info = "SELECT building_id, first_name, last_name, rating, comments, filepath
                FROM reviews
                WHERE review_id = " . $review_id . ";";

    // query SQL cmd
    $results_get_review_info = $mysqli->query($sql_get_review_info);

    // if there's an error with querying the SQL cmd:
    if (!$results_get_review_info) {
        // print error
        echo $mysqli->error;

        // close connection to db
		$mysqli->close();

        // exit program
		exit();
    }

    // save info from results
    $review_info = $results_get_review_info->fetch_assoc();

    // SQL cmd to get all building names and building ids in alphabetical order 
    $sql_buildings = "SELECT name, building_id
                            FROM buildings
                            ORDER BY abbreviation ASC;";

    // query SQL cmd
    $results_buildings = $mysqli->query($sql_buildings);

    // if there's an error with querying the SQL cmd:
    if (!$results_buildings) {
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
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- self-made stylesheets -->
    <link rel="stylesheet" href="../styles/upload_form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- awesome font-->
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>
    
    <!-- title -->
    <title>Rate My Potty | Edit Review Form</title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <!-- container for input forms -->
        <div class="p-5 row justify-content-center container-fluid">
            <div class="col-8"> 
                <h1 class="animate__animated animate__fadeInUp animate__slow" id="building-name">Edit Your Review</h1>
                <form action="edit_review_confirmation.php" method="POST" enctype="multipart/form-data">
                    <input type="number" name="review_id" value="<?php echo $review_id; ?>" id="review-id" style="display: none;">
                    
                    <!-- first name - text input -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slow">
                        <h5>First Name</h5>
                        <input name="firstName" value="<?php echo $review_info["first_name"]; ?>" id="first-name-id" type="text" spellcheck="true" class="w-50 form-control" placeholder="e.g. John" aria-label="firstName" aria-describedby="basic-addon1">
                    </div>

                    <!-- last name - text input -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slow">
                        <h5>Last Name</h5>
                        <input name="lastName" value="<?php echo $review_info["last_name"]; ?>" id="last-name-id" type="text" spellcheck="true" class="w-50 form-control" placeholder="e.g. Smith" aria-label="lastName" aria-describedby="basic-addon1">
                    </div>

                    <!-- buidling dropdown menu -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slow">
                        <h5>Building</h5>
                        <select name="building_id" id="building-id" class="w-50 form-control" required>
                            <option value="null" selected disabled>-- Select One --</option>

                            <?php while ( $row = $results_buildings->fetch_assoc() ) : ?>

                                <?php if ($row['building_id'] == $review_info["building_id"]) :  ?>
                                    
                                    <option value="<?php echo $row['building_id']; ?>" selected>
                                        <?php echo $row['name']; ?>
                                    </option>

                                <?php else : ?>

                                    <option value="<?php echo $row['building_id']; ?>">
                                        <?php echo $row['name']; ?>
                                    </option>

                                <?php endif; ?>
                            <?php endwhile; ?>
                            
                        </select>
                    </div>

                    <!-- number rating -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slower">
                        <h5>Rating</h5>
                        <select name="rating" id="rating-id" class="w-50 form-control" required>
                            <!-- select previous option -->
                            <option value="null" selected disabled>-- Select One --</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <!-- comments - text input -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slower">
                        <h5>Comments</h5>
                        <textarea rows="4" name="comments" id="comments-id" class="w-50 form-control" spellcheck="true"><?php echo $review_info["comments"]; ?></textarea>
                    </div>  

                    <!-- picture upload -->
                    <!-- <div class="py-3 animate__animated animate__fadeInUp animate__slower">
                        <h5>Upload Photos</h5>
                        <div class="mb-3">
                            <input class="form-control w-25" name="review_photo" value="<?php echo $review_info["filepath"]; ?>" type="file" id="review-photo-upload">
                        </div>
                    </div>   -->

                    <!-- submit btn -->
                    <button href="../pages/upload_form.html" type="submit" class="my-4 rounded-3 btn fw-medium animate__animated animate__fadeInUp animate__slower" id="submit-btn">
                        <span id="submit-btn-text">Submit</span>
                    </button>
                </form>
            </div>
        </div>
    </main>
    <?php include '../components/footer.html'; ?>
    <!-- include js script tags at end of body -->
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
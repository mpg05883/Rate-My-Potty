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
    <link rel="stylesheet" href="../styles/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- awesome font-->
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>
    
    <!-- title -->
    <title>Rate My Potty | Add Review Form</title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <!-- container for input forms -->
        <div class="p-5 row justify-content-center container-fluid">
            <div class="col-8"> 
                <h1 class="my-0 animate__animated animate__fadeInUp animate__slow" id="building-name">Write Your Review</h1>

                <!-- required container -->
                <div class="pb-3 animate__animated animate__fadeInUp animate__slow">
                    <span class="asterisk">* </span>
                    <span class="fst-italic">Required</span>
                </div>
                
                <form action="add_review_confirmation.php" method="POST" enctype="multipart/form-data" id="add-review-form">
                    <!-- first name - text input -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slow">
                        <h5><span class="asterisk">* </span>First Name</h5>
                        <input name="firstName" id="first-name" type="text" spellcheck="true" class="w-50 form-control" placeholder="John" aria-label="firstName" aria-describedby="basic-addon1" required>
                        <small class="error" id="first-name-error"></small>
                    </div>
                    
                    <!-- last name - text input -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slow">
                        <h5><span class="asterisk">* </span>Last Name</h5>
                        <input name="lastName" id="last-name" type="text" spellcheck="true" class="w-50 form-control" placeholder="Smith" aria-label="lastName" aria-describedby="basic-addon1" required>
                        <small class="error" id="last-name-error"></small>
                    </div>

                    <!-- buidling dropdown menu -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slow">
                        <h5><span class="asterisk">* </span>Building</h5>
                        <select name="building_id" id="building-id" class="w-50 form-control" required>
                            <option value="" selected disabled>-- Select One --</option>

                            <?php while ( $row = $results_buildings->fetch_assoc() ) : ?>

                                <?php if ($row['building_id'] == $building_id) :  ?>
                                    
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
                        <small class="error" id="building-id-error"></small>
                    </div>
                    <!-- number rating -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slower">
                        <h5><span class="asterisk">* </span>Rating</h5>
                        <select name="rating" id="rating" class="w-50 form-control" required>
                            <option value="" selected disabled>-- Select One --</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <small class="error" id="rating-error"></small>
                    </div>

                    <!-- comments - text input -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slower">
                        <h5>Comments</h5>
                        <textarea rows="4" name="comments" id="comments" class="w-50 form-control" spellcheck="true"></textarea>
                    </div>  

                    <!-- picture upload -->
                    <div class="py-3 animate__animated animate__fadeInUp animate__slower">
                        <h5>Upload Photos</h5>
                        <div class="mb-3">
                            <input class="form-control w-25" name="review_photo" type="file" id="review-photo-upload">
                        </div>
                    </div>  

                    <!-- submit btn -->
                    <button type="submit" class="rounded-3 btn fw-medium animate__animated animate__fadeInUp animate__slower" id="submit-btn">
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
    <!-- <script src="../script/verify_form.js"></script> -->
</body>
</html>
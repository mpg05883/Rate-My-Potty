<?php 
    // echo ("<pre>");
    // var_dump($_POST);
    // echo ("</pre>");

    // echo ("<pre>");
    // var_dump($_FILES);
    // echo ("</pre>");

    //* ========== error check required data ==========
    // return true if first name is not set or is empty
    $firstNameInvalid = !isset($_POST['firstName']) || trim($_POST['firstName']) == '';

    // check last name
    $lastNameInvalid = !isset($_POST['lastName']) || trim($_POST['lastName']) == '';

    // if first name, last name, or rating are invalid:
    if ($firstNameInvalid || $lastNameInvalid) {
        $error = "Invalid input. Please submit a first and last name";

        // exit program
        exit();
    }
    else {
        // //* ========== move photo to uploads folder ==========
        // // save file name
        // $fileName = $_FILES["review_photo"]["name"];

        // // if no photo was uploaded
        // if (trim($fileName) == '') {
        //     $destination = null;
        // } 
        // else {
        //     // if there's an error with the file:
        //     if ($_FILES['review_photo']['error'] > 0 ) {
        //         // print error
        //         $error = "File upload error # " . $_FILES['review_photo']['error'];

        //         // exit program
        //         exit();
        //     }
        //     // else - there's no error with the file
        //     else {
        //         // move file from temporary directory to uploads folder:
        //         $source = $_FILES['review_photo']['tmp_name'];
        //         $destination = "../uploads/" . $_FILES['review_photo']['name'];
        //         $destination = preg_replace('/\s/', '_', $destination);
        //         move_uploaded_file($source, $destination);
        //     }        
        // } 

        //* ========== connect to db, insert review, and insert filepath ==========
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

        // save fist name, last name, building id, and rating
        $review_id = intval($_POST['review_id']);
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $building_id = $_POST['building_id'];
        $rating = intval($_POST['rating']);
        $comments = $_POST['comments'];

        // var_dump($_POST);

        // // if comments is set and not empty:
        // if ( isset($_POST['comments']) && trim($_POST['comments']) != '') {
        //     // save comments
            
        // } 
        // else {
        //     $comments = null;
        // }

        

        // $nullDestination = is_null($destination);
        // $nullComments = is_null($comments);

        // if destination and comments are null
        // if ($nullDestination && $nullComments) {
        //     $sql_insert_new_review = "INSERT INTO reviews (building_id, first_name, last_name, rating, comments, filepath)
        //                                 VALUES ($building_id, '$firstName', '$lastName', $rating, NULL, NULL);";
        // }
        
        // // if destination is not null and comments are null
        // else if (!$nullDestination && $nullComments) {
        //     $sql_insert_new_review = "INSERT INTO reviews (building_id, first_name, last_name, rating, comments, filepath)
        //                                 VALUES ($building_id, '$firstName', '$lastName', $rating, NULL, '$destination');";
        // }

        // // if destination is null and comments are not null
        // else if ($nullDestination && !$nullComments) {
        //     $sql_insert_new_review = "INSERT INTO reviews (building_id, first_name, last_name, rating, comments, filepath)
        //                                 VALUES ($building_id, '$firstName', '$lastName', $rating, '$comments', NULL);";
        // }

        // // if destination and comments are not null
        // else {
        //     $sql_insert_new_review = "INSERT INTO reviews (building_id, first_name, last_name, rating, comments, filepath)
        //                                 VALUES ($building_id, '$firstName', '$lastName', $rating, '$comments', '$destination');";
        // }

        // sql cmd to update review
        $sql_update_review = "UPDATE reviews
                                SET first_name = '$firstName', last_name = '$lastName', rating = $rating, comments = '$comments'
                                WHERE review_id = " . $review_id . ";";

        // query SQL cmd
        $results_update_review = $mysqli->query($sql_update_review);

        // if there's an error with querying the SQL cmd:
        if (!$results_update_review) {
            // print error
            echo $mysqli->error;

            // close connection to db
            $mysqli->close();

            // exit program
            exit();
        }
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
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- awesome font-->
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>
    
    <!-- title -->
    <title>Rate My Potty | Edit Review Confirmation</title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <!-- container for input forms -->
        <div class="p-5 row justify-content-center container-fluid">
            <div class="col-8"> 
                <!-- if there's an error: -->
                <?php if (isset($error) && !empty($error)) : ?>
					<div class="text-danger font-italic">
                        <!-- print error -->
						<?php echo $error; ?>
					</div>	
				<?php else : ?>
					<div class="text-success">
						Review was successfully added.
					</div>
				<?php endif; ?>
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
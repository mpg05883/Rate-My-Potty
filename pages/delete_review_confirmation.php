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

    // save review id from GET
    $review_id = $_GET['review_id'];

    // SQL cmd to delete review
    $sql_delete_review = "DELETE FROM reviews
                        WHERE review_id =" . $review_id . ";";

    // query SQL cmd
    $results_delete_review = $mysqli->query($sql_delete_review);

    // if there's an error with querying the SQL cmd:
    if (!$results_delete_review) {
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
    <link rel="stylesheet" href="../styles/confirmation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- awesome font-->
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>
    
    <!-- title -->
    <title>Rate My Potty | Delete Review Confirmation</title>
    
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
						Review was successfully deleted.
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
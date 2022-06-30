<?php 
    require_once 'word.php'; 
    require_once 'languages.php';
    $language = new Languages();
    $languageOfNow = $language->getLanguageOfNow();
    $wordModel = new Word();
    if(isset($_POST['changeLanguage'])) {$language->changeLanguage();header("refresh:0");}
?>

<!DOCTYPE html>

<html lang="en">


<head>

    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/Grid.css">
    <link rel="stylesheet" type="text/css" href="resources/css/index.css">

    <title>
    Pharaohs Experimental School
    </title>

</head>

<body>
    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <a class="titleA navbar-brand" href="#"><?php echo $wordModel->getSpecificWord("home_title", $languageOfNow); ?></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <form action="#" method="POST">
                <li><input type="submit" value="<?php echo $wordModel->getSpecificWord("nav_0", $languageOfNow); ?>" name="changeLanguage" class="btn btn-info"></li>
                </form>
                    <li><a class="nav-link" href="login.php"><?php echo $wordModel->getSpecificWord("nav_1", $languageOfNow); ?></a></li>
                    <li><a class="nav-link" href="applicationStatus.php"><?php echo $wordModel->getSpecificWord("nav_2", $languageOfNow); ?></a></li>
                    <li><a class="nav-link" href="employeeLogin.php"><?php echo $wordModel->getSpecificWord("nav_3", $languageOfNow); ?></a></li>
                    <li>
                        <a class="nav-link" href="aboutus.php"><?php echo $wordModel->getSpecificWord("nav_4", $languageOfNow); ?></a>
                    </li>

                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $wordModel->getSpecificWord("card1_1", $languageOfNow); ?></h4>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $wordModel->getSpecificWord("card1_2", $languageOfNow); ?></h6>
                            <p class="card-text">
                            <?php echo $wordModel->getSpecificWord("card1_3", $languageOfNow); ?>
                            </p>
                            <a href="register.php?type=teacher" class="btn-sm btn btn-outline-secondary card-link"><?php echo $wordModel->getSpecificWord("button1", $languageOfNow); ?></a>
                            <a href="#!" class="card-link text-secondary"><?php echo $wordModel->getSpecificWord("button2", $languageOfNow); ?></a>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $wordModel->getSpecificWord("card2_1", $languageOfNow); ?></h4>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $wordModel->getSpecificWord("card2_2", $languageOfNow); ?></h6>
                            <p class="card-text">
                            <?php echo $wordModel->getSpecificWord("card2_3", $languageOfNow); ?>
                            </p>
                            <a href="register.php?type=student" class="btn-sm btn btn-outline-info card-link"><?php echo $wordModel->getSpecificWord("button1", $languageOfNow); ?></a>
                            <a href="#!" class="card-link text-info"><?php echo $wordModel->getSpecificWord("button2", $languageOfNow); ?></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $wordModel->getSpecificWord("card3_1", $languageOfNow); ?></h4>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $wordModel->getSpecificWord("card3_2", $languageOfNow); ?></h6>
                            <p class="card-text">
                            <?php echo $wordModel->getSpecificWord("card3_3", $languageOfNow); ?>
                            </p>
                            <a href="register.php?type=parent" class="btn-sm btn btn-outline-secondary card-link"><?php echo $wordModel->getSpecificWord("button1", $languageOfNow); ?></a>
                            <a href="#!" class="card-link text-secondary"><?php echo $wordModel->getSpecificWord("button2", $languageOfNow); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
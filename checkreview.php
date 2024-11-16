<?php

session_start();

include 'connection.php';

if (!isset($_SESSION['submittedForm'])) {
    $_SESSION['submittedForm'] = false;
}

if (isset($_SESSION['isLoggedIn']['status']) && $_SESSION['isLoggedIn']['status'] === true) {
    header('Location: home');
    exit;
}

$accesedByReloading = true;

$query = "SELECT * FROM securityquestions";

$secQuestionsStmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($secQuestionsStmt);

$secQuestionResult = mysqli_stmt_get_result($secQuestionsStmt);

if ($secQuestionResult && mysqli_num_rows($secQuestionResult) > 0) {
    $rows = mysqli_fetch_all($secQuestionResult, MYSQLI_ASSOC);
    $rowCount = count($rows);
} else {
    echo 'Error';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Review | Liriko</title>

    <link rel="stylesheet" href="CSS/signupF2.css">
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="icon" href="Images/Icon/icon-website-l.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.11.0/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="JS/locationsF1.js"></script>
    <script defer src="JS/signupF7.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<body style="font-family: Poppins">
    <header style="background-color: white;">
        <nav class="navbar navbar-expand-lg bg-light px-lg-5">
            <div class="container-fluid">
                <a class="navbar-brand px-4" href="home">
                    <img src="Images/Logo/LIRIKO-LOGO-1.png" width="160px" alt="">
                </a>
                <div class="row right-panel" style="padding-right: 4%;">
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item" style="width: 140%;">
                                <a class="nav-link " style="font-size: 90%;" aria-current="page" href="home"><span><i
                                            class="fa fa-home px-1" aria-hidden="true"></i> Home</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item" style="width: 140%;">
                                <a class="nav-link" href="#" style="font-size: 90%;"><span><i
                                            class="fa-solid fa-store px-1"></i> Shop</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="text-center" style="background-color: black;">
            <h6 class="poppins text-light small py-1 py-lg-2 px-2" style="font-size: 70%; letter-spacing: 0.3px;">
            Experience hassle-free and secure payments at our music store, where you can easily purchase your favorite 
            instruments and items with confidence.
            </h6>
        </div>
    </header>

         <!-- CSS -->
         <style>

        </style>

    <div class="container py-1"></div>    

    <div class="container" >
        <h1 class="mt-5 mb-5">Review</h1>

        <div class="card">
            <div class="card-header">Products</div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-4 text-center">
                        <h1 class="mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>

                        <div class="mb-3">
                            <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                            <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                            <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                            <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                            <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                        </div>

                        <h3><span id="total_review">0</span> Review</h3>
                    </div>

                    <div class="col-sm-1">
                        <p> <div class="progress-label-left"><b class="pl-3">5</b><i class="fas fa-star pl-3"></i> </div> </p>
                        <p> <div class="progress-label-left"><b class="pl-3">4</b><i class="fas fa-star pl-3"></i> </div> </p>
                        <p> <div class="progress-label-left"><b class="pl-3">3</b><i class="fas fa-star pl-3"></i> </div> </p>
                        <p> <div class="progress-label-left"><b class="pl-3">2</b><i class="fas fa-star pl-3"></i> </div> </p>
                        <p> <div class="progress-label-left"><b class="pl-3">1&nbsp;</b><i class="fas fa-star pl-3"></i> </div> </p>
                    
                    </div>

                    <div class="col-sm-3 pt-1">
                        <p>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>

                        <p class="my-4">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>
                        </p>

                        <p class="my-4">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>
                        </p>

                        <p class="my-4">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>
                        </p>

                        <p class="my-4">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>
                        </p>
                    </div>

                    <div class="col-sm-1">
                    <p><div class="progress-label-right">(<span class="total_five_star_review">0</span>)</div></p>
                    <p><div class="progress-label-right">(<span class="total_four_star_review">0</span>)</div></p>
                    <p><div class="progress-label-right">(<span class="total_three_star_review">0</span>)</div></p>
                    <p><div class="progress-label-right">(<span class="total_two_star_review">0</span>)</div></p>
                    <p><div class="progress-label-right">(<span class="total_one_star_review">0</span>)</div></p>
                    </div>

                    <div class="col-sm-3 text-center">
                        <h3 class="mt-4 mb-3">Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-dark">Review</button>
                    </div>
                    
                </div>
            </div>
        </div>

       <div class="mt-5" id="review_content"></div>

    </div>

    <div class="container py-5"></div>

    <!-- Footer -->
    <footer style="background: #121212">
        <section class="footer_content" style="align-content: center; align-items: center;">
            <div class="container text-left text-md-start mt-5">
                <div class="row mt-3">

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"
                        style="padding-top:40px; font-family:Poppins; font-size:15px; letter-spacing: 0.4px;">
                        <ul class="list-unstyled mb-0 text-center text-lg-start">
                            <h6 class="text-uppercase" style="color: white; font-weight:bold;"> Shop
                            </h6>

                            <li>
                                <a href="#!" class="text" style="color: white;">Acoustic Guitar</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Electric Guitar</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Bass Guitar</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Piano</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Drums</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Accessories</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"
                        style="padding-top:40px; font-family:Poppins; font-size:15px; letter-spacing: 0.4px;">
                        <ul class="list-unstyled mb-0 text-center text-lg-start">
                            <h6 class="text-uppercase" style="color: white; font-weight:bold;">
                                Our Company
                            </h6>

                            <li>
                                <a href="#!" class="text" style="color: white;">About</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Career</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Developers</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Contact Us</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"
                        style="padding-top:40px; font-family:Poppins; font-size:15px; letter-spacing: 0.4px;">
                        <ul class="list-unstyled mb-0 text-center text-lg-start">
                            <h6 class="text-uppercase" style="color: white; font-weight:bold;">Support</h6>

                            <li>
                                <a href="#!" class="text" style="color: white;">Customer Service</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Virtual Guitar Tech</a>
                            </li>
                        </ul>
                    </div>


                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-center text-lg-start"
                        style="padding-top:40px; font-family:Poppins;">
                        <h6 class="text-uppercase px-lg-4" style="color: white; font-weight: bold;">FOLLOW
                            OUR SOCIALS</h6>
                        <div class="mt-4">
                            <!-- Facebook -->
                            <a href="#!" type="button" class="btn "><i class="social-icon fab fa-facebook-f fa-2x"
                                    style="color: white;"></i> </a>
                            <!-- Twitter -->
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-twitter fa-2x"
                                    style="color: white;"></i> </a>
                            <!-- Google -->
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-google fa-2x"
                                    style="color: white;"></i> </a>
                            <!-- Instagram -->
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-instagram fa-2x"
                                    style="color: white;"></i> </a>
                        </div>
                    </div>

                    <hr style="color:white;">

                    <div class="" style="padding-top: 30px; ">
                        <h5 class="text-uppercase" style="color: white; font-weight: bold; text-align: center;">Paid
                            Partnership</h5>
                    </div>
                </div>
                <div class="d-lg-flex justify-content-center">
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/EpiphoneLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/FenderLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/GibsonLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/TaylorLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/DDLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/JCraftLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1 ">
                            <img class="img-fluid" src="Images/Brands/TakamineLogo1.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="text-center p-3">
                    <p class="text-white" style="font-size: 12px">
                        Copyright ©2024. Liriko Philippines. All Rights Reserved.
                    </p>
                </div>
            </div>
            </div>
    </footer>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.11.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        // Reset reCAPTCHA widget on page reload
        grecaptcha.ready(function () {
            grecaptcha.reset();
        });
    </script>
</body>

</html>

<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1" style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2" style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3" style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4" style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5" style="color:#E7E2E1;"></i>
                </h4>

                <div class="form-group">
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name"/>
                </div>

                <div class="form-group">
                    <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                </div>

                <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-dark" id="save_review">Submit</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

$(document).ready(function(){

    var rating_data = 0;

    $('#add_review').click(function(){
        $('#review_modal').modal('show');
    });

    $(document).on('mouseenter', '.submit_star ', function(){
        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {
            $('#submit_star_' +count).addClass('text-black');
        }
    });

    function reset_background()
    {
        for(var count = 1; count <=5; count++)
        {
            $('#submit_star_' +count).addClass('star-light');
            $('#submit_star_' +count).removeClass('text-black');
        }
    }

    $(document).on('mouseleave', '.submit_star', function(){
        reset_background();
    });
});
</script>




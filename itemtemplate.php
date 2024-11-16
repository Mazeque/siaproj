<?php

$fetchprod = "SELECT * FROM products p JOIN category c ON p.category_id = c.category_id WHERE product_id = ?";

$fetchstmt = mysqli_prepare($conn, $fetchprod);
$fetchstmt->bind_param("i", $pid);
$fetchstmt->execute();

$fetchresult = $fetchstmt->get_result();

?>

<?php if ($fetchresult && $frow = mysqli_fetch_assoc($fetchresult)):


    $pimage = $frow['product_images'];

    $pimage = trim($pimage, "[]");

    $parray = explode(",", $pimage);

    $parray = array_map('trim', $parray);

    $parray = array_map(function ($item) {
        return str_replace('"', '', $item);
    }, $parray);

    ?>

    <section>
        <div class="col-12 header-container mb-5 d-flex justify-content-center ">
            <div class="col-12 header-cont d-flex justify-content-center">
                <div class="col-12 ">
                    <span class="btp" id="back-prod"><i class="fa-solid fa-chevron-left"></i> Back to products</span>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="col-12 px-5 mb-3">
            <div class="row item-d">
                <div class="col-12 col-lg-6 pt-5">

                    <!-- DIV FOR THE SHOWN CURRENT IMAGE -->
                    <div class="col-12 main-image d-flex justify-content-center ">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($parray); $i++):
                                    $plink = "admin/php-addons/productimages/{$parray[$i]}";
                                    ?>
                                    <div class="carousel-item <?php echo ($i === 0) ? 'active' : ''; ?>">
                                        <img src="<?php echo $plink ?>" class="d-block w-100" alt="...">
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                    </div>
                    <hr>

                    <!-- DIV FOR THE BUTTON BELOW THE MAIN / CURRENT IMAGE -->
                    <div class="sub-image col-12 d-flex justify-content-center justify-content-lg-start mt-3">
                        <?php for ($i = 0; $i < count($parray); $i++):
                            $plink = "admin/php-addons/productimages/{$parray[$i]}";
                            ?>
                            <button type="button" class="image-button mx-1" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="<?php echo $i; ?>" <?php echo ($i === 0) ? 'class="active"' : ''; ?>
                                aria-label="Slide <?php echo ($i + 1) ?>"> <img src="<?php echo $plink ?>"
                                    class="d-block w-100 img-sub" alt="..."></button>
                        <?php endfor; ?>
                    </div>

                    &nbsp;
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-2 px-lg-4 ">
                    <div class="col-12 d-flex justify-content-center justify-content-lg-start">
                        <span class="prod-title text-lg-start text-center">
                            <?php echo $frow['name'] ?>
                        </span>
                    </div>
                    <div class="col-12 d-flex justify-content-center justify-content-lg-start">
                        <span class="prod-subtitle text-lg-start text-center">
                            <?php echo $frow['category_name'] ?>
                        </span>
                    </div>
                    <div class="col-12 d-flex justify-content-center justify-content-lg-start mt-5">
                        <span class="prod-price text-lg-start text-center">
                            ₱<?php echo number_format($frow['price'], 2, '.', '') ?>
                        </span>
                    </div>
                    <div class="col-12 d-flex justify-content-center justify-content-lg-start mt-5 mb-5 ">
                        <div class="col-12 description ">
                            <span class="text-lg-start text-center description-text ">
                                <?php echo $frow['description'] ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 d-flex justify-content-center justify-content-lg-start mt-5 mb-5 ">
                        <div class="row px-2 col-12 d-flex justify-content-center justify-content-lg-start">
                            <div class="col-12 col-lg-3 variation-box  d-flex justify-content-center">
                                <span class="variation-title">Stock(s): </span>
                            </div>
                            <div
                                class="col-12 col-lg-9 d-flex justify-content-center justify-content-lg-start mt-4 mt-lg-0 main-quantity-box px-0">
                                <span class="stocks-total">
                                    <?php echo $frow['stocks'] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center justify-content-lg-start mt-5 mb-5 ">
                        <div class="row px-2 col-12 d-flex justify-content-center justify-content-lg-start">
                            <div class="col-12 col-lg-3 variation-box  d-flex justify-content-center">
                                <span class="variation-title">Quantity: </span>
                            </div>
                            <div
                                class="col-12 col-lg-9 d-flex justify-content-center justify-content-lg-start mt-4 mt-lg-0 main-quantity-box">
                                <div class="quantity-view-box row">
                                    <div class="col px-0 ">
                                        <input type="text" class="qty-field" id="qty-field" />
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        <div class="row">
                                            <div class="col-12 justify-content-center qty-button qty-top">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                            <div class="col-12 justify-content-center qty-button qty-bot">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row d-flex justify-content-center justify-content-lg-start">
                            <div
                                class="col d-flex button-boxx justify-content-center justify-content-lg-start py-2 py-lg-0">
                                <button type="button" class="btn btn-outline-dark checkout-button" <?php if (!isset($_SESSION['isLoggedIn']['status'])): ?> data-bs-toggle="modal"
                                        data-bs-target="#loginModal" <?php endif; ?> id="addcart" prodid="<?php echo $pid; ?>"
                                    price="<?php echo $frow['price'] ?>">ADD TO CART</button>
                            </div>
                            <div
                                class="col d-flex button-boxx justify-content-center justify-content-lg-start py-2 py-lg-0">
                                <button type="button" class="btn btn-dark checkout-button" id="checkoutcart"
                                    prodid="<?php echo $pid; ?>" price="<?php echo $frow['price'] ?>">CHECK
                                    OUT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    $fetchreview = "SELECT * FROM reviews WHERE product_id = ?";
    $fetchstmt = mysqli_prepare($conn, $fetchreview);
    $fetchstmt->bind_param('i', $pid);
    $fetchstmt->execute();

    $fres = $fetchstmt->get_result();

    $numberofreviews = mysqli_num_rows($fres);


    ?>

    <?php

    if (mysqli_num_rows($fres) > 0):

        $totalreviews = 0;

        $totalin5 = 0;
        $totalin4 = 0;
        $totalin3 = 0;
        $totalin2 = 0;
        $totalin1 = 0;

        while ($trow = mysqli_fetch_assoc($fres)) {
            $totalreviews += intval($trow['ratings']);

            if (intval($trow['ratings']) == 1) {
                $totalin1 += 1;
            } else if (intval($trow['ratings']) == 2) {
                $totalin2 += 1;
            } else if (intval($trow['ratings']) == 3) {
                $totalin3 += 1;
            } else if (intval($trow['ratings']) == 4) {
                $totalin4 += 1;
            } else if (intval($trow['ratings']) == 5) {
                $totalin5 += 1;
            }
        }

        $percent5 = ($totalin5 / $totalreviews) * 100;
        $percent4 = ($totalin4 / $totalreviews) * 100;
        $percent3 = ($totalin3 / $totalreviews) * 100;
        $percent2 = ($totalin2 / $totalreviews) * 100;
        $percent1 = ($totalin1 / $totalreviews) * 100;

        $width5 = $percent5;
        $width4 = $percent4;
        $width3 = $percent3;
        $width2 = $percent2;
        $width1 = $percent1;

        $averagereview = floatval($totalreviews / intval($numberofreviews));

        ?>
        <section>
            <div class="col-12 mt-5 pt-3">
                <div class="container">
                    <div class="card">
                        <div class="card-header subtitle mt-0 lt-lg-space">Overall review(s) for this product</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-lg-5 text-center">
                                    <h1 class="mt-4 mb-4">
                                        <b><span
                                                id="average_rating"><?php echo number_format($averagereview, 1, '.', '') ?></span>
                                            / 5</b>
                                    </h1>

                                    <div class="mb-3">
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                    </div>

                                    <h3><span class="total-review inter"
                                            id="total_review"><?php echo $numberofreviews; ?></span> <span
                                            class="subtitle medium-text lg-lt-space"> Review(s)</span></h3>
                                </div>

                                <div class="col-12 col-lg-7 pt-1">
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">5</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-barbg-dark" id="star-review-5"
                                                    style="width: <?php echo $width5 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span
                                                    class="total_five_star_review"><?php echo $totalin5; ?></span>)</div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">4</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-4"
                                                    style="width: <?php echo $width4 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span
                                                    class="total_five_star_review"><?php echo $totalin4; ?></span>)</div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">3</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-3"
                                                    style="width: <?php echo $width3 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span
                                                    class="total_five_star_review"><?php echo $totalin3; ?></span>)</div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">2</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-2"
                                                    style="width: <?php echo $width2 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span
                                                    class="total_five_star_review"><?php echo $totalin2; ?></span>)</div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">1</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-1"
                                                    style="width: <?php echo $width1 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span
                                                    class="total_five_star_review"><?php echo $totalin1; ?></span>)</div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="mt-5" id="review_content"></div>

                </div>
            </div>
        </section>
    <?php else: ?>
        <section>
            <div class="col-12 mt-5 pt-3">
                <div class="container">
                    <div class="card">
                        <div class="card-header subtitle mt-0 lt-lg-space">Overall review(s) for this product</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-lg-5 text-center">
                                    <h1 class="mt-4 mb-4">
                                        <b><span id="average_rating">0</span>
                                        </b>
                                    </h1>

                                    <div class="mb-3">
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                        <i class="fas fa-star star-light  main_star" style="color:#E7E2E1;"></i>
                                    </div>

                                    <h3><span class="total-review inter" id="total_review">0</span> <span
                                            class="subtitle medium-text lg-lt-space"> Review(s)</span></h3>
                                </div>

                                <div class="col-12 col-lg-7 pt-1">
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">5</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-barbg-dark" id="star-review-5" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span class="total_five_star_review">0</span>)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">4</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-4" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span class="total_five_star_review">0</span>)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">3</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-3" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span class="total_five_star_review">0</span>)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">2</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-2" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span class="total_five_star_review">0</span>)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col progress-left">
                                            <span class="progress-label-left"><b class="star-place">1</b><i
                                                    class="fas fa-star"></i></span>
                                        </div>
                                        <div class="col progress-bar-box">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-dark" id="star-review-1" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        <div class="col progress-right">
                                            <div class="progress-label-right">(<span class="total_five_star_review">0</span>)
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="mt-5" id="review_content"></div>

                </div>
            </div>
        </section>

    <?php endif; ?>

    <style>
        .rev-img {
            max-width: 100px;
            max-height: 100px;
            min-height: 100px;
            align-items: center;
        }

        .img-box {
            border-radius: 50px;
            max-width: 90px;
            min-width: 90px;
            max-height: 90px;
            min-height: 90px;
        }

        .name-text {
            font-size: 13px;
            letter-spacing: 1px;
            font-weight: bold;
        }

        .name-col {
            max-width: 180px;
        }

        .star-col {
            max-width: 30px;
        }

        .message-text {
            font-size: 14px;
            letter-spacing: 1px;
        }

        .ratings-num{
            font-size: 13px;
            letter-spacing: 1px;
        }
    </style>

<?php endif; ?>

<?php

$getreviews = "SELECT * FROM reviews r JOIN users u ON r.user_id = u.user_id WHERE r.product_id = ? AND r.user_id = ?";
$getrstmt = mysqli_prepare($conn, $getreviews);
$getrstmt->bind_param("ii", $pid, $_SESSION['userid']);
$getrstmt->execute();

$getrres = $getrstmt->get_result();

if (mysqli_num_rows($getrres) > 0):
    ?>

    <section>
        <div class="col-12 mt-5 pt-3">
            <div class="container">
                <?php while ($revrow = mysqli_fetch_assoc($getrres)): ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col rev-img d-flex justify-content-center">
                                <div class="img-box bg-secondary">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="col py-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg name-col">
                                                <span
                                                    class="name-text"><?php echo $revrow['firstname'] . ' ' . $revrow['lastname'] ?></span>
                                            </div>
                                            <div class="col-lg row">
                                                <div class="col star-col">
                                                    <span class = "ratings-num"><?php echo number_format($revrow['ratings'], 1, '.', '')?></span>
                                                </div>
                                                <?php for ($i = 0; $i < intval($revrow['ratings']); $i++): ?>
                                                    <div class="col star-col">
                                                        <i class="fas fa-star star-light main_star text-black" style="color:#E7E2E1;"></i>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <span class="message-text"><?php echo $revrow['message'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

<?php endif; ?>
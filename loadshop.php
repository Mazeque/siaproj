<?php

include 'connection.php';

$category = $_POST['category'];
$name = $_POST['name'];
$sortby = $_POST['sortby'];
$pagenum = $_POST['pagenum'];

$initpage = $pagenum - 1;
$finalpage = $initpage * 16;

$fetchprod = null;
if ($sortby == 1) {
    $fetchprod = "SELECT * FROM products WHERE category_id = ? AND stocks > 0 ORDER BY price ASC LIMIT ?, 16;";
} else if ($sortby == 2) {
    $fetchprod = "SELECT * FROM products WHERE category_id = ? AND stocks > 0 ORDER BY price DESC LIMIT ?, 16;";
} else if ($sortby == 3) {
    $fetchprod = "SELECT * FROM products WHERE category_id = ? AND stocks > 0 ORDER BY product_date_created DESC LIMIT ?, 16;";
}


$prodstmt = mysqli_prepare($conn, $fetchprod);
$prodstmt->bind_param('ii', $category, $finalpage);
$prodstmt->execute();

$result = $prodstmt->get_result();

$limit = 16;
$itemidx = 1;
$totalrows = mysqli_num_rows($result);
?>
<?php while ($row = $result->fetch_assoc()):




    $priceValue = $row['price'];
    $formattedPrice = number_format($priceValue, 2, '.', ''); 

    $imageString = $row['product_images'];

    $imageString = trim($imageString, "[]");

    $imageArray = explode(",", $imageString);

    $imageArray = array_map('trim', $imageArray);

    $imageArray = array_map(function ($item) {
        return str_replace('"', '', $item);
    }, $imageArray);

    $imagelink = "admin/php-addons/productimages/{$imageArray[0]}"; ?>


    <div class="product-container mx-2 my-2 px-3 py-3 rounded d-flex flex-column">
        <div class="row d-flex justify-content-end flex-grow-1">
            <div class="col-12 mb-0 d-flex justify-content-center " style="height: 70%;">
                <div class="rounded"
                    style="background-image: url(<?php echo $imagelink ?>); background-size: cover; background-position: center; background-repeat: no-repeat; flex-grow: 1; height: 100%; padding: 0;  margin: 0;  margin-bottom: 0px;">
                </div>
            </div>
            <div class="col-12" style="margin-top: -30px; overflow-x: hidden;">
                <div class="row">
                    <div class="col-12 flex-grow-1">
                        <div>
                            <span class="subtitle">
                                <?php echo $name ?>
                            </span>
                        </div>
                        <div class="col-12">
                            <span class="item-name">
                                <?php echo $row['name']; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <div class="row">
                        <div class="col">
                            <div class="item-stocks" style=" position: absolute; bottom: 10px; left: 16px;">
                                <span class="item-stocks">
                                    <?php echo $row['stocks']; ?> stock(s)
                                </span>
                            </div>
                        </div>
                        <div class="col bg-warning">
                            <div class="item-price-box" style=" position: absolute; bottom: 10px; right: 10px;">
                                <span class="item-price fw-bold">₱
                                    <?php echo $formattedPrice; ?>
                                </span>
                            </div>
                            <div class="item-buttons rounded">
                                <button class="btn btn-light my-1 button-item add-to-cart" <?php if (!isset($_SESSION['isLoggedIn'])): ?> data-bs-toggle="modal"
                                        data-bs-target="#loginModal" <?php endif; ?>
                                    productid="<?php echo $row['product_id']; ?>" price="<?php echo $formattedPrice ?>">
                                    <svg class="svg-icon" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" id="cart"
                                        width="20" height="20" style="opacity: 0.9">
                                        <path
                                            d="M91.8 27.3 81.1 61c-.8 2.4-2.9 4-5.4 4H34.4c-2.4 0-4.7-1.5-5.5-3.7L13.1 19H4c-2.2 0-4-1.8-4-4s1.8-4 4-4h11.9c1.7 0 3.2 1.1 3.8 2.7L36 57h38l8.5-27H35.4c-2.2 0-4-1.8-4-4s1.8-4 4-4H88c1.3 0 2.5.7 3.2 1.7.8 1 1 2.4.6 3.6zm-55.4 43c-1.7 0-3.4.7-4.6 1.9-1.2 1.2-1.9 2.9-1.9 4.6 0 1.7.7 3.4 1.9 4.6 1.2 1.2 2.9 1.9 4.6 1.9s3.4-.7 4.6-1.9c1.2-1.2 1.9-2.9 1.9-4.6 0-1.7-.7-3.4-1.9-4.6-1.2-1.2-2.9-1.9-4.6-1.9zm35.9 0c-1.7 0-3.4.7-4.6 1.9s-1.9 2.9-1.9 4.6c0 1.7.7 3.4 1.9 4.6 1.2 1.2 2.9 1.9 4.6 1.9 1.7 0 3.4-.7 4.6-1.9 1.2-1.2 1.9-2.9 1.9-4.6 0-1.7-.7-3.4-1.9-4.6s-2.9-1.9-4.6-1.9z">
                                        </path>
                                    </svg>&nbsp;
                                    <span class="button-tit">Add to cart</span>
                                </button>
                                <button class="btn btn-dark my-2 button-item view-item"
                                    prodid="<?php echo $row['product_id'] ?>"><span class="button-tit">View
                                        item</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>


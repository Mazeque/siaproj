<?php
include '../../connection.php';

$section = htmlspecialchars($_POST['productsection']);

$loadproductsection = "SELECT * FROM products WHERE category_id = ? ORDER BY product_id ASC";

$loadprodstmt = mysqli_prepare($conn, $loadproductsection);
mysqli_stmt_bind_param($loadprodstmt, "i", $section);
mysqli_stmt_execute($loadprodstmt);

$loadprodresult = mysqli_stmt_get_result($loadprodstmt);

$allproducts = array();

if ($loadprodresult && mysqli_num_rows($loadprodresult) > 0) {
    while ($row = mysqli_fetch_assoc($loadprodresult)) {
        $images = json_decode($row['product_images'], true);
        $row['product_images'] = $images;
        $allproducts[] = $row;
    }
}

$allproductsJson = json_encode($allproducts, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
?>


    <?php if (!empty($allproducts)): ?>
        <?php foreach ($allproducts as $row): ?>
            <div class="col-12 product-container px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#prodModal" productid="<?php echo $row['product_id'] ?>">
                <div class="row">
                    <div class="col-4   ">
                        <div class="col-12">
                            <span class="product-title">Product ID</span>
                        </div>
                        <div class="col-12">
                            <span class="text-warning">#<?php echo $row['product_id'] ?></span>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="col-12">
                            <span class="product-title">Product Name</span>
                        </div>
                        <div class="col-12">
                            <span class="fw-bold"><?php echo $row['name'] ?></span>
                        </div>  
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php

            echo '<script>';
            echo 'allproductsJson = {';
            if (!empty($allproducts)) {
                $first = true;
                foreach ($allproducts as $row) {
                    if (!$first) {
                        echo ',';
                    }
                    echo "'" . $row['product_id'] . "': " . json_encode($row);
                    $first = false;
                }
            }
            echo '}; ';
            echo '</script>';
        ?>

    <?php endif; ?>


<div class="modal fade" id="prodModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content theme-color edit-modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product's Information</h5><button type="button" id="close-modal-icon"
                    class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <label for="edit-product-id" class="edit-label">Product ID</label>
                            <input type="text" id="edit-field" class="form-control edit-field" disabled />
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="edit-product-name" class="edit-label">Product Name</label>
                            <input type="text" id="edit-product-name" class="form-control edit-field" />
                        </div>
                    </div>
                </div>
                <div class="col-12 py-3">
                    <label for="edit-product-description" class="edit-label">Product Description</label>
                    <textarea type="text" id="edit-product-description" class="form-control edit-description-field"
                        placeholder="Product Description" rows="5"></textarea>
                </div>
                <div class="col-12 py-3">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <label for="Price" class="edit-label px-1">Product Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-peso-sign"></i>
                                    </span>
                                </div>
                                <input type="text" id="edit-product-price" class="form-control edit-field px-0" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="edit-product-stocks" class="edit-label">Product Stock(s)</label>
                            <input type="text" id="edit-product-stocks" class="form-control edit-field" />
                        </div>
                    </div>
                </div>
                <div class="col-12 py-3">
                    <div class="row">
                        <div class="col-8">
                            <span class="create-product-header">Product Photo</span>
                            <br>
                            <span class="subtitle">Attach images of the product</span>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <button type="button" class="btn-light add-products px-3 py-2" aria-label="Close"
                                id="edit-add-image">
                                <i class="fa-solid fa-plus"></i> <span> Add Image</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row flex-nowrap overflow-auto d-lg-flex justify-content-center justify-content-lg-start py-2 edit-image-container"
                            id="edit-image-container">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row modal-row py-2">
                    <div class="col-6">
                        <button type="button" id="close-modal" class="btn modal-button btn-light px-5 fw-bold"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn modal-button btn-success px-5 fw-bold">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="JS/editprodimg1.js"></script>
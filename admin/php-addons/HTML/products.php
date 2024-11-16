<?php

$fetchcategories = "SELECT * FROM category";

$categorystmt = mysqli_prepare($conn, $fetchcategories);
mysqli_stmt_execute($categorystmt) or die(mysqli_stmt_error($categorystmt));

$categoryresult = mysqli_stmt_get_result($categorystmt);

?>
<div class="col-12 products-section">
    <div class="col-12 py-2">
        &nbsp;
    </div>
    <div class="row products-content">
        <div class="col-12 col-lg-3 border-secondary border-2 border-end">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold text-dark h4 col-12 text-center">Category</span>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <span class=" h6 col-12 text-center subcategory-label">All Categories</span>
            </div>
            <div class="mt-3 mb-2 d-flex justify-content-center">
                <span class="add-category-btn px-5 py-2 rounded" data-bs-toggle="modal"
                    data-bs-target="#categoryModal"><span class="text-warning">+</span> Add Category</span>
            </div>
            <div class="px-3 py-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input type="search" placeholder="Search category" class="form-control search-category">
                </div>
            </div>

            <div class="col-12 mb-5 mb-lg-0 mt-4">
                <?php

                if ($categoryresult && mysqli_num_rows($categoryresult) > 0):
                    while ($row = mysqli_fetch_array($categoryresult)):

                        $fetchproducts = "SELECT * FROM products WHERE category_id = ?";

                        $countstmt = mysqli_prepare($conn, $fetchproducts);
                        $countstmt->bind_param("i", $row['category_id']);
                        $countstmt->execute();

                        $productresult = mysqli_stmt_get_result($countstmt);
                        $productcount = mysqli_num_rows($productresult);

                        ?>

                        <div class="col-12 category-container px-3 py-4" category="<?php echo $row['category_name'] ?>"
                            categoryid="<?php echo $row['category_id'] ?>">
                            <div class="col-12 fw-bold">
                                <span class="category-label">
                                    <?php echo $row['category_name'] ?>
                                </span>
                            </div>
                            <div class="col-12">
                                <span class="subcategory-label">
                                    <?php echo $productcount ?> products
                                </span>
                            </div>
                        </div>

                    <?php endwhile; endif; ?>
            </div>
        </div>

        <div class="col-12 col-lg-3 border-secondary border-2 border-end d-none" id="sub-category-section">
            <!-- <div class="col-12 col-lg-3 border-secondary border-2 category-section  border-end">
                
            </div> -->
            <div class="col-12 d-flex justify-content-center">
                <span id="sub-category-header-label" class="fw-bold text-warning h4 col-12 text-center"></span>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <span class=" h6 col-12 text-center subcategory-label">Products</span>
            </div>
            <div class="mt-3 mb-2 d-flex justify-content-center">
                <span class="add-category-btn px-5 py-2 rounded" id="add-product-button"><span
                        class="text-warning">+</span> Add Product</span>
            </div>
            <div class="px-3 py-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input type="search" placeholder="Search products" class="form-control search-category">
                </div>
            </div>
            <div class="col-12 mb-5 mb-lg-0 mt-4" id="category-content">

            </div>
        </div>
        <div class="col-12 col-lg-6 d-none" id="products-section">
            <div class="row d-flex justify-content-between">
                <div class="col-3">
                </div>
                <div class="col-6  d-flex justify-content-center">
                    <span id="products-header-label" class="fw-bold text-warning h4 col-12 text-center"></span>
                </div>
                <div class="col-3 d-flex justify-content-end px-4">
                    <button type="button" class="btn-light add-products px-3 py-2" data-bs-dismiss="modal"
                        aria-label="Close" id="add-product-button">
                        <i class="fa-solid fa-plus"></i> <span> Add</span>
                    </button>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <span class=" h6 col-12 text-center subcategory-label">Products</span>
            </div>
            <div class="products-content-1 d-none" id="products-content-1">

            </div>
            <div class="products-content-2 d-none" id="products-content-2">

            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div class="modal fade category-modal py-5" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content category-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="categoryModalLabel">Create a new Category</h1>
                    <button type="button" class="btn-light close-category-modal px-3 py-0" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 py-3">
                        <label for="" class="mb-1 input-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control py-2 input-field" id="category-input"
                            placeholder="Enter a category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="category-add-button" class="btn btn-success px-3">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub Category Modal -->
    <div class="modal fade category-modal py-5" id="sub-categoryModal" tabindex="-1"
        aria-labelledby="sub-categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content category-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sub-categoryModalLabel">Create a new Sub Category</h1>
                    <button type="button" class="btn-light close-category-modal px-3 py-0" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 py-3">
                        <label for="" class="mb-1 input-label">Subcategory Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control py-2 input-field" id="sub-category-input"
                            placeholder="Enter a sub-category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="sub-category-add-button" class="btn btn-success px-3">Add</button>
                </div>
            </div>
        </div>
    </div>

</div>
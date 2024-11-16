<?php


?>
<div class="col-12 add-product-content px-3 py-3" id="add-product-content">
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-12 d-flex justify-content-center">
            <span class="create-product-header text-warning" id="product-title-category"></span>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <span class="subtitle">Category</span>
        </div>
    </div>
    <div class="col-12">
        <span class="create-product-header">Create Product</span>
        <span class="subtitle">Add a new product in the list!</span>
    </div>
    <div class="col-12 mt-3">
        <label for="ProductName" class="input-label px-1">Product Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control input-field" placeholder="Product Name" id="product-name">
    </div>
    <div class="col-12 mt-3">
        <label for="ProductDescription" class="input-label px-1">Product Description <span
                class="text-danger">*</span></label>
        <textarea type="text" class="form-control description-field" placeholder="Product Description" rows="5"
            id="product-description"></textarea>
    </div>
    <hr class="mt-4">
    <div class="col-12 mt-3">
        <div class="row">
            <div class="col-12 col-lg-6">
                <label for="Price" class="input-label px-1">Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <input type="price" placeholder="Price" class="form-control price" id="product-price">
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                <label for="Stocks" class="input-label px-1">Stocks <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-field" placeholder="Stocks" id="product-stocks">
            </div>
        </div>
    </div>
    <hr class="mt-4">
    <div class="col-12">
        <div class="col-12 my-2">
            <div class="row">
                <div class="col-8">
                    <span class="create-product-header">Product Photo</span>
                    <span class="subtitle">Attach images of the product</span>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <button type="button" class="btn-light add-products px-3 py-2" data-bs-dismiss="modal"
                        aria-label="Close" id="add-image">
                        <i class="fa-solid fa-plus"></i> <span> Add Image</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row flex-nowrap overflow-auto d-lg-flex justify-content-center justify-content-lg-start py-2"
                id="image-container">
            </div>
        </div>
    </div>
    <div class="col-12 mt-4 mb-2">
        <button class="btn btn-success create-product-button" id="create-product">Create Product</button>
    </div>

</div>
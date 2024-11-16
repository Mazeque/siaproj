<?php
include '../../connection.php';

$productname = htmlspecialchars($_POST['productname']);
$productdescription = htmlspecialchars($_POST['productdescription']);
$productprice = htmlspecialchars($_POST['productprice']);
$productstocks = htmlspecialchars($_POST['productstocks']);
$productcategory = htmlspecialchars($_POST['productcategory']);

$media_dir = "productimages/";

if (!file_exists($media_dir)) {
    mkdir($media_dir, 0777, true);
}

$uploadedImages = [];

if (isset($_FILES['productimages'])) {
    $fileArray = $_FILES['productimages'];

    for ($i = 0; $i < count($fileArray['name']); $i++) {
        $fileName = $fileArray['name'][$i];
        $fileTmpName = $fileArray['tmp_name'][$i];

        $uniqueName = uniqid() . '_' . $fileName;

        $destination = $media_dir . $uniqueName;
        move_uploaded_file($fileTmpName, $destination);
        
        $uploadedImages[] = $uniqueName;
    }
}

$serializedImages = json_encode($uploadedImages);

$stmt = $conn->prepare("INSERT INTO products (name, description, stocks, price, category_id, product_images) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssidis", $productname, $productdescription, $productstocks, $productprice, $productcategory, $serializedImages);
$result = $stmt->execute();

if (!$result) {
    $response = array(
        'success' => false,
        'message' => 'Error creating product: ' . $stmt->error
    );
    echo json_encode($response);
} else {

    $productID = $stmt->insert_id;

    $response = array(
        'success' => true,
        'message' => 'Product created successfully',
        'productID' => $productID,
        'uploadedImages' => $uploadedImages
    );
    echo json_encode($response);
}

$stmt->close();
$conn->close();
?>
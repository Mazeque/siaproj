<?php
include '../../connection.php';

$maincategory = $_POST['maincategory'];

$retrievequery = "SELECT * FROM category WHERE category = ?";
$retrievestmt = mysqli_prepare($conn, $retrievequery);

if ($retrievestmt) {
    mysqli_stmt_bind_param($retrievestmt, "s", $maincategory);
    mysqli_stmt_execute($retrievestmt);
    $retrieveresult = mysqli_stmt_get_result($retrievestmt);

    if ($retrieveresult && mysqli_num_rows($retrieveresult) > 0) {

        while ($row = mysqli_fetch_array($retrieveresult)) {
            $subcategories = json_decode($row['subcategory'], true);

            if ($subcategories === null) {
                exit;
            }

            $keys = array_keys($subcategories);
            $values = array_values($subcategories);
            $numKeys = count($keys);
            for ($i = 0; $i < $numKeys; $i++) {
                $key = $keys[$i];
                $value = $values[$i];
                ?>
                <div class="col-12 sub-category-container px-3 py-4 " subcategory = "<?php echo $key?>">
                    <div class="col-12 fw-bold">
                        <span class="category-label">
                            <?php echo $key ?>
                        </span>
                    </div>
                    <div class="col-12">
                        <span class="subcategory-label">
                           <span productof = "<?php echo $key?>"></span> products
                        </span>
                    </div>
                </div>
                <?php
            }
        }


    } else {
        echo 'No rows found.';
    }

    mysqli_stmt_close($retrievestmt);
} else {
    echo 'Database error. Please try again.';
}
?>
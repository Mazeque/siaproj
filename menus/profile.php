<?php

session_start();
include '../connection.php';

$userquery = "SELECT * FROM users WHERE user_id = ?";
$userstmt = mysqli_prepare($conn, $userquery);
$userstmt->bind_param("i", $_SESSION['userid']);
$userstmt->execute();

$userresult = $userstmt->get_result();

if ($userresult && mysqli_num_rows($userresult) > 0) {
    $urow = mysqli_fetch_assoc($userresult);
} else {

}

$gender = $urow['gender'];
?>
<div class="container h-100">
    <h2>My Profile</h2>
    <span>Manage and protect your account<span>
            <hr>
            <div class="avatar text-center d-flex justify-content-center">
                <?php if ($urow['userprofileimg'] == null): ?>
                    <img src="Images/User/Profile/Image/Default/default-profile.png" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;" id = "profileImage">
                <?php else: ?>
                    <img src="Images/User/Profile/Image/<?php echo $urow['user_id']?>/<?php echo $urow['userprofileimg']; ?>" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;" id = "profileImage">
                <?php endif; ?>
            </div>
            <div class="profile-button col-12 d-flex justify-content-center">

                <div class="file-input-container mt-3 pointer-cursor">
                    <label for="file-input" class="custom-file-input text-center">
                        <i class="fa-solid fa-camera"></i>&nbsp; Change Photo
                    </label>
                    <input type="file" id="input-profile-img" class="actual-file-input">
                </div>

            </div>
            <hr>
            <div class="card-body py-5">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Username</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo $urow['username'] ?>">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Name</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                            value="<?php echo $urow['firstname'] . ' ' . $urow['lastname'] ?>">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo $urow['email'] ?>">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Phone Number</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php $contnum = substr_replace($urow['contactnumber'], '+63', 0, 1);
                        echo $contnum; ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Gender</p>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                                <?php if ($gender == 'Male'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                <?php if ($gender == 'Female'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"
                                <?php if ($gender == 'Other'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="flexRadioDefault3">
                                Other
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"
                                <?php if ($gender == 'Prefer not to say'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="flexRadioDefault3">
                                Prefer not to say
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Date of Birth</p>
                    </div>
                    <div class="col">
                        <div class="form-outline datepicker">
                            <input type="date" class="form-control" id="birthday" name="birthday"
                                style="font-size: 13px;" value="<?php echo $urow['birthday'] ?>">
                        </div>
                        <label class="error-selector" id="error-birthday" style="color: red; font-size: 10px;"></label>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Address</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                            value="<?php echo $urow['street'] . ' ' . $urow['barangay'] . ', ' . $urow['city'] . ' City' ?>">
                    </div>
                </div>
            </div>

</div>

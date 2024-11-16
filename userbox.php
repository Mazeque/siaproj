<?php 

    $fetchwallet = "SELECT * FROM wallet WHERE user_id = ?";
    $fetchstmt = mysqli_prepare($conn, $fetchwallet);
    $fetchstmt -> bind_param("i", $u_row['user_id']);
    $fetchstmt -> execute();

    $fetchres = $fetchstmt -> get_result();

    if (mysqli_num_rows($fetchres) > 0) {
        $f_row = mysqli_fetch_assoc($fetchres);
    }
?>


<div class="user-box d-flex justify-content-between" id="user-box">
    <div class="col-12 container-fluid">
        <div class="col-12 my-2">
            <button type="button" class="btn-close"></button>
        </div>
        <div class="col-12 profile-cont d-flex justify-content-center mt-5">
            <div class="row">
                <div class="col-12 container-fluid d-flex justify-content-center">
                    <div class="profile-avatar">
                        &nbsp;
                    </div>
                </div>
                <div class="col-12 container-fluid d-flex justify-content-center mt-4">
                    <div class="row profile-info d-flex justify-content-center ">
                        <div class="row col-12 d-flex justify-content-center">
                            <div class="col-12 d-flex justify-content-center"> <span
                                    class="profile-name fw-bold letter-spacing big-text"><?php echo $u_row['firstname'] . ' ' . $u_row['lastname'] ?></span>
                            </div>
                            <div class="col-12 d-flex justify-content-center"> <span
                                    class="profile-sname letter-spacing small-text">@<?php echo $u_row['username'] ?></span>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 d-flex justify-content-center container-fluid">
                            <div class="row d-flex justify-content-center">
                                <div class="d-flex justify-content-center bal-bg">
                                    <span class="sm-lt-space fw-bold inter <?php if (!isset($f_row)) : ?> text-danger <?php endif;?> lg-lt-space"><?php if (isset($f_row)) : ?>₱<?php 
                                    echo number_format($f_row['balance'], 2, '.', ''); else : ?> NOT ACTIVATED <?php endif; ?></span>
                                </div>
                                <div class="d-flex justify-content-center mt-1">
                                    <span class="small-text lg-lt-space fade-text">Balance</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="col-12">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center my-2 rounded px-4 profile-menu-box"
                    goto="profile">
                    <div class="box">
                        <i class="fa-solid fa-user" style="width: 30px;"></i> Profile
                    </div>
                    <span class="badge bg-dark rounded-pill"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center my-2 rounded px-4 profile-menu-box"
                    goto="wallet">
                    <div class="box">
                        <i class="fa-solid fa-wallet" style="width: 30px;"></i> My Wallet
                    </div>
                    <span class="badge bg-dark rounded-pill"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center my-2 rounded px-4 profile-menu-box"
                    goto="orders">
                    <div class="box">
                        <i class="fa-solid fa-list-ul" style="width: 30px;"></i> My Orders
                    </div>
                    <span class="badge bg-dark rounded-pill"><?php
                        $cquery = "SELECT COUNT(*) FROM payment WHERE user_id = ? AND order_status = 'Processing' OR order_status = 'On-delivery' GROUP BY order_id";
                        $cstmt = mysqli_prepare($conn, $cquery);
                        $cstmt->bind_param("i", $_SESSION['userid']);
                        $cstmt->execute();

                        $cres = $cstmt->get_result();
                        if (mysqli_num_rows($cres) > 0):
                            echo mysqli_num_rows($cres);
                        endif; ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center my-2 rounded px-4 profile-menu-box"
                    goto="payments">
                    <div class="box">
                        <i class="fa-solid fa-credit-card" style="width: 30px;"></i> Payment Method
                    </div>
                    <span class="badge bg-dark rounded-pill"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center my-2 rounded px-4 profile-menu-box"
                    goto="settings">
                    <div class="box">
                        <i class="fa-solid fa-gear" style="width: 30px;"></i> Settings
                    </div>
                    <span class="badge bg-dark rounded-pill"></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-start px-3 py-3">
        <span class="logout-button pointer lg-lt-space text-danger" id="logout-button"><i
                class="fa-solid fa-right-from-bracket logout-icon"></i>&nbsp; Log out</span>
    </div>


</div>
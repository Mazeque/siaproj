<div class="col-12">

    <div class="row d-flex justify-content-lg-between py-2 px-4">
        <div class="col-12 col-lg-6">
            <span class="user-main-title fw-bold">Users
                <span class="user-sub-title">List of all registered accounts in the system.</span>
            </span>
        </div>
        <div class="col-12 d-lg-none">
            <hr>
        </div>
        <div class="col-12 col-lg-4 mx-lg-4 py-2 d-flex justify-content-end">
            <input type="search" class="form-control search-field">
        </div>
    </div>
    <div class="row px-2 d-flex justify-content-center bg-darkd rounded py-1 pb-2">
        <div class="col-2 col-lg-1 d-flex justify-content-center py-2 border-bottom-title odd">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center container-fluid">ID</span>
            </div>
        </div>
        <div class="col-3 col-lg-2 d-flex justify-content-center py-2 border-bottom-title even">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">Username</span>
            </div>
        </div>
        <div class="col-3 col-lg-2 d-flex justify-content-center py-2 border-bottom-title odd">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">Name</span>
            </div>
        </div>
        <div class="col-lg-1 d-none d-lg-flex d-flex justify-content-center py-2 border-bottom-title even">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">Location</span>
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-flex  justify-content-center py-2 border-bottom-title odd">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">User IP</span>
            </div>
        </div>
        <div class="col-2 col-lg-1 d-flex justify-content-center py-2 border-bottom-title even">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">Type</span>
            </div>
        </div>

        <div class="col-lg-1 d-none d-lg-flex  justify-content-center py-2 border-bottom-title odd">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">Status</span>
            </div>
        </div>
        <div class="col-lg-1 d-none d-lg-flex  justify-content-center py-2 border-bottom-title even">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">Last Seen</span>
            </div>
        </div>
        <div class="col-2 col-lg-1 d-flex justify-content-center py-2 border-bottom-title odd">
            <div class="col-12 d-flex justify-content-center">
                <span class="fw-bold user-header-title text-center">Actions</span>
            </div>
        </div>
    </div>
    <?php $indexrow = 1;
    $dynamicArray = []; ?>
    <?php while ($row = mysqli_fetch_assoc($result)):
        $rowObject = [
            'id' => $row['user_id'],
            'username' => $row['username'],
            'middlename' => $row['middlename'],
            'lastname' => $row['lastname'],
            'firstname' => $row['firstname'],
            'email' => $row['email'],
            'contactnumber' => $row['contactnumber'],
            'birthday' => $row['birthday'],
            'gender' => $row['gender'],
            'country' => $row['country'],
            'barangay' => $row['barangay'],
            'street' => $row['street'],
            'postcode' => $row['postcode'],
            'region' => $row['regionstate'],
            'city' => $row['city'],
            'ip_address' => $row['ip_address'],
            'account_type' => $row['account_type'],
        ];
        array_push($dynamicArray, $rowObject) ?>
        <div class="row px-2 d-flex justify-content-center bg-darkd rounded" index="<?php echo $indexrow ?>">
            <div class="col-2 col-lg-1 d-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center mx-3">
                    <span class="user-info text-center container-fluid">
                        <?php echo $row['user_id'] ?>
                    </span>
                </div>
            </div>
            <div class="col-3 col-lg-2 d-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span class="user-info text-center">
                        <?php echo $row['username'] ?>
                    </span>
                </div>
            </div>
            <div class="col-3 col-lg-2 d-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span class="user-info text-center">
                        <?php echo $row['lastname'] . ', ' . $row['firstname'] ?>
                    </span>
                </div>
            </div>
            <div class="col-lg-1 d-none d-lg-flex  justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span class="user-info text-center">
                        <?php echo $row['country'] ?>
                    </span>
                </div>
            </div>

            <div class="col-lg-2 d-none d-lg-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span class="user-info text-center">
                        <?php echo $row['ip_address'] ?>
                    </span>
                </div>
            </div>
            <div class="col-2 col-lg-1 d-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span
                        class="user-info text-center <?php if ($row['account_type'] === 'Admin'): ?> admin <?php endif; ?>">
                        <?php echo $row['account_type'] ?>
                    </span>
                </div>
            </div>
            <div class="col-lg-1 d-none d-lg-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span class="user-info text-center">
                        <?php echo '0' ?>
                    </span>
                </div>
            </div>
            <div class="col-lg-1 d-none d-lg-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span class="user-info text-center">
                        <?php echo '0' ?>
                    </span>
                </div>
            </div>
            <div class="col-2 col-lg-1 d-flex justify-content-center py-2 border-bottom-title ">
                <div class="col-12 d-flex justify-content-center">
                    <span class="user-info text-center mx-2 mx-lg-2"><i class="fa-solid fa-pen-to-square edit"
                            id="editButton" index="<?php echo $indexrow; ?>"></i></span>
                    <span class="user-info text-center mx-2 mx-lg-2"><i class="fa-solid fa-trash delete"></i></span>
                </div>
            </div>
        </div>
        <?php $indexrow++; ?>
    <?php endwhile; ?>

    <div class="success hide d-none">
         <span class="fas fa-exclamation-circle"></span>
         <span class="msg">Account successfully updated!</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
      </div>
    <script> dynamicArray = <?php echo json_encode($dynamicArray); ?> </script>
</div>

<div class="modal fade mt-5" id="myModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true" index="">
    <div class="modal-dialog" role="document">
        <!-- <form action=""> -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark edit-title">Edit account for <span class="edit-span-title"
                            id="editModalHeader"></span></h5>
                    <button type="button" class="bg-dark py-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="edit-modal modal-body text-dark">
                    <div class="col-12">
                        <span>User ID: <span id="edit-id" class="text-danger fw-bold"></span></span>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="edit-field-label" for="Username">Username</label>
                        <input type="text" class="form-control" id="edit-username" placeholder="Username">
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-4">
                                <label class="edit-field-label" for="Username">First name</label>
                                <input type="text" class="form-control" id="edit-firstname" placeholder="First name">
                            </div>
                            <div class="col-4">
                                <label class="edit-field-label" for="Username">Middle name</label>
                                <input type="text" class="form-control" id="edit-middlename" placeholder="Middle name">
                            </div>
                            <div class="col-4">
                                <label class="edit-field-label" for="Username">Last name</label>
                                <input type="text" class="form-control" id="edit-lastname" placeholder="Last name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="edit-field-label" for="Email">Email</label>
                        <input type="text" class="form-control" id="edit-email" placeholder="Email">
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="edit-field-label" for="Contactnumber">Contact number</label>
                                <input type="text" class="form-control" id="edit-contactnumber"
                                    placeholder="Contact number">
                            </div>
                            <div class="col-6">
                                <label class="edit-field-label" for="Gender">Gender</label>
                                <select class="form-control" id="edit-gender">
                                    <option>Specify</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                    <option>Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="edit-field-label" for="Birthday">Birthday</label>
                        <div class="form-outline datepicker">
                            <input type="date" class="form-control" id="edit-birthday" name="birthday">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-4">
                                <label class="edit-field-label" for="Country">Country</label>
                                <select class="form-control" id="edit-country" name="country">
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="edit-field-label" for="State">State / Province</label>
                                <select class="form-control" id="edit-state" name="state">
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="edit-field-label" for="City">City</label>
                                <select class="form-control" id="edit-city" name="city">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-4">
                                <label class="edit-field-label" for="Barangay">Barangay</label>
                                <input type="text" class="form-control" id="edit-barangay" placeholder="Barangay">
                            </div>
                            <div class="col-4">
                                <label class="edit-field-label" for="Street">Street</label>
                                <input type="text" class="form-control" id="edit-street" placeholder="Street">
                            </div>
                            <div class="col-4">
                                <label class="edit-field-label" for="Postcode">Post code</label>
                                <input type="text" class="form-control" id="edit-postcode" placeholder="Postcode">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="edit-field-label" for="AccountType">Account Type</label>
                        <select class="form-control" id="edit-accounttype" name="accounttype">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name = "submit" id="edit-savebutton" class="btn btn-dark submit-button">Save changes</button>
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>
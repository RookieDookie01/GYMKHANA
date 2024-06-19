<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbusername = "gymkhana_db";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbusername)) {
    die("Failed to connect!");
}
//Start login and register
session_start();
if (isset($_POST['register_btn'])) {
    $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
    $customer_username = mysqli_real_escape_string($con, $_POST['customer_username']);
    $customer_password = mysqli_real_escape_string($con, $_POST['customer_password']);
    $customer_cpassword = mysqli_real_escape_string($con, $_POST['customer_cpassword']);

    //check if username already registered
    $check_useremail_query = "SELECT customer_username FROM customer WHERE customer_username = '$customer_username' ";
    $check_useremail_query_run = mysqli_query($con, $check_useremail_query);

    if (mysqli_num_rows($check_useremail_query_run) > 0) {
        echo "<script>
                    setTimeout(function() {
                    alert('Username already registered');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/uregister.php';
                    }, 1);
                </script>";
        exit();
    } else {
        if ($customer_password == $customer_cpassword) { // Change $user_cpassword to $customer_cpassword
            $insert_query = "INSERT INTO customer (customer_name, customer_username, customer_password) VALUES ('$customer_name', '$customer_username', '$customer_password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                echo "<script>
                        setTimeout(function() {
                            alert('Registered Successfully');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/ulogin.php';
                        }, 1);
                    </script>";
                exit();
            } else {
                echo "<script>
                        setTimeout(function() {
                            alert('Something went wrong');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/ulogin.php';
                        }, 1);
                    </script>";
                exit();
            }
        } else {
            echo "<script>
                        setTimeout(function() {
                            alert('Password do not match');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/uregister.php';
                        }, 1);
                    </script>";
            exit();
        }
    }
}
if (isset($_POST['login_btn'])) {
    $customer_username = mysqli_real_escape_string($con, $_POST['customer_username']);
    $customer_password = mysqli_real_escape_string($con, $_POST['customer_password']);

    $login_query = "SELECT * FROM customer WHERE customer_username='$customer_username' AND customer_password='$customer_password' ";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_array($login_query_run);
        $customer_id = $userdata['customer_id'];
        $customer_username = $userdata['customer_username'];
        $customer_email = $userdata['customer_email'];
        $customer_name = $userdata['customer_name'];
        $customer_address = $userdata['customer_address'];
        $customer_contact = $userdata['customer_contact'];
        $customer_plan = $userdata['customer_plan'];

        $_SESSION['auth_user'] = [
            'customer_id' => $customer_id,
            'customer_username' => $customer_username,
            'customer_email' => $customer_email,
            'customer_name' => $customer_name,
            'customer_address' => $customer_address,
            'customer_contact' => $customer_contact,
            'customer_plan' => $customer_plan
        ];

        //$_SESSION['message'] = "Login successful";
        echo "<script>
            setTimeout(function() {
                alert('Login successful');
                window.location.href = '/myWeb/GYMKHANA/member/index.php';
            }, 1);
        </script>";
        exit();
    } else {
        //$_SESSION['message'] = "Invalid username or password";
        echo "<script>
            setTimeout(function() {
                alert('Invalid username or password');
                window.location.href = '/myWeb/GYMKHANA/member/upage/ulogin.php';
            }, 1);
        </script>";
        exit();
    }
}
// ---------------- end login and register user

//  ---------------- start edit profile 
if (isset($_POST['update_profile_btn'])) {
    $current_user = $_SESSION['auth_user']['customer_username'];
    $customer_email = mysqli_real_escape_string($con, $_POST['customer_email']);
    $customer_contact = mysqli_real_escape_string($con, $_POST['customer_contact']);
    $customer_address = mysqli_real_escape_string($con, $_POST['customer_address']);

    $update_query = "UPDATE customer SET customer_email='$customer_email', customer_contact='$customer_contact', customer_address='$customer_address' WHERE customer_username='$current_user'";
    $run_update_query = mysqli_query($con, $update_query);

    if ($run_update_query) {
        echo "<script>
                    setTimeout(function() {
                        alert('Profile Updated');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uprofile.php';
                    }, 1);
                </script>";
        exit();
    } else {
        echo "<script>
                    setTimeout(function() {
                        alert('Failed to update profile');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uprofile.php';
                    }, 1);
                </script>";
        exit();
    }
} elseif (isset($_POST['update_password_btn'])) {
    $current_user = $_SESSION['auth_user']['customer_username'];
    $cpassword = $_POST['cpassword'];
    $npassword = $_POST['npassword'];
    $cnpassword = $_POST['cnpassword'];

    $qry = "SELECT * FROM customer WHERE customer_username='$current_user'";
    $run_qry = mysqli_query($con, $qry);

    if (mysqli_num_rows($run_qry) > 0) {
        foreach ($run_qry as $qq) {
            if ($cpassword == $qq['customer_password']) {
                if ($npassword == $cnpassword) {
                    $reset_query = "UPDATE customer SET customer_password='$npassword' WHERE customer_username='$current_user'";
                    $run_reset_query = mysqli_query($con, $reset_query);

                    if ($run_reset_query) {
                        echo "<script>
                                setTimeout(function() {
                                    alert('Password Has Been Changed');
                                    window.location.href = '/myWeb/GYMKHANA/member/upage/uprofile.php';
                                }, 1);
                            </script>";
                        exit();
                    }
                } else {
                    echo "<script>
                            setTimeout(function() {
                                alert('Password Not Match');
                                window.location.href = '/myWeb/GYMKHANA/member/upage/uupdatepassword.php';
                            }, 1);
                        </script>";
                    exit();
                }
            } else {
                echo "<script>
                            setTimeout(function() {
                                alert('Wrong Password');
                                window.location.href = '/myWeb/GYMKHANA/member/upage/uupdatepassword.php';
                            }, 1);
                        </script>";
                exit();
            }
        }
    }
}
//  ---------------- end edit profile 

// ---------------- start Trainer apply 
if (isset($_POST['apply_btn'])) {
    chdir(dirname(__FILE__));

    $apply_name = mysqli_real_escape_string($con, $_POST['apply_name']);
    $apply_class_name = mysqli_real_escape_string($con, $_POST['apply_class_name']);
    $apply_class_type = mysqli_real_escape_string($con, $_POST['apply_class_type']);
    $apply_class_desc = mysqli_real_escape_string($con, $_POST['apply_class_desc']);
    $apply_email = mysqli_real_escape_string($con, $_POST['apply_email']);
    $apply_contact = mysqli_real_escape_string($con, $_POST['apply_contact']);
    $apply_address = mysqli_real_escape_string($con, $_POST['apply_address']);

    $userEnteredType = mysqli_real_escape_string($con, $_POST['otherType']);

    if ($apply_class_type == 'Choose your option') {
        echo "<script>
                    alert('Please choose a class type.');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                </script>";
        exit();
    }

    $finalClassType = $apply_class_type === 'other' ? $userEnteredType : $apply_class_type;

    function generateUniqueCode($con)
    {
        $code = mt_rand(100000, 999999);
        $check_query = "SELECT * FROM applynow WHERE apply_code = '$code'";
        $check_result = mysqli_query($con, $check_query);

        while ($check_result && mysqli_num_rows($check_result) > 0) {
            $code = mt_rand(100000, 999999);
            $check_query = "SELECT * FROM applynow WHERE apply_code = '$code'";
            $check_result = mysqli_query($con, $check_query);
        }

        return $code;
    }

    $apply_code = generateUniqueCode($con);

    $targetDirectory = "../img/trainer/";
    $targetFile = $targetDirectory . basename($_FILES["apply_image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["apply_image"]["tmp_name"]);
    if ($check !== false) {
        if (file_exists($targetFile)) {
            echo "<script>
                        alert('Sorry, file already exists.');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                    </script>";
            exit();
        }

        if ($_FILES["apply_image"]["size"] > 500000) { // Adjust the size limit as needed
            echo "<script>
                        alert('Sorry, your file is too large.');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                    </script>";
            exit();
        }

        $allowedFormats = array("jpg", "jpeg", "png");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<script>
                        alert('Sorry, only JPG, JPEG, & PNG  files are allowed.');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                    </script>";
            exit();
        }
        if (move_uploaded_file($_FILES["apply_image"]["tmp_name"], $targetFile)) {
            $apply_image_path = $targetFile;

            $insert_query = "INSERT INTO applynow (apply_name, apply_class_name, apply_class_type, apply_class_desc, apply_email, apply_contact, apply_address, apply_image, apply_code) 
            VALUES ('$apply_name', '$apply_class_name', '$finalClassType', '$apply_class_desc', '$apply_email', '$apply_contact', '$apply_address', '$apply_image_path', '$apply_code')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                echo "<script>
                            alert('Applied Successfully');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                        </script>";
                exit();
            } else {
                echo "<script>
                            alert('Something went wrong');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                        </script>";
                exit();
            }
        } else {
            echo "<script>
                        alert('Sorry, there was an error uploading your file.');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                    </script>";
            exit();
        }
    } else {
        echo "<script>
                    alert('File is not an image.');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
                </script>";
        exit();
    }
}
// ---------------- End Trainer apply
// ---------------- Start Trainer check code
if (isset($_POST['code_btn'])) {
    $apply_code = mysqli_real_escape_string($con, $_POST['apply_code']);

    $login_query = "SELECT * FROM applynow WHERE apply_code='$apply_code'";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        // Code approved
        $apply_data = mysqli_fetch_assoc($login_query_run);

        $check_trainer_query = "SELECT * FROM trainer WHERE trainer_email = '" . mysqli_real_escape_string($con, $apply_data['apply_email']) . "'";
        $check_trainer_query_run = mysqli_query($con, $check_trainer_query);

        if (mysqli_num_rows($check_trainer_query_run) > 0) {
            $update_trainer_query = "UPDATE trainer SET
                trainer_name = '" . mysqli_real_escape_string($con, $apply_data['apply_name']) . "',
                trainer_contact = '" . mysqli_real_escape_string($con, $apply_data['apply_contact']) . "',
                trainer_address = '" . mysqli_real_escape_string($con, $apply_data['apply_address']) . "',
                trainer_image = '" . mysqli_real_escape_string($con, $apply_data['apply_image']) . "'
                WHERE trainer_email = '" . mysqli_real_escape_string($con, $apply_data['apply_email']) . "'";

            $update_trainer_query_run = mysqli_query($con, $update_trainer_query);

            if (!$update_trainer_query_run) {
                echo "<script>
                    setTimeout(function() {
                        alert('Error updating Trainer');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
                    }, 1);
                </script>";
                exit();
            }
        } else {
            $insert_trainer_query = "INSERT INTO trainer (trainer_name, trainer_email, trainer_contact, trainer_address, trainer_image) VALUES (
                '" . mysqli_real_escape_string($con, $apply_data['apply_name']) . "',
                '" . mysqli_real_escape_string($con, $apply_data['apply_email']) . "',
                '" . mysqli_real_escape_string($con, $apply_data['apply_contact']) . "',
                '" . mysqli_real_escape_string($con, $apply_data['apply_address']) . "',
                '" . mysqli_real_escape_string($con, $apply_data['apply_image']) . "'
            )";

            $insert_trainer_query_run = mysqli_query($con, $insert_trainer_query);

            if (!$insert_trainer_query_run) {
                echo "<script>
                    setTimeout(function() {
                        alert('Error registering Trainer');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
                    }, 1);
                </script>";
                exit();
            }
        }

        // Get or insert trainer_id
        $trainer_id_query = "SELECT trainer_id FROM trainer WHERE trainer_email = '" . mysqli_real_escape_string($con, $apply_data['apply_email']) . "'";
        $trainer_id_query_run = mysqli_query($con, $trainer_id_query);
        $trainer_id = mysqli_fetch_assoc($trainer_id_query_run)['trainer_id'];

        // Check if class already exists
        $check_class_query = "SELECT * FROM class WHERE trainer_id = '$trainer_id' AND class_name = '" . mysqli_real_escape_string($con, $apply_data['apply_class_name']) . "'";
        $check_class_query_run = mysqli_query($con, $check_class_query);

        if (mysqli_num_rows($check_class_query_run) > 0) {
            // Class exists, update the existing record
            $update_class_query = "UPDATE class SET
                class_type = '" . mysqli_real_escape_string($con, $apply_data['apply_class_type']) . "',
                class_desc = '" . mysqli_real_escape_string($con, $apply_data['apply_class_desc']) . "'
                WHERE trainer_id = '$trainer_id' AND class_name = '" . mysqli_real_escape_string($con, $apply_data['apply_class_name']) . "'";

            $update_class_query_run = mysqli_query($con, $update_class_query);

            if (!$update_class_query_run) {
                echo "<script>
                    setTimeout(function() {
                        alert('Error updating Class');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
                    }, 1);
                </script>";
                exit();
            }
        } else {
            // Class does not exist, insert a new record
            $insert_class_query = "INSERT INTO class (trainer_id, class_name, class_type, class_desc) VALUES (
                '$trainer_id',
                '" . mysqli_real_escape_string($con, $apply_data['apply_class_name']) . "',
                '" . mysqli_real_escape_string($con, $apply_data['apply_class_type']) . "',
                '" . mysqli_real_escape_string($con, $apply_data['apply_class_desc']) . "'
            )";

            $insert_class_query_run = mysqli_query($con, $insert_class_query);

            if (!$insert_class_query_run) {
                echo "<script>
                    setTimeout(function() {
                        alert('Error registering Class');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
                    }, 1);
                </script>";
                exit();
            }
        }

        // $_SESSION['message'] = "Trainer and Class registered successfully";
        echo "<script>
        setTimeout(function() {
            alert('Code approved.');
            window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php?apply_code={$apply_code}';
        }, 1);
    </script>";
        exit();
    } else {
        // Code rejected
        echo "<script>
            setTimeout(function() {
                alert('Code rejected');
                window.location.href = '/myWeb/GYMKHANA/member/upage/uapplynow.php';
            }, 1);
        </script>";
        exit();
    }
}
// ---------------- end Trainer check code
// ---------------- start Trainer register 
if (isset($_POST['registert_btn'])) {
    $apply_code = mysqli_real_escape_string($con, $_POST['apply_code']);

    // Retrieve the trainer_id from applynow table based on the apply_code
    $get_trainer_id_query = "SELECT apply_id FROM applynow WHERE apply_code = '$apply_code'";
    $get_trainer_id_query_run = mysqli_query($con, $get_trainer_id_query);

    if ($get_trainer_id_query_run) {
        $apply_data = mysqli_fetch_assoc($get_trainer_id_query_run);
        $trainer_id = $apply_data['apply_id'];

        $trainer_username = mysqli_real_escape_string($con, $_POST['trainer_username']);
        $trainer_password = mysqli_real_escape_string($con, $_POST['trainer_password']);
        $trainer_cpassword = mysqli_real_escape_string($con, $_POST['trainer_cpassword']);
        $trainer_age = mysqli_real_escape_string($con, $_POST['trainer_age']);
        $trainer_height = mysqli_real_escape_string($con, $_POST['trainer_height']);
        $trainer_weight = mysqli_real_escape_string($con, $_POST['trainer_weight']);
        $class_day = mysqli_real_escape_string($con, $_POST['class_day']);
        $class_time = mysqli_real_escape_string($con, $_POST['class_time']);

        $check_useremail_query = "SELECT trainer_username FROM trainer WHERE trainer_username = '$trainer_username'";
        $check_useremail_query_run = mysqli_query($con, $check_useremail_query);

        if (mysqli_num_rows($check_useremail_query_run) > 0) {
            echo "<script>
                    setTimeout(function() {
                        alert('Username already registered');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/uregister.php';
                    }, 1);
                </script>";
            exit();
        } else {
            if ($trainer_password == $trainer_cpassword) {
                $update_trainer_query = "UPDATE trainer SET 
                    trainer_username = '$trainer_username', 
                    trainer_password = '$trainer_password', 
                    trainer_age = '$trainer_age', 
                    trainer_height = '$trainer_height', 
                    trainer_weight = '$trainer_weight' 
                    WHERE trainer_id = '$trainer_id'";

                $update_trainer_query_run = mysqli_query($con, $update_trainer_query);

                if ($update_trainer_query_run) {
                    $update_class_query = "UPDATE class SET 
                        class_day = '$class_day', 
                        class_time = '$class_time' 
                        WHERE trainer_id = '$trainer_id'";

                    $update_class_query_run = mysqli_query($con, $update_class_query);

                    if ($update_class_query_run) {
                        echo "<script>
                            setTimeout(function() {
                                alert('Registered Successfully');
                                window.location.href = '/myWeb/GYMKHANA/member/upage/utrainer.php';
                            }, 1);
                        </script>";
                        exit();
                    } else {
                        echo "<script>
                            setTimeout(function() {
                                alert('Error updating class information');
                                window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
                            }, 1);
                        </script>";
                        exit();
                    }
                } else {
                    echo "<script>
                        setTimeout(function() {
                            alert('Error updating trainer information');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
                        }, 1);
                    </script>";
                    exit();
                }
            } else {
                echo "<script>
                        setTimeout(function() {
                            alert('Password do not match');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
                        }, 1);
                    </script>";
                exit();
            }
        }
    } else {
        echo "<script>
            setTimeout(function() {
                alert('Error retrieving trainer_id');
                window.location.href = '/myWeb/GYMKHANA/member/upage/uregistert.php';
            }, 1);
        </script>";
        exit();
    }
}
// ---------------- end Trainer register 

// ---------------- start payment
if (isset($_POST['pay_btn'])) {
    $current_user = $_SESSION['auth_user']['customer_username'];
    $customer_id = $_SESSION['auth_user']['customer_id'];
    $selectedPlanId = mysqli_real_escape_string($con, $_POST['plan_id']);
    $card_number = mysqli_real_escape_string($con, $_POST['card_number']);
    $card_holder = mysqli_real_escape_string($con, $_POST['card_holder']);
    $card_cvc = mysqli_real_escape_string($con, $_POST['card_cvc']);
    $card_mm = mysqli_real_escape_string($con, $_POST['card_mm']);
    $card_yy = mysqli_real_escape_string($con, $_POST['card_yy']);

    // Check card details
    $check_query = "SELECT * FROM cardd WHERE 
        card_number = '$card_number' AND
        card_holder = '$card_holder' AND
        card_cvc = '$card_cvc' AND
        card_mm = '$card_mm' AND
        card_yy = '$card_yy'";

    $check_query_run = mysqli_query($con, $check_query);

    if ($check_query_run && mysqli_num_rows($check_query_run) > 0) {

        // Get plan price
        $get_amount_query = "SELECT plan_price FROM plan WHERE plan_id = '$selectedPlanId'";
        $get_amount_run = mysqli_query($con, $get_amount_query);

        if ($get_amount_run && $row = mysqli_fetch_assoc($get_amount_run)) {
            $invoice_amount = $row['plan_price'];
            $invoice_number = mt_rand(100000, 999999);

            // Insert invoice
            $insert_invoice_query = "INSERT INTO invoice (customer_id, invoice_number, invoice_amount) 
                                    VALUES ('$customer_id', '$invoice_number', '$invoice_amount')";

            $insert_invoice_run = mysqli_query($con, $insert_invoice_query);
            if ($insert_invoice_run) {
                $invoice_id = mysqli_insert_id($con);

                $insert_payment = "INSERT INTO payment (customer_id, invoice_id, payment_amount) 
                                VALUES ('$customer_id', '$invoice_id', '$invoice_amount')";

                $insert_payment_run = mysqli_query($con, $insert_payment);

                if ($insert_payment_run) {
                    // Get plan duration
                    $get_plan_duration_query = "SELECT plan_duration FROM plan WHERE plan_id = '$selectedPlanId'";
                    $get_plan_duration_run = mysqli_query($con, $get_plan_duration_query);

                    if ($get_plan_duration_run && $row = mysqli_fetch_assoc($get_plan_duration_run)) {
                        $plan_duration_days = $row['plan_duration'];

                        // Get plan name
                        $get_plan_query = "SELECT plan_name FROM plan WHERE plan_id = '$selectedPlanId'";
                        $get_plan_run = mysqli_query($con, $get_plan_query);

                        if ($get_plan_run && $plan_row = mysqli_fetch_assoc($get_plan_run)) {
                            $plan_name = $plan_row['plan_name'];

                            // Insert membership
                            $insert_membership = "INSERT INTO membership (customer_id, plan_id, membership_start_date, membership_end_date, membership_status)
                                                VALUES ('$customer_id', '$selectedPlanId', NOW(), DATE_ADD(NOW(), INTERVAL $plan_duration_days DAY), 'active')";

                            $insert_membership_run = mysqli_query($con, $insert_membership);

                            if ($insert_membership_run) {
                                // Update customer plan
                                $update_customer_plan = "UPDATE customer SET customer_plan = '$plan_name' WHERE customer_id = '$customer_id'";
                                $update_customer_plan_run = mysqli_query($con, $update_customer_plan);

                                if ($update_customer_plan_run) {
                                    echo "<script>
                                            alert('Payment Successful. Membership created.');
                                            window.location.href = '/myWeb/GYMKHANA/member/upage/uservices.php';
                                        </script>";
                                } else {
                                    echo "<script>
                                            alert('Error updating customer plan');
                                            window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                                        </script>";
                                }
                            } else {
                                echo "<script>
                                        alert('Error creating membership');
                                        window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                                    </script>";
                            }
                        } else {
                            echo "<script>
                                    alert('Error fetching plan name');
                                    window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                                </script>";
                        }
                    } else {
                        echo "<script>
                                alert('Error fetching plan duration');
                                window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                            </script>";
                    }
                } else {
                    echo "<script>
                            alert('Payment Unsuccessfulyy');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                        </script>";
                }
            } else {
                echo "<script>
                        setTimeout(function() {
                            alert('Error generating invoice');
                            window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                        }, 1);
                    </script>";
            }

        } else {
            echo "<script>
                    setTimeout(function() {
                        alert('Error fetching plan amount');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                    }, 1);
                </script>";
        }
    } else {
        echo "<script>
                setTimeout(function() {
                    alert('Invalid card details. Payment Unsuccessful');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/upayment.php';
                }, 1);
            </script>";
    }
}
if (isset($_POST['add_class'])) {
    $customer_id = $_SESSION['auth_user']['customer_id'];
    $class_name = urldecode($_POST['class']);

    // Check if the record already exists for the customer and class
    $class_query = "SELECT class_id, trainer_id FROM class WHERE class_name = '$class_name'";
    $class_result = mysqli_query($con, $class_query);

    if ($class_result && mysqli_num_rows($class_result) > 0) {
        $class_row = mysqli_fetch_assoc($class_result);
        $class_id = $class_row['class_id'];
        $trainer_id = $class_row['trainer_id'];

        $existing_timetable_query = "SELECT * FROM timetable WHERE customer_id = '$customer_id' AND class_id = '$class_id'";
        $existing_timetable_result = mysqli_query($con, $existing_timetable_query);

        if ($existing_timetable_result && mysqli_num_rows($existing_timetable_result) > 0) {
            // If the record exists, update the timetable_status to 'active'
            $update_query = "UPDATE timetable SET timetable_status = 'active' WHERE customer_id = '$customer_id' AND class_id = '$class_id'";

            if (mysqli_query($con, $update_query)) {
                echo "<script>
                    setTimeout(function() {
                        alert('Class Updated Successfully');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
                    }, 1);
                </script>";
            } else {
                echo "<script>
                    setTimeout(function() {
                        alert('Something went wrong');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
                    }, 1);
                </script>";
            }
        } else {
            // If the record doesn't exist, insert a new record
            $insert_query = "INSERT INTO timetable (customer_id, class_id, trainer_id, timetable_status) 
                            VALUES ('$customer_id', '$class_id', '$trainer_id', 'active')";

            if (mysqli_query($con, $insert_query)) {
                echo "<script>
                    setTimeout(function() {
                        alert('Class Added Successfully');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
                    }, 1);
                </script>";
            } else {
                echo "<script>
                    setTimeout(function() {
                        alert('Something went wrong');
                        window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
                    }, 1);
                </script>";
            }
        }
    } else {
        echo "<script>
            setTimeout(function() {
                alert('Error retrieving class information');
                window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
            }, 1);
        </script>";
    }
}


if (isset($_POST['remove_class'])) {
    $customer_id = $_SESSION['auth_user']['customer_id'];
    $class_name = urldecode($_POST['class']);

    $class_query = "SELECT class_id, trainer_id FROM class WHERE class_name = '$class_name'";
    $class_result = mysqli_query($con, $class_query);

    if ($class_result) {
        $class_row = mysqli_fetch_assoc($class_result);

        $class_id = $class_row['class_id'];
        $trainer_id = $class_row['trainer_id'];

        // Update the timetable_status to 'inactive'
        $timetable_query = "UPDATE timetable 
                            SET timetable_status = 'inactive'
                            WHERE customer_id = '$customer_id' 
                            AND class_id = '$class_id'";

        if (mysqli_query($con, $timetable_query)) {
            echo "<script>
                setTimeout(function() {
                    alert('Class Removed Successfully');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
                }, 1);
            </script>";
        } else {
            echo "<script>
                setTimeout(function() {
                    alert('Something went wrong');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
                }, 1);
            </script>";
        }
    } else {
        echo "<script>
                setTimeout(function() {
                    alert('Error retrieving class information');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/umyclass.php';
                }, 1);
            </script>";
    }
}
if (isset($_POST['comment_btn'])) {
    $customer_id = $_SESSION['auth_user']['customer_id'];
    $customer_email = $_SESSION['auth_user']['customer_email'];
    $comment_type = $_POST['comment_type'];
    $comment = $_POST['comment'];

    $query = "INSERT INTO comment (customer_id, customer_email, comment_type, comment_desc)
            VALUES ('$customer_id', '$customer_email', '$comment_type', '$comment')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "<script>
                setTimeout(function() {
                    alert('Comment sent successfully');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/ucontact.php';
                }, 1);
            </script>";
    } else {
        echo "<script>
                setTimeout(function() {
                    alert('Something went wrong');
                    window.location.href = '/myWeb/GYMKHANA/member/upage/ucontact.php';
                }, 1);
            </script>";
    }
}

// ---------------- end payment
?>
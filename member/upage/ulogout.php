<?php
include("../Requires/mysql.php");

if(isset($_SESSION['auth']))
{
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
}
echo "<script>
        setTimeout(function() {
            alert('Logged out succesfully');
            window.location.href = '/myWeb/GYMKHANA/member/index.php';
        }, 1);
    </script>";
die; 
<?php
session_start();

session_destroy();

    echo "<script>alert('Akun sudah Log Out');location.href='front.php'</script>";

?>
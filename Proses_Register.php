<?php

function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert ('Username sudah ada');
          </script>";

        return false;
    }

    if ($password !== $password2) {
        echo "<script>
                alert ('Password tidak sama');
              </script>";
        return false;
    }
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$username' ,'$password','')");

    return mysqli_affected_rows($conn);
}

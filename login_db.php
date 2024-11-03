<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'kinraidee');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    $query = "SELECT * FROM account WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($_SESSION['role'] == 'u') {
                header("Location: randommenu.php");
            } elseif ($_SESSION['role'] == 's') {
                header("Location: addmenu.php");
            } else {
                header("Location: data.php");
            }
        } else {
            echo "<script> alert ('Invalid password'); 
                document.location.href = 'register_and_login.php';
               </script>";
        }
    } else {
        echo "<script> alert ('Invalid username or email'); 
            document.location.href = 'register_and_login.php';
           </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

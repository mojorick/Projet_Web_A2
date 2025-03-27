<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetweb"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


if (isset($_POST['ok'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        
        $request = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $request->execute([':email' => $email]);

        $user = $request->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email']; 
            header("Location: ../accueil/accueil.php"); 
            exit();
        } else {
            header("Location: erreur.php"); 
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>


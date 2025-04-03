<?php
// Début du fichier profilPage.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("./views/commons/header.php");
require_once("./models/ProfileModel.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$profileModel = new ProfileModel();
$user = $profileModel->getUser($_SESSION['email']);

// Initialisation des variables
$error = '';
$success = '';

// Récupérer la photo actuelle
$currentPhoto = isset($user['photo']) && !empty($user['photo']) ? $user['photo'] : 'https://bootdey.com/img/Content/avatar/avatar1.png';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gestion de la photo de profil
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $result = $profileModel->uploadProfilePhoto($_SESSION['email'], $_FILES['profile_photo']);
        if ($result) {
            $_SESSION['profile_photo'] = $result;
            $currentPhoto = $result;
            $success = "Photo téléversée avec succès!";
        } else {
            $error = "Erreur lors du téléversement de la photo.";
        }
    }
    
    // Mise à jour des informations générales
    if (isset($_POST['nom']) && isset($_POST['prenom'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'] ?? '';
        $domaine = $_POST['domaine'] ?? '';
        
        if ($profileModel->updateUser($_SESSION['email'], $nom, $prenom, $adresse, $domaine)) {
            $success = $success ? $success . " Informations mises à jour avec succès!" : "Informations mises à jour avec succès!";
            $user = $profileModel->getUser($_SESSION['email']); // Rafraîchir les données
        } else {
            $error = $error ? $error . " Erreur lors de la mise à jour des informations." : "Erreur lors de la mise à jour des informations.";
        }
    }
    
    // Changement de mot de passe
    if (isset($_POST['current_password']) && !empty($_POST['current_password'])) {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        
        // Vérification du mot de passe actuel
        if (!password_verify($currentPassword, $user['password'])) {
            $error = "Le mot de passe actuel est incorrect.";
        } elseif ($newPassword !== $confirmPassword) {
            $error = "Les nouveaux mots de passe ne correspondent pas.";
        } elseif (strlen($newPassword) < 8) {
            $error = "Le mot de passe doit contenir au moins 8 caractères.";
        } else {
            if ($profileModel->updatePassword($_SESSION['email'], $newPassword)) {
                $success = $success ? $success . " Mot de passe changé avec succès!" : "Mot de passe changé avec succès!";
            } else {
                $error = $error ? $error . " Erreur lors du changement de mot de passe." : "Erreur lors du changement de mot de passe.";
            }
        }
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container light-style flex-grow-1 container-p-y" >
    <h4 class="font-weight-bold py-3 mb-4" style="margin-top: 10%;">Paramètres du compte</h4>
    
    <!-- Affichage des messages d'erreur/succès -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-auto-close"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success alert-auto-close"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-3 pt-0">
                <div class="list-group list-group-flush account-settings-links">
                    <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Général</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Changer le mot de passe</a>
                </div>
            </div>
            <div class="col-md-9">
                <form method="POST" enctype="multipart/form-data" id="profileForm">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="<?= htmlspecialchars($currentPhoto) ?>" alt="Photo de profil" class="d-block ui-w-80 rounded-circle" id="profile-preview">
                                
                                <div class="media-body ml-4" style="margin-top:30px">
                                    <label class="btn btn-outline-primary">
                                        Téléverser une photo
                                        <input type="file" name="profile_photo" id="profile-upload" class="account-settings-fileinput" accept="image/jpeg,image/png,image/gif">
                                    </label> 
                                    &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat" id="reset-photo">Réinitialiser</button>
                                    <div class="text-light small mt-1">Formats autorisés : JPG, PNG ou GIF. Max 800Ko</div>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Nom :</label>
                                    <input type="text" class="form-control mb-1" name="nom" value="<?= htmlspecialchars($user['nom'] ?? '') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Prénom(s) :</label>
                                    <input type="text" class="form-control mb-1" name="prenom" value="<?= htmlspecialchars($user['prenom'] ?? '') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Adresse :</label>
                                    <input type="text" class="form-control" name="adresse" value="<?= htmlspecialchars($user['adresse'] ?? '') ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Domaine d'étude :</label>
                                    <input type="text" class="form-control" name="domaine" value="<?= htmlspecialchars($user['domaine'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Mot de passe actuel :</label>
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nouveau mot de passe :</label>
                                    <input type="password" class="form-control" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirmation :</label>
                                    <input type="password" class="form-control" name="confirm_password">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right mt-3" style="margin-right: 15px; margin-bottom: 10px;">
                        <button type="submit" class="btn btn-primary" name="save_profile">Sauvegarder</button>&nbsp;
                        <a href="./../" class="btn btn-default">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if (isset($_SESSION['error'])): ?>
    <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="container">
    <h2>Réinitialisation du mot de passe</h2>
    <form action="index.php?page=enregistrement/reset-password" method="post">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Confirmez le mot de passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit">Mettre à jour</button>
    </form>
</div>

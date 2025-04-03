<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="container">
    <h2>Mot de passe oublié</h2>
    <form method="POST">
        <div class="form-group">
            <label>Entrez votre addresse mail pour recevoir votre lien de reinitialisation</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" name="send" class="btn btn-primary" style="background-color: #158515;">Envoyer</button>
    </form>
</div>
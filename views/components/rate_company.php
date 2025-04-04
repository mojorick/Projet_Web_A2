<?php
require_once(__DIR__.'/../../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['rating'])) {
        // Afficher le formulaire d'évaluation
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Évaluer l'entreprise</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .rating-container { text-align: center; }
                .stars { font-size: 2em; margin: 20px 0; }
                .star { 
                    cursor: pointer; 
                    color: #e0e0e0; 
                    transition: color 0.2s;
                    margin: 0 5px;
                }
                .star.selected, 
                .star:hover, 
                .star:hover ~ .star {
                    color: #e0e0e0;
                }
                .star.selected, 
                .star.hover {
                    color: #ffc107;
                }
                button { 
                    padding: 10px 20px; 
                    background: #2e7d32; 
                    color: white; 
                    border: none; 
                    border-radius: 4px; 
                    cursor: pointer;
                    font-size: 1rem;
                }
                button:hover {
                    background: #3e8e41;
                }
            </style>
            <script>
                function setRating(rating) {
                    document.querySelectorAll('.star').forEach((star, index) => {
                        if (index < rating) {
                            star.classList.add('selected');
                        } else {
                            star.classList.remove('selected');
                        }
                    });
                    document.getElementById('ratingValue').value = rating;
                }
            </script>
        </head>
        <body>
            <div class="rating-container">
                <h2>Évaluer l'entreprise</h2>
                <form method="post">
                    <input type="hidden" name="company_id" value="<?= htmlspecialchars($_POST['company_id']) ?>">
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star" onclick="setRating(<?= $i ?>)">★</span>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" id="ratingValue" name="rating" required>
                    <button type="submit">Soumettre l'évaluation</button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit();
    } else {
        // Traitement de l'évaluation
        try {
            $rating = floatval($_POST['rating']);
            
            // Validation de la note (doit être entre 1 et 5)
            if ($rating < 1 || $rating > 5) {
                die("La note doit être comprise entre 1 et 5");
            }
            
            $stmt = $pdo->prepare("INSERT INTO company_ratings (company_id, rating) VALUES (?, ?)");
            $stmt->execute([
                $_POST['company_id'],
                $rating
            ]);
            
            // Redirection vers la page de gestion
            header("Location: ../../Gestion_des_entreprises");
            exit();
            
        } catch (PDOException $e) {
            die("Erreur lors de l'évaluation : " . $e->getMessage());
        }
    }
} else {
    // Si l'utilisateur arrive directement sur cette page sans POST
    header("Location: ../../Gestion_des_entreprises");
    exit();
}
?>
<?php
require_once(__DIR__.'/../../config/database.php'); // Chemin corrigé

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Afficher un formulaire simple pour l'évaluation
    if (!isset($_POST['rating'])) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Évaluer l'entreprise</title>
            <style>
                /* Style général */
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background-color: #f5f7fa;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    color: #333;
                }

                /* Conteneur principal */
                .evaluation-container {
                    background-color: white;
                    border-radius: 12px;
                    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
                    padding: 40px;
                    width: 100%;
                    max-width: 500px;
                    text-align: center;
                    transition: transform 0.3s ease;
                }

                .evaluation-container:hover {
                    transform: translateY(-5px);
                }

                /* Titre */
                .evaluation-title {
                    font-size: 24px;
                    font-weight: 600;
                    margin-bottom: 10px;
                    color: #2c3e50;
                }

                .evaluation-subtitle {
                    font-size: 16px;
                    color: #7f8c8d;
                    margin-bottom: 30px;
                }

                /* Étoiles */
                .stars-container {
                    margin: 30px 0;
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                }

                .star {
                    font-size: 2.5rem;
                    color: #ddd;
                    cursor: pointer;
                    transition: all 0.2s ease;
                    position: relative;
                }

                .star:hover {
                    transform: scale(1.2);
                }

                .star.selected {
                    color: #FFD700;
                }

                .star.selected:before {
                    content: '★';
                    position: absolute;
                    color: rgba(255, 215, 0, 0.4);
                    transform: scale(1.3);
                    z-index: -1;
                }

                /* Bouton */
                .submit-btn {
                    background-color: #3498db;
                    color: white;
                    border: none;
                    padding: 12px 30px;
                    font-size: 16px;
                    border-radius: 50px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    font-weight: 500;
                    letter-spacing: 0.5px;
                    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
                }

                .submit-btn:hover {
                    background-color: #2980b9;
                    transform: translateY(-2px);
                    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
                }

                .submit-btn:active {
                    transform: translateY(0);
                }

                /* Animation */
                @keyframes pulse {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.1); }
                    100% { transform: scale(1); }
                }

                .star.selected {
                    animation: pulse 0.5s ease;
                }

                /* Responsive */
                @media (max-width: 600px) {
                    .evaluation-container {
                        padding: 30px 20px;
                        margin: 20px;
                    }
                    
                    .star {
                        font-size: 2rem;
                    }
                }
            </style>
        </head>
        <body>
            <div class="evaluation-container">
                <h1 class="evaluation-title">Évaluer l'entreprise</h1>
                <p class="evaluation-subtitle">Sélectionnez votre note en cliquant sur les étoiles</p>
                
                <form method="post">
                    <input type="hidden" name="company_id" value="<?= $_POST['company_id'] ?>">
                    
                    <div class="stars-container">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star" 
                                onclick="document.getElementById('rating').value = <?= $i ?>;
                                document.querySelectorAll('.star').forEach(s => s.classList.remove('selected'));
                                for (let j = 1; j <= <?= $i ?>; j++) {
                                    document.querySelector('.star:nth-child(' + j + ')').classList.add('selected');
                                }">★</span>
                        <?php endfor; ?>
                    </div>
                    
                    <input type="hidden" id="rating" name="rating" required>
                    <button type="submit" class="submit-btn">Soumettre l'évaluation</button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit();
    }

    // Traitement de l'évaluation
    $stmt = $pdo->prepare("INSERT INTO company_ratings (company_id, rating) VALUES (?, ?)");
    $stmt->execute([$_POST['company_id'], $_POST['rating']]);
    
    header("Location: ../../Gestion_des_entreprises");
    exit();
}
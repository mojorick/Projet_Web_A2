<?php
require_once('./config/database.php'); // Fichier avec vos infos de connexion

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        try {
            switch ($_POST['action']) {
                case 'add_company':
                    $stmt = $pdo->prepare("INSERT INTO companies 
                                        (name, description, email, phone, address, sector) 
                                        VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $_POST['name'],
                        $_POST['description'],
                        $_POST['email'],
                        $_POST['phone'],
                        $_POST['address'],
                        $_POST['sector']
                    ]);
                    break;
                case 'update_company':
                    $stmt = $pdo->prepare("UPDATE companies SET 
                                            name = ?, 
                                            description = ?, 
                                            email = ?, 
                                            phone = ?, 
                                            address = ?, 
                                            sector = ? 
                                            WHERE id = ?");
                    $stmt->execute([
                        $_POST['name'],
                        $_POST['description'],
                        $_POST['email'],
                        $_POST['phone'],
                        $_POST['address'],
                        $_POST['sector'],
                        $_POST['id']
                    ]);
                    break;
                    
                case 'delete_company':
                    $stmt = $pdo->prepare("DELETE FROM companies WHERE id = ?");
                    $stmt->execute([$_POST['id']]);
                    break;
                    
                case 'add_rating':
                    $stmt = $pdo->prepare("INSERT INTO company_ratings 
                                        (company_id, rating) 
                                        VALUES (?, ?)");
                    $stmt->execute([
                        $_POST['company_id'],
                        $_POST['rating']
                    ]);
                    break;

                    case 'delete_company':
                        try {
                            $pdo->beginTransaction();
                            
                            // 1. Récupérer le nom de l'entreprise à supprimer
                            $stmt = $pdo->prepare("SELECT name FROM companies WHERE id = ?");
                            $stmt->execute([$_POST['id']]);
                            $companyName = $stmt->fetchColumn();
                            
                            if ($companyName) {
                                // 2. Supprimer les candidatures liées aux stages de cette entreprise
                                $stmt = $pdo->prepare("DELETE a FROM applications a 
                                                      JOIN internships i ON a.internship_id = i.id 
                                                      WHERE i.company = ?");
                                $stmt->execute([$companyName]);
                                
                                // 3. Supprimer les stages de l'entreprise
                                $stmt = $pdo->prepare("DELETE FROM internships WHERE company = ?");
                                $stmt->execute([$companyName]);
                                
                                // 4. Supprimer les évaluations de l'entreprise
                                $stmt = $pdo->prepare("DELETE FROM company_ratings WHERE company_id = ?");
                                $stmt->execute([$_POST['id']]);
                                
                                // 5. Enfin, supprimer l'entreprise elle-même
                                $stmt = $pdo->prepare("DELETE FROM companies WHERE id = ?");
                                $stmt->execute([$_POST['id']]);
                            }
                            
                            $pdo->commit();
                        } catch (PDOException $e) {
                            $pdo->rollBack();
                            die("Erreur lors de la suppression: " . $e->getMessage());
                        }
                        break;              
            }
            header("Location: Gestion_des_entreprises");
            exit();
        } catch (PDOException $e) {
            die("Erreur: " . $e->getMessage());
        }
    }
}

// Récupérer l'entreprise à éditer si l'ID est présent dans l'URL
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM companies WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editCompany = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$editCompany) {
        header("Location: Gestion_des_entreprises");
        exit();
    }
}

// Récupération des entreprises avec leurs infos
$search = $_GET['search'] ?? '';
$sector = $_GET['sector'] ?? '';

$query = "SELECT c.*, 
          AVG(r.rating) as average_rating,
          COUNT(DISTINCT i.id) as internships_count,
          COUNT(DISTINCT a.id) as applications_count,
          GROUP_CONCAT(DISTINCT 
            CONCAT(
              i.title, '|',
              i.salary_base, '|',
              i.start_date, '|',
              i.end_date, '|',
              i.short_description
            )
          ) as internships_details
          FROM companies c
          LEFT JOIN company_ratings r ON c.id = r.company_id
          LEFT JOIN internships i ON c.name = i.company
          LEFT JOIN applications a ON i.id = a.internship_id
          WHERE 1=1";

if ($search) {
    $query .= " AND (c.name LIKE ? OR c.description LIKE ? OR c.email LIKE ?)";
    $params = ["%$search%", "%$search%", "%$search%"];
}

if ($sector) {
    $query .= " AND c.sector = ?";
    $params[] = $sector;
}

$query .= " GROUP BY c.id ORDER BY c.name ASC";

$stmt = $pdo->prepare($query);
$stmt->execute($params ?? []);
$companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once("./views/commons/header.php")?>
    <main class="container">
        <div class="page-header">
            <h1>Gestion des entreprises</h1>
        </div>

        <!-- Formulaire de recherche -->
        <form method="get">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Nom, secteur, mot-clé..." 
                       value="<?= htmlspecialchars($search) ?>">
                <select name="sector">
                    <option value="">Tous secteurs</option>
                    <option value="Informatique & Digital" <?= $sector === 'Informatique & Digital' ? 'selected' : '' ?>>Informatique & Digital</option>
                    <option value="Business & Management" <?= $sector === 'Business & Management' ? 'selected' : '' ?>>Business & Management</option>
                    <option value="Ingénierie & Innovation" <?= $sector === 'Ingénierie & Innovation' ? 'selected' : '' ?>>Ingénierie & Innovation</option>
                </select>
                <button type="submit" class="btn-search">Rechercher</button>
                <?php if ($search || $sector): ?>
                    <a href="?" class="clear-search">X Annuler</a>
                <?php endif; ?>
            </div>
        </form>
        <?php if ($isLoggedIn && $role === 'pilote' || $role === 'admin'): ?>
        <section class="create-company">
            <div id="companyModal" class="modal" style="<?= isset($_GET['edit']) ? 'display: flex;' : 'display: none;' ?>">
                <div class="modal-content">
                    <span class="close-modal" onclick="document.getElementById('companyModal').style.display='none'">&times;</span>
                    <h2><?= isset($_GET['edit']) ? 'Modifier' : 'Créer' ?> une entreprise</h2>
                    <form method="post">
                        <input type="hidden" name="action" value="<?= isset($_GET['edit']) ? 'update_company' : 'add_company' ?>">
                        <?php if (isset($_GET['edit'])): ?>
                            <input type="hidden" name="id" value="<?= $_GET['edit'] ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="name">Nom de l'entreprise</label>
                            <input type="text" id="name" name="name" required 
                                value="<?= isset($editCompany) ? htmlspecialchars($editCompany['name']) : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" required><?= isset($editCompany) ? htmlspecialchars($editCompany['description']) : '' ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email de contact</label>
                            <input type="email" id="email" name="email" required 
                                value="<?= isset($editCompany) ? htmlspecialchars($editCompany['email']) : '' ?>">
                        </div>
                        
                        <div class="form0000000000-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone"
                                value="<?= isset($editCompany) ? htmlspecialchars($editCompany['phone']) : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <input type="text" id="address" name="address"
                                value="<?= isset($editCompany) ? htmlspecialchars($editCompany['address']) : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="sector">Secteur d'activité</label>
                            <select id="sector" name="sector" required>
                                <option value="">Sélectionner un secteur</option>
                                <option value="Informatique & Digital" <?= (isset($editCompany) && $editCompany['sector'] === 'Informatique & Digital') ? 'selected' : '' ?>>Informatique & Digital</option>
                                <option value="Business & Management" <?= (isset($editCompany) && $editCompany['sector'] === 'Business & Management') ? 'selected' : '' ?>>Business & Management</option>
                                <option value="Ingénierie & Innovation" <?= (isset($editCompany) && $editCompany['sector'] === 'Ingénierie & Innovation') ? 'selected' : '' ?>>Ingénierie & Innovation</option>
                            </select>
                        </div>
                        
                        <div class="form-buttons">
                            <button type="button" class="btn-cancel" onclick="document.getElementById('companyModal').style.display='none'">Annuler</button>
                            <button type="submit" class="btn-create"><?= isset($_GET['edit']) ? 'Mettre à jour' : 'Créer' ?></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bouton pour créer une nouvelle entreprise (à ajouter près du bouton de recherche) -->
            <div class="search-actions">
                <button class="btn-create" onclick="document.getElementById('companyModal').style.display='flex'">
                    + Ajouter une entreprise
                </button>
            </div>
        </section>
        <?php endif; ?>

        <div class="results-header">
            <span><?= count($companies) ?> entreprise(s) trouvée(s)</span>
        </div>

        

        <!-- Liste des entreprises -->
        <div class="companies-grid">
            <?php foreach ($companies as $company): ?>
                <div class="company-card">
                    <div class="card-header">
                        <h3 class="company-name"><?= htmlspecialchars($company['name']) ?></h3>
                        <span class="rating">⭐ <?= number_format($company['average_rating'] ?? 0, 1) ?>/5</span>
                    </div>
                    <div class="company-info">
                    <div class="contact-info">
                        <p>📧 <?= !empty($company['email']) ? htmlspecialchars($company['email']) : '<span class="empty-field">Information non renseignée</span>' ?></p>
                        <p>📞 <?= !empty($company['phone']) ? htmlspecialchars($company['phone']) : '<span class="empty-field">Information non renseignée</span>' ?></p>
                        <p>Secteur : <?= !empty($company['sector']) ? htmlspecialchars($company['sector']) : '<span class="empty-field">Information non renseignée</span>' ?></p>
                        <p>Adresse : <?= !empty($company['address']) ? htmlspecialchars($company['address']) : '<span class="empty-field">Information non renseignée</span>' ?></p>
                    </div>
                        <div class="stats">
                            <div>
                                <div class="stat-value"><?= $company['internships_count'] ?></div>
                                <div>Stages proposés</div>
                            </div>
                            <div>
                                <div class="stat-value"><?= $company['applications_count'] ?></div>
                                <div>Candidatures</div>
                            </div>
                        </div>
                        <p class="company-description"><?= htmlspecialchars($company['description']) ?></p>
                    
                        <?php if ($company['internships_details']): ?>
                            <div class="internships-list">
                                <h4>Offres de stage</h4>
                                <?php 
                                $internships = explode(',', $company['internships_details']);
                                foreach ($internships as $internship):
                                    list($title, $salary, $start_date, $end_date, $description) = explode('|', $internship);
                                ?>
                                    <div class="internship-item">
                                        <h5><?= htmlspecialchars($title) ?></h5>
                                        <p class="salary">💰 <?= htmlspecialchars($salary) ?></p>
                                        <p class="dates">📅 Du <?= date('d/m/Y', strtotime($start_date)) ?> 
                                                    au <?= date('d/m/Y', strtotime($end_date)) ?></p>
                                        <p class="description"><?= htmlspecialchars($description) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="internships-list">
                                <h4>Offres de stage</h4>
                                <p class="no-internship">Aucune offre disponible actuellement</p>
                            </div>
                        <?php endif; ?>
                    </div>
        
                    <div class="company-actions">
                    <?php if ($isLoggedIn && $role === 'pilote' || $role === 'admin'): ?>
                        <a href="?edit=<?= $company['id'] ?>" class="btn btn-edit">
                            <span class="btn-icon">✏️</span> Modifier
                        </a>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="action" value="delete_company">
                            <input type="hidden" name="id" value="<?= $company['id'] ?>">
                            <button type="submit" class="btn btn-delete" 
                                    onclick="return confirm('Supprimer cette entreprise et tous ses stages ?')">
                                <span class="btn-icon">🗑️</span> Supprimer
                            </button>
                        </form>
                        <?php endif; ?>
                        <form method="post" action="./views/components/rate_company.php" style="ddisplay: inline-block; width:500px;">
                            <input type="hidden" name="company_id" value="<?= $company['id'] ?>">
                            <button type="submit" class="btn btn-evaluate">
                                <span class="btn-icon">⚡</span> Évaluer
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
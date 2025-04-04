<?php
require_once('./models/StudentModel.php');
$studentModel = new StudentModel();

// Récupération de l'étudiant à modifier si nécessaire
$editStudent = null;
if (isset($_GET['edit'])) {
    $editStudent = $studentModel->getStudentById($_GET['edit']);
}

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        try {
            switch ($_POST['action']) {
                case 'add':
                    $studentModel->addStudent($_POST);
                    break;
                case 'update':
                    $studentModel->updateStudent($_POST['id'], $_POST);
                    break;
                case 'delete':
                    $studentModel->deleteStudent($_POST['id']);
                    break;
            }
            header("Location: Gestion_des_etudiants");
            exit();
        } catch (Exception $e) {
            $error = "Une erreur est survenue : " . $e->getMessage();
        }
    }
}

// Au début du fichier, après la récupération des étudiants
$showStats = isset($_GET['view_stats']);
$studentStats = null;

// Récupération des étudiants (avec recherche si applicable)
$search = $_GET['search'] ?? '';
$students = $studentModel->getAllStudents($search);
?>
<?php require_once("./views/commons/header.php")?>
   <div class="container">
        <h1>Gestion des Étudiants</h1>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="main-content">
            <div class="left-panel">
                <!-- Formulaire de recherche -->
                <div class="search-section">
                    <h2>Rechercher un étudiant</h2>
                    <form method="get">
                        <div class="search-box">
                            <input type="text" name="search" placeholder="Rechercher par nom, prénom ou email" 
                                   value="<?= htmlspecialchars($search) ?>">
                            <button type="submit">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Rechercher
                            </button>
                            <?php if ($search): ?>
                                <a href="?" class="clear-search">Effacer</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <!-- Formulaire d'ajout/modification -->
                <div class="form-section">
                    <h2><?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?> un étudiant</h2>
                    <form method="post">
                        <input type="hidden" name="action" value="<?= isset($_GET['edit']) ? 'update' : 'add' ?>">
                        <?php if (isset($_GET['edit'])): ?>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['edit']) ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" required 
                                   value="<?= isset($editStudent) ? htmlspecialchars($editStudent['nom']) : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" required
                                   value="<?= isset($editStudent) ? htmlspecialchars($editStudent['prenom']) : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required
                                   value="<?= isset($editStudent) ? htmlspecialchars($editStudent['email']) : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" 
                                   <?= !isset($_GET['edit']) ? 'required' : '' ?>>
                            <?php if (isset($_GET['edit'])): ?>
                                <small>Laisser vide pour ne pas modifier</small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse"
                                   value="<?= isset($editStudent) ? htmlspecialchars($editStudent['adresse']) : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="domaine">Domaine</label>
                            <input type="text" id="domaine" name="domaine"
                                   value="<?= isset($editStudent) ? htmlspecialchars($editStudent['domaine']) : '' ?>">
                        </div>
                        
                        <div class="form-buttons">
                            <button type="submit" class="btn-primary pulse">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?>
                            </button>
                            <?php if (isset($_GET['edit'])): ?>
                                <a href="?" class="btn-secondary">Annuler</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <div class="right-panel">
                <!-- Liste des étudiants -->
                <div class="list-section">
                    <h2>Liste des étudiants (<?= count($students) ?>)</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Domaine</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?= htmlspecialchars($student['nom']) ?></td>
                                    <td><?= htmlspecialchars($student['prenom']) ?></td>
                                    <td><?= htmlspecialchars($student['email']) ?></td>
                                    <td><?= htmlspecialchars($student['domaine'] ?? 'Non spécifié') ?></td>
                                    <td>
                                        <a href="?edit=<?= $student['id'] ?>" class="action-btn edit-btn" style="width: 140px;">
                                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Modifier
                                        </a>
                                        <form method="post" style="display: inline-block; margin: 2.5%; margin-left: 1%;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $student['id'] ?>">
                                            <button type="submit" class="action-btn delete-btn" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')" >
                                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                        <a href="?view_stats=<?= $student['id'] ?>" class="action-btn stats-btn" style="width: 140px;">
                                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            Stats
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section des statistiques -->
                <?php if (isset($_GET['view_stats'])): ?>
                    <?php 
                    $studentId = $_GET['view_stats'];
                    $studentDetails = $studentModel->getStudentById($studentId);
                    $applications = $studentModel->getStudentApplications($studentId);
                    $status = $studentModel->getStudentStatus($studentId);
                    ?>
                    <div class="stats-section">
                        <h2>Statistiques de l'étudiant</h2>
                        <div class="stats-card">
                            <div class="stat-item">
                                <span class="stat-label">Nom:</span>
                                <span class="stat-value"><?= htmlspecialchars($studentDetails['nom']) ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Prénom:</span>
                                <span class="stat-value"><?= htmlspecialchars($studentDetails['prenom']) ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Email:</span>
                                <span class="stat-value"><?= htmlspecialchars($studentDetails['email']) ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Date d'inscription:</span>
                                <span class="stat-value"><?= date('d/m/Y', strtotime($studentDetails['date_inscription'])) ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Statut de stage:</span>
                                <span class="stat-value"><?= htmlspecialchars($status) ?></span>
                            </div>
                            
                            <!-- Liste des candidatures -->
                            <div class="applications-list">
                                <h3>Candidatures de stage</h3>
                                <?php if (!empty($applications)): ?>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Entreprise</th>
                                                <th>Poste</th>
                                                <th>Date</th>
                                                <th>Statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($applications as $app): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($app['company']) ?></td>
                                                <td><?= htmlspecialchars($app['title']) ?></td>
                                                <td><?= date('d/m/Y', strtotime($app['application_date'])) ?></td>
                                                <td>
                                                    <span class="status-badge status-<?= $app['status'] ?>">
                                                        <?= ucfirst($app['status']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Aucune candidature trouvée.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
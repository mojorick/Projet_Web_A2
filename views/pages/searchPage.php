<?php require_once("./views/commons/header.php") ?>
<main>
  <h1>Offres de stage</h1>
  <?php require_once("./views/components/search_main.php"); ?>
  <section class="search-results">
    <div class="container">
        <?php if (empty($internships)): ?>
            <div class="no-results">
                <p>Aucune offre ne correspond à votre recherche. Essayez d'élargir vos critères.</p>
            </div>
              <?php else: ?>
                  <div class="content-wrapper">
                      <div class="results-list">
                          <?php foreach($internships as $internship): ?>
                              <div class="result-card" data-id="<?= $internship['id'] ?>">
                                <div class="result-content">
                                  <h3><?= htmlspecialchars($internship['title']) ?></h3>
                                  <div class="details">
                                    <span><i class="fas fa-building"></i> <?= htmlspecialchars($internship['company']) ?></span>
                                    <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($internship['location']) ?></span>
                                    <span><i class="fas fa-briefcase"></i> <?= htmlspecialchars($internship['type']) ?></span>
                                    <span><i class="fas fa-laptop-house"></i> <?= htmlspecialchars($internship['remote']) ?></span>
                                    <span><i class="fas fa-euro-sign"></i> <?= htmlspecialchars($internship['salary_base']) ?></span>
                                    <span><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($internship['start_date']) ?> - <?= htmlspecialchars($internship['end_date']) ?></span>
                                  </div>
                                  <p class="description" data-fulltext="<?= htmlspecialchars($internship['full_description']) ?>">
                                    <?= htmlspecialchars($internship['short_description']) ?>
                                  </p>
                                  <p class="company-desc"><strong>À propos de l'entreprise :</strong> <?= htmlspecialchars($internship['company_description']) ?></p>
                                  <div class="card-footer">
                                    <span class="time-ago"><i class="far fa-clock"></i> <?= htmlspecialchars($internship['posted_at']) ?></span>
                                    <button class="btn-secondary">Voir l'offre</button>
                                  </div>
                                </div>
                              </div>
                              <?php endforeach; ?>
                </div>
                <div class="offer-details" hidden>
                <button class="close-btn">&times;</button>
                <div class="offer-content"></div>
              </div>
            </div>
        <?php endif; ?>
    </div>
</section>
</main>
<?php require_once("./views/commons/footer.php") ?>


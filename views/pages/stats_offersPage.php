<?php require_once("./views/commons/header.php")?>
<h1>Statistiques des offres de stage</h1>
    <div class="min-h-screen" style="background: linear-gradient(90deg,#ffffff ,#93f593);">
        <main class="main-container">
            <div class="max-w-7xl">
                <div class="stats-container">
                    <!-- Passer les données PHP au JavaScript -->
                    <script id="skillsData" type="application/json"><?= json_encode($skillsData) ?></script>
                    <script id="durationData" type="application/json"><?= json_encode($durationData) ?></script>
                    <script id="topOffersData" type="application/json"><?= json_encode($topOffersData) ?></script>
                    
                    <div class="stats-grid">
                        <div class="chart-card">
                            <h3 class="chart-title">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 20V10"></path>
                                    <path d="M18 20V4"></path>
                                    <path d="M6 20v-4"></path>
                                </svg>
                                Top 5 des compétences
                            </h3>
                            <div class="chart-container">
                                <canvas id="skills-chart"></canvas>
                            </div>
                        </div>

                        <div class="chart-card">
                            <h3 class="chart-title">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 6v6l4 2"></path>
                                </svg>
                                Durée des stages
                            </h3>
                            <div class="chart-container">
                                <canvas id="duration-chart"></canvas>
                            </div>
                        </div>
                    </div>

                    <h3 class="section-title">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5h3.5"></path>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5h-3.5"></path>
                            <path d="M4 22h16"></path>
                            <path d="M10 14.66V17c0 .55-.47.98-.97.93l-2-.2c-.41-.04-.75-.36-.83-.77L6 16"></path>
                            <path d="M14 14.66V17c0 .55.47.98.97.93l2-.2c.41-.04.75-.36.83-.77L18 16"></path>
                            <path d="M8 14a6 6 0 1 1 8 0"></path>
                        </svg>
                        Top 3 des offres favorites
                    </h3>
                    <div id="top-offers"></div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TDL - Réservation de Véhicules</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
           <a href="index.php"><img src="../assets/images/favicon.png" alt="Logo Togo Data Lab" class="mb-4" height="60"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <?php if (!empty($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=dashboard" style="font-size: 20px;">Tableau de bord</a>
                        </li>
                        <li class="nav-item ms-lg-4">
                            <a class="btn btn-primary btn-lg" href="index.php?action=logout">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="index.php?action=login">Connexion</a>
                        </li>
                        <li class="nav-item ms-lg-4">
                            <a class="btn btn-primary btn-lg" href="index.php?action=register">S'inscrire</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav> <br> <br> 

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-badge mb-4">
                        <!-- <span class="badge bg-primary rounded-pill">NOUVEAU</span> -->
                        <span class="text-muted small fw-semibold">Plateforme de gestion de parc automobile</span>
                    </div>
                    <h1 class="hero-title">
                        Gérez vos déplacements <br>
                        <span class="text-primary">Simplement.</span>
                    </h1>
                    <p class="hero-subtitle">
                        La solution professionnelle pour la réservation de véhicules d'entreprise. 
                        Fiable, rapide et sécurisée pour tous vos collaborateurs.
                    </p>
                    <div class="d-flex gap-3">
                       <center><a href="index.php?action=register" class="btn btn-primary btn-lg px-4">
                            S'inscrire
                        </a></center>
                        <center><a href="index.php?action=login" class="btn btn-outline-primary btn-lg px-4">
                            Voir le catalogue
                        </a></center>
                    </div>
                    <div class="mt-5 d-flex gap-4 text-muted small">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success"></i> Accès 24/7
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success"></i> Flotte moderne
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success"></i> Support dédié
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <div class="card border-0 shadow-lg p-3 rotate-card" style="transform: rotate(2deg);">
                            <img src="../assets/images/vehicles/RAV4_bleue.png" class="rounded-3 w-100" alt="Dashboard Preview">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mb-3 text-primary">
                        <i class="fas fa-car fa-3x"></i>
                    </div>
                    <h4 class="fw-bold">Flotte Premium</h4>
                    <p class="text-muted">Accédez à une large gamme de véhicules récents et parfaitement entretenus pour votre confort.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mb-3 text-success">
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                    <h4 class="fw-bold">Réservation Instantanée</h4>
                    <p class="text-muted">Vérifiez la disponibilité en temps réel et réservez votre véhicule en moins de 2 minutes.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mb-3 text-warning">
                        <i class="fas fa-shield-alt fa-3x"></i>
                    </div>
                    <h4 class="fw-bold">Sécurité Maximale</h4>
                    <p class="text-muted">Vos données sont chiffrées et protégées. Roulez l'esprit tranquille, nous gérons le reste.</p>
                </div>
            </div>
        </div>
    </div> -->

    <footer class="bg-white border-top py-5 mt-5">
        <div class="container text-center">
            <h5 class="fw-bold mb-3">Togo Data Lab</h5>
            <p class="text-muted mb-4">Plateforme de gestion de parc automobile.</p>
            <p class="small text-muted">&copy; 2026 TDL. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
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
    <title>Tableau de Bord - TDL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a href="index.php?action=dashboard"><img src="../assets/images/favicon.png" alt="Logo Togo Data Lab" class="mb-4" height="60"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=dashboard">Véhicules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=my_reservations">Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=profile">Profil</a>
                    </li>
                    <?php if (!empty($_SESSION['is_admin'])): ?>
                        <li class="nav-item">
                            <span class="nav-link text-muted">|</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary fw-bold" href="index.php?action=admin">Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-primary btn-sm" href="index.php?action=logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <?php require_once __DIR__ . '/../app/services/FlashMessage.php'; ?>
        <?php FlashMessage::display(); ?>

        <div class="row mb-5 align-items-end">
            <div class="col-md-8">
                <h6 class="text-primary fw-bold text-uppercase small mb-2">Espace Professionnel</h6>
                <h1 class="fw-bold mb-2">Véhicules disponibles</h1>
                <p class="text-muted mb-0">Sélectionnez un véhicule pour vos missions.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="index.php?action=my_reservations" class="btn btn-outline-primary">
                    Mes Réservations &rarr;
                </a>
            </div>
        </div>

        <?php
        $vehicleImages = [
            // Toyota Models
            'Corolla' => '../assets/images/vehicles/Corolla.jpeg',
            'Land Cruiser' => '../assets/images/vehicles/Land_cruiser.png',
            'Land Cruiser 300' => '../assets/images/vehicles/Cruiser300.png',
            'Hilux' => '../assets/images/vehicles/Toyota-Hilux.webp',
            'RAV4' => '../assets/images/vehicles/TOYOYA-RAV4.webp',
            'Yaris' => '../assets/images/vehicles/Yaris.png',
            
            // Mitsubishi Models
            'L200' => '../assets/images/vehicles/MITSUBISHI-L200.webp',
            
            // Brand Fallbacks
            'Toyota' => '../assets/images/vehicles/Corolla.jpeg',
            'Mitsubishi' => '../assets/images/vehicles/MITSUBISHI-L200.webp',
        ];
        ?>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card mb-4 border-0 shadow-sm bg-white">
                    <div class="card-body p-2">
                        <form method="GET" action="index.php" class="row g-2 align-items-center">
                            <input type="hidden" name="action" value="dashboard">
                            <div class="col">
                                <input type="text" name="search" class="form-control border-0 bg-transparent" placeholder="Rechercher par marque (ex: Toyota)..." value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES); ?>">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary px-4">Rechercher</button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if (empty($vehicles)): ?>
                    <div class="alert alert-warning">Aucun véhicule disponible pour le moment.</div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($vehicles as $vehicle): ?>
                            <?php
                                $brand = $vehicle['brand'];
                                $model = $vehicle['model'];
                                // Prioritize DB image, then Model, then Brand, then default
                                if (!empty($vehicle['image_path'])) {
                                    $imageUrl = $vehicle['image_path'];
                                } else {
                                    $imageUrl = $vehicleImages[$model] ?? $vehicleImages[$brand] ?? 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                                }
                            ?>
                            <div class="col-md-6">
                                <div class="card h-100 overflow-hidden group-hover-shadow">
                                    <div class="position-relative" style="height: 200px; overflow: hidden;">
                                        <img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($vehicle['brand'], ENT_QUOTES); ?>" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
                                        <div class="position-absolute bottom-0 start-0 bg-white px-3 py-1 m-2 rounded fw-bold text-uppercase small shadow-sm">
                                            <?php echo htmlspecialchars($vehicle['brand'], ENT_QUOTES); ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($vehicle['model'], ENT_QUOTES); ?></h5>
                                        <p class="text-muted small mb-3">Immat: <?php echo htmlspecialchars($vehicle['registration_number'], ENT_QUOTES); ?></p>
                                        
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-outline-primary" 
                                                    onclick="showDetails('<?php echo htmlspecialchars($vehicle['brand'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($vehicle['model'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($vehicle['registration_number'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($imageUrl, ENT_QUOTES); ?>', '<?php echo $vehicle['id']; ?>')">
                                                Voir détails
                                            </button>
                                            <a href="index.php?action=reserve&vehicle_id=<?php echo $vehicle['id']; ?>" class="btn btn-primary">
                                                Réserver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar Details -->
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 100px;">
                    <div class="card-header bg-transparent py-3">
                        <h6 class="mb-0 fw-bold">Aperçu rapide</h6>
                    </div>
                    <div class="card-body" id="vehicle-details-panel">
                        <div class="text-center py-5 text-muted">
                            <p>Cliquez sur "Voir détails" pour afficher les informations ici.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-top py-5 mt-5">
        <div class="container text-center">
            <h5 class="fw-bold mb-3">Togo Data Lab</h5>
            <p class="text-muted mb-4">Plateforme de gestion de parc automobile.</p>
            <p class="small text-muted">&copy; 2026 TDL. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        function showDetails(brand, model, registration, image, id) {
            const panel = document.getElementById('vehicle-details-panel');
            panel.innerHTML = `
                <div class="text-center mb-4">
                    <img src="${image}" class="img-fluid rounded mb-3 shadow-sm" style="max-height: 200px; width: 100%; object-fit: cover;">
                    <h4 class="fw-bold text-dark">${brand} ${model}</h4>
                    <span class="badge bg-light text-dark border p-2">IMMAT: ${registration}</span>
                </div>
                <div class="d-grid">
                    <a href="index.php?action=reserve&vehicle_id=${id}" class="btn btn-primary btn-lg">
                        Confirmer la réservation
                    </a>
                </div>
            `;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
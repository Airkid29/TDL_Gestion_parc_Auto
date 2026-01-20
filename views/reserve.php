<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver un Véhicule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <img src="../assets/images/favicon.png" alt="Logo Togo Data Lab" class="mb-4" height="60">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=dashboard">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=my_reservations">Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=profile">Profil</a>
                    </li>
                   
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-primary btn-sm" href="index.php?action=logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php require_once __DIR__ . '/../app/services/FlashMessage.php'; ?>
        <?php FlashMessage::display(); ?>

        <h1 class="mb-4">Réserver un Véhicule</h1>
                <div class="page-header-actions">
                    <a href="index.php?action=dashboard" class="back-link">
                        ← Retour
                    </a>
                </div> <br>
        <form action="index.php?action=reserve" method="POST">
            <?php if ($selectedVehicle): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Véhicule sélectionné</label>
                    <p class="mb-1"><?php echo htmlspecialchars($selectedVehicle['brand'] . ' ' . $selectedVehicle['model'], ENT_QUOTES); ?></p>
                    <p class="text-muted">Immatriculation : <?php echo htmlspecialchars($selectedVehicle['registration_number'], ENT_QUOTES); ?></p>
                </div>
                <input type="hidden" name="vehicle_id" value="<?php echo $selectedVehicle['id']; ?>">
            <?php else: ?>
                <div class="mb-3">
                    <label for="vehicle_id" class="form-label">Choisir un véhicule</label>
                    <select class="form-select" name="vehicle_id" id="vehicle_id" required>
                        <option value="">-- Sélectionnez --</option>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <option value="<?php echo $vehicle['id']; ?>">
                                <?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model'] . ' - ' . $vehicle['registration_number'], ENT_QUOTES); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="start_date" class="form-label">Date de début</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Date de fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmer la réservation</button>
        </form>
    </div>

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
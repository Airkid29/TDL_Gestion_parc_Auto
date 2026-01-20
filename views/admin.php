<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Véhicules - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="index.php?action=dashboard"><img src="../assets/images/favicon.png" alt="Logo Togo Data Lab" class="mb-4" height="60"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=dashboard">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary btn-sm" href="index.php?action=logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-4">
        <?php require_once __DIR__ . '/../app/services/FlashMessage.php'; ?>
        <?php FlashMessage::display(); ?>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Utilisateurs</h5>
                        <p class="card-text fs-4 fw-bold"><?php echo $totalUsers; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Réservations</h5>
                        <p class="card-text fs-4 fw-bold"><?php echo $totalReservations; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Réservations actives</h5>
                        <p class="card-text fs-4 fw-bold"><?php echo $activeReservations; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">Gestion des véhicules</h1>
            <a href="index.php?action=add_vehicle" class="btn btn-success">Ajouter un véhicule</a>
        </div>

        <?php if (empty($vehicles)): ?>
            <p>Aucun véhicule enregistré.</p>
        <?php else: ?>
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Immatriculation</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($vehicle['brand'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars($vehicle['model'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars($vehicle['registration_number'], ENT_QUOTES); ?></td>
                            <td class="text-center">
                                <a href="index.php?action=edit_vehicle&id=<?php echo $vehicle['id']; ?>" class="btn btn-primary btn-sm">Modifier</a>
                                <a href="index.php?action=delete_vehicle&id=<?php echo $vehicle['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce véhicule ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="mt-4">
            <a href="index.php?action=admin_reservations" class="btn btn-outline-primary">Voir toutes les réservations</a>
        </div>
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
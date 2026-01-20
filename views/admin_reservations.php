<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les réservations</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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

    <div class="page-header-actions" styl="padding-top: 60px;">
                    <a href="index.php?action=admin" class="back-link" style="margin-left: 80px;">
                        ← Retour
                    </a>
                </div>

    <div class="container mt-5">
        <?php require_once __DIR__ . '/../app/services/FlashMessage.php'; ?>
        <?php FlashMessage::display(); ?>
        <h2>Toutes les réservations</h2>
        <?php if (empty($reservations)): ?>
            <p>Aucune réservation.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Véhicule</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo $reservation['user_name']; ?></td>
                            <td><?php echo $reservation['brand'] . ' ' . $reservation['model'] . ' (' . $reservation['registration_number'] . ')'; ?></td>
                            <td><?php echo $reservation['start_date']; ?></td>
                            <td><?php echo $reservation['end_date']; ?></td>
                            <td>
                                <a href="index.php?action=delete_reservation&id=<?php echo $reservation['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">Annuler</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
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
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
    <title>Mes Réservations - Togo Data Lab</title>
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
                        <a class="nav-link active" href="index.php?action=my_reservations">Mes Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=profile">Mon Profil</a>
                    </li>
                    <?php if (!empty($_SESSION['is_admin'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=admin">Espace admin</a>
                        </li>   
                    <?php endif; ?>
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

        <?php
        $total = count($reservations ?? []);
        $upcoming = 0;
        $ongoing = 0;
        $done = 0;
        if (!empty($reservations)) {
            $now = new DateTime();
            foreach ($reservations as $r) {
                $startR = new DateTime($r['start_date']);
                $endR = new DateTime($r['end_date']);
                if ($startR > $now) {
                    $upcoming++;
                } elseif ($startR <= $now && $endR >= $now) {
                    $ongoing++;
                } else {
                    $done++;
                }
            }
        }
        ?>

        <div class="page-header">
            <div>
                <h1 class="section-title mb-1">Mes réservations</h1><br>
                <p class="section-subtitle mb-0">Suivez vos déplacements et anticipez vos prochaines missions.</p>
            </div><br>
            <button type="button" class="btn btn-primary"><div class="page-header-actions">
                <a href="index.php?action=dashboard" class="back-link">
                    ← Retour aux véhicules
                </a>
            </div></button><br><br>

        <?php if (empty($reservations)): ?>
            <p>Aucune réservation pour le moment. Rendez-vous sur le tableau de bord pour réserver un véhicule.</p>
        <?php else: ?>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="section-subtitle mb-1">Total</p>
                            <h4 class="mb-0"><?php echo $total; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="section-subtitle mb-1">À venir</p>
                            <h4 class="mb-0"><?php echo $upcoming; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="section-subtitle mb-1">En cours</p>
                            <h4 class="mb-0"><?php echo $ongoing; ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Véhicule</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Statut</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <?php
                                    $now = new DateTime();
                                    $start = new DateTime($reservation['start_date']);
                                    $end = new DateTime($reservation['end_date']);
                                    $statusLabel = 'Terminée';
                                    $badgeClass = 'status-badge done';

                                    if ($start > $now) {
                                        $statusLabel = 'À venir';
                                        $badgeClass = 'status-badge upcoming';
                                    } elseif ($start <= $now && $end >= $now) {
                                        $statusLabel = 'En cours';
                                        $badgeClass = 'status-badge ongoing';
                                    }
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reservation['brand'] . ' ' . $reservation['model'], ENT_QUOTES); ?></td>
                                    <td><?php echo $reservation['start_date']; ?></td>
                                    <td><?php echo $reservation['end_date']; ?></td>
                                    <td>
                                        <span class="<?php echo $badgeClass; ?>"><?php echo $statusLabel; ?></span>
                                    </td>
                                    <td class="text-end">
                                        <?php if ($statusLabel === 'À venir'): ?>
                                            <a href="index.php?action=delete_reservation&id=<?php echo $reservation['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Annuler cette réservation ?');">Annuler</a>
                                        <?php else: ?>
                                            <span class="text-muted small">Aucune action</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
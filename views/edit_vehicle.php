<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un véhicule</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css"></head>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Modifier un véhicule</h2>
                <?php require_once __DIR__ . '/../app/services/FlashMessage.php'; ?>
                <?php FlashMessage::display(); ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="brand" class="form-label">Marque</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="<?php echo htmlspecialchars($vehicle['brand'], ENT_QUOTES); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Modèle</label>
                        <input type="text" class="form-control" id="model" name="model" value="<?php echo htmlspecialchars($vehicle['model'], ENT_QUOTES); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="registration_number" class="form-label">Immatriculation</label>
                        <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo htmlspecialchars($vehicle['registration_number'], ENT_QUOTES); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Image actuelle</label>
                        <?php if (!empty($vehicle['image_path'])): ?>
                            <div class="mb-2">
                                <img src="<?php echo htmlspecialchars($vehicle['image_path'], ENT_QUOTES); ?>" alt="Véhicule" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        <?php else: ?>
                            <div class="text-muted small mb-2">Aucune image définie.</div>
                        <?php endif; ?>
                        
                        <label for="image" class="form-label">Changer l'image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Laissez vide pour conserver l'image actuelle.</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Modifier</button>
                </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
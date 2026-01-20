<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Togo Data Lab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="text-center">
                <img src="../assets/images/favicon.png" alt="Logo Togo Data Lab" class="mb-4" height="60">
                <h4 class="mb-2 fw-bold text-dark">Bon retour !</h4>
                <p class="text-secondary mb-4 small">Connectez-vous pour accéder à votre espace</p>
            </div>
            
            <?php require_once __DIR__ . '/../app/services/FlashMessage.php'; ?>
            <?php FlashMessage::display(); ?>

            <form action="index.php?action=login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email professionnel</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="nom@mail.com">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-secondary mb-0">
                    Pas encore de compte ? 
                    <a href="index.php?action=register" class="text-primary fw-semibold">Créer un compte</a>
                </p>
            </div><br>

            <center>
                <div class="page-header-actions">
                    <a href="index.php" class="back-link">
                        ← Retour
                    </a>
                </div>
            </center>

        </div>
    </div>
</body>
</html>
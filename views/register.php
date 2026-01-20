<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Togo Data Lab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            if (password !== confirmPassword) {
                alert("Les mots de passe ne correspondent pas.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="text-center">
                <img src="../assets/images/favicon.png" alt="Logo Togo Data Lab" class="mb-4" height="60">
                <h4 class="mb-2 fw-bold text-dark">Créer un compte</h4>
                <p class="text-secondary mb-4 small">Rejoignez la plateforme de gestion</p>
            </div>

            <?php require_once __DIR__ . '/../app/services/FlashMessage.php'; ?>
            <?php FlashMessage::display(); ?>

            <form action="index.php?action=register" method="POST" onsubmit="return validatePassword()">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="James BOND">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email professionnel</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="nom@mail.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Minimum 6 caractères" minlength="6">
                </div>
                <div class="mb-4">
                    <label for="confirm-password" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" required placeholder="Répétez le mot de passe">
                </div>
                <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-secondary mb-0">
                    Déjà un compte ? 
                    <a href="index.php?action=login" class="text-primary fw-semibold">Se connecter</a>
                </p>
            </div> <br>

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
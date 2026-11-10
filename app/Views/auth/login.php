<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Informasi Laundry</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="bg-body-tertiary">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">

                <h1 class="h3 text-center fw-bold mb-4">LAUNDRY</h1>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">Masuk ke sistem</h2>

                        <?php if ($error) : ?>
                            <div class="alert alert-danger"><?= e($error) ?></div>
                        <?php endif; ?>

                        <form action="?r=login/proses" method="POST">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="user_name" class="form-label">Username</label>
                                <input type="text" class="form-control" name="user_name" id="user_name"
                                       value="<?= e($old) ?>" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

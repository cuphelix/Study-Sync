<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Jadwal Kuliah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 600px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .login-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px 30px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 20px;
        }

        .login-options {
            display: grid;
            gap: 20px;
        }

        .login-card {
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .login-card-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .login-card h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #333;
        }

        .login-card p {
            color: #666;
            font-size: 14px;
        }

        /* CARD COLORS */
        .mahasiswa-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
        }

        .mahasiswa-card:hover {
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.4);
        }

        .dosen-card {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border: none;
        }

        .dosen-card:hover {
            box-shadow: 0 10px 30px rgba(67, 233, 123, 0.4);
        }

        .admin-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
        }

        .admin-card:hover {
            box-shadow: 0 10px 30px rgba(240, 147, 251, 0.4);
        }

        .mahasiswa-card h3,
        .mahasiswa-card p,
        .dosen-card h3,
        .dosen-card p,
        .admin-card h3,
        .admin-card p {
            color: white;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        @media (max-width: 600px) {
            .login-header h1 {
                font-size: 24px;
            }

            .login-card {
                padding: 20px;
            }

            .login-card-icon {
                font-size: 36px;
            }

            .login-card h3 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🎓 StudySync</h1>
            <p>Sistem Informasi Jadwal Kuliah</p>
        </div>

        <div class="login-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    ✅ <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <h2 class="login-title">Pilih Jenis Login</h2>

            <div class="login-options">
                <!-- Login Mahasiswa -->
                <a href="<?= base_url('mahasiswa/login') ?>" class="login-card mahasiswa-card">
                    <div class="login-card-icon">👨‍🎓</div>
                    <h3>Login Mahasiswa</h3>
                    <p>Akses jadwal kuliah, mata kuliah, dan pengingat</p>
                </a>

                <!-- Login Dosen -->
                <a href="<?= base_url('dosen/login') ?>" class="login-card dosen-card">
                    <div class="login-card-icon">👨‍🏫</div>
                    <h3>Login Dosen</h3>
                    <p>Kelola jadwal mengajar, mahasiswa, dan mata kuliah</p>
                </a>

                <!-- Login Admin -->
                <a href="<?= base_url('admin/login') ?>" class="login-card admin-card">
                    <div class="login-card-icon">👨‍💼</div>
                    <h3>Login Admin</h3>
                    <p>Kelola seluruh sistem dan data akademik</p>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah - StudySync</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            padding: 0 20px;
            margin-bottom: 10px;
        }

        .logo h2 {
            font-size: 22px;
            color: #2563eb;
            font-weight: 700;
        }

        .logo p {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }

        .menu-item {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            color: #475569;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: #f1f5f9;
            color: #2563eb;
        }

        .menu-item.active {
            background: #eff6ff;
            color: #2563eb;
            border-left-color: #2563eb;
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .menu-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 10px 20px;
        }

        .menu-item.logout {
            color: #dc2626;
            margin-top: 10px;
        }

        .menu-item.logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #1e293b;
        }

        .total-sks-badge {
            background: #2563eb;
            color: white;
            padding: 10px 24px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }

        .matakuliah-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
        }

        .matkul-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid #e2e8f0;
        }

        .matkul-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-color: #3b82f6;
        }

        .matkul-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .matkul-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #2563eb;
        }

        .matkul-code {
            background: #f1f5f9;
            color: #475569;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .matkul-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .matkul-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .matkul-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
        }

        .matkul-lecturer {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-size: 14px;
        }

        .matkul-lecturer i {
            color: #64748b;
        }

        .matkul-sks {
            background: #2563eb;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            animation: fadeIn 0.3s;
        }

        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .modal-title-section h2 {
            font-size: 22px;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .modal-code-sks {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .modal-code {
            background: #f1f5f9;
            color: #475569;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .modal-sks {
            background: #2563eb;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .close-btn {
            background: #f1f5f9;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.2s;
        }

        .close-btn:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-description {
            color: #475569;
            line-height: 1.6;
            margin-bottom: 24px;
            font-size: 15px;
        }

        .info-section {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .info-section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .dosen-info {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .dosen-avatar {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #2563eb;
            font-weight: 600;
        }

        .dosen-details h3 {
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .dosen-contact {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 13px;
        }

        .contact-item i {
            width: 16px;
            color: #94a3b8;
        }

        .jadwal-section {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
        }

        .jadwal-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .jadwal-item:last-child {
            border-bottom: none;
        }

        .jadwal-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
        }

        .jadwal-info {
            flex: 1;
        }

        .jadwal-info p {
            color: #475569;
            font-size: 14px;
            font-weight: 500;
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .no-data i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .matakuliah-grid {
                grid-template-columns: 1fr;
            }

            .modal {
                width: 95%;
                margin: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar FIXED -->
    <div class="sidebar">
        <div class="logo">
            <h2>StudySync</h2>
            <p>Portal Mahasiswa</p>
        </div>

        <div style="margin-top: 30px;">
            <a href="<?= base_url('mahasiswa/dashboard') ?>" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('mahasiswa/jadwal') ?>" class="menu-item">
                <i class="fas fa-clock"></i>
                <span>Jadwal Kuliah</span>
            </a>

            <a href="<?= base_url('mahasiswa/matakuliah') ?>" class="menu-item active">
                <i class="fas fa-book"></i>
                <span>Mata Kuliah</span>
            </a>

            <a href="<?= base_url('mahasiswa/pengingat') ?>" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Pengingat</span>
            </a>

            <a href="<?= base_url('mahasiswa/kalender') ?>" class="menu-item">
                <i class="fas fa-calendar"></i>
                <span>Kalender Akademik</span>
            </a>

            <a href="<?= base_url('mahasiswa/profil') ?>" class="menu-item">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        </div>

        <div class="menu-divider"></div>

        <a href="<?= base_url('logout') ?>" class="menu-item logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Mata Kuliah</h1>
            <div class="total-sks-badge">
                Total: <?= $total_sks ?> SKS
            </div>
        </div>

        <?php if (empty($matakuliah)): ?>
            <div class="no-data">
                <i class="fas fa-book-open"></i>
                <h3>Belum Ada Mata Kuliah</h3>
                <p>Mata kuliah akan muncul di sini setelah ditambahkan</p>
            </div>
        <?php else: ?>
            <div class="matakuliah-grid">
                <?php foreach ($matakuliah as $mk): ?>
                    <div class="matkul-card" onclick="showDetail(<?= $mk['id_matakuliah'] ?>)">
                        <div class="matkul-header">
                            <div class="matkul-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="matkul-code"><?= esc($mk['kode_matakuliah']) ?></div>
                        </div>

                        <h3 class="matkul-title"><?= esc($mk['nama_matakuliah']) ?></h3>

                        <p class="matkul-description">
                            <?php
                            $descriptions = [
                                'IF101' => 'Mata kuliah ini membahas konsep dan praktik pengembangan aplikasi web modern menggunakan HTML, CSS, JavaScript, dan framework populer.',
                                'IF102' => 'Mempelajari konsep sistem basis data, normalisasi, SQL, dan manajemen database modern termasuk NoSQL.',
                                'IF201' => 'Mata kuliah fundamental tentang algoritma, kompleksitas, dan struktur data seperti array, linked list, tree.',
                                'IF202' => 'Membahas konsep jaringan komputer, protokol TCP/IP, routing, switching, dan keamanan jaringan.',
                                'EL101' => 'Mempelajari konsep sistem operasi, manajemen proses, memori, file system, dan concurrency.',
                                'EL102' => 'Membahas metodologi pengembangan perangkat lunak, SDLC, Agile, design patterns, dan software testing.',
                                'EL201' => 'Pengantar kecerdasan buatan, machine learning, neural networks, dan aplikasi AI dalam berbagai bidang.',
                                'MK101' => 'Mata kuliah tentang pemrograman mobile menggunakan Android/iOS, UI/UX design, dan deployment aplikasi.',
                                'MK201' => 'Mempelajari konsep keamanan informasi, kriptografi, network security, dan ethical hacking.',
                                'IF301' => 'Pengantar kecerdasan buatan, machine learning, neural networks, dan aplikasi AI dalam berbagai bidang.'
                            ];
                            echo $descriptions[$mk['kode_matakuliah']] ?? 'Deskripsi mata kuliah belum tersedia.';
                            ?>
                        </p>

                        <div class="matkul-footer">
                            <div class="matkul-lecturer">
                                <i class="fas fa-user"></i>
                                <span><?= esc($mk['nama_dosen']) ?></span>
                            </div>
                            <div class="matkul-sks">3 SKS</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal Detail -->
    <div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
        <div class="modal" onclick="event.stopPropagation()">
            <div class="modal-header">
                <div class="modal-title-section">
                    <h2 id="modalTitle">Detail Mata Kuliah</h2>
                    <div class="modal-code-sks">
                        <span class="modal-code" id="modalCode">TI301</span>
                        <span class="modal-sks">3 SKS</span>
                    </div>
                </div>
                <button class="close-btn" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body" id="modalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        const dummyData = {
            descriptions: {
                'IF101': 'Mata kuliah ini membahas konsep dan praktik pengembangan aplikasi web modern menggunakan HTML, CSS, JavaScript, dan framework populer.',
                'IF102': 'Mempelajari konsep sistem basis data, normalisasi, SQL, dan manajemen database modern termasuk NoSQL.',
                'IF201': 'Mata kuliah fundamental tentang algoritma, kompleksitas, dan struktur data seperti array, linked list, tree.',
                'IF202': 'Membahas konsep jaringan komputer, protokol TCP/IP, routing, switching, dan keamanan jaringan.',
                'EL101': 'Mempelajari konsep sistem operasi, manajemen proses, memori, file system, dan concurrency.',
                'EL102': 'Membahas metodologi pengembangan perangkat lunak, SDLC, Agile, design patterns, dan software testing.',
                'EL201': 'Pengantar kecerdasan buatan, machine learning, neural networks, dan aplikasi AI dalam berbagai bidang.',
                'MK101': 'Mata kuliah tentang pemrograman mobile menggunakan Android/iOS, UI/UX design, dan deployment aplikasi.',
                'MK201': 'Mempelajari konsep keamanan informasi, kriptografi, network security, dan ethical hacking.',
                'IF301': 'Pengantar kecerdasan buatan, machine learning, neural networks, dan aplikasi AI dalam berbagai bidang.'
            },
            emails: {
                'Dr. Budi Santoso': 'budi@example.com',
                'Andi Pratama, M.Kom': 'andi@example.com',
                'Dewi Lestari, M.Kom': 'dewi@example.com',
                'Siti Rahma, M.T': 'siti@example.com',
                'Rudi Hartono, M.T': 'rudi@example.com',
                'Maria M., M.Kom': 'maria@example.com',
                'Joko Purnomo, M.Kom': 'joko@example.com',
                'Mega Sari, M.T': 'mega@example.com',
                'Tri Handoko, M.Kom': 'tri@example.com',
                'Dian Pertiwi, M.Kom': 'dian@example.com'
            },
            phones: {
                'Dr. Budi Santoso': '+62 812-3456-7890',
                'Andi Pratama, M.Kom': '+62 821-3456-7891',
                'Dewi Lestari, M.Kom': '+62 813-3456-7892',
                'Siti Rahma, M.T': '+62 814-3456-7893',
                'Rudi Hartono, M.T': '+62 815-3456-7894',
                'Maria M., M.Kom': '+62 816-3456-7895',
                'Joko Purnomo, M.Kom': '+62 817-3456-7896',
                'Mega Sari, M.T': '+62 818-3456-7897',
                'Tri Handoko, M.Kom': '+62 819-3456-7898',
                'Dian Pertiwi, M.Kom': '+62 820-3456-7899'
            },
            jadwal: {
                hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
                waktu: ['08:00 - 10:00', '10:00 - 12:00', '13:00 - 15:00', '15:00 - 17:00']
            }
        };

        function showDetail(id) {
            const modal = document.getElementById('modalOverlay');
            modal.classList.add('active');

            fetch(`<?= base_url('mahasiswa/getMatakuliahDetail/') ?>${id}`)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        const data = result.data;
                        document.getElementById('modalTitle').textContent = data.nama_matakuliah || 'Detail Mata Kuliah';
                        document.getElementById('modalCode').textContent = data.kode_matakuliah || 'TI301';

                        const description = dummyData.descriptions[data.kode_matakuliah] || 'Mata kuliah ini memberikan pemahaman mendalam tentang konsep dan praktik dalam bidang teknologi informasi.';
                        const email = data.email || dummyData.emails[data.nama_dosen] || 'dosen@university.ac.id';
                        const phone = data.no_wa || dummyData.phones[data.nama_dosen] || '+62 812-3456-7890';

                        const getInitials = (name) => {
                            if (!name) return 'DS';
                            return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                        };

                        let lokasi = '-';
                        if (data.nama_gedung && data.kode_kelas) {
                            lokasi = `${data.nama_gedung} Lt. ${data.lantai || '3'}, Ruang ${data.kode_kelas}`;
                        } else if (data.kode_kelas) {
                            lokasi = `Gedung Teknik Lt. 3, Ruang ${data.kode_kelas}`;
                        }

                        let jadwalHTML = '';
                        if (data.jadwal && data.jadwal.hari) {
                            jadwalHTML = `
                            <div class="jadwal-section">
                                <h3 class="info-section-title">Jadwal Perkuliahan</h3>
                                <div class="jadwal-item">
                                    <div class="jadwal-icon"><i class="fas fa-calendar"></i></div>
                                    <div class="jadwal-info"><p>${data.jadwal.hari}</p></div>
                                </div>
                                <div class="jadwal-item">
                                    <div class="jadwal-icon"><i class="far fa-clock"></i></div>
                                    <div class="jadwal-info"><p>${data.jadwal.jam_mulai ? data.jadwal.jam_mulai.substring(0,5) : '08:00'} - ${data.jadwal.jam_selesai ? data.jadwal.jam_selesai.substring(0,5) : '10:00'}</p></div>
                                </div>
                                <div class="jadwal-item">
                                    <div class="jadwal-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="jadwal-info"><p>${data.kode_kelas || 'Lab. Komputer 1'}</p></div>
                                </div>
                            </div>`;
                        } else {
                            const randomHari = dummyData.jadwal.hari[Math.floor(Math.random() * dummyData.jadwal.hari.length)];
                            const randomWaktu = dummyData.jadwal.waktu[Math.floor(Math.random() * dummyData.jadwal.waktu.length)];
                            jadwalHTML = `
                            <div class="jadwal-section">
                                <h3 class="info-section-title">Jadwal Perkuliahan</h3>
                                <div class="jadwal-item">
                                    <div class="jadwal-icon"><i class="fas fa-calendar"></i></div>
                                    <div class="jadwal-info"><p>${randomHari}</p></div>
                                </div>
                                <div class="jadwal-item">
                                    <div class="jadwal-icon"><i class="far fa-clock"></i></div>
                                    <div class="jadwal-info"><p>${randomWaktu}</p></div>
                                </div>
                                <div class="jadwal-item">
                                    <div class="jadwal-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="jadwal-info"><p>${data.kode_kelas || 'Lab. Komputer 1'}</p></div>
                                </div>
                            </div>`;
                        }

                        const modalContent = `
                            <p class="modal-description">${description}</p>
                            <div class="info-section">
                                <h3 class="info-section-title">Informasi Dosen</h3>
                                <div class="dosen-info">
                                    <div class="dosen-avatar">${getInitials(data.nama_dosen)}</div>
                                    <div class="dosen-details">
                                        <h3>${data.nama_dosen || 'Nama Dosen'}</h3>
                                        <div class="dosen-contact">
                                            <div class="contact-item"><i class="fas fa-envelope"></i><span>${email}</span></div>
                                            <div class="contact-item"><i class="fas fa-phone"></i><span>${phone}</span></div>
                                            <div class="contact-item"><i class="fas fa-map-marker-alt"></i><span>${lokasi}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ${jadwalHTML}
                        `;
                        document.getElementById('modalBody').innerHTML = modalContent;
                    } else {
                        document.getElementById('modalBody').innerHTML = '<p style="text-align: center; color: #64748b; padding: 40px;">Data tidak ditemukan</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('modalBody').innerHTML = '<p style="text-align: center; color: #64748b;">Gagal memuat data</p>';
                });
        }

        function closeModal(event) {
            if (!event || event.target.id === 'modalOverlay') {
                document.getElementById('modalOverlay').classList.remove('active');
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>

</html>
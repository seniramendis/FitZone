<?php
include 'header.php';

// Dynamic Trainer Data
$trainers_data = [
    1 => [
        'name' => 'Nuwan Perera',
        'specialty' => 'Head Strength Coach',
        'image' => 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?q=80&w=600&auto=format&fit=crop',
        'bio' => 'Nuwan has over 10 years of experience in powerlifting and strength conditioning. He specializes in helping clients push their physical limits, focusing on form, raw power, and muscle hypertrophy.',
        'experience' => '10+ Years',
        'email' => 'nuwan@fitzone.lk',
        'skills' => ['Powerlifting' => 95, 'Hypertrophy' => 90, 'Form & Mobility' => 85],
        'certs' => ['ISSA Certified', 'SLPA Strength Coach']
    ],
    2 => [
        'name' => 'Dilani Silva',
        'specialty' => 'Yoga & Mobility Lead',
        'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600&auto=format&fit=crop',
        'bio' => 'Dilani specializes in Ashtanga Yoga and joint mobility, helping members find balance between strength and flexibility for long-term health.',
        'experience' => '8 Years',
        'email' => 'dilani@fitzone.lk',
        'skills' => ['Ashtanga Yoga' => 95, 'Joint Mobility' => 90, 'Mindfulness' => 80],
        'certs' => ['RYT 200', 'Mobility Specialist']
    ],
    3 => [
        'name' => 'Kavindu Jayawardena',
        'specialty' => 'HIIT & Cardio Specialist',
        'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=600&auto=format&fit=crop',
        'bio' => 'Kavindu brings unmatched energy to every session. His high-intensity interval classes are designed to torch calories and build cardiovascular endurance.',
        'experience' => '5 Years',
        'email' => 'kavindu@fitzone.lk',
        'skills' => ['HIIT Programming' => 95, 'Cardio Endurance' => 85, 'Fat Loss' => 90],
        'certs' => ['ACE Certified', 'Advanced HIIT Instructor']
    ]
];

$trainer_id = isset($_GET['id']) && array_key_exists($_GET['id'], $trainers_data) ? $_GET['id'] : 1;
$trainer = $trainers_data[$trainer_id];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --fz-red: #e63946;
        --fz-dark: #111827;
    }

    body {
        background-color: #f8f9fa;
    }

    .profile-card {
        margin-top: 120px;
        margin-bottom: 50px;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
    }

    .sidebar-info {
        background-color: var(--fz-dark);
        color: white;
        padding: 3rem 2rem;
    }

    .trainer-img-circle {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 5px solid var(--fz-red);
        object-fit: cover;
        box-shadow: 0 0 25px rgba(230, 57, 70, 0.3);
    }

    /* Elegant Progress Bars */
    .progress {
        height: 12px;
        background-color: #e9ecef;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .progress-bar {
        background-color: var(--fz-red);
        border-radius: 10px;
        width: 0%;
        /* Start at 0 for animation */
        transition: width 2s cubic-bezier(0.1, 0.42, 0.41, 1);
    }

    .badge-outline {
        background: transparent;
        color: var(--fz-dark);
        border: 1px solid #dee2e6;
        padding: 0.6rem 1.2rem;
        border-radius: 50px;
        font-weight: 500;
        margin-right: 10px;
        margin-bottom: 10px;
        display: inline-block;
    }

    .btn-transformation {
        background-color: var(--fz-red);
        color: white !important;
        font-weight: 700;
        padding: 1.2rem 2.5rem;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-transformation:hover {
        background-color: #c1121f;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(230, 57, 70, 0.3);
    }

    @media (max-width: 991px) {
        .profile-card {
            margin-top: 80px;
        }
    }
</style>

<div class="container">
    <div class="card profile-card shadow-lg">
        <div class="row g-0">
            <div class="col-lg-4 sidebar-info text-center d-flex flex-column align-items-center">
                <img src="<?php echo $trainer['image']; ?>" class="trainer-img-circle mb-4" alt="Trainer Profile">
                <h2 class="fw-bold mb-1"><?php echo $trainer['name']; ?></h2>
                <p class="fw-bold mb-5" style="color: var(--fz-red);"><?php echo $trainer['specialty']; ?></p>

                <div class="w-100 text-start px-3">
                    <p class="mb-3 d-flex align-items-center">
                        <i class="fa-solid fa-medal me-3 text-danger"></i>
                        <span><strong>Experience:</strong> <?php echo $trainer['experience']; ?></span>
                    </p>
                    <p class="mb-3 d-flex align-items-center">
                        <i class="fa-solid fa-envelope me-3 text-danger"></i>
                        <span><strong>Email:</strong> <?php echo $trainer['email']; ?></span>
                    </p>
                    <p class="d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-3 text-danger"></i>
                        <span><strong>Branch:</strong> Kurunegala</span>
                    </p>
                </div>
            </div>

            <div class="col-lg-8 p-4 p-md-5">
                <h4 class="fw-bold text-uppercase mb-4">Technical Proficiency</h4>

                <div class="mb-5">
                    <?php foreach ($trainer['skills'] as $skill => $level): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold text-secondary small text-uppercase"><?php echo $skill; ?></span>
                            <div>
                                <span class="fw-bold text-danger counter" data-target="<?php echo $level; ?>">0</span>
                                <span class="fw-bold text-danger">%</span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated animate-bar"
                                data-width="<?php echo $level; ?>%"
                                role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h4 class="fw-bold text-uppercase mb-4">Professional Credentials</h4>
                <div class="mb-5">
                    <?php foreach ($trainer['certs'] as $cert): ?>
                        <span class="badge-outline"><?php echo $cert; ?></span>
                    <?php endforeach; ?>
                </div>

                <div class="pt-4 border-top d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <p class="text-muted mb-4 mb-md-0 me-md-4">Ready to hit your targets? Join <?php echo explode(' ', $trainer['name'])[0]; ?> and start your fitness journey today.</p>
                    <a href="register.php" class="btn-transformation">Start Your Transformation</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Animate the percentage numbers
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const speed = 40;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 25);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });

        // 2. Animate the progress bars filling up
        const bars = document.querySelectorAll('.animate-bar');
        setTimeout(() => {
            bars.forEach(bar => {
                bar.style.width = bar.getAttribute('data-width');
            });
        }, 300);
    });
</script>

<?php include 'footer.php'; ?>
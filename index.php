<?php
// 1. SMART LOGIN LOGIC
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_id']);
$dashboard_link = 'login.php';
if ($is_logged_in) {
    if ($_SESSION['role'] === 'admin') $dashboard_link = 'admin_dashboard.php';
    elseif ($_SESSION['role'] === 'trainer') $dashboard_link = 'trainer_dashboard.php';
    else $dashboard_link = 'member_dashboard.php';
}

include 'header.php';
?>

<style>
    /* --- CAROUSEL STYLING (Programs & Trainers) --- */
    .programs-carousel,
    .trainers-carousel {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        gap: 25px;
        padding: 20px 10px 40px 10px;
        /* Padding for the shadow overflow */
        max-width: 1200px;
        margin: 0 auto;

        /* Custom Scrollbar */
        scrollbar-width: thin;
        scrollbar-color: #e63946 #f3f4f6;
    }

    .programs-carousel::-webkit-scrollbar,
    .trainers-carousel::-webkit-scrollbar {
        height: 8px;
    }

    .programs-carousel::-webkit-scrollbar-track,
    .trainers-carousel::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 10px;
    }

    .programs-carousel::-webkit-scrollbar-thumb,
    .trainers-carousel::-webkit-scrollbar-thumb {
        background-color: #e63946;
        border-radius: 10px;
    }

    /* Standardize card sizes for both carousels */
    .programs-carousel .program-card,
    .trainers-carousel .trainer-card {
        flex: 0 0 350px;
        scroll-snap-align: start;
        margin: 0;
    }

    /* --- PROGRAMS HOVER BUTTON --- */
    .btn-book-class {
        display: inline-block;
        margin-top: 15px;
        padding: 8px 20px;
        background-color: #e63946;
        color: #fff !important;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        border-radius: 6px;
        text-decoration: none;
        letter-spacing: 1px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0;
        transform: translateY(20px);
        pointer-events: none;
    }

    .program-card:hover .btn-book-class {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .btn-book-class:hover {
        background-color: #c1121f;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(230, 57, 70, 0.4);
    }

    /* --- TRAINER PROFILE BUTTON --- */
    .btn-profile {
        display: inline-block;
        margin-top: 20px;
        padding: 8px 24px;
        background: rgba(230, 57, 70, 0.1);
        color: #e63946;
        border-radius: 50px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-profile:hover {
        background: #e63946;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(230, 57, 70, 0.2);
    }

    /* Mobile Responsiveness for Carousels */
    @media (max-width: 768px) {

        .programs-carousel .program-card,
        .trainers-carousel .trainer-card {
            flex: 0 0 85%;
            /* Shows 1 full card and peeks the next one */
            scroll-snap-align: center;
        }
    }
</style>

<section id="home" class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div id="text-slider" class="fade-transition">
            <h1 id="hero-heading">Modernizing Your Fitness Journey</h1>
            <p id="hero-subtext">The most trusted health and wellness center in Kurunegala. Access high-end equipment, professional trainers, and dynamic classes.</p>
        </div>

        <?php if ($is_logged_in): ?>
            <a href="<?php echo $dashboard_link; ?>" class="btn-primary">Go to Dashboard</a>
        <?php else: ?>
            <a href="register.php" class="btn-primary">Join Now</a>
        <?php endif; ?>
    </div>
</section>

<section id="programs" class="programs-section">
    <h2 class="section-title">Explore Our Programs</h2>

    <div class="programs-carousel">
        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Strength & Power</h3>
                <p>Build muscle and increase your raw power with our premium free weights and resistance machines.</p>
                <a href="class_details.php?id=1" class="btn-book-class">View & Book</a>
            </div>
        </div>
        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Cardio & HIIT</h3>
                <p>Burn calories fast and boost your endurance with high-intensity intervals and top-tier cardio equipment.</p>
                <a href="class_details.php?id=2" class="btn-book-class">View & Book</a>
            </div>
        </div>
        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Yoga & Mobility</h3>
                <p>Enhance your flexibility, balance, and core strength in our guided, relaxing studio sessions.</p>
                <a href="class_details.php?id=3" class="btn-book-class">View & Book</a>
            </div>
        </div>
        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1549833284-6a7df91c1f65?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Boxing & Martial Arts</h3>
                <p>Improve your agility, speed, and self-defense skills with our heavy bags and expert striking coaches.</p>
                <a href="class_details.php?id=4" class="btn-book-class">View & Book</a>
            </div>
        </div>
        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1538805060514-97d9cc17730c?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>CrossFit & Conditioning</h3>
                <p>A hardcore mix of Olympic weightlifting, gymnastics, and aerobic exercise for ultimate functional fitness.</p>
                <a href="class_details.php?id=5" class="btn-book-class">View & Book</a>
            </div>
        </div>
        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1524594152303-9fd13543fe6e?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Zumba & Dance</h3>
                <p>Burn calories while having a blast. A high-energy, rhythm-based workout perfect for all fitness levels.</p>
                <a href="class_details.php?id=6" class="btn-book-class">View & Book</a>
            </div>
        </div>
    </div>
</section>

<section id="classes" class="features-section">
    <h2 class="section-title">The Smarter Way to Train</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🔍</div>
            <h3>Search & Book</h3>
            <p>Browse our extensive catalog of fitness classes and personal trainers. Filter by time and availability to book instantly.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">👨‍🏫</div>
            <h3>Expert Trainers</h3>
            <p>All sessions come with the option of a certified fitness operator, ensuring your workout is managed by professionals.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🛡️</div>
            <h3>Secure Memberships</h3>
            <p>Payments are held securely and subscriptions can be managed or cancelled anytime through your personalized dashboard.</p>
        </div>
    </div>
</section>

<section id="trainers" class="trainers-section">
    <h2 class="section-title">Meet Our Experts</h2>

    <div class="trainers-carousel">
        <div class="trainer-card">
            <div class="trainer-img" style="background-image: url('https://images.unsplash.com/photo-1567013127542-490d757e51fc?q=80&w=600&auto=format&fit=crop');"></div>
            <h3>Nuwan Perera</h3>
            <p class="specialty">Head Strength Coach</p>
            <div class="trainer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <a href="trainer_profile.php?id=1" class="btn-profile">View Profile</a>
        </div>
        <div class="trainer-card">
            <div class="trainer-img" style="background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600&auto=format&fit=crop');"></div>
            <h3>Dilani Silva</h3>
            <p class="specialty">Yoga & Mobility Lead</p>
            <div class="trainer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <a href="trainer_profile.php?id=2" class="btn-profile">View Profile</a>
        </div>
        <div class="trainer-card">
            <div class="trainer-img" style="background-image: url('https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=600&auto=format&fit=crop');"></div>
            <h3>Kavindu Jayawardena</h3>
            <p class="specialty">HIIT & Cardio Specialist</p>
            <div class="trainer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <a href="trainer_profile.php?id=3" class="btn-profile">View Profile</a>
        </div>
        <div class="trainer-card">
            <div class="trainer-img" style="background-image: url('https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=600&auto=format&fit=crop');"></div>
            <h3>Senuri Fernando</h3>
            <p class="specialty">Pilates & Core Expert</p>
            <div class="trainer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <a href="trainer_profile.php?id=4" class="btn-profile">View Profile</a>
        </div>
        <div class="trainer-card">
            <div class="trainer-img" style="background-image: url('https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=600&auto=format&fit=crop');"></div>
            <h3>Roshan Silva</h3>
            <p class="specialty">Boxing & Martial Arts</p>
            <div class="trainer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <a href="trainer_profile.php?id=5" class="btn-profile">View Profile</a>
        </div>
        <div class="trainer-card">
            <div class="trainer-img" style="background-image: url('https://images.unsplash.com/photo-1558611848-73f7eb4001a1?q=80&w=600&auto=format&fit=crop');"></div>
            <h3>Malith Kumara</h3>
            <p class="specialty">CrossFit & Conditioning</p>
            <div class="trainer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <a href="trainer_profile.php?id=6" class="btn-profile">View Profile</a>
        </div>
    </div>
</section>

<section id="memberships" class="pricing-section">
    <h2 class="section-title">Choose Your Plan</h2>
    <div class="pricing-grid">

        <div class="pricing-card">
            <h3>Basic</h3>
            <div class="price">LKR 3,500<span>/mo</span></div>
            <ul class="plan-features">
                <li><i class="fa-solid fa-check"></i> Gym Access (6 AM - 8 PM)</li>
                <li><i class="fa-solid fa-check"></i> Standard Equipment</li>
                <li><i class="fa-solid fa-xmark" style="color:#9ca3af"></i> Group Classes</li>
                <li><i class="fa-solid fa-xmark" style="color:#9ca3af"></i> Personal Trainer</li>
            </ul>
            <?php if ($is_logged_in): ?>
                <form action="checkout_subscription.php" method="POST" style="margin: 0;">
                    <input type="hidden" name="plan_name" value="Basic">
                    <input type="hidden" name="plan_price" value="3500">
                    <button type="submit" class="btn-plan" style="width: 100%; cursor: pointer; background-color: transparent;">Upgrade Now</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="btn-plan">Get Started</a>
            <?php endif; ?>
        </div>

        <div class="pricing-card popular">
            <div class="popular-badge">Most Popular</div>
            <h3>Pro</h3>
            <div class="price">LKR 5,500<span>/mo</span></div>
            <ul class="plan-features">
                <li><i class="fa-solid fa-check" style="color:#fff;"></i> 24/7 Gym Access</li>
                <li><i class="fa-solid fa-check" style="color:#fff;"></i> Premium Equipment</li>
                <li><i class="fa-solid fa-check" style="color:#fff;"></i> All Group Classes</li>
                <li><i class="fa-solid fa-xmark" style="color:#9ca3af"></i> Personal Trainer</li>
            </ul>
            <?php if ($is_logged_in): ?>
                <form action="checkout_subscription.php" method="POST" style="margin: 0;">
                    <input type="hidden" name="plan_name" value="Pro">
                    <input type="hidden" name="plan_price" value="5500">
                    <button type="submit" class="btn-primary" style="display: block; width: 100%; text-align: center; cursor: pointer; border: none;">Upgrade Now</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="btn-primary" style="display:block; text-align:center;">Get Started</a>
            <?php endif; ?>
        </div>

        <div class="pricing-card">
            <h3>VIP</h3>
            <div class="price">LKR 10,000<span>/mo</span></div>
            <ul class="plan-features">
                <li><i class="fa-solid fa-check"></i> 24/7 Gym Access</li>
                <li><i class="fa-solid fa-check"></i> Premium Equipment</li>
                <li><i class="fa-solid fa-check"></i> All Group Classes</li>
                <li><i class="fa-solid fa-check"></i> 4 PT Sessions / Month</li>
            </ul>
            <?php if ($is_logged_in): ?>
                <form action="checkout_subscription.php" method="POST" style="margin: 0;">
                    <input type="hidden" name="plan_name" value="VIP">
                    <input type="hidden" name="plan_price" value="10000">
                    <button type="submit" class="btn-plan" style="width: 100%; cursor: pointer; background-color: transparent;">Upgrade Now</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="btn-plan">Get Started</a>
            <?php endif; ?>
        </div>

    </div>
</section>

<section id="location" class="location-section">
    <h2 class="section-title">Find Your Zone</h2>
    <div class="location-container">
        <div class="location-details">
            <h3>Located in the Heart of Kurunegala</h3>
            <p>Stop by for a tour of our state-of-the-art facility. Our certified trainers are ready to help you get started on your fitness journey today.</p>
            <ul class="info-list">
                <li><i class="fa-solid fa-location-dot"></i> 123 Colombo Road, Kurunegala, Sri Lanka</li>
                <li><i class="fa-solid fa-clock"></i> Open 24/7 for Members</li>
                <li><i class="fa-solid fa-phone"></i> +94 77 123 4567</li>
                <li><i class="fa-solid fa-envelope"></i> info@fitzone.lk</li>
            </ul>
        </div>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126604.28314144419!2d80.2769418659174!3d7.487046039544971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae33a1ceac88cb3%3A0xe3ea442079149021!2sKurunegala!5e0!3m2!1sen!2slk!4v1710230000000!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
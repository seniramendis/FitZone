<?php include 'header.php'; ?>

<style>
    /* --- PAGE HEADER --- */
    .page-header {
        position: relative;
        width: 100%;
        height: 40vh;
        margin-top: 60px;
        background-image: url('https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=1920&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .page-header-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 20, 32, 0.85);
    }

    .page-header-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 0 20px;
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
    }

    .page-header h1 span {
        color: #e63946;
    }

    /* --- SEARCH BAR --- */
    .search-container {
        max-width: 600px;
        margin: -30px auto 50px auto;
        position: relative;
        z-index: 10;
        padding: 0 20px;
    }

    .search-box {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 50px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 2px solid transparent;
        transition: 0.3s ease;
    }

    .search-box:focus-within {
        border-color: #e63946;
        box-shadow: 0 10px 30px rgba(230, 57, 70, 0.15);
    }

    .search-box i {
        padding-left: 25px;
        color: #9ca3af;
        font-size: 1.2rem;
    }

    .search-box input {
        width: 100%;
        padding: 18px 20px;
        border: none;
        outline: none;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        color: #374151;
        background: transparent;
    }

    /* --- PROFILE BUTTON --- */
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
    }
</style>

<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="page-header-content">
        <h1>Meet Our <span>Experts</span></h1>
    </div>
</section>

<section class="trainers-section" style="padding-top: 0;">

    <div class="search-container">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="trainerSearch" placeholder="Search by name or specialty (e.g., Yoga, HIIT)...">
        </div>
    </div>

    <div class="trainers-grid" id="trainersGrid">
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

<script>
    document.getElementById('trainerSearch').addEventListener('keyup', function() {
        let searchQuery = this.value.toLowerCase();
        let trainerCards = document.querySelectorAll('.trainer-card');

        trainerCards.forEach(function(card) {
            let cardText = card.textContent.toLowerCase();
            if (cardText.includes(searchQuery)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
</script>

<?php include 'footer.php'; ?>
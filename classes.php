<?php include 'header.php'; ?>

<style>
    /* --- PAGE HEADER --- */
    .page-header {
        position: relative;
        width: 100%;
        height: 40vh;
        margin-top: 60px;
        background-image: url('https://images.unsplash.com/photo-1558611848-73f7eb4001a1?q=80&w=1920&auto=format&fit=crop');
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
        /* Pulls it up slightly over the section below */
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
</style>

<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="page-header-content">
        <h1>Our <span>Programs</span></h1>
    </div>
</section>

<section class="programs-section" style="padding-top: 0;">

    <div class="search-container">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="classSearch" placeholder="Search for a class (e.g., Yoga, HIIT, Boxing)...">
        </div>
    </div>

    <div class="programs-grid" id="classesGrid">
        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Strength & Power</h3>
                <p>Build muscle and increase your raw power with our premium free weights and resistance machines.</p>
            </div>
        </div>

        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Cardio & HIIT</h3>
                <p>Burn calories fast and boost your endurance with high-intensity intervals and top-tier cardio equipment.</p>
            </div>
        </div>

        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Yoga & Mobility</h3>
                <p>Enhance your flexibility, balance, and core strength in our guided, relaxing studio sessions.</p>
            </div>
        </div>

        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1549833284-6a7df91c1f65?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Boxing & Martial Arts</h3>
                <p>Improve your agility, speed, and self-defense skills with our heavy bags and expert striking coaches.</p>
            </div>
        </div>

        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1538805060514-97d9cc17730c?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>CrossFit & Conditioning</h3>
                <p>A hardcore mix of Olympic weightlifting, gymnastics, and aerobic exercise for ultimate functional fitness.</p>
            </div>
        </div>

        <div class="program-card" style="background-image: url('https://images.unsplash.com/photo-1524594152303-9fd13543fe6e?q=80&w=800&auto=format&fit=crop');">
            <div class="program-overlay"></div>
            <div class="program-info">
                <h3>Zumba & Dance</h3>
                <p>Burn calories while having a blast. A high-energy, rhythm-based workout perfect for all fitness levels.</p>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('classSearch').addEventListener('keyup', function() {
        // Get the search value and convert to lowercase
        let searchQuery = this.value.toLowerCase();

        // Get all the class cards
        let classCards = document.querySelectorAll('.program-card');

        // Loop through each card
        classCards.forEach(function(card) {
            // Get the text inside the card (the H3 title and P description)
            let cardText = card.textContent.toLowerCase();

            // If the card text includes the search query, show it. Otherwise, hide it.
            if (cardText.includes(searchQuery)) {
                card.style.display = "flex"; // Restores the default display type
            } else {
                card.style.display = "none"; // Hides the card completely
            }
        });
    });
</script>

<?php include 'footer.php'; ?>
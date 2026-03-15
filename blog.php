<?php include 'header.php'; ?>

<style>
    .page-header {
        position: relative;
        width: 100%;
        height: 40vh;
        margin-top: 60px;

        background-image: url('https://images.unsplash.com/photo-1574680096145-d05b474e2155?q=80&w=1920&auto=format&fit=crop');
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
        margin-bottom: 10px;
    }

    .page-header h1 span {
        color: #e63946;
    }

    .page-header p {
        font-size: 1.1rem;
        color: #e5e7eb;
    }

    /* --- BLOG GRID --- */
    .blog-section {
        padding: 80px 5%;
        background-color: #f9fafb;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .blog-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .blog-img {
        width: 100%;
        height: 220px;
        background-size: cover;
        background-position: center;
    }

    .blog-content {
        padding: 30px;
    }

    .blog-category {
        display: inline-block;
        background: rgba(230, 57, 70, 0.1);
        color: #e63946;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .blog-content h3 {
        font-size: 1.4rem;
        color: #111827;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .blog-content p {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .read-more {
        color: #111827;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: color 0.3s ease;
    }

    .read-more:hover {
        color: #e63946;
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2.2rem;
        }
    }
</style>

<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="page-header-content">
        <h1>FitZone <span>Insights</span></h1>
        <p>Expert advice, nutrition tips, and workout guides to fuel your journey.</p>
    </div>
</section>

<section class="blog-section">
    <div class="blog-grid">
        <article class="blog-card">
            <div class="blog-img" style="background-image: url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=800&auto=format&fit=crop');"></div>
            <div class="blog-content">
                <span class="blog-category">Training</span>
                <h3>The Ultimate 4-Week Beginner Strength Guide</h3>
                <p>New to lifting? This step-by-step guide covers the fundamental compound movements to build a solid foundation safely.</p>
                <a href="#" class="read-more">Read Article <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </article>

        <article class="blog-card">
            <div class="blog-img" style="background-image: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=800&auto=format&fit=crop');"></div>
            <div class="blog-content">
                <span class="blog-category">Nutrition</span>
                <h3>Post-Workout Meals: What to Eat for Recovery</h3>
                <p>Maximize your muscle growth and energy recovery by timing your macronutrients correctly after a heavy session.</p>
                <a href="#" class="read-more">Read Article <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </article>

        <article class="blog-card">
            <div class="blog-img" style="background-image: url('https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=800&auto=format&fit=crop');"></div>
            <div class="blog-content">
                <span class="blog-category">Cardio</span>
                <h3>HIIT vs. LISS: Which Cardio is Right for You?</h3>
                <p>Breaking down the science between High-Intensity Interval Training and Low-Intensity Steady State cardio for fat loss.</p>
                <a href="#" class="read-more">Read Article <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </article>

        <article class="blog-card">
            <div class="blog-img" style="background-image: url('https://images.unsplash.com/photo-1552196563-552592624bb0?q=80&w=800&auto=format&fit=crop');"></div>
            <div class="blog-content">
                <span class="blog-category">Recovery</span>
                <h3>Why Mobility Training is Crucial for Lifters</h3>
                <p>Stop ignoring your warm-ups. Learn how active stretching and yoga can prevent injuries and increase your squat depth.</p>
                <a href="#" class="read-more">Read Article <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </article>
    </div>
</section>

<?php include 'footer.php'; ?>
<style>
        .main-footer {
            background-color: var(--darker-bg, #0f1420);
            color: #d1d5db;
            padding: 60px 5% 20px 5%;
            font-family: 'Poppins', sans-serif;
            border-top: 4px solid var(--primary-red, #e63946);
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .footer-col h3 i {
            color: var(--primary-red, #e63946);
            margin-right: 10px;
        }

        .footer-col h4 {
            color: #fff;
            font-size: 1.2rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-red, #e63946);
        }

        .footer-col p {
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col ul li {
            margin-bottom: 12px;
        }

        .footer-col ul li a {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s ease, padding-left 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: var(--primary-red, #e63946);
            padding-left: 5px; 
        }

        .contact-info li {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
        }

        .contact-info li i {
            color: var(--primary-red, #e63946);
            font-size: 1.1rem;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #1f2937;
            color: #fff;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--primary-red, #e63946);
            transform: translateY(-3px);
        }

        .newsletter-form {
            display: flex;
            margin-top: 15px;
        }

        .newsletter-form input {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            outline: none;
            font-family: 'Poppins', sans-serif;
        }

        .newsletter-form button {
            background-color: var(--primary-red, #e63946);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .newsletter-form button:hover {
            background-color: #c1121f;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #374151;
            font-size: 0.85rem;
            color: #9ca3af;
        }
    </style>

    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3><i class="fa-solid fa-dumbbell"></i> FitZone</h3>
                <p>Kurunegala's premier fitness destination. We are dedicated to helping you achieve a balanced lifestyle through physical and mental well-being.</p>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Explore</h4>
                <ul>
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#classes">Our Classes</a></li>
                    <li><a href="index.php#trainers">Expert Trainers</a></li>
                    <li><a href="index.php#memberships">Membership Plans</a></li>
                    <li><a href="blog.php">Fitness Blog</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul class="contact-info">
                    <li><i class="fa-solid fa-location-dot"></i> Kurunegala, Sri Lanka</li>
                    <li><i class="fa-solid fa-phone"></i> +94 77 123 4567</li>
                    <li><i class="fa-solid fa-envelope"></i> info@fitzone.lk</li>
                    <li><i class="fa-solid fa-clock"></i> Open 24/7</li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Newsletter</h4>
                <p>Subscribe for fitness tips, healthy recipes, and exclusive gym offers.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your Email Address" required>
                    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2026 FitZone Fitness Center, Kurunegala. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
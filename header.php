<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone | Modern Fitness Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

    <style>
        :root {
            --primary-red: #e63946;
            --dark-bg: rgba(17, 24, 39, 0.85);
        }

        header {
            background: var(--dark-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #fff;
            padding: 0.8rem 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            box-sizing: border-box;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        header .logo {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        header .logo h1 {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            margin: 0;
        }

        header .logo i {
            color: var(--primary-red);
            margin-right: 8px;
            font-size: 1.3rem;
        }

        .menu-toggle {
            display: none;
            font-size: 1.6rem;
            cursor: pointer;
            color: #fff;
            transition: color 0.3s ease;
        }

        .menu-toggle:hover {
            color: var(--primary-red);
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-grow: 1;
        }

        nav {
            margin-right: auto;
            margin-left: 25px;
        }

        nav ul {
            list-style: none;
            display: flex;
            padding: 0;
            margin: 0;
            gap: 5px;
        }

        nav a {
            color: #d1d5db;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        nav a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .btn-login,
        .btn-register {
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-login {
            color: #fff;
        }

        .btn-login:hover {
            color: var(--primary-red);
            background: rgba(230, 57, 70, 0.1);
        }

        .btn-register {
            background: var(--primary-red);
            color: #fff;
            box-shadow: inset 0 0 0 0 #c1121f;
            transition: color 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
        }

        .btn-register:hover {
            box-shadow: inset 200px 0 0 0 #c1121f;
        }

        /* --- NEW PROFILE DROPDOWN STYLING --- */
        .user-profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-icon {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .profile-icon:hover,
        .user-profile-dropdown.active .profile-icon {
            border-color: var(--primary-red);
            background: rgba(230, 57, 70, 0.1);
            color: var(--primary-red);
        }

        .profile-dropdown-menu {
            position: absolute;
            top: 130%;
            right: 0;
            width: 220px;
            background: rgba(17, 24, 39, 0.98);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 10px 0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1000;
        }

        /* Show on hover for desktop, or click for mobile */
        .user-profile-dropdown:hover .profile-dropdown-menu,
        .user-profile-dropdown.active .profile-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header-custom {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 8px;
            text-align: left;
        }

        .dropdown-header-custom strong {
            color: #fff;
            display: block;
            font-size: 1rem;
        }

        .dropdown-header-custom span {
            font-size: 0.75rem;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .profile-dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #d1d5db;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            text-align: left;
        }

        .profile-dropdown-menu a i {
            margin-right: 12px;
            width: 16px;
            text-align: center;
            color: var(--primary-red);
        }

        .profile-dropdown-menu a:hover {
            background: rgba(230, 57, 70, 0.1);
            color: #fff;
            padding-left: 25px;
        }

        .logout-link:hover i {
            color: #fff !important;
        }

        @media (max-width: 992px) {
            header {
                padding: 12px 5%;
                flex-direction: row;
                justify-content: space-between;
                gap: 0;
            }

            .menu-toggle {
                display: block;
                z-index: 1001;
            }

            header .logo {
                margin-bottom: 0;
                z-index: 1001;
            }

            .nav-container {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 65px;
                left: 5%;
                width: 90%;
                background: rgba(17, 24, 39, 0.95);
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 16px;
                padding: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
                z-index: 999;
                margin-left: 0;
                box-sizing: border-box;
            }

            .nav-container.active {
                display: flex;
                animation: popIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            }

            @keyframes popIn {
                from {
                    opacity: 0;
                    transform: translateY(-15px) scale(0.95);
                }

                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            nav {
                width: 100%;
                margin: 0;
            }

            nav ul {
                flex-direction: column;
                text-align: center;
                width: 100%;
                gap: 5px;
            }

            nav a {
                display: block;
                width: 100%;
                padding: 12px 10px;
                border-radius: 10px;
                font-size: 1.05rem;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                gap: 15px;
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px solid rgba(255, 255, 255, 0.05);
                align-items: center;
            }

            /* Adjust dropdown for mobile */
            .user-profile-dropdown {
                width: 100%;
            }

            .profile-icon {
                margin: 0 auto;
            }

            .profile-dropdown-menu {
                position: relative;
                top: 0;
                width: 100%;
                box-shadow: none;
                background: transparent;
                border: none;
                display: none;
                opacity: 1;
                visibility: visible;
                transform: none;
                padding-top: 15px;
            }

            .user-profile-dropdown.active .profile-dropdown-menu {
                display: block;
            }

            .dropdown-header-custom,
            .profile-dropdown-menu a {
                text-align: center;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <header id="main-header">
        <div class="logo">
            <h1><i class="fa-solid fa-dumbbell"></i>FitZone</h1>
        </div>

        <div class="menu-toggle" id="mobile-menu">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="nav-container" id="nav-container">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="classes.php">Classes</a></li>
                    <li><a href="trainers.php">Trainers</a></li>
                    <li><a href="pricing.php">Pricing</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['user_id'])): ?>

                    <?php
                    // Route to the correct dashboard based on role
                    $dashboard_url = 'member_dashboard.php';
                    if ($_SESSION['role'] == 'admin') {
                        $dashboard_url = 'admin_dashboard.php';
                    } elseif ($_SESSION['role'] == 'trainer') {
                        $dashboard_url = 'trainer_dashboard.php';
                    }

                    // Grab the FULL name here so edits show immediately
                    $fullName = $_SESSION['fullname'];
                    $roleLabel = ucfirst($_SESSION['role']);
                    ?>

                    <div class="user-profile-dropdown" onclick="this.classList.toggle('active')">
                        <div class="profile-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="profile-dropdown-menu">
                            <div class="dropdown-header-custom">
                                <strong><?php echo htmlspecialchars($fullName); ?></strong>
                                <span><?php echo htmlspecialchars($roleLabel); ?></span>
                            </div>
                            <a href="<?php echo $dashboard_url; ?>"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
                            <a href="edit_profile.php"><i class="fa-solid fa-user-pen"></i> Edit Profile</a>

                            <div style="height: 1px; background: rgba(255,255,255,0.08); margin: 8px 0;"></div>

                            <a href="logout.php" class="logout-link" style="color: #ef4444;">
                                <i class="fa-solid fa-right-from-bracket" style="color: #ef4444;"></i> Logout
                            </a>
                        </div>
                    </div>

                <?php else: ?>

                    <a href="login.php" class="btn-login">Login</a>
                    <a href="register.php" class="btn-register">Register</a>

                <?php endif; ?>
            </div>
        </div>
    </header>

    <script>
        // Simple JS to handle mobile menu toggle
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-container').classList.toggle('active');
        });
    </script>
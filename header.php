<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone | Modern Fitness Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        /* --- BRAND COLORS --- */
        :root {
            --primary-red: #e63946;
            --dark-bg: rgba(17, 24, 39, 0.85);
        }

        /* --- FROSTED GLASS HEADER --- */
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

            /* Change position: sticky to fixed or absolute to prevent pushing the hero down */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        /* LOGO */
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

        /* NAV CONTAINER (CLEANER WITHOUT SEARCH BAR) */
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

        /* AUTH BUTTONS */
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

        /* Sleek Button Sweep Animation */
        .btn-register {
            background: var(--primary-red);
            color: #fff;
            box-shadow: inset 0 0 0 0 #c1121f;
            transition: color 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
        }

        .btn-register:hover {
            box-shadow: inset 200px 0 0 0 #c1121f;
            color: #ffffff;
        }

        /* =========================================
           FLOATING ISLAND MOBILE MENU
           ========================================= */
        @media (max-width: 992px) {
            header {
                padding: 12px 5%;
                flex-direction: row;
                justify-content: flex-start;
                gap: 0;
            }

            header.menu-open .logo {
                display: none;
            }

            header.menu-open {
                justify-content: flex-start;
            }

            .menu-toggle {
                display: block;
                margin-right: 20px;
                z-index: 1001;
                width: 30px;
            }

            header .logo {
                margin-bottom: 0;
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

            nav a:hover {
                background: rgba(230, 57, 70, 0.1);
                color: var(--primary-red);
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                gap: 15px;
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px solid rgba(255, 255, 255, 0.05);
            }

            .btn-login,
            .btn-register {
                width: 100%;
                text-align: center;
                padding: 12px 0;
                font-size: 1.05rem;
            }
        }
    </style>
</head>

<body>

    <header id="main-header">
        <div class="menu-toggle" id="mobile-menu">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="logo">
            <h1><i class="fa-solid fa-dumbbell"></i>FitZone</h1>
        </div>

        <div class="nav-container" id="nav-container">
            <nav>
                <ul>
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#classes">Classes</a></li>
                    <li><a href="index.php#trainers">Trainers</a></li>
                    <li><a href="index.php#memberships">Pricing</a></li>
                    <li><a href="blog.php">Blog</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="login.php" class="btn-login">Login</a>
                <a href="register.php" class="btn-register">Register</a>
            </div>
        </div>
    </header>
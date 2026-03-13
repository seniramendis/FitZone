<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --fz-red: #e63946;
        --fz-dark: #111827;
    }

    body {
        background-color: #f8f9fa;
    }

    /* Page Header */
    .page-header {
        position: relative;
        width: 100%;
        height: 40vh;
        margin-top: 60px;
        background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1920&auto=format&fit=crop');
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
        background: rgba(17, 24, 39, 0.85);
    }

    .page-header-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 0 20px;
    }

    /* Contact Section */
    .contact-card {
        margin-top: -50px;
        margin-bottom: 80px;
        border: none;
        border-radius: 20px;
        background: #fff;
        z-index: 10;
        position: relative;
    }

    .contact-info-panel {
        background-color: var(--fz-dark);
        color: white;
        padding: 3rem;
        border-radius: 20px 0 0 20px;
        height: 100%;
    }

    .contact-icon-box {
        width: 50px;
        height: 50px;
        background: rgba(230, 57, 70, 0.1);
        color: var(--fz-red);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .form-control {
        padding: 1rem 1.2rem;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: var(--fz-red);
        box-shadow: 0 0 0 0.25rem rgba(230, 57, 70, 0.25);
        background-color: #fff;
    }

    .btn-submit {
        background-color: var(--fz-red);
        color: white;
        font-weight: 700;
        padding: 1rem 2.5rem;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        background-color: #c1121f;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(230, 57, 70, 0.2);
    }

    @media (max-width: 991px) {
        .contact-info-panel {
            border-radius: 20px 20px 0 0;
            padding: 2rem;
        }
    }
</style>

<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="page-header-content">
        <h1 class="fw-bold display-4">Get In <span style="color: var(--fz-red);">Touch</span></h1>
        <p class="lead">Submit a query or visit our Kurunegala branch today.</p>
    </div>
</section>

<div class="container">
    <div class="card contact-card shadow-lg">
        <div class="row g-0">

            <div class="col-lg-5 contact-info-panel">
                <h3 class="fw-bold mb-4">Contact Information</h3>
                <p class="text-secondary mb-5 text-light opacity-75">Have a question about our memberships, classes, or personal training? Drop us a message and our management staff will get back to you shortly.</p>

                <div class="d-flex align-items-center mb-4">
                    <div class="contact-icon-box">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Our Location</h6>
                        <p class="mb-0 text-light opacity-75">123 Colombo Road, Kurunegala, Sri Lanka</p>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4">
                    <div class="contact-icon-box">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Phone Number</h6>
                        <p class="mb-0 text-light opacity-75">+94 77 123 4567</p>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="contact-icon-box">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Email Address</h6>
                        <p class="mb-0 text-light opacity-75">inquiries@fitzone.lk</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 p-4 p-md-5">
                <h3 class="fw-bold mb-4">Send Us A Query</h3>
                <form action="process_query.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-secondary">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Joel De Silva" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-secondary">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Subject / Event</label>
                        <select class="form-select form-control" name="subject" required>
                            <option value="" disabled selected>Select an option...</option>
                            <option value="Membership Inquiry">Membership Inquiry</option>
                            <option value="Class Booking Issue">Class Booking Issue</option>
                            <option value="Personal Training Info">Personal Training Info</option>
                            <option value="Other">Other Event-Related Matters</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">Your Message</label>
                        <textarea class="form-control" name="message" rows="5" placeholder="How can we help you?" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-submit">Submit Query</button>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
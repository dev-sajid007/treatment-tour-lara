<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            animation: slideIn 0.8s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-verify {
            transition: all 0.3s ease-in-out;
        }

        .btn-verify:hover {
            background-color: #2563eb;
            color: white;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 30px;
        }
    </style>
</head>
<body>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" class="logout-btn">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold">
            Logout
        </button>
    </form>

    <!-- Main Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4 fs-5 fw-semibold">
                        Verify Your Email Address
                    </div>

                    <div class="card-body p-4">

                        <!-- Success message -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                             style="display: {{ session('resent') ? 'block' : 'none' }}">
                            A fresh verification link has been sent to your email address.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <p class="mb-3">
                            Before proceeding, please check your email for a verification link.
                        </p>

                        <p class="mb-4">
                            If you did not receive the email, you can request another below.
                        </p>

                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary w-100 btn-verify fw-semibold">
                                Request Another Verification Email
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS (for dismissable alerts) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



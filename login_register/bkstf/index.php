<?php 
session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>": '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="css/login.css">
        <style>
            /* Back Button Styles */
            .back-button {
                position: absolute;
                top: 20px;
                left: 20px;
                display: flex;
                align-items: center;
                padding: 8px 16px;
                background-color: #40e0d0;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .back-button:hover {
                background-color: #20b2aa;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            }

            .back-button:active {
                transform: translateY(0);
            }

            .back-button::before {
                content: "←";
                margin-right: 8px;
                font-size: 18px;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .back-button {
                    top: 15px;
                    left: 15px;
                    padding: 6px 12px;
                    font-size: 14px;
                }
            }

            @media (max-width: 480px) {
                .back-button {
                    top: 10px;
                    left: 10px;
                    padding: 5px 10px;
                    font-size: 12px;
                }
            }
        </style>
    </head>

    <body>
        <!-- Back Button -->
        <a href="../index.php" class="back-button">Back</a>

        <div class="container">
            <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
                <form action="login_register.php" method="post">
                    <h2>Login</h2>
                    <?= showError($errors['login']); ?>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login">Login</button>
                    <p>Don't Have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>
                </form>
            </div>

            <div class="form-box <?= isActiveForm('register', $activeForm); ?> " id="register-form">
                <form action="login_register.php" method="post">
                    <h2>Register</h2>
                    <?= showError($errors['register']); ?>
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="register">Register</button>
                    <p>Already Have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
                </form>
            </div>
        </div>

        <script src="script.js"></script>
    </body>
</html>
<?php
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt =$conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username,$password);

    if ($stmt->execute()) {
        header("Location: login.php?registered=1");
        exit;
    } else {
        $message = "Username already exists or invalid input.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Elementary Quiz</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@500;700&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 40px 15px;
            background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #a1c4fd, #c2e9fb);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .shape {
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            animation: float 8s ease-in-out infinite;
            z-index: 0;
        }
        .shape1 { width: 140px; height: 140px; top: 8%; left: 10%; animation-delay: 0s; }
        .shape2 { width: 190px; height: 190px; bottom: 10%; right: 8%; animation-delay: 2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(5px);
            text-align: center;
            animation: slideUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes slideUp {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        h2 {
            font-family: 'Fredoka One', cursive;
            color: #4a4e69;
            font-size: 32px;
            margin-top: 0;
            text-shadow: 2px 2px 0px #f2e9e4;
        }

        .input-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #4a4e69;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            font-family: 'Quicksand', sans-serif;
            box-sizing: border-box;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: #6c5ce7;
            box-shadow: 0 0 8px rgba(108, 92, 231, 0.3);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #00b894, #55efc4);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Fredoka One', cursive;
            box-shadow: 0 6px 15px rgba(0, 184, 148, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-top: 10px;
        }

        .btn:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 184, 148, 0.4);
        }

        .alert {
            padding: 12px;
            border-radius: 10px;
            background-color: #ffeaa7;
            color: #d63031;
            font-weight: bold;
            margin-bottom: 20px;
        }

        a {
            color: #6c5ce7;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="shape shape1"></div>
    <div class="shape shape2"></div>

    <div class="card">
        <h2>Join the Fun! ✏️</h2>
        <?php if ($message): ?>
            <div class="alert"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Choose a username" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create a password" required>
            </div>
            <button type="submit" class="btn">Register Now 🚀</button>
        </form>
        <p style="margin-top: 20px; color: #636e72;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
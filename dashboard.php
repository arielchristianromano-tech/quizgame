<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id =$_SESSION['user_id'];
$score_query =$conn->prepare("SELECT subject, score, total_questions, created_at FROM scores WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$score_query->bind_param("i", $user_id);$score_query->execute();
$scores =$score_query->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Elementary Quiz</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@500;700&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 30px 15px;
            background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #a1c4fd, #c2e9fb);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            box-sizing: border-box;
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
        .shape1 { width: 120px; height: 120px; top: 10%; left: 8%; animation-delay: 0s; }
        .shape2 { width: 180px; height: 180px; bottom: 12%; right: 10%; animation-delay: 2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 35px;
            max-width: 550px;
            margin: 0 auto;
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

        h3 {
            font-family: 'Fredoka One', cursive;
            color: #6c5ce7;
            margin-top: 25px;
        }

        .logout-btn {
            display: inline-block;
            padding: 8px 18px;
            background: #ff7675;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(255, 118, 117, 0.3);
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .logout-btn:hover {
            background: #d63031;
            transform: scale(1.05);
        }

        .btn-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 15px;
        }

        .btn-subject {
            padding: 16px;
            background: linear-gradient(45deg, #00cec9, #81ecec);
            color: #2d3436;
            text-decoration: none;
            border-radius: 14px;
            font-weight: bold;
            font-family: 'Fredoka One', cursive;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(0, 206, 201, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-subject:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 206, 201, 0.4);
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        th {
            background: #6c5ce7;
            color: white;
            padding: 12px;
            font-family: 'Fredoka One', cursive;
            font-weight: normal;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #f1f2f6;
            color: #2d3436;
            font-size: 15px;
        }

        tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="shape shape1"></div>
    <div class="shape shape2"></div>

    <div class="card">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! 🌟</h2>
        <a href="logout.php" class="logout-btn">Logout 🚪</a>

        <h3>Select a Subject</h3>
        <div class="btn-grid">
            <a href="quiz.php?subject=Math" class="btn-subject">🔢 Math</a>
            <a href="quiz.php?subject=Science" class="btn-subject">🧪 Science</a>
            <a href="quiz.php?subject=English" class="btn-subject">📚 English</a>
            <a href="quiz.php?subject=Social+Studies" class="btn-subject">🌍 Social Studies</a>
            <a href="quiz.php?subject=Filipino" class="btn-subject">🇵🇭 Filipino</a>
            <a href="quiz.php?subject=General+Knowledge" class="btn-subject">💡 General Knowledge</a>
        </div>

        <h3>Recent Quiz Results</h3>
        <table>
            <tr><th>Subject</th><th>Score</th><th>Date</th></tr>
            <?php if ($scores->num_rows > 0): ?>
                <?php while ($row =$scores->fetch_assoc()): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($row['subject']) ?></strong></td>
                        <td><?= $row['score'] ?> / <?=$row['total_questions'] ?></td>
                        <td><?= date('M d, H:i', strtotime($row['created_at'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="color: #b2bec3;">No quizzes taken yet. Pick a subject above!</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
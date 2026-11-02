<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$questions = [
    'Math' => [
        ['q' => 'What is 7 + 8?', 'options' => ['13', '14', '15', '16'], 'ans' => '15'],
        ['q' => 'What is 12 ÷ 3?', 'options' => ['3', '4', '5', '6'], 'ans' => '4'],
        ['q' => 'Which number is an even number?', 'options' => ['5', '9', '11', '14'], 'ans' => '14'],
        ['q' => 'What is 9 × 6?', 'options' => ['48', '54', '56', '63'], 'ans' => '54'],
        ['q' => 'What is the value of 5² (5 squared)?', 'options' => ['10', '20', '25', '50'], 'ans' => '25'],
        ['q' => 'What is 100 - 37?', 'options' => ['63', '67', '73', '53'], 'ans' => '63'],
        ['q' => 'How many sides does a hexagon have?', 'options' => ['5', '6', '7', '8'], 'ans' => '6'],
        ['q' => 'What is 1/2 + 1/4?', 'options' => ['2/4', '3/4', '1/6', '2/6'], 'ans' => '3/4'],
        ['q' => 'What is the perimeter of a square with a side length of 4 cm?', 'options' => ['8 cm', '12 cm', '16 cm', '20 cm'], 'ans' => '16 cm'],
        ['q' => 'What is the next number in the pattern: 2, 4, 8, 16, ___?', 'options' => ['20', '24', '32', '64'], 'ans' => '32']
    ],
    'Science' => [
        ['q' => 'What planet is known as the Red Planet?', 'options' => ['Earth', 'Mars', 'Jupiter', 'Venus'], 'ans' => 'Mars'],
        ['q' => 'What part of a plant absorbs water from the soil?', 'options' => ['Leaves', 'Stem', 'Roots', 'Flowers'], 'ans' => 'Roots'],
        ['q' => 'What state of matter is water vapor?', 'options' => ['Solid', 'Liquid', 'Gas', 'Plasma'], 'ans' => 'Gas'],
        ['q' => 'Which organ pumps blood throughout the human body?', 'options' => ['Lungs', 'Brain', 'Heart', 'Stomach'], 'ans' => 'Heart'],
        ['q' => 'What process do plants use to make food using sunlight?', 'options' => ['Respiration', 'Photosynthesis', 'Digestion', 'Evaporation'], 'ans' => 'Photosynthesis'],
        ['q' => 'Which animal group is warm-blooded and has feathers?', 'options' => ['Reptiles', 'Amphibians', 'Birds', 'Fish'], 'ans' => 'Birds'],
        ['q' => 'What gas do humans need to breathe in to survive?', 'options' => ['Carbon Dioxide', 'Oxygen', 'Nitrogen', 'Helium'], 'ans' => 'Oxygen'],
        ['q' => 'What is the center of our solar system?', 'options' => ['Earth', 'Moon', 'Sun', 'Jupiter'], 'ans' => 'Sun'],
        ['q' => 'Water freezes at what temperature in Celsius?', 'options' => ['0°C', '32°C', '100°C', '-10°C'], 'ans' => '0°C'],
        ['q' => 'Which force pulls objects down toward the center of the Earth?', 'options' => ['Friction', 'Magnetism', 'Gravity', 'Tension'], 'ans' => 'Gravity']
    ],
    'English' => [
        ['q' => 'Which word is a noun?', 'options' => ['Run', 'Happy', 'Dog', 'Quickly'], 'ans' => 'Dog'],
        ['q' => 'What is the opposite of "Hot"?', 'options' => ['Warm', 'Cold', 'Dry', 'Soft'], 'ans' => 'Cold'],
        ['q' => 'Find the correctly spelled word:', 'options' => ['Becaus', 'Bikause', 'Because', 'Becausse'], 'ans' => 'Because'],
        ['q' => 'Which sentence uses correct punctuation?', 'options' => ['where are you going.', 'Where are you going?', 'where are you going?', 'Where are you going.'], 'ans' => 'Where are you going?'],
        ['q' => 'What is a synonym for the word "Huge"?', 'options' => ['Small', 'Tiny', 'Large', 'Narrow'], 'ans' => 'Large'],
        ['q' => 'Which word is a verb in this sentence: "The cat slept quietly."?', 'options' => ['The', 'cat', 'slept', 'quietly'], 'ans' => 'slept'],
        ['q' => 'What is the plural form of "Child"?', 'options' => ['Childs', 'Children', 'Childrens', 'Childes'], 'ans' => 'Children'],
        ['q' => 'Which word is an adjective?', 'options' => ['Beautiful', 'Beauty', 'Beautify', 'Beautification'], 'ans' => 'Beautiful'],
        ['q' => 'What is the past tense of "Go"?', 'options' => ['Goed', 'Gone', 'Went', 'Going'], 'ans' => 'Went'],
        ['q' => 'Identify the pronoun: "She went to the market."', 'options' => ['She', 'went', 'market', 'the'], 'ans' => 'She']
    ],
    'Social Studies' => [
        ['q' => 'How many continents are there on Earth?', 'options' => ['5', '6', '7', '8'], 'ans' => '7'],
        ['q' => 'Which is the largest ocean in the world?', 'options' => ['Atlantic', 'Indian', 'Arctic', 'Pacific'], 'ans' => 'Pacific'],
        ['q' => 'What model shows a round, 3D representation of Earth?', 'options' => ['Map', 'Globe', 'Compass', 'Atlas'], 'ans' => 'Globe'],
        ['q' => 'What tool helps travelers identify direction (North, South, East, West)?', 'options' => ['Scale', 'Compass', 'Ruler', 'Thermometer'], 'ans' => 'Compass'],
        ['q' => 'What do we call a landform that rises high above surrounding land?', 'options' => ['Valley', 'Mountain', 'Plain', 'Island'], 'ans' => 'Mountain'],
        ['q' => 'What is the capital city of the Philippines?', 'options' => ['Cebu', 'Davao', 'Manila', 'Quezon City'], 'ans' => 'Manila'],
        ['q' => 'Which line divides the Earth into the Northern and Southern Hemispheres?', 'options' => ['Equator', 'Prime Meridian', 'Tropic of Cancer', 'Longitude'], 'ans' => 'Equator'],
        ['q' => 'What type of government is led by elected officials and a president?', 'options' => ['Monarchy', 'Republic', 'Dictatorship', 'Kingdom'], 'ans' => 'Republic'],
        ['q' => 'What do we call pieces of land completely surrounded by water?', 'options' => ['Peninsulas', 'Islands', 'Lakes', 'Rivers'], 'ans' => 'Islands'],
        ['q' => 'What primary resource do trees provide for humans?', 'options' => ['Plastic', 'Oxygen and Wood', 'Metal', 'Oil'], 'ans' => 'Oxygen and Wood']
    ],
    'Filipino' => [
        ['q' => 'Ano ang pambansang ibon ng Pilipinas?', 'options' => ['Maya', 'Agila ng Pilipinas', 'Pigeon', 'Parrot'], 'ans' => 'Agila ng Pilipinas'],
        ['q' => 'Ano ang kasalungat ng salitang "Mabilis"?', 'options' => ['Matulin', 'Mabagal', 'Malaki', 'Maliit'], 'ans' => 'Mabagal'],
        ['q' => 'Alin sa mga sumusunod ang pangngalan (Noun)?', 'options' => ['Lumakad', 'Maganda', 'Aso', 'Mabilis'], 'ans' => 'Aso'],
        ['q' => 'Ano ang kasingkahulugan ng "Pangit"?', 'options' => ['Maganda', 'Di-kaaya-aya', 'Mabait', 'Masaya'], 'ans' => 'Di-kaaya-aya'],
        ['q' => 'Sino ang pambansang bayani ng Pilipinas?', 'options' => ['Andres Bonifacio', 'Dr. Jose Rizal', 'Apolinario Mabini', 'Emilio Aguinaldo'], 'ans' => 'Dr. Jose Rizal'],
        ['q' => 'Ano ang maramihang anyo ng "Bata"?', 'options' => ['Kabataan', 'Mga bata', 'Bata-bata', 'Magbata'], 'ans' => 'Mga bata'],
        ['q' => 'Alin ang salitang kilos (Pandiwa / Verb)?', 'options' => ['Tumatakbo', 'Matangkad', 'Silya', 'Aklat'], 'ans' => 'Tumatakbo'],
        ['q' => 'Ilang titik mayroon ang makabagong Alpabetong Filipino?', 'options' => ['20', '26', '28', '30'], 'ans' => '28'],
        ['q' => 'Ano ang pambansang bulaklak ng Pilipinas?', 'options' => ['Sampaguita', 'Rosas', 'Orchid', 'Sunflower'], 'ans' => 'Sampaguita'],
        ['q' => 'Ano ang katumbas sa Filipino ng Ingles na salitang "Book"?', 'options' => ['Lapis', 'Aklat', 'Papel', 'Sulat'], 'ans' => 'Aklat']
    ],
    'General Knowledge' => [
        ['q' => 'How many hours are there in one full day?', 'options' => ['12', '24', '48', '60'], 'ans' => '24'],
        ['q' => 'How many primary colors are there?', 'options' => ['2', '3', '5', '7'], 'ans' => '3'],
        ['q' => 'Which animal is known as the "King of the Jungle"?', 'options' => ['Tiger', 'Elephant', 'Lion', 'Bear'], 'ans' => 'Lion'],
        ['q' => 'How many days are there in a standard calendar year?', 'options' => ['350', '360', '365', '366'], 'ans' => '365'],
        ['q' => 'What color do you get when you mix Red and Yellow?', 'options' => ['Green', 'Purple', 'Orange', 'Brown'], 'ans' => 'Orange'],
        ['q' => 'How many legs does a spider have?', 'options' => ['6', '8', '10', '12'], 'ans' => '8'],
        ['q' => 'Which shapes have three sides?', 'options' => ['Squares', 'Circles', 'Triangles', 'Rectangles'], 'ans' => 'Triangles'],
        ['q' => 'What is the largest land mammal?', 'options' => ['Rhino', 'Hippo', 'Giraffe', 'African Elephant'], 'ans' => 'African Elephant'],
        ['q' => 'Which sense organ do you use to hear sound?', 'options' => ['Eyes', 'Nose', 'Ears', 'Tongue'], 'ans' => 'Ears'],
        ['q' => 'In which direction does the sun rise?', 'options' => ['North', 'South', 'East', 'West'], 'ans' => 'East']
    ]
];

$subject = $_GET['subject'] ?? 'Math';
if (!array_key_exists($subject, $questions)) {
    $subject = 'Math';
}

$quiz_data = $questions[$subject];
$score = null;
$user_answers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    $total = count($quiz_data);

    foreach ($quiz_data as $index => $q) {
        $selected = $_POST['q_' . $index] ?? '';
        $user_answers[$index] = $selected;
        if ($selected === $q['ans']) {
            $score++;
        }
    }

    $stmt = $conn->prepare("INSERT INTO scores (user_id, subject, score, total_questions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isii", $_SESSION['user_id'], $subject, $score, $total);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($subject) ?> Quiz</title>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
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
        .shape3 { width: 90px; height: 90px; top: 65%; left: 5%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 35px;
            max-width: 680px;
            margin: 0 auto;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(5px);
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
            text-align: center;
            margin-top: 0;
            text-shadow: 2px 2px 0px #f2e9e4;
        }

        .question {
            margin-bottom: 22px;
            padding: 18px;
            background: #ffffff;
            border-radius: 14px;
            border-left: 6px solid #6c5ce7;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .question:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.15);
        }

        .question.wrong-q {
            border-left: 6px solid #ff7675;
            background: #fff5f5;
        }
        .question.correct-q {
            border-left: 6px solid #55efc4;
            background: #f0fff4;
        }

        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Fredoka One', cursive;
            box-shadow: 0 6px 15px rgba(108, 92, 231, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
        }
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.4);
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: #6c5ce7;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 16px;
            background: #f1f2f6;
            border-radius: 20px;
            transition: background 0.2s ease;
        }
        .back-btn:hover {
            background: #dfe4ea;
        }

        .opt-container {
            display: block;
            margin: 8px 0;
            padding: 10px 14px;
            border-radius: 10px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .opt-container:hover {
            background: #eef2ff;
            border-color: #a29bfe;
            transform: translateX(5px);
        }

        .opt-correct {
            background-color: #d4edda !important;
            color: #155724;
            font-weight: bold;
            border: 2px solid #c3e6cb !important;
            animation: pulseCorrect 1s ease;
        }
        .opt-wrong {
            background-color: #f8d7da !important;
            color: #721c24;
            text-decoration: line-through;
            border: 2px solid #f5c6cb !important;
        }

        @keyframes pulseCorrect {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .badge-correct {
            color: #00b894;
            font-weight: bold;
            float: right;
            font-family: 'Fredoka One', cursive;
        }
        .badge-wrong {
            color: #d63031;
            font-weight: bold;
            float: right;
            font-family: 'Fredoka One', cursive;
        }

        .score-banner {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, #a8ff78, #78ffd6);
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(120, 255, 214, 0.3);
            animation: bounceIn 0.8s ease;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>

    <div class="card">
        <a href="dashboard.php" class="back-btn">&larr; Back to Dashboard</a>
        <h2><?= htmlspecialchars($subject) ?> Quiz</h2>

        <?php if ($score !== null): ?>
            <div class="score-banner">
                <h3 style="margin: 0; color: #2d3436; font-family: 'Fredoka One', cursive; font-size: 26px;">Quiz Completed! 🎉</h3>
                <p style="font-size: 24px; margin: 10px 0 0 0; color: #2d3436;">Your Score: <strong><?= $score ?> / <?= count($quiz_data) ?></strong></p>
            </div>

            <script>
                confetti({ particleCount: 120, spread: 80, origin: { y: 0.6 } });
            </script>

            <h3 style="color: #4a4e69; font-family: 'Fredoka One', cursive;">Review Your Answers:</h3>

            <?php foreach ($quiz_data as $index => $q): 
                $user_ans = $user_answers[$index] ?? '';
                $is_correct = ($user_ans === $q['ans']);
            ?>
                <div class="question <?= $is_correct ? 'correct-q' : 'wrong-q' ?>">
                    <p style="font-size: 17px;">
                        <strong>Q<?= $index + 1 ?>: <?= htmlspecialchars($q['q']) ?></strong>
                        <?php if ($is_correct): ?>
                            <span class="badge-correct">&#10004; Correct</span>
                        <?php else: ?>
                            <span class="badge-wrong">&#10008; Wrong</span>
                        <?php endif; ?>
                    </p>

                    <?php foreach ($q['options'] as $opt): 
                        $class = '';
                        if ($opt === $q['ans']) {
                            $class = 'opt-correct';
                        } elseif ($opt === $user_ans && !$is_correct) {
                            $class = 'opt-wrong';
                        }
                    ?>
                        <div class="opt-container <?= $class ?>">
                            <?php if ($opt === $user_ans): ?>
                                <strong>&bull; Your Choice: </strong>
                            <?php endif; ?>
                            <?= htmlspecialchars($opt) ?>
                            <?php if ($opt === $q['ans']): ?>
                                <span>(Correct Answer)</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <div style="text-align: center; margin-top: 25px;">
                <a href="quiz.php?subject=<?= urlencode($subject) ?>" class="btn">Try Again 🔄</a>
            </div>

        <?php else: ?>
            <form method="POST">
                <?php foreach ($quiz_data as $index => $q): ?>
                    <div class="question">
                        <p style="font-size: 17px;"><strong>Q<?= $index + 1 ?>: <?= htmlspecialchars($q['q']) ?></strong></p>
                        <?php foreach ($q['options'] as $opt): ?>
                            <label class="opt-container">
                                <input type="radio" name="q_<?= $index ?>" value="<?= htmlspecialchars($opt) ?>" required>
                                <?= htmlspecialchars($opt) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <div style="text-align: center; margin-top: 20px;">
                    <button type="submit" class="btn">Submit Quiz 🚀</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
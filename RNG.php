<?php
declare(strict_types=1);

class RandomNumberGenerator {
    public static function generateNumber(int $min = 1, int $max = 100): int {
        return random_int($min, $max);
    }
}

if (isset($_POST['generate'])) {
    $min = isset($_POST['min']) ? (int)$_POST['min'] : 1;
    $max = isset($_POST['max']) ? (int)$_POST['max'] : 100;
    $result = RandomNumberGenerator::generateNumber($min, $max);
    echo json_encode(['number' => $result]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Number Generator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Random Number Generator</h1>
        <div class="input-group">
            <input type="number" id="min" placeholder="Min" value="1">
            <input type="number" id="max" placeholder="Max" value="100">
        </div>
        <button id="generateBtn">Generate Number</button>
        <div id="result" class="result"></div>
    </div>
    
    <script>
        document.getElementById('generateBtn').addEventListener('click', async () => {
            const min = document.getElementById('min').value;
            const max = document.getElementById('max').value;
            
            try {
                const response = await fetch('RNG.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `generate=1&min=${min}&max=${max}`
                });
                
                const data = await response.json();
                document.getElementById('result').textContent = data.number;
                document.getElementById('result').classList.add('pop');
                
                setTimeout(() => {
                    document.getElementById('result').classList.remove('pop');
                }, 300);
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
</body>
</html>

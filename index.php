<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Проверка простых чисел</title>
<style>
    .container {
        max-width: 600px;
        margin: 50px auto;
        text-align: center;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Проверка простых чисел</h2>
    <form method="post">
        <input type="text" name="numberInput" placeholder="Введите число от 0 до 1 000 000">
        <button type="submit" name="submit">Проверить</button>
    </form>
    <div id="result">
        <?php
        if (isset($_POST['submit'])) {
            $numberInput = isset($_POST['numberInput']) ? $_POST['numberInput'] : '';
            if (!is_numeric($numberInput) || $numberInput < 0 || $numberInput > 1000000) {
                echo 'Пожалуйста, введите число от 0 до 1 000 000.';
            } else {
                $number = (int)$numberInput;
                $isNumberPrime = isPrime($number);
                if ($isNumberPrime) {
                    echo "Число $number является простым.";
                } else {
                    $nearestPrimes = findNearestPrimes($number);
                    echo "Число $number не является простым.<br>";
                    echo "Ближайшие простые числа: " . ($nearestPrimes[0] ?? 'нет') . " (слева) и " . ($nearestPrimes[1] ?? 'нет') . " (справа).";
                }
            }
        }

        function isPrime($num) {
            if ($num <= 1) return false;
            if ($num <= 3) return true;
            if ($num % 2 === 0 || $num % 3 === 0) return false;
            for ($i = 5; $i * $i <= $num; $i += 6) {
                if ($num % $i === 0 || $num % ($i + 2) === 0) return false;
            }
            return true;
        }

        function findNearestPrimes($num) {
            $smallerPrime = null;
            $largerPrime = null;
            for ($i = $num - 1; $i > 1; $i--) {
                if (isPrime($i)) {
                    $smallerPrime = $i;
                    break;
                }
            }
            for ($i = $num + 1; $i <= 1000000; $i++) {
                if (isPrime($i)) {
                    $largerPrime = $i;
                    break;
                }
            }
            return [$smallerPrime, $largerPrime];
        }
        ?>
    </div>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="calculator.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Calculator</title>
</head>

<body>

    <div id="calculator">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="number" name="num01" placeholder="1st Number" required>
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">x</option>
                <option value="divide">/</option>
            </select>
            <input type="number" name="num02" placeholder="2nd Number" required>
            <button>Calculate</button>
        </form>
    </div>

    <?php
    if (($_SERVER["REQUEST_METHOD"] == "POST")) {
        // Grab data from inputs
        $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
        $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);

        // Error handlers
        $errors = false;

        if (empty($num01) || empty($num02) || empty($operator)) {
            echo "<p class='calc_error'>Fill in all the fields!</p>";
            $errors = true;
        }

        if (!is_numeric($num01) || !is_numeric($num02)) {
            echo "<p class='calc_error'>Only input numbers!</p>";
            $errors = true;
        }

        // Calculate the numbers if no errors
        if (!$errors) {
            $result = 0;

            switch ($operator) {
                case "add":
                    $result = $num01 + $num02;
                    break;
                case "subtract":
                    $result = $num01 - $num02;
                    break;
                case "multiply":
                    $result = $num01 * $num02;
                    break;
                case "divide":
                    $result = $num01 / $num02;
                    break;
                default:
                    echo "<p class='calc-error'>Something went wrong!</p>";
                    break;
            }

            echo "<p class='calc-result'>Result = " . $result . "</p>";
        }
    }
    ?>
</body>

</html>
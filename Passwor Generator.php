<?php

include ('config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Password Generator</h1>
        <h3 class="password-display" id = "passwordDisplay">Password</h3>
        <form id="passwordGeneratorForm" class="form">
            <label for="characterAmountNumber">Number Of Characters</label>
            <div class="character-amount-container">
            <input type="range" min="1" max="25" value ="10" id="characterAmountRange">
            <input class="number-input" type="number" min="1" max="25" value="10" id="characterAmountNumber"> 
            </div>

            <label for="includeUppercase">Include Uppercase</label>
            <input type="checkbox" id="includeUppercase">

            <label for="includeNumbers">Include Numbers</label>
            <input type="checkbox" id="includeNumbers">

            <label for="includeSymbols">Include Symbols</label>
            <input type="checkbox" id="includeSymbols">

            <button type="submit" class="btn">Generate Password</button>
        </form>
    </div>
</body>
</html>
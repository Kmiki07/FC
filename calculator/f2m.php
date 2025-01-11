<?php

// functions
function validate($get, &$data, &$errors)
{
    $data = $get;
    if (empty($data['fyrecoin'])) {
        $errors['fyrecoin'] = 'Nem adtál meg FyreCoin-t.';
    } else if (!is_numeric($data['fyrecoin'])) {
        $errors['fyrecoin'] = 'Nem számot adtál meg.';
    } else if ($data['fyrecoin'] <= 0) {
        $errors['fyrecoin'] = 'A szám nem lehet nulla vagy negatív.';
    }

    // if (!isset($data['huf']) || $data['huf'] === '') {
    //     $errors['huf'] = 'Nem adtál meg Forint-ot.';
    // } else {
    //     $data['huf'] = $data['huf'];
    // }

    return count($errors) === 0;
}

// main
$data = [];
$errors = [];
$m = 0;
if (count($_GET) > 0) {
    if (validate($_GET, $data, $errors)) {
        $m = round(790 / 950 * $data['fyrecoin']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FyreCoin Átváltó</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <form method="get">
        <div class="container-fluid calculator-div">
            <div class="row">
                <div class="col-12">
                    <h1>FyreCoin Átváltó</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="fyrecoin">FyreCoin</label><br>
                    <input type="number" name="fyrecoin" id="fyrecoin" placeholder="FyreCoin" <?= isset($_GET['fyrecoin']) ? 'value="' . $_GET['fyrecoin'] . '"' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="huf">Forint</label><br>
                    <input type="number" id="huf" placeholder="Forint" <?= !empty($m) ? 'value="' . $m . '"' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <button type="submit" class="primary-button">Átváltás</button>
                </div>
                <div class="col-3">
                    <button type="button" class="primary-button" onclick="window.location.href='m2f.php'">Csere</button>
                </div>
            </div>
            <?php if (count($errors) > 0): ?>
                <div class="row">
                    <?php foreach ($errors as $error): ?>
                        <div class="col-12 error">
                            <?= $error ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php
    header("Content-Type: text/html");

?>
<?php
echo <<<HEAD
<!DOCTYPE html>
<html lang="de">
<head>
    <style>
        table, th, td {
            border: 1px solid white;
        }
        body {
            background-image: url(Fire.png);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
    <meta charset="UTF-8" />
    <!-- für später: CSS include -->
    <!-- <link rel="stylesheet" href="XXX.css"/> -->
    <!-- für später: JavaScript include -->
    <!-- <script src="XXX.js"></script> -->
    <title>Der Testi Pizza Bestellservice</title>
</head>
HEAD;
echo <<<MAIN
<body>
    <h1 style="color: white">Testi Pizza Bestellservice</h1>
    <br>
    <h2 style="color: white">Bestellungen</h2>
    <br>
    <section>
        <h3 style="color: white">Speisekarte</h3>
        <div>
            <ul>
                <li style="color: white">Krasse Pizza<br/><span data-price-euro="5,50">5,50</span>€<br>
                    <img src="testi_pizza.png" alt="Krasse Pizza" width="100" height="100" >
                    <button>In den Warenkorb</button></li>
                <li style="color: white">Tee Pizza<br><span data-price-euro="6,50">6,50</span>€<br>
                    <img src="testi_pizza.png" alt="Tee Pizza" width="100" height="100" >
                    <button>In den Warenkorb</button></li>
                <li style="color: white">Coole Pizza<br><span>8,50</span>€<br>
                    <img src="testi_pizza.png" alt="Coole Pizza" width="100" height="100" >
                    <button>In den Warenkorb</button></li>
            </ul>
        </div>
    </section>
MAIN;
    ?>
    <?php
    echo <<<WARENKORB
    <section>
        
        <h3 style="color: white">Warenkorb</h3>
        <div>
            <select name="Warenkorb[]" size="5" multiple>
                <option selected> Krasse Pizza</option>
                <option> Tee Pizza</option>
            </select>           
            <p style="color: white">Gesamtpreis: 12,00€</p>
        </div>
        <button>Element löschen</button>
        <button>Warenkorb leeren</button>
        <br>
        <br>
        <form>
            <input type="text" name="adresse" value="" placeholder="Ihre Adresse" />
            <br>
            <input type="button" value="Bestellen">
        </form>
        <button>Verwerfen</button>
WARENKORB;
        ?>
    </section>
</body>
</html>
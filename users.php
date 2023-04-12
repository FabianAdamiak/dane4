<html>
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="styl4.css">
</head>
<body>
    <?php
    $con = new mysqli("localhost", "root", "", "dane4");
    ?>

    <div class="baner">
        <h3>Portal Społecznościowy - panel administratora</h3>
    </div>
    <div class="lewy">
        <h4>Użytkownicy</h4>
        <?php
        $sql = "SELECT `id`, `imie`, `nazwisko`, `rok_urodzenia`, `zdjecie` FROM `osoby` WHERE 1 LIMIT 30;";
        $res = $con->query($sql);
        while($r = $res->fetch_assoc()){
            $lat = date("Y") - $r["rok_urodzenia"];
            echo $r["id"].". ".$r["imie"]." ".$r["nazwisko"].", ".$lat."lat<br>";
        }
        ?>
        <a href="settings.html">Inne ustawienia</a>
    </div>
    <div class="prawy">
        <h4>Podaj id użytkownika</h4>
        <form action="./users.php" method="POST">
            <input type="number" name="id">
            <input type="submit" value="ZOBACZ">
        </form>
        <hr>
        <?php
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            $sql = "SELECT o.imie, o.nazwisko, o.rok_urodzenia, o.opis, o.zdjecie, h.nazwa FROM osoby as o JOIN hobby as h ON h.id = o.Hobby_id WHERE o.id =".$_POST["id"].";";
            $res = $con->query($sql);

            while($r = $res->fetch_assoc()){
                echo "<h2>".$_POST["id"].". ".$r["imie"]." ".$r["nazwisko"]."</h2>";
                echo "<img src='".$r["zdjecie"]."' alt='".$_POST["id"]."'>";
                echo "<p>Rok urodzenia: ".$r["rok_urodzenia"]."</p>";
                echo "<p>Opis: ".$r["opis"]."</p>";
                echo "<p>Hobby: ".$r["nazwa"]."</p>";
            }
        }
        ?>
    </div>
    <div class="stopka">
        Stronę wykonał: Fabian Adamiak
    </div>
    <?php
    $con->close();
    ?>
</body>
</html>
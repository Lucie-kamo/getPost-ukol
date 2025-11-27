<?php
$pole = [
    [
        'nazev' => 'film1',
        'autor' => 'blebleble',
        'rok' => 1910 ,
        'kategorie' => 'scifi'
    ],

    [
        'nazev' => 'film2',
        'autor' => 'bleee',
        'rok' => 1950 ,
        'kategorie' => 'komedie'
    ],

    [
        'nazev' => 'film3',
        'autor' => 'AAAAAA',
        'rok' => 2019 ,
        'kategorie' => 'blbost'
    ],

    [
        'nazev' => 'film4',
        'autor' => 'hahhah',
        'rok' => 1950 ,
        'kategorie' => 'scifi'
    ]
];
if(isset($_POST['formularPOST'])){
    if(isset($_POST['nazev'])&&isset($_POST['autor'])&&isset($_POST['rok'])&&isset($_POST['kategoriePridat'])){
        $pole[] = [
            'nazev' => $_POST['nazev'],
            'autor' => $_POST['autor'],
            'rok' => $_POST['rok'],
            'kategorie' => $_POST['kategoriePridat']
        ];
    }
    else {
      echo "Vyplnte všechny pole";
    }
}

if(isset(($_GET['nazev']), ($_GET['autor']), ($_GET['rok']), ($_GET['kategorie']))){
    $polozka[] = [
        'nazev' => $_GET['nazev'],
        'autor' => $_GET['autor'],
        'rok' => $_GET['rok'],
        'kategorie' => $_GET['kategorie']
    ];
}


if(isset($_GET['formular'])){
    if(isset($_GET['nazev'])||isset($_GET['autor'])||isset($_GET['rok'])||isset($_GET['kategorie'])||isset($_GET['zadej'])){
        $kategorie = $_GET['kategorie'];
        if($kategorie != '0'){
            function filterByCategory($var) {
                return $var['kategorie'] == $_GET['kategorie'];
            }
 
            $pole = array_filter($pole, "filterByCategory");

        }
    
    function filterByText($var){
        return str_contains($var['nazev'], $_GET['zadej']) ||
        str_contains($var['autor'], $_GET['zadej']) ||
        str_contains((string)$var['rok'], $_GET['zadej']) ||
        str_contains($var['kategorie'], $_GET['zadej']);
    }

    $pole = array_filter($pole, "filterByText");
    }
    
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>




    <style>
        /* ---CSS OD CHATGPT + TABULKA Z W3SCHOOLS--- bleebleblee priznavam se :(*/
        body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f0e6; /* jemné béžové pozadí */
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0;
        padding: 2rem 0;
    }

    /* Kontejner pro formuláře */
    .forms-container {
        display: flex;
        justify-content: center;
        gap: 2rem; /* mezera mezi formuláři */
        flex-wrap: wrap; /* aby na malých obrazovkách spadly pod sebe */
        width: 100%;
        max-width: 900px;
        margin-bottom: 2rem;
    }

    form {
        background-color: #fff;
        padding: 1.5rem;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        width: 30%;
        max-width: 400px;
    }

    form label {
        font-weight: bold;
        margin-bottom: 0.3rem;
        font-size: 0.9rem;
    }

    form input[type="text"],
    form input[type="number"],
    form select {
        padding: 8px 10px;
        margin-bottom: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 0.9rem;
    }

    input[type="submit"] {
        background-color: #c71585;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 6px;
        font-size: 1rem;
        cursor: pointer;
        transition: 0.2s;
    }

    input[type="submit"]:hover {
        background-color: #a50f6d;
    }

    /* Nadpisy formulářů */
    .form-title {
        text-align: center;
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #555;
    }

    /* Tabulka */
    table {
        border-collapse: collapse;
        width: 90%;
        max-width: 900px;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #c71585;
        color: white;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ffe0f0;
    }
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin:5%;
        }
        table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 50px;
        }
        
        td, th {
        border: 1px solid #ddd;
        padding: 8px;
        }
        
        tr:nth-child(even){background-color: #f2f2f2;}
        
        tr:hover {background-color: #ddd;}
        
        th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #c71585;
        color: white;
        }
    </style>
</head>
<body>
    <div class="forms-container">
    <form method="GET">
        <div class="form-title">Vyhledat položky</div>
        <label for="zadej">zadej</label>
        <input type="text" name="zadej" id="zadej" value="<?= isset($_GET['zadej']) ? htmlspecialchars($_GET['zadej']) : '' ?>">
        <label for="vyber">vyber</label>
        <select name="kategorie" id="kategorie">
            <option value="0">Vyberte kategorii</option>
            <option value="scifi" <?= (isset($_GET['kategorie']) && $_GET['kategorie'] == 'scifi') ? 'selected' : '' ?>>scifi</option>
            <option value="komedie" <?= (isset($_GET['kategorie']) && $_GET['kategorie'] == 'komedie') ? 'selected' : '' ?>>komedie</option>
            <option value="blbost" <?= (isset($_GET['kategorie']) && $_GET['kategorie'] == 'blbost') ? 'selected' : '' ?>>blbost</option>
        </select>
        
        <input type="submit" name="formular" value="vyhledat">
    </form>
    
    
    <form id="form" method="POST">
        <div class="form-title">Nová položka</div>
        <label for="nazev">název</label>
        <input type="text" name="nazev" id="nazev">
        <label for="autor">autor</label>
        <input type="text" name="autor" id="autor">
        <label for="rok">rok vydání</label>
        <input type="number" name="rok" id="rok">
        <label for="kategoriePridat">kategorie</label>
        <input type="text" name="kategoriePridat" id="kategoriePridat">
        <input type="submit" name="formularPOST" value="pridat">
    </form>
    </div>
   
    <table>
    <tr>
        <th>název</th>
        <th>autor</th>
        <th>rok</th>
        <th>kategorie</th>
    </tr>
        <?php foreach($pole as $polozka): ?>
            <tr>
            <td><?= htmlspecialchars($polozka['nazev'])?></td>
            <td><?= htmlspecialchars($polozka['autor']) ?></td>
            <td><?= htmlspecialchars($polozka['rok']) ?></td>
            <td><?= htmlspecialchars($polozka['kategorie']) ?></td>
            </tr>
        <?php endforeach; ?>
        
    </table>
    
    
</body>
</html>
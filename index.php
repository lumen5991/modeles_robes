<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css?v=0.1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css?v=0.1">
    <link rel="stylesheet" href="./assets/style.css">
    <title>modele_robe</title>
</head>

<body>
    <header class="shadow-sm p-1 mb-2 bg-body rounded">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#" style="color: brown;">Ro<span style="color: black">Be</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: brown;"><i class="mdi mdi-home-account"></i> <span style="color: black;">Home</span> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: brown;"><i class="mdi mdi-bell"></i><span style="color: black;">Notification</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: brown;"><i class="mdi mdi-cart-variant"></i>
                            <span>Panier</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="d-flex px-5">
        <div class="d-flex px-5">
            <div class="shadow-sm p-3 mb-5 bg-white rounded mx-2 col-md-6">
                <h4>Faites votre choix de <span style="color: brown;font-size: 36px;">Robe</span> par ici</h4>
                <form id="robeForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="py-3">
                        <label for="model">Modèle :</label>
                        <select name="model" id="model" style="width: 100%;">
                            <option value="Robe de soirée">Robe de soirée</option>
                            <option value="Robe simple">Robe simple</option>
                        </select>
                    </div>
                    <div class="py-3">
                        <label for="size">Taille :</label>
                        <select name="size" id="size" style="width: 100%;">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                        </select>
                    </div>
                    <div class="py-3">
                        <label for="color">Couleur :</label>
                        <select name="color" id="color" style="width: 100%;">
                            <option value="Bleu">Bleu</option>
                            <option value="Rouge">Rouge</option>
                            <option value="Vert">Vert</option>
                            <option value="Noir">Noir</option>
                        </select>
                    </div>
                    <input type="submit" id="showButton" class="btn" style="background-color: brown; color: #fff;">
                </form>
            </div>
            <div class="dressContainer" id="details col-md-6">
                <?php
                class Robes
                {
                    public $model;
                    public $color;
                    public $size;
                    public $image; 

                    function __construct($model, $color, $size, $image)
                    {
                        $this->model = $model;
                        $this->color = $color;
                        $this->size = $size;
                        $this->image = $image;
                    }

                    function getModel()
                    {
                        return $this->model;
                    }

                    function getColor()
                    {
                        return $this->color;
                    }

                    function getSize()
                    {
                        return $this->size;
                    }

                    function getImage()
                    {
                        return $this->image;
                    }
                }

                $robes = [
                    "modele_a" => new Robes("Robe de soirée", "Rouge", "S", "robe_soirée_rouge_s.jpg"),
                    "modele_b" => new Robes("Robe simple", "Vert", "M", "robe_simple_vert_m.jpg"),
                    "modele_c" => new Robes("Robe de soirée", "Bleu", "L", "robe_soirée_bleu_l.jpg")
                ];
                
                $userChoices = [];

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $selectedModel = $_POST["model"];
                    $selectedSize = $_POST["size"];
                    $selectedColor = $_POST["color"];

                    foreach ($robes as $robe) {
                        if ($robe->getModel() === $selectedModel && $robe->getSize() === $selectedSize && $robe->getColor() == $selectedColor) {
                            $userChoices = [$robe];
                        }
                    }

                    if (empty($userChoices)) {
                        echo "Ce modèle n'est pas disponible dans cette taille ou couleur.";
                    }
                }
                if (!empty($userChoices)) {
                    echo "<table class='table table-bordered'>
                            <thead class='thead-light'>
                                <tr>
                                    <th>Modèle</th>
                                    <th>Couleur</th>
                                    <th>Taille</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>";
                    foreach ($userChoices as $robe) {
                        echo "<tr>
                                <td>" . $robe->getModel() . "</td>
                                <td>" . $robe->getColor() . "</td>
                                <td>" . $robe->getSize() . "</td>
                                <td><img src='./assets/images/" . $robe->getImage() . "' alt=' ' style='max-width: 200px; height: 350px;'></td>
                            </tr>";
                    }
                    echo "</tbody></table>";
                }
                
                ?>
            </div>
        </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
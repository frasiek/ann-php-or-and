<html>
    <head>
        <meta charset="UTF-8">
        <title>Trening Sieci ANN</title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="main.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Informacje</a></li>
                    <li><a href="/networkAnd.php">And</a></li>
                    <li><a href="/networkOr.php">Or</a></li>
                    <li><a href="/networkXor.php">Xor</a></li>
                </ul>
            </div>
        </nav>
        <div class="container main">
            <div class="row">
                <div class="col-md-12 ">
                    <h1 class="text-center">
                        Projekt wytrenowania sieci neuronowej dla logicznych wyrażeń AND OR XOR
                    </h1>
                    <div class="text-justify">
                        <h2>
                            Jak zbudowany jest ten projekt?
                        </h2>
                        <p>
                            Projekt oparty jest o bibliotekę <a href="http://ann.thwien.de/">ANN</a>. Zakłada wytrenowanie 3 sieci neuronowych tak
                            aby były w stanie wykonywać operacje logiczne. Projekt ANN oddaje nam do dyspozycji klasy potrafiące stworzyć sieć 
                            neuronową - <a href="http://ann.thwien.de/index.php/Multilayer_perceptron">Wielowarstwowy Perceptron</a>
                        </p>
                        <p>
                            Aby stworzyć taką sieć w warunkach domowych wystarcza duet <span class="badge">Apache</span> + <span class="badge">PHP 5.4+</span>
                        </p>
                        <p>
                            Nie musimy martwić się o algorytmy uczenia ponieważ wszystko jest już za nas oprogramowane. Jedyne co należy zrobić to eksperymenty 
                            z ilościami warstw oraz ilością neuronów w warstwach ukrytych. Biblioteka ANN zajmuje się uczeniem za pomocą podanych do niej danych
                            uczących oraz przechowaniem wyniku nauki. Ponieważ PHP najczęściej jest opatrzone limitem czasu wykonania, biblioteka ANN pozwala uczyć
                            sieć na raty, za każdym razem przechowując wynik nauki na dysku.
                        </p>
                        <p class="well well-sm">
                            Całość kodu znajduje się na <a href="https://github.com/frasiek/ann-php-or-and">GitHub</a>
                        </p>
                        <hr/>
                        <h2>
                            Szczegóły techniczne
                        </h2>
                        <p>
                            Sieć tworzymy jako obiekt <code>$network = new Network($intNumberOfHiddenLayers, $intNumberOfNeuronsPerLayer, $intNumberOfOutputs)</code> przekazując
                        </p>
                        <ul>
                            <li>
                                <code>$intNumberOfHiddenLayers</code> - ilość warstw ukrytych
                            </li>
                            <li>
                                <code>$intNumberOfNeuronsPerLayer</code> - ilość neuronów w warstwie ukrytej
                            </li>
                            <li>
                                <code>$intNumberOfOutputs</code> - ilość wyjść z sieci
                            </li>
                        </ul>
                        <p>
                            Następnie możemy zapisywać wewnętrzny stan sieci do pliku <pre>$network->saveToFile($netPath);</pre>
                        </p>
                        <p>
                            Taką samą procedurę wykonujemy z wartościami uczącymi
                        <pre>
$values = new Values();
$values->train()
        ->input(0,0)->output(0)
        ->input(0,1)->output(1)
        ->input(1,0)->output(1)
        ->input(1,1)->output(0);

$values->saveToFile($valuePath);
</pre>
                        <p>
                            Gdy mamy przygotowaną sieć oraz zestaw uczący możemy przejść do uczenia sieci. Po pierwsze wczytujemy zestaw uczący do sieci: 
                            <code>$network->setValues($values);</code>. Aby trenować sieć wywołujemy metodę <code>$network->train()</code> aż do momentu
                            gdy zacznie zwracać wartość <code>false</code>.
                        </p>
                        <h2>
                            Wykorzystanie sieci do zwracania wyników
                        </h2>
                        <p>
                            Zwracanie wartości dla nowych zestawów danych wymaga stworzenie obiektu wartości, a następnie załadowania go do sieci 
                            oraz poproszenia o wynik.
                        </p>
                        <pre>
$objValues = new ANN\Values();
$objValues->input(0,0);
$network->setValues($objValues);
$result = $network->getOutputs();
</pre>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
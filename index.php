<?php



if(isset($_POST['submit'])){
    $radio = $_POST['radio'];


    $file = $radio.".txt";  // в переменной vote содержится число 2, 3, 4, или 5 Наши файлы имеют такие же названия, значит мы можем использовать эти значения длявыбора файла, сформировав таким образом его имя
    $f = fopen($file, "r"); // открываем файл для чтения
    $votes = fread($f, 100); // записываем в переменную $votes старое количество голосов
    fclose($f); // закрываем файл
    
    $votes++; // увеличиваем на единицу количество голосов

  
    $SharedFile = "1.txt";
    $SharedFileOpen = fopen($SharedFile, "r"); // открываем файл для чтения
    $SharedFileVotes = fread($SharedFileOpen, 100);
    fclose($SharedFileOpen);

    $SharedFileVotes++;

    $f = fopen($file, "w");  // открываем файл для записи
    fwrite($f, $votes);  // записываем в файл новое количество голосов
    fclose($f);  // закрываем файл

    $SharedFileOpen = fopen($SharedFile, "w");  // открываем файл для записи
    fwrite($SharedFileOpen, $SharedFileVotes);  // записываем в файл новое количество голосов
    fclose($SharedFileOpen);  // закрываем файл

    header('Location: index.php');
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<header>
    <div class="container">
        <form action="" method="post">
            <h2>Как вы оцениваете наш магазин</h2>

            <label class="inputForm">
                <input type="radio" name="radio" id="" value="5" checked> 
                <p>Отлично</p>
            </label>

            <label class="inputForm">
                <input type="radio" name="radio" id="" value="4"> 
                <p>Хорошо</p>
            </label>    
            
            <label class="inputForm">
                <input type="radio" name="radio" id="" value="3"> 
                <p>Удовлетворительно</p>
            </label>    
            
            <label class="inputForm">
                <input type="radio" name="radio" id="" value="2"> 
                <p>Плохо</p>
            </label>   
            
            <input type="submit" value="Проголосовать" class="submit" name="submit">
        </form>


        <div class="votingContent">
            <?php 
            
            $sharedFileFor = "1.txt";
            $sharedFileForResult = fopen($sharedFileFor, "r");  
            $sharedFileForResultFgets = fgets($sharedFileForResult); // 10 - 100%

            if($sharedFileForResultFgets == null){ ?>
                <div class="notVote">
                    <h3>Голосов нет</h3>
                </div>
            <?php }else{
                for ($i=2; $i < 6; $i++) {
                    $fileFor = $i.".txt";
                    $fileOpenResult = fopen($fileFor, "r");  
    
                   
    
                    while ($line = fgets($fileOpenResult)) {
                        $roundResult = round((100 * $line) / $sharedFileForResultFgets);
                        ?>
                        <div class="voting">
                            <div class="votingText">
                                <p><?php echo $i." - ".$line; ?> чел.</p>
                            </div>
    
                            <div class="votingDiagramContent">
                                <div class="totingDiagram" style="width: <?php echo $roundResult; ?>%;">
                                <p><?php echo $roundResult; ?>%</p>
                            </div>
                            </div>
                        </div>
                    <?php }
                } 
            }
            
           ?>
        </div>
    </div>
</header>
</body>
</html>
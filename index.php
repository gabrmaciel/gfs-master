<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <?php
        require 'funcoes.php';
        require 'simple_html_dom.php';

        $html = new simple_html_dom();
        
        $html->load_file('https://www.tropicaltidbits.com/analysis/models/');

        $scripts = $html->find('script'); //retorna todas as tags <script>

        foreach($scripts as $s) { //splita todos as tags <script> que retornaram e as transforma em objeto
            if(strpos($s->innertext, 'APP.runtime') !== false) { //seleciona a TAG que tem o texto 'APP.runtime' dentro
                $script = explode(";", $s); //quebra o texto dentro da tag separados por ';'
                $dataatual = $script[2];
                $dataatual = preg_replace("/[^0-9]/", "", $dataatual);
            }
        }

        $data = ConverteData($dataatual); //pega a string e splita o ano, mês, dia e hora
        list($ano, $mes, $dia, $hora) = $data; //

        $datasemhora = substr($dataatual, 0, 8);

        
        echo "ano: ".$ano." mes: ".$mes." dia: ".$dia." hora: ".$hora;
        ?>
        <br>
        <div class="row text-center" style='margin-top: 20px'>
            <div class="form-group">
                <label for="sel1">Select list:</label>
                <select class="form-control" id="sel1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <div class="float-left">
                <div class="float-left box panel panel-default">
                    <div class="box-box panel">
                        <div class="box-hour panel-heading">
                            <?php
                            echo $dia.'/'.$mes.'/'.$ano.' '.$hora.':00';
                            ?>
                        </div>
                        <br>
                        <div class="box-img">
                            <div class="box-img-img" style="background-image:url('https://www.tropicaltidbits.com/analysis/models/gfs/<?php echo $dataatual ?>/gfs_apcpn24_samer_1.png')"></div>
                        </div>
                        <br>
                    </div>
                </div>
                <?php
                    for ($i=0; $i < 3; $i++) {
                        while($hora > 0){
                            $hora = $hora - 6;
                            $hora = ConverteHora($hora);
                            echo '<div class="float-left box panel panel-default"><div class="box-box"><div class="box-hour panel-heading">'.$dia.'/'.$mes.'/'.$ano.' '.$hora.':00</div><br><div class="box-img"><div class="box-img-img" style="background-image:url(https://www.tropicaltidbits.com/analysis/models/gfs/'.$datasemhora.$hora.'/gfs_apcpn24_samer_1.png)"></div></div><br></div></div>';
                        }
                    }
                    ?>
                <br>
                <img src="barra.png" alt="" width="100%" style="margin-top:10px">
            </div>
            <div>
                <select name="" id="" style="display:none">
                    <option value=""><?php echo $ano."/".$mes."/".$dia." ".$hora.":00" ?></option>
                    <?php
                    $hora3 = $hora;
                    while($hora3 > 0){
                        $hora3 = $hora3 - 6;
                        echo '<option value="">'.$ano."/".$mes."/".$dia." ".$hora3.":00".'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <br><br>
    </div>
</body>
</html>
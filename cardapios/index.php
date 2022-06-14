<?php
    require dirname(__FILE__) . "/../classCardapio.php";

    $o = new Cardapio();
    $data = $o->findAll();

    function getTipo($id){
        
        switch($id){
            case '1': return 'CAFE';
            case '2': return 'ALMOCO';
            case '3': return 'JANTA';
        }
    }

    $resposta = [
        'ALMOCO' => [],
        'CAFE' => [],
        'JANTA' => []
    ];

    
    foreach($data as $d) {
        
        $resposta[getTipo($d['tipo'])][] = $d;
    }
    
    //var_dump($resposta);
    print json_encode($resposta);

?>
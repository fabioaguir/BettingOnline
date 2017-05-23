<?php
if(isset($_POST["acao"])){
    include_once "repositorio.php";
    switch($_POST['acao']){
        case "login":
            Repositorio::login($_POST);
            break;
        case "getAposta":
            Repositorio::getAposta($_POST);
            break;
        case "getCampeonatos":
            Repositorio::getCampeonatos($_POST);
            break;
        case "getFinanceiro":
            Repositorio::getFinanceiro($_POST);
            break;
        case "apostasVencedoras":
            apostasVencedoras($_POST);
            break;
        case "getRodape":
            Repositorio::getRodape($_POST);
            break;
        case "cancelarAposta":
            Repositorio::cancelarAposta($_POST);
            break;
        case "zerarFinanceiro":
            zerarFinanceiro($_POST);
            break;
        case "getPartidas":
            Repositorio::getPartidas($_POST);
            break;
        case "con":
            Repositorio::con();
            break;
        case "relPartidasDia":
            Repositorio::relPartidasDia($_POST);
            break;
		case "insApostas":
            Repositorio::insApostas($_POST);
            break;
        default:
            echo "Erro na passagem de url. Volte para a pagina inicial e tente novamente.";
            break;
    }   
}

    function login($post){
        if($post['login'] == "adm" && $post['senha'] == "1234"){
            echo "true";
        }else{
            echo "false";
        }
    }

    
    function getCampeonatos($post){
        echo "Campeonato Brasileiro Serie A;Campeonato Brasileiro Serie B;Campeonato Brasileiro Serie C;Campeonato Brasileiro Serie D;UEFA CHampions League;Nordestao;Campeonato Pernambucano;Copa do Brasil";
    }

    function getFinanceiro($post){
        echo "1000.00;100.00;500.00";
    }

    function apostasVencedoras($post){
        echo "Num. Aposta: 002;Santos 3 x 2 Palmeiras 17/07/2016;Valor a Ser Ganho: R$15.00;Vencedor: Casa";
    }

    function getPartidas($post){

        $str = '[{"equipes":"Santa Cruz x Sport", "data_partida":"10/10/2016 - 22:00", "cotacao_casa":"1.56", "cotacao_empate":"2.33", "cotacao_fora":"1.90", "cotacao_especial":"Placar Certo 4x4:100.00,Casa 1o Tempo:4.00,Fora Acima de 3:6.00"},{"equipes":"Central x Nautico", "data_partida":"10/10/2016 - 22:00", "cotacao_casa":"2.00", "cotacao_empate":"1.15", "cotacao_fora":"1.50", "cotacao_especial":"Placar Certo 4x4:100.00,Casa 1o Tempo:4.00,Fora Acima de 3:6.00"}]';
        echo $str;

    }

    function getAposta($post){
        if($post['numAposta'] == 109){
            $json_str =  '{"status":"false", 
                           "data_aposta":09/07/2016 11:00:00, 
                           "NSU": "1",
                           "num_partidas":"2",
                           "partidas":{
                                      {
                                      "equipes":"Santos x Palmeiras",
                                      "data_partida":"17/07/2016 17:00:00",
                                      "vencedor":"casa",
                                      "cotacao":"1.42",
                                      "valor_apostado":"10.00",
                                      "valor_ganhar":"14.20"
                                      },
                                      {
                                      "equipes":"PSG x Barcelona",
                                      "data_partida":"17/07/2016 22:00:00",
                                      "vencedor":"fora",
                                      "cotacao":"2.00",
                                      "valor_apostado":"20.00",
                                      "valor_ganhar":"40.00"
                                      },
                           "total_apostado":"30.00",
                           "total_ganhar":"54.20"}';

            echo  ($json_str);

        }else if ($post['numAposta'] == 2){

            echo "Data da Aposta: 09/07/2016 11:00:00; NSU: 002;#; Santos x Palmeiras; 17/07/2016 17:00:00; Vencedor: Casa; Cotacao: 1.50; Valor Apostado: R$ 10.00; Valor a Ser Ganho: R$15.00; Aposta Vencedora;#; PSG x Barcelona; 17/07/2016 22:00:00; Vencedor: Fora; Cotacao: 2.00; Valor Apostado: R$ 20.00; Valor a Ser Ganho: R$ 40.00;#;Total Apostado: R$ 30.00; Total a ser Ganho: R$ 55.00;";
            
        }else if ($post['numAposta'] == 3){
            
            echo "Data da Aposta: 08/07/2016 20:47:00; NSU: 003;#; Santa Cruz x Sport; 10/07/2016 17:00:00; Vencedor: Empate; Cotacao: 2.00; Valor Apostado: R$ 15.00; Valor a Ser Ganho: R$30.00;#; Brasil x Alemanha; 02/07/2016 22:00:00; Vencedor: Casa; Cotacao: 2.24; Valor Apostado: R$ 10.00; Valor a Ser Ganho: R$ 24.00;#;Total Apostado: R$ 25.00; Total a ser Ganho: R$ 54.00; INFO: Roberto";

        }else if ($post['numAposta'] == 4){
            
            echo "Data: 10/07/2016 10:00:00; Num. Aposta: 004; Santa Cruz x Sport;10/07/2016 17:00:00; Vencedor: Casa; Cotacao: 1.88; Valor Apostado: R$ 10.00; Valor a Ser Ganho: R$18.80; Brasil x Alemanha;02/07/2016 22:00:00; Vencedor: Fora; Cotacao: 1.24; Valor Apostado: R$ 100.00; Valor a Ser Ganho: R$ 124.00; Total Apostado: R$ 110.00; Total a ser Ganho: R$ 142.80; INFO: Joseph Climber";

        }else{
            echo "false";
        }
    }

    function cancelarAposta($post){
        echo "true";
    }

    function zerarFinanceiro($post){
        echo "true";
    }

    function con(){
pg_connect("host=54.218.74.108 port=5432 dbname=bettingonline user=postgres password=123456");
echo pg_dbname();
    }
?>									
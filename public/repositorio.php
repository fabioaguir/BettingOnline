<?php
class Repositorio{
	
	public function login($post){
		$conn = pg_connect("host=54.218.74.108 port=5432 dbname=bettingonline user=postgres password=123456") or die ("0");
		if (!$conn) {
			echo "Erro na conexão com o banco de dados.";
			exit;	
		}
		$usuario = $post['login'];
		$senha = $post['senha'];
		//$usuario = "adm";
		//$senha = "1234";
		
		$result = pg_query($conn, "select id, nome from pessoas where usuario = '$usuario' and senha = '$senha'");
		$row = pg_fetch_row($result);

		if(!$row[0]){
			echo "0";
		}else{
			echo $row[0] . ';' . $row[1];
		}
		pg_close($conn);
	}
	
	public function getPartidas($post){
		$conn = pg_connect("host=54.218.74.108 port=5432 dbname=bettingonline user=postgres password=123456") or die ("0");
		if (!$conn) {
			echo "Erro na conexão com o banco de dados.";
			exit;	
		}
				
		$data = $post['dataPartida'];
		$data = str_replace('/', '-', $data);
		$data = date('Y-m-d', strtotime($data));

		$campeonato = $post['campeonato'];		
		
		$json = "[";
		
		$result = pg_query($conn, "select id, hora, (select nome from times where times.id = partidas.time_casa_id), (select nome from times where times.id = partidas.time_fora_id) from partidas where data = '$data' and campeonato_id = (select id from campeonatos where nome = '$campeonato')");
		
		while ( $row = pg_fetch_row($result)) {
			$json = $json.'{"equipes":"'.$row[2].' x '.$row[3].'", "data_partida":"'.$post['dataPartida'].' - '.substr($row[1], 0, -3).'",';
			
			$cotacoes_especiais = '"cotacao_especial":"';
			
			$result2 = pg_query($conn, "select (select nome from modalidades where cotacoes.modalidade_id = modalidades.id), valor from cotacoes where partida_id = $row[0]");	
			
			while ( $row2 = pg_fetch_row($result2)) {
			
				if($row2[0] == 'Casa' || $row2[0] == 'Empate' || $row2[0] == 'Fora'){
					$json = $json . '"' . $row2[0] . '":"' . $row2[1] . '",';
				}else{
					$cotacoes_especiais = $cotacoes_especiais . $row2[0] . ':' . $row2[1] . ',';
				}
			}

			if(strlen($cotacoes_especiais)> 20){
				$json = $json . substr($cotacoes_especiais, 0, -1) . '"},';				
			}else{
				$json = substr($json, 0, -1) . '}]' ;			
			}			
		}
		echo substr($json, 0, -1) . ']';
		pg_close($conn);
	}
	
	function getAposta($post){
		$conn = pg_connect("host=54.218.74.108 port=5432 dbname=bettingonline user=postgres password=123456") or die ("0");
		if (!$conn) {
			echo "Erro na conexão com o banco de dados.";
			exit;	
		}
		
		$tipo_aposta = 1;

		$numAposta = $post['numAposta'];
		
		$query = "select tipo_aposta_id from vendas where id = $numAposta";
	
		$result = pg_query($conn, $query);
		
		while ($row = pg_fetch_row($result)) {
			$tipo_aposta = $row[0];
		}
		
		$query = 'select';
		$query = $query . '(select data from vendas where vendas.id = venda_id),';
		$query = $query . '(select hora from partidas where partidas.id = partida_id),';
		$query = $query . "(select ((select nome from times where times.id = time_casa_id) || ' x '";
		$query = $query . '|| (select nome from times where times.id = time_fora_id)) as equipes from partidas where partidas.id = partida_id),';
		$query = $query . '(select valor as cotacao from cotacoes where cotacoes.id = cotacao_id),';
		$query = $query . '(select (select nome from modalidades where modalidades.id = cotacoes.modalidade_id) as Aposta from cotacoes where cotacoes.id = cotacao_id),';
		$query = $query . '(select (select nome from campeonatos where campeonatos.id = partidas.campeonato_id) as Campeonato from partidas where partidas.id = partida_id),';
		$query = $query . 'valor as valor_apostado, ';
		$query = $query . '(select obs from vendas where vendas.id = venda_id),';
		$query = $query . '(select status_v_id from vendas where vendas.id = venda_id), (select valor_total from vendas where vendas.id = venda_id) from ';
		$query = $query . 'apostas where venda_id =';
		$query = $query . $numAposta;
				
		$result = pg_query($conn, $query);
	
		if($tipo_aposta == 1){
			$json = '';
		}else{
			$json = 'APOSTA CASADINHA;--------------------------------;';
		}
		$total = 0;
		$premio = 0;
		$info = '';
		
		while ($row = pg_fetch_row($result)) {
			
			if($row[8] == 2){
				$json = $json . 'APOSTA CANCELADA;--------------------------------;';
			}
			
			$data = date('d-m-Y', strtotime($row[0]));
			$data = str_replace('-', '/', $data);
				
			if($tipo_aposta == 1){
				$json = $json . '' . $row[5] . ';' .  $row[2] . ';' . $data .' - ' .substr($row[1], 0, -3).  ';' . $row[4] .  ';R$ ' . $row[6] .  ' x ' . $row[3] . ' = R$ '. number_format($row[3] * $row[6], 2, '.', '').';#;';
				$total = $total + $row[6];
			}else{
				$json = $json . '' . $row[5] . ';' .  $row[2] . ';' . $data .' - ' .substr($row[1], 0, -3).  ';' . $row[4] .  '; x ' . $row[3] .';#;';
				$total = $row[6];
			}
				
			$premio = $premio + $row[3] * $row[6];
			$info = $row[7];
		}
	
		if($total == 0){
			echo "false";
		}else{
			echo $json . 'INFO: ' . $info . ';Total Apostado:  R$' . number_format($total, 2, '.', '') . ';Premio Total:  R$' . number_format($premio, 2, '.', '');
		}
		pg_close($conn);		
	}
	
    function cancelarAposta($post){
		$conn = pg_connect("host=54.218.74.108 port=5432 dbname=bettingonline user=postgres password=123456") or die ("0");
		
		$numAposta = $post['numAposta'];
		$query = "select status_v_id, current_timestamp::timestamp,  created_at from vendas where id = $numAposta";
		$result = pg_query($conn, $query);
		$return = 'Aposta não encontrada.';
	
		while ($row = pg_fetch_row($result)) {
			$now = new DateTime($row[1]);
			$date = new DateTime($row[2]);
			$diff = $now->diff($date);
			
			$dias = $diff->format('%d');
			$horas = $diff->format('%h');
			
			if($horas >= 1 || $dias > 0){
				$return = 'Não é possível cancelar uma aposta depois de 1 hora da realização.';
			}else{
				if($row[0] == 1){
					$result = pg_query($conn, "update vendas set status_v_id = 2 where id = $numAposta");
					$return = 'Aposta cancelada com sucesso.';
				}else{
					$return = 'A aposta já está cancelada.';
				}
			}
			echo $return;
		}
		pg_close($conn);
    }
	
	function getFinanceiro($post){
		$conn = pg_connect("host=54.218.74.108 port=5432 dbname=bettingonline user=postgres password=123456") or die ("0");
		
		$numVendedor = $post['numVendedor'];
		
		$query = "select sum(valor_total), (select limite_vendas from conf_vendas where vendedor_id = $numVendedor) ";
		
		$query = $query . "from vendas where conf_venda_id = (select id from conf_vendas where vendedor_id = $numVendedor) ";
		
		$result = pg_query($conn, $query);
	
		$ret = "0;0";
	
		while ($row = pg_fetch_row($result)) {
			$ret = $row[0] . ";" . $row[1];
		}
	
		echo $ret;
	}
	
	function insApostas($post){
		$conn = pg_connect("host=54.218.74.108 port=5432 dbname=bettingonline user=postgres password=123456") or die ("0");
		
		$jsonArray = json_decode($post['json']);
		$tipo_aposta = $post['tipo_aposta'];
		
		if($post['obs'] != '' && $post['obs'] != ' '){
			$obs = $post['obs'];
		}else{
			$obs = '-';
		}
		
		$now = date("Y-m-d H:i:s");
		$valor_total = $post['totAp'];
		$valor_retorno = $post['premio'];
		$query = "SELECT NEXTVAL('vendas_id_seq')";
		
		$vendedor_id = $post['vendedor_id'];
		
		$result = pg_query($conn, $query);
		
		while ($row = pg_fetch_row($result)) {
			$vendas_id = $row[0];
		}
		
		$query = "INSERT INTO vendas(id, data, obs, valor_total, retorno, status_v_id, premiacao_id, tipo_aposta_id, conf_venda_id, created_at, updated_at)";
		$query = $query . "VALUES ($vendas_id, '$now', '$obs', $valor_total, $valor_retorno, 1, 2, $tipo_aposta, (select id from conf_vendas where vendedor_id = $vendedor_id), '$now', '$now')";
			
		pg_query($conn, $query);
			
		for ($i = 0; $i < count($jsonArray); $i++) {
			$json = $jsonArray[$i];
					
			$equipes = explode( " x ",$json->{'partida'});
			$data = str_replace('/', '-', $json->{'data'});
			$data = date('Y-m-d', strtotime($data));
			$modalidade = $json->{'cotacao'};
			$valor_apostado = $json ->{'valor_apostado'};
			$valor_cotacao = $json ->{'valor_cotacao'};
			
			//$valor_total = $valor_total + $valor_apostado;
			//$valor_retorno = $valor_retorno + ($valor_apostado + $valor_cotacao);
			
			$query = "select id from partidas where time_casa_id = (select id from times where nome = '$equipes[0]') and ";
			$query = $query . "time_fora_id = (select id from times where nome = '$equipes[1]') and ";
			$query = $query . "data = '$data'";
			
			$result = pg_query($conn, $query);
			while ($row = pg_fetch_row($result)) {
				$partida_id = $row[0];
			}			
			
			$query = "select id from cotacoes where modalidade_id = (select id from modalidades where nome = '$modalidade') and partida_id = $partida_id";
			$query = $query . "";
			
			$result = pg_query($conn, $query);
			while ($row = pg_fetch_row($result)) {
				$cotacao_id = $row[0];
			}
			
			$query = "SELECT NEXTVAL('apostas_id_seq')";
		
			$result = pg_query($conn, $query);
			
			while ($row = pg_fetch_row($result)) {
				$apostas_id = $row[0];
			}
			
			if($tipo_aposta == 2){
				$valor_apostado = $valor_total;
			}
			
			$query = "INSERT INTO apostas(id, venda_id, partida_id, cotacao_id, premiada, valor, created_at, updated_at)";
			$query = $query . "VALUES ($apostas_id, $vendas_id, $partida_id, $cotacao_id, 2, $valor_apostado, '$now', '$now')";	
			
			pg_query($conn, $query);
		}
		
		pg_close($conn);
		
		echo $vendas_id;	
	}
}
?>	
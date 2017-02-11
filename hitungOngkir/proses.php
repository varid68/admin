<?php
require_once('idmore.php');
$IdmoreRO = new IdmoreRO();

if(isset($_GET['act'])):
	switch ($_GET['act']) {
		case 'tampilprovinsi':
		$province = $IdmoreRO->tampilProvinsi();
		echo $province;
		break;

		case 'tampilkabupaten':
		$idprovince = $_GET['provinsi'];
		$city = $IdmoreRO->tampilKabupaten($idprovince);
		echo $city;
		break;

		case 'cost':
		$asal = $_GET['asal'];
		$tujuan = $_GET['tujuan'];
		$berat = $_GET['berat'];
		$kurir = $_GET['kurir'];
		$cost = $IdmoreRO->hitungOngkir($asal,$tujuan,$berat,$kurir);
		
		//parse json
		$costarray = json_decode($cost);
		$results = $costarray->rajaongkir->results;
		$no = 0;
		if(!empty($results)):
			foreach($results as $r):
				foreach($r->costs as $rc):
					foreach($rc->cost as $rcc):
						$no++;
						echo "<tr><td>$no</td><td>$r->code</td><td>$rc->service</td><td>$rc->description</td><td>$rcc->etd</td><td>".number_format($rcc->value)."</td></tr>";
					endforeach;
				endforeach;
			endforeach;
		endif;
		//end of parse json
		break;

		default:
		echo 'aksi tidak tersedia';
		break;
	}
endif;

?>
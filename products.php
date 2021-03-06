<?php
	
	if($_GET['page']){
		$page = $_GET['page'];		
	}else{
		$page = 1;
	}
	$perPage = 10;

	$data = file_get_contents('products.json');

	$data = json_decode($data, true);
	$products = $data['products'];

	$total = count($products);

	$start = ($page - 1) * $perPage;
	$end = $start + $perPage;
	if(count($products) < $end){
		$end = count($products);
	}

	$output = [];

	for ($i=$start; $i < $end; $i++) { 
		array_push($output, $products[$i]);
	}
	$output = json_encode($output);

	$titles = [];

	for ($i=0; $i < ($total - 1); $i++) { 
		array_push($titles, $products[$i]['name']);
	}
	$titles = json_encode($titles);

	print_r('{"total": ['.$total.'], "per_page": ['.$perPage.'], "page": ['.$page.'], "products":'.$output.', "search":'.$titles.'}');

?>
<?php
function magentoIntegration() {
include_once('magentoIntegration.php');

$transName = 'magento-products';
$magTrans = get_transient($transName);
$cacheTime = 360; // Time in minutes between updates.

$magento = new MagentoIntegration();
$productObject = array();

if( false === $magTrans ){
	$products = json_decode($magento->getAllProducts());
	if(!empty($products) && $products != '' && !is_null($products)){
		foreach($products->items as $product) {
			$array = array();
			$array = array(
				'name' => $product->name,
				'price' => $product->price
			);
			foreach($product->custom_attributes as $attribute ){
				if($attribute->attribute_code == "url_key")
					$array = array_merge($array,array('url_key' => $attribute->value));
				if($attribute->attribute_code == "thumbnail")
					$array = array_merge($array,array('thumbnail' => 'https://{URL_OF_MAGENTO}/pub/media/catalog/product' . $attribute->value));
			}
			array_push($productObject, $array);
		}
	}
	set_transient($transName, $productObject, 60 * $cacheTime);
	$magTrans = $productObject;
}
$response .= '<div class="magento-carousel owl-carousel owl-theme">';
if(!empty($magTrans) && !is_null($magTrans))
{
	foreach($magTrans as $mage)
		$response .= '<div class="item text-center pb-2">
			<img src='.$mage['thumbnail'].'>
			<h3>'.$mage['name'].'</h3>
			<p class="price">$'.$mage['price'].'</p>
			<a href="https://{URL_OF_MAGENTO}/'.$mage['url_key'].'" class="btn btn-danger">Quick Shop</a>
			<a href="https://{URL_OF_MAGENTO}/'.$mage['url_key'].'" class="btn btn-secondary">Details</a>
			</div>'; 
}
$response .= '</div><a href="https://{URL_OF_MAGENTO}/shop" class="view-more">View More</a>';
return $response;
//print_r(json_encode($productObject));
}

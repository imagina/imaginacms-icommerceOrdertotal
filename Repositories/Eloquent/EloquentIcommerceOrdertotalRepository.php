<?php

namespace Modules\Icommerceordertotal\Repositories\Eloquent;

use Modules\Icommerceordertotal\Repositories\IcommerceOrdertotalRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentIcommerceOrdertotalRepository extends EloquentBaseRepository implements IcommerceOrdertotalRepository
{

    function calculate($parameters, $conf)
    {

        //\Log::info("Icommerceordertotal | Calculate");

        $orderTotal = $parameters['products']['total'];
        $orderValuesRanges = $conf->orderTotalRanges;

        //Check Products
        $items = json_decode($parameters["products"]["items"]);

        //Validation Products | onlyFullProductsValue
        $oneFullPrice = $this->checkOneProductoWithoutDiscount($items);

        $shippingValue = 0;
        //Check each range
        foreach ($orderValuesRanges as $key => $range) {

            //\Log::info("Range: " . json_encode($range));

            //Case - Between - Desde xxx Hasta xxx
            if (isset($range->from) && isset($range->to)) {
                if ($orderTotal >= $range->from && $orderTotal <= $range->to) {
                    $shippingValue = $range->value;
                    break;
                }
            } else {
                //Case - From - Mayores a
                if (isset($range->from) && $orderTotal > $range->from) {
                    //\Log::info("Range: Aplica From");
                    $shippingValue = $range->value;
                    if (isset($range->onlyFullProductsValue) && $oneFullPrice) {
                        $shippingValue = $range->onlyFullProductsValue;
                    }
                    break;
                } else {
                    //Case - to - Menores a 
                    if (isset($range->to) && $orderTotal < $range->to) {
                        //\Log::info("Range: Aplica To");
                        $shippingValue = $range->value;
                        if (isset($range->onlyFullProductsValue) && $oneFullPrice) {
                            $shippingValue = $range->onlyFullProductsValue;
                        }
                        break;
                    }
                }
            }
        }

        //============= Standart Response
        $response["status"] = "success";
        $response["items"] = null;

        //============= Final Price
        $response["price"] = $shippingValue;
        $response["priceshow"] = true;

        return $response;
    }

    function checkOneProductoWithoutDiscount($items)
    {

        //Get all products information
        $productIds = [];
        foreach ($items as $item) {
            $productIds[] = $item->product_id;
        }
        $products = \Modules\Icommerce\Entities\Product::whereIn('id', $productIds)->get();

        //validation discount product
        foreach ($products as $key => $product) {
            $discount =  $product->discount;
            if (is_null($discount))
                return true; //Not discount for this cart
        }


        return false;
    }
}

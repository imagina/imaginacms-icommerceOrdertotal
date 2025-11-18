# imaginacms-icommerceordertotal (ShippingMethod)

## Install
```bash
composer require imagina/icommerceordertotal-module=v10.x-dev
```

## Enable the module
```bash
php artisan module:enable Icommerceordertotal
```

## Seeder
```bash
php artisan module:seed Icommerceordertotal
```

## Configuration Iadmin Example:

```bash
//Case - From - Mayores a
{
  "to": 300000,
  "value": 15000
},
//Case - to - Menores a 
{
  "from": 300000,
  "value": 15000,
  "onlyFullProductsValue": 0 
},
```

"onlyFullProductsValue" => 'Si en los productos que estan en el carrito existe al menos uno sin descuento, se aplica el valor de "onlyFullProductsValue" como el valor de envio

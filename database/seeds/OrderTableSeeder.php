<?php

use CodeDelivery\Models\Order;
use CodeDelivery\Models\Product;
use CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function($o) {
            for ($i = 0; $i <= 2; $i++) {
                $product = Product::find(rand(1,5));

                $o->items()->save(factory(OrderItem::class)->make([
                    'product_id' => $product->id,
                    'qtd' => rand(1,3),
                    'price' => $product->price
                ]));
            }

            $o->total = $o->items->sum('totals') + $o->shipping;

            $o->save();
        });
    }
}
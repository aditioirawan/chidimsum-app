<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        Product::truncate();
        $products = [
            ['name' => 'Siomay Ayam', 'price' => 15000, 'image' => 'siomay.jpg', 'description' => 'Siomay ayam lembut dengan topping wortel.'],
            ['name' => 'Hakau Udang', 'price' => 18000, 'image' => 'hakau.jpg', 'description' => 'Kulit transparan dengan isian udang utuh.'],
            ['name' => 'Lumpia Kulit Tahu', 'price' => 16000, 'image' => 'lumpia.jpg', 'description' => 'Lumpia goreng renyah isi ayam dan udang.'],
            ['name' => 'Bakpao Telur Asin', 'price' => 14000, 'image' => 'bakpao.jpg', 'description' => 'Bakpao lembut dengan isian telur asin lumer.'],
            ['name' => 'Dimsum Mentai', 'price' => 20000, 'image' => 'mentai.jpg', 'description' => 'Siomay ayam dengan saus mentai bakar.'],
            ['name' => 'Ceker Pedas', 'price' => 17000, 'image' => 'ceker.jpg', 'description' => 'Ceker ayam bumbu merah pedas manis.'],
            ['name' => 'Xiao Long Bao', 'price' => 19000, 'image' => 'xiaolongbao.jpg', 'description' => 'Pangsit kuah kaldu di dalam kulit tipis.'],
            ['name' => 'Nori Chicken', 'price' => 16000, 'image' => 'nori.jpg', 'description' => 'Dimsum ayam balut rumput laut gurih.'],
            ['name' => 'Es Teh Manis', 'price' => 5000, 'image' => 'esteh.jpg', 'description' => 'Teh manis dingin segar.'],
            ['name' => 'Air Mineral', 'price' => 4000, 'image' => 'air.jpg', 'description' => 'Air mineral botol 600ml.']
        ];
        foreach ($products as $p) { Product::create($p); }
    }
}
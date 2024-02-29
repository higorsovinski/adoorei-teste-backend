<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Galaxy S22', 'features' => 'Tela Super AMOLED, câmera de 108MP, 8GB de RAM'],
            ['name' => 'iPhone 15', 'features' => 'Chip A16 Bionic, Face ID avançado, iOS 17'],
            ['name' => 'Pixel 7', 'features' => 'Câmera traseira de 50MP, Google Tensor SoC, Android 14'],
            ['name' => 'OnePlus 10', 'features' => 'Tela de 120Hz, carregamento rápido de 120W, 12GB de RAM'],
            ['name' => 'Xperia XZ4', 'features' => 'Câmera Motion Eye de 64MP, tela 4K HDR, resistente à água'],
            ['name' => 'Redmi Note 11', 'features' => 'Bateria de 5000mAh, processador MediaTek Dimensity 900'],
            ['name' => 'Nokia X100', 'features' => 'Android One, atualizações de segurança garantidas'],
            ['name' => 'Moto G9 Plus', 'features' => 'Tela Max Vision de 6.8", bateria de longa duração'],
            ['name' => 'Huawei P50', 'features' => 'Câmera principal de 200MP, processador Kirin 9000'],
            ['name' => 'Oppo Find X4', 'features' => 'Câmera telescópica, carregamento sem fio rápido'],
            ['name' => 'LG V80', 'features' => 'Segunda tela giratória, áudio Quad DAC 3D'],
            ['name' => 'Realme GT 3', 'features' => 'Snapdragon 8 Gen 2, tela AMOLED de 120Hz'],
            ['name' => 'Asus Zenfone 9', 'features' => 'Flip camera, Snapdragon 888, tela OLED'],
            ['name' => 'Blackberry Key4', 'features' => 'Teclado físico, foco na segurança e produtividade'],
            ['name' => 'Xiaomi Mi Mix 5', 'features' => 'Design sem bordas, câmera sob o display'],
            ['name' => 'Google Nexus 8', 'features' => 'Android puro, atualizações rápidas e garantidas'],
            ['name' => 'Vivo X80', 'features' => 'Câmera periscópio, carregamento rápido de 120W'],
            ['name' => 'Lenovo Legion Phone 3', 'features' => 'Chipset Snapdragon 895, sistema de resfriamento ativo'],
            ['name' => 'Sony Xperia 1 III', 'features' => 'Tela 4K OLED, câmera de foco automático real-time'],
            ['name' => 'Samsung Galaxy Z Flip 4', 'features' => 'Design dobrável, tela AMOLED flexível'],
        ];

        foreach ($products as $row) {
            Product::create([
                'name' => $row['name'],
                'price' => rand(2000, 10000),
                'description' => $row['features'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

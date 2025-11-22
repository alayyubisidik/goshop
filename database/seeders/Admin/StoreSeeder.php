<?php

namespace Database\Seeders\Admin;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $stores = [
            [
                'seller_id' => 2,
                'logo' => '/defaults/logo.png',
                'banner' => '/defaults/banner.png',
                'name' => 'Tech Haven',
                'phone' => '081234567890',
                'email' => 'contact@techhaven.com',
                'short_description' => 'Tech Haven is your ultimate destination for the newest gadgets, innovative electronics, and high-performance devices — all in one place.',
                'long_description' => 'Tech Haven is a trusted modern electronics store dedicated to providing cutting-edge technology at affordable prices. From premium laptops, flagship smartphones, to essential accessories, every product is carefully selected for quality and performance. We aim to make technology more accessible and enjoyable for everyone through exceptional service, fast delivery, and customer-first policies.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'seller_id' => 3,
                'logo' => '/defaults/logo.png',
                'banner' => '/defaults/banner.png',
                'name' => 'Gadget World',
                'phone' => '089876543210',
                'email' => 'info@gadgetworld.com',
                'short_description' => 'Discover endless innovation at Gadget World — where technology meets lifestyle and quality meets affordability.',
                'long_description' => 'Gadget World is the perfect destination for anyone passionate about technology and modern living. We offer a wide range of gadgets, from smart home devices and gaming accessories to wearables and smartphones. Our team continuously curates the latest innovations from top global brands, ensuring that our customers always experience the future of tech today. Shop with confidence and enjoy exceptional after-sales support from our dedicated team.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'seller_id' => 4,
                'logo' => '/defaults/logo.png',
                'banner' => '/defaults/banner.png',
                'name' => 'Smart Living Hub',
                'phone' => '082233445566',
                'email' => 'hello@smartlivinghub.com',
                'short_description' => 'Smart Living Hub brings comfort, convenience, and innovation to your home through the latest smart technology.',
                'long_description' => 'At Smart Living Hub, we focus on transforming everyday homes into smart, efficient spaces. Our catalog includes top-rated smart speakers, lighting systems, home security solutions, and IoT-based appliances. We partner with leading global brands to ensure every customer gets products that blend seamlessly with their lifestyle. Experience a new level of living powered by innovation and simplicity.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'seller_id' => 5,
                'logo' => '/defaults/logo.png',
                'banner' => '/defaults/banner.png',
                'name' => 'Elite Electronics',
                'phone' => '085112233445',
                'email' => 'support@eliteelectronics.com',
                'short_description' => 'Elite Electronics — home of premium gadgets and exclusive high-performance tech for professionals.',
                'long_description' => 'Elite Electronics offers a curated collection of premium devices designed for performance and luxury. Whether you need a workstation-grade laptop, studio-quality headphones, or 4K displays, our store delivers excellence in every detail. We pride ourselves on offering personalized service, fast shipping, and a strong warranty program to ensure customer satisfaction.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'seller_id' => 6,
                'logo' => '/defaults/logo.png',
                'banner' => '/defaults/banner.png',
                'name' => 'NextGen Tech Store',
                'phone' => '087755533311',
                'email' => 'sales@nextgentech.com',
                'short_description' => 'NextGen Tech Store is where futuristic technology meets everyday convenience.',
                'long_description' => 'NextGen Tech Store focuses on next-generation gadgets that redefine the digital experience. From AI-powered devices, robotics, and wearables to electric mobility solutions, we bring the future closer to you. Our goal is to empower innovation and provide customers with products that enhance productivity, creativity, and entertainment. Join us and be part of the next tech evolution.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];


        DB::table('stores')->insert($stores);
    }
}

<?php

use App\Models\Product;
use App\Models\ProductLevel;

$levels = ['Beginner', 'Intermediate', 'Advanced'];
$products = Product::all();

foreach($products as $p) {
    $lv = $levels[array_rand($levels)];
    $p->skill_level = $lv;
    $p->skill_level_jp = ($lv == 'Beginner') ? '初級' : (($lv == 'Intermediate') ? '中級' : '上級');
    
    if($lv == 'Beginner') $pts = rand(500, 1000);
    elseif($lv == 'Intermediate') $pts = rand(1100, 2500);
    else $pts = rand(2600, 5000);
    
    $p->price_in_points = $pts;
    $p->save();

    // Create a level entry in product_levels
    ProductLevel::updateOrCreate(
        ['course_id' => $p->id, 'skill_level' => $lv],
        [
            'skill_level_jp' => $p->skill_level_jp,
            'purpose' => 'Master the core concepts of ' . $p->title,
            'purpose_jp' => $p->title . 'の核心的な概念をマスターする',
            'learn_info' => 'Hands-on projects and theoretical foundations.',
            'outcome' => 'Professional certification and job-ready skills.',
            'price' => $p->price,
            'price_jp' => $p->price_jp,
            'price_hk' => $p->price_hk
        ]
    );
}

echo "Updated " . count($products) . " products with random levels and points.\n";

<?php

use App\Models\Product;
use App\Models\ProductLevel;

$levels_config = [
    ['name' => 'Beginner', 'jp' => '初級', 'mult' => 1],
    ['name' => 'Intermediate', 'jp' => '中級', 'mult' => 2.5],
    ['name' => 'Advanced', 'jp' => '上級', 'mult' => 5],
    ['name' => 'Expert', 'jp' => 'エキスパート', 'mult' => 10]
];

$products = Product::all();

// Clear existing levels first to avoid duplicates or mess
ProductLevel::truncate();

foreach($products as $p) {
    foreach($levels_config as $config) {
        $base_pts = $p->price_in_points ?: 1000;
        $final_pts = round($base_pts * $config['mult']);

        ProductLevel::create([
            'course_id' => $p->id,
            'skill_level' => $config['name'],
            'skill_level_jp' => $config['jp'],
            'purpose' => 'Master the ' . $config['name'] . ' level core concepts of ' . $p->title,
            'purpose_jp' => $p->title . 'の' . $config['jp'] . 'レベルの核心的な概念をマスターする',
            'learn_info' => 'Comprehensive modules. Hands-on exercises. Real-world applications.',
            'outcome' => 'Certification of ' . $config['name'] . ' Proficiency.',
            'price' => round($p->price * $config['mult'], 2),
            'price_jp' => round($p->price_jp * $config['mult']),
            'price_hk' => round($p->price_hk * $config['mult'], 2),
            'price_in_points' => $final_pts // Assuming we add this column or use it
        ]);
    }
}

echo "Populated 4 levels for " . count($products) . " products.\n";

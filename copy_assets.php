<?php
$srcDir = 'C:/Users/User/.gemini/antigravity-ide/brain/1f23c66f-701e-46e5-861d-b98ece8a06ba';
$destDir = __DIR__ . '/uploads';

if (!is_dir($destDir)) {
    mkdir($destDir, 0777, true);
}

$patterns = [
    'hero_banner.jpg' => 'hero_spiritual_banner_*.jpg',
    'cat_rudraksha.jpg' => 'cat_rudraksha_*.jpg',
    'rudraksha_1mukhi.jpg' => 'cat_rudraksha_*.jpg',
    'cat_gemstones.jpg' => 'cat_gemstones_*.jpg',
    'pukhraj_stone.jpg' => 'cat_gemstones_*.jpg',
    'panna_emerald.jpg' => 'cat_gemstones_*.jpg',
    'neelam_sapphire.jpg' => 'cat_gemstones_*.jpg',
    'cat_malas.jpg' => 'cat_malas_*.jpg',
    'tulsi_mala.jpg' => 'cat_malas_*.jpg',
    'sphatik_mala.jpg' => 'cat_malas_*.jpg',
    'cat_shankh.jpg' => 'cat_shankh_*.jpg',
    'shankh_original.jpg' => 'cat_shankh_*.jpg',
    'cat_yantras.jpg' => 'cat_yantras_*.jpg',
    'shree_yantra.jpg' => 'cat_yantras_*.jpg',
    'cat_navratna.jpg' => 'cat_navratna_*.jpg',
    'navratna_ring.jpg' => 'cat_navratna_*.jpg',
];

foreach ($patterns as $destName => $pattern) {
    $matches = glob($srcDir . '/' . $pattern);
    if (!empty($matches)) {
        copy($matches[0], $destDir . '/' . $destName);
        echo "Copied {$destName} (" . filesize($matches[0]) . " bytes)\n";
    } else {
        echo "Warning: No match for {$pattern}\n";
    }
}
echo "Asset copy completed.\n";

<?php
$files = [
    'd:/Server/www/projects/familytree/ui/themes/default/css/style.css',
    'd:/Server/www/projects/familytree/ui/themes/default/css/mobile.css'
];

foreach ($files as $file) {
    $css = file_get_contents($file);
    
    // Replace dark grays and blacks
    $css = preg_replace('/color:\s*#000000\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#000\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#111111\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#111\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#222222\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#222\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#333333\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#333\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#444444\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#444\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#555555\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#555\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#666666\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#666\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*#6a6a6a\b/i', 'color: var(--text-main)', $css);
    $css = preg_replace('/color:\s*black\b/i', 'color: var(--text-main)', $css);
    
    // Replace medium grays
    $css = preg_replace('/color:\s*#777777\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#777\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#888888\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#888\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#999999\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#999\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#aaaaaa\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#aaa\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#bbbbbb\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*#bbb\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*gray\b/i', 'color: var(--text-muted)', $css);
    $css = preg_replace('/color:\s*grey\b/i', 'color: var(--text-muted)', $css);
    
    // Replace legacy blues (links)
    $css = preg_replace('/color:\s*#1a7ab0\b/i', 'color: var(--primary-accent)', $css);
    $css = preg_replace('/color:\s*#3e8ec1\b/i', 'color: var(--primary-accent)', $css);
    $css = preg_replace('/color:\s*#195e86\b/i', 'color: var(--primary-accent)', $css);
    
    // Replace reds
    $css = preg_replace('/color:\s*#ff0000\b/i', 'color: var(--danger-color, #ef4444)', $css);
    $css = preg_replace('/color:\s*#f00\b/i', 'color: var(--danger-color, #ef4444)', $css);
    $css = preg_replace('/color:\s*#ff3300\b/i', 'color: var(--danger-color, #ef4444)', $css);
    $css = preg_replace('/color:\s*#f30\b/i', 'color: var(--danger-color, #ef4444)', $css);
    $css = preg_replace('/color:\s*red\b/i', 'color: var(--danger-color, #ef4444)', $css);
    
    file_put_contents($file, $css);
    echo "Processed $file\n";
}
?>

<?php
/**
 * Core Autoloader Class.
 * Responsible for loading classes dynamically based on namespaces.
 */

namespace App\Core;

class Autoloader
{
    /**
     * Register the autoloader.
     *
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register(function ($class) {
            $root = dirname(__DIR__, 2); // Go up to project root
            
            // Map namespaces to directory paths
            $map = [
                'App\\' => $root . '/app/',
                'Config\\' => $root . '/config/'
            ];

            foreach ($map as $prefix => $baseDir) {
                if (strpos($class, $prefix) === 0) {
                    $relativeClass = substr($class, strlen($prefix));
                    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
                    
                    if (file_exists($file)) {
                        require $file;
                        return;
                    }
                }
            }
        });
    }
}
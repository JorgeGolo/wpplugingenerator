<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plugin; // añadimos esta línea

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plugin = new Plugin();
        $plugin->name = 'Plugin de Ejemplo';
        $plugin->description = 'Descripción del plugin';
        $plugin->slug = 'plugin-de-ejemplo';

        $plugin->save();

        $plugin = new Plugin();
        $plugin->name = 'Plugin de Ejemplo 2';
        $plugin->description = 'Descripción del plugin';
        $plugin->slug = 'plugin-de-ejemplo-2';

        $plugin->save();

        $plugin = new Plugin();
        $plugin->name = 'Plugin de Ejemplo 3';
        $plugin->description = 'Descripción del plugin';
        $plugin->slug = 'plugin-de-ejemplo-3';

        $plugin->save();
    }
}

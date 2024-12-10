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

        $plugin->save();

        $plugin = new Plugin();
        $plugin->name = 'Plugin de Ejemplo';
        $plugin->description = 'Descripción del plugin';

        $plugin->save();

        $plugin = new Plugin();
        $plugin->name = 'Plugin de Ejemplo';
        $plugin->description = 'Descripción del plugin';

        $plugin->save();
    }
}

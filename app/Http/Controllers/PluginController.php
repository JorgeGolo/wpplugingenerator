<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlugin;
use Illuminate\Support\Facades\File; // Para manejar el sistema de archivos
use Illuminate\Support\Facades\Storage;

class PluginController extends Controller
{
    public function index(){

        // return "Bienvenido a la página de plugins";
        // return view("plugins.index");

        // counsulta a la base de datos mediante el modelo
        $plugins = Plugin::all();

        // devolver la vista con la variable consultada,
        // uso de "compact" para nombrar la variable
        return view("plugins.index", compact("plugins"));

    }

    public function create(){

        return view("plugins.create");

    }

    //public function show($plugin){
    // cambiamos la función anterior para usar find con id

   /*
    public function show($id){
        //return "Url con la variable $curso";
        
        // definición de la variable
        //return view("plugins.show", ['plugin' => $plugin]);

        // Cuando tenemos intención de pasarle una variable a la vista que coincide con el nombre
        //return view("plugins.show", compact("plugin"));

        // cambiamos la función anterior para usar find con id
        $plugin = Plugin::find($id);

        return view("plugins.show", compact("plugin"));

    }
    */

    // cambio en el tupo de variable
    // ya no necesitamos el find
    public function show(Plugin $plugin){
 
        return view("plugins.show", compact("plugin"));

    }


    public function store(StorePlugin $request){
        //return $request->all()
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);

        $plugin = new Plugin();

        /* First asignation */ 
        /*
        $plugin->name= $request->name;
        $plugin->description= $request->description;
        */

        /* Second asignation */ 

        /*
        $plugin = Plugin::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        */

        /* Third asignation */
        /* fillable or guarded field required */

        //$plugin = Plugin::create($request->all());


        // Usando fillable y el mutator del slug
        $plugin = Plugin::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $request->name, // El mutator generará el slug automáticamente
        ]);

        /* saving */
        $plugin->save();
        $this->generate($plugin);
        // no es necesario pasar la id, Laravel va a usarla de forma inteligente
        //return redirect()->route('plugins.show',$plugin);



        return redirect()->route('plugins.index');
    }

    /*
    public function edit($id) {
       $plugin = Plugin::find($id);
       return view("plugins.edit", compact("plugin"));
    } 
    */


    public function edit(Plugin $plugin) {

       return view("plugins.edit", compact("plugin"));

    }

    public function update(Request $request, Plugin $plugin)
{
    // Guardar los valores actuales antes de actualizar
    $oldSlug = $plugin->slug;

    // Actualizar los datos del plugin
    $plugin->name = $request->name;
    $plugin->description = $request->description;
    $plugin->slug = $request->name; // Actualiza el slug basado en el nuevo nombre
    $plugin->save();

    // Actualizar los archivos y carpetas
    $basePath = public_path('generated');
    $oldPluginPath = $basePath . '/' . $oldSlug;
    $newPluginPath = $basePath . '/' . $plugin->slug;

    // Si el slug cambió, renombrar la carpeta
    if ($oldSlug !== $plugin->slug && File::exists($oldPluginPath)) {
        File::move($oldPluginPath, $newPluginPath);
    }

    // Actualizar el contenido de los archivos
    $readmePath = $newPluginPath . '/readme.txt';
    $phpFilePath = $newPluginPath . '/' . $plugin->slug . '.php';

    if (File::exists($readmePath)) {
        $readmeContent = <<<EOT
        === {$plugin->name} ===
        Contributors: jorgegl
        Tags: 
        Requires at least: 4.7
        Tested up to: 6.7
        Stable tag: 1.0
        License: GPLv2 or later
        License URI: https://www.gnu.org/licenses/gpl-2.0.html

        {$plugin->description}
        EOT;
        File::put($readmePath, $readmeContent);
    }

    if (File::exists($phpFilePath)) {
        $phpFileContent = <<<PHP
        <?php
        // Archivo generado automáticamente para el plugin "{$plugin->name}"
        echo "Este es el archivo del plugin {$plugin->name}";
        PHP;
        File::put($phpFilePath, $phpFileContent);
    }

    return redirect()->route('plugins.index')->with('success', 'Plugin y archivos actualizados correctamente.');
}

    
    public function destroy(Plugin $plugin)
    {
        // Define la ruta base de la carpeta generada del plugin
        $pluginPath = public_path('generated/' . $plugin->slug);

        // Verifica si la carpeta existe y elimínala
        if (File::exists($pluginPath)) {
            File::deleteDirectory($pluginPath); // Elimina la carpeta y todos sus archivos
        }

        // Elimina el registro del plugin en la base de datos
        $plugin->delete();

        // Redirige al usuario con un mensaje de éxito
        return redirect()->route('plugins.index')->with('success', 'El plugin y su carpeta han sido eliminados correctamente.');
    }

    public function generate(Plugin $plugin)
    {
        // Define el directorio donde se creará la carpeta
        $basePath = public_path('generated'); // Cambiado a public_path para apuntar a la carpeta correcta
    
        // Asegúrate de que la carpeta base exista
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true); // Crea la carpeta con permisos recursivos
        }
    
        // Crea una carpeta con el slug del plugin
        $pluginPath = $basePath . '/' . $plugin->slug;
    
        if (File::exists($pluginPath)) {
            return redirect()->route('plugins.index')->with('error', 'La carpeta ya existe.');
        }

   
        File::makeDirectory($pluginPath, 0755, true);

        // Crea una carpeta languages
        $languagesPath = $pluginPath . '/languages';
        if (!File::exists($languagesPath)) {
            File::makeDirectory($languagesPath, 0755, true); // Crea la carpeta con permisos recursivos
        }

        // Crea una carpeta assets
        $assetsPath = $pluginPath . '/assets';
        if (!File::exists($assetsPath)) {
            File::makeDirectory($assetsPath, 0755, true); // Crea la carpeta con permisos recursivos
        }

        // Crea una carpeta js
        $jsPath = $assetsPath . '/js';
        if (!File::exists($jsPath)) {
            File::makeDirectory($jsPath, 0755, true); // Crea la carpeta con permisos recursivos
        }

        // Crea una carpeta css
        $cssPath = $assetsPath . '/css';
        if (!File::exists($cssPath)) {
            File::makeDirectory($cssPath, 0755, true); // Crea la carpeta con permisos recursivos
        }

        // Crear archivo JS en la carpeta 'js'
        $jsFileContent = <<<JS
        // Archivo JavaScript generado automáticamente para el plugin "{$plugin->name}"
        console.log('Script cargado para el plugin {$plugin->name}');
        JS;

        File::put($jsPath . '/script.js', $jsFileContent);

        // Crear archivo CSS en la carpeta 'css'
        $cssFileContent = <<<CSS
        /* Archivo CSS generado automáticamente para el plugin "{$plugin->name}" */
        body {
            font-family: Arial, sans-serif;
        }
        CSS;

        File::put($cssPath . '/style.css', $cssFileContent);

        // Crear el archivo readme.txt con contenido
        $readmeContent = <<<EOT
        === {$plugin->name} ===
        Contributors: jorgegl
        Tags: 
        Requires at least: 4.7
        Tested up to: 6.7
        Stable tag: 1.0
        License: GPLv2 or later
        License URI: https://www.gnu.org/licenses/gpl-2.0.html

        {$plugin->description}

        EOT;

        File::put($pluginPath . '/readme.txt', $readmeContent);

        // Crear el archivo PHP con el nombre del slug
        $phpFileContent = <<<PHP
        <?php
        /*
        Plugin Name: {$plugin->name}
        Description: {$plugin->description}
        Version: 1.0
        Author: JorgeGL
        Author URI: https://mittsforcode.es
        Text Domain: {$plugin->slug}
        Domain Path: /languages
        License: GPL2
        License URI: https://www.gnu.org/licenses/gpl-2.0.html
        */

        // Enlace directo a los ajustes
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), '{$plugin->slug}_add_settings_link' );

        function {$plugin->slug}_add_settings_link( \$links ) {
            \$settings_link = '<a href="options-general.php?page={$plugin->slug}-settings">' . esc_html__( 'Settings', '{$plugin->name}' ) . '</a>';
            array_unshift( \$links, \$settings_link );
            return \$links;
        }

        // carga de archivos de traducción
        add_action( 'plugins_loaded', '{$plugin->slug}_load_textdomain' );
        function pluginname_load_textdomain() {
            load_plugin_textdomain( '{$plugin->slug}', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        // Añadir un menú en el panel de administración
        add_action( 'admin_menu', '{$plugin->slug}_add_admin_menu' );
        function {$plugin->slug}_add_admin_menu() {
            add_options_page(
                __( 'Plugin Settings', '{$plugin->slug}' ), // Título de la página
                __( 'Plugin Name', '{$plugin->slug}' ),    // Nombre del menú
                'manage_options',                     // Permiso necesario
                '{$plugin->slug}-settings',                // Slug único
                '{$plugin->slug}_settings_page'            // Función para mostrar la página
            );
        }

        // Página de ajustes del plugin
        function {$plugin->slug}_settings_page() {
            ?>
            <div class="wrap">
                <h1><?php esc_html_e( 'Plugin Settings', '{$plugin->slug}' ); ?></h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields( '{$plugin->slug}_settings_group' );
                    do_settings_sections( '{$plugin->slug}-settings' );
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        // Carga de archivos JS y CSS
        add_action( 'admin_enqueue_scripts', '{$plugin->slug}_enqueue_admin_scripts' );
        function {$plugin->slug}_enqueue_admin_scripts( \$hook ) {
            if ( \$hook !== 'settings_page_{$plugin->slug}-settings' ) {
                return;
            }
            wp_enqueue_script( '{$plugin->slug}-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_style( '{$plugin->slug}-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), '1.0' );
        }

        PHP;

        File::put($pluginPath . '/' . $plugin->slug . '.php', $phpFileContent);

        //return redirect()->route('plugins.index')->with('success', 'Carpeta y archivo README generados correctamente.');
        
    }
    
}
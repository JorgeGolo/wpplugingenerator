<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlugin;

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

        $plugin->name= $request->name;
        $plugin->description= $request->description;

        $plugin->save();
        
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

    public function update(Request $request, Plugin $plugin) {
        // return $plugin;
        // return $request->all();



        $plugin->name= $request->name;
        $plugin->description= $request->description;

        $plugin->save();

        //return redirect()->route('plugins.show',$plugin->id);
        //return redirect()->route('plugins.show',$plugin);

        return redirect()->route('plugins.index');
    }
    

}
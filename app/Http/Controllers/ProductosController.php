<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "Estas en el inicio";
        $productos=Producto::all();
        return view("productos.index", compact("productos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("productos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*       //
        $this->validate($request,['seccion'=>'required']);
        //return view("productos.insert");
        $producto=new Producto;
        $producto->nombre_articulo=$request->nombre_articulo;
        $producto->seccion=$request->seccion;
        $producto->precio=$request->precio;
        $producto->fecha=$request->fecha;
        $producto->pais_origen=$request->pais_origen;
        $producto->ruta=$request->imagen;
      

        $producto->save();
          
 */
        
        $entrada=$request->all();
        if($archivo=$request->file('file')){
            $nombre=$archivo->getClientOriginalName();
            $archivo->move('images', $nombre);
            $entrada['ruta']=$nombre;
        }
        Producto::create($entrada);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $producto=Producto::findOrFail($id);
        return view("productos.show",compact("producto"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $producto=Producto::findOrFail($id);
         return view("productos.edit", compact("producto"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       // return view("productos.update");
        $producto=Producto::findOrFail($id);
        $producto->update($request->all());
return redirect("/productos");
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return view("productos.delete");
    }
}

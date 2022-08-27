<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class customerController extends Controller
{

 public function listaCustomer(Request $request){
     $texto=trim($request->get('texto'));
     $customer=DB::table('customer')
         ->select('customer.*')
         ->where('name','LIKE','%'.$texto.'%')
         ->orwhere('addres','LIKE','%'.$texto.'%')
         ->orwhere('phone_number','LIKE','%'.$texto.'%')


         ->paginate(10);

    return view('listaCustomer',compact('customer','texto'));
}

    public function formCustomer(){

    return view('crearCustomer');
}

    public function guardarCustomer(Request $request){
    try{
        $validar=$this->validate($request,[
            'name'=>'required',
            'addres'=>'required',
            'phone_number'=>'required',


        ]);
        customer::create([
            'name'=>$validar['name'],
            'addres'=>$validar['addres'],
            'phone_number'=>$validar['phone_number'],

        ]);
    }catch (QueryException $queryException){
        Log::debug($queryException->getMessage());
        return redirect('/formCustomer')->with('alertaQery', 'no');
    } catch (\Exception $exception){

        Log::debug($exception->getMessage());

        return redirect('/formCustomer')->with('alerta', 'si');
    }
    return redirect('/')->with('customeriaGuardado', 'Guardado');
}

    public function editformCustomer($id){
        $category=category::all();
    $customer=customer::findOrFail($id);

    return view('customer.editCustomer', compact('customer','category'));
}
    public function editCustomer(Request $request, $id ){
    $dato=request()->except((['_token','_method']));
    customer::where('id','=', $id)->update($dato);
    return redirect('/')->with('customerModificado', 'Modificado');
}
    public function destroy($id){
    try {
        customer::destroy($id);
        return redirect('/')->with('customerEliminado', 'Eliminado');
    }catch (\Exception $exception){
        Log::debug($exception->getMessage());
        return redirect('/')->with('alerta','si');
    }
}
}


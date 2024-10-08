<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;

class ZipcodeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('user', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        
        $zipcode = DB::table('zipcode_availibility')->paginate(10);
        return view('backend.zipcode.index', compact('zipcode'));
    }
    
    
    
    public function create()
    {
        return view('backend.zipcode.create');
    }    
    
    
    public function insert(Request $request){
        
        $zipcode    = DB::table('zipcode_availibility')->select('id')->where('name', $request->name)->first();
        
        if(empty($zipcode)){
            
            DB::table('zipcode_availibility')->insert([
            'name' => $request->name, 
            'zipcode' => json_encode(array_map('trim', explode(',', $request->zipcode))),
            'charges' => $request->zipcodecharges, // Add charges data
            'type' => 'allow', 
            ]);
            flash(translate('Shipping Class Add successfully!'))->success();
            return redirect()->route('zipcode.index');
        } else{
            flash(translate('Shipping Class Already exist!'))->warning();
            return redirect()->route('zipcode.create');
        }
                
    }
    

    public function edit($id){
        $zipcode    = DB::table('zipcode_availibility')->where('id', $id)->first();
        return view('backend.zipcode.edit', compact('zipcode'));        
    }
    

    public function update(Request $request){
        DB::table('zipcode_availibility')->where('id', $request->id)->update([
            'name' => $request->name, 
            'zipcode' => json_encode(array_map('trim', explode(',', $request->zipcode))),
            'charges' => $request->zipcodecharges, // Add charges data
        ]);
        flash(translate('Shipping Class has been updated successfully!'))->success();
        return redirect()->route('zipcode.index');          
    }    
    
    
    public function destroy($id)
    {
        DB::table('zipcode_availibility')->where('id', $id)->delete();
        flash(translate('Shipping Class has been deleted successfully'))->success();
        return redirect()->route('zipcode.index');
    }

}
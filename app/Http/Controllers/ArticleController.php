<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

use Validator;
use Response;
use Iluminate\Support\Facades\Input;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vueCrud(){
      
        return view('/vuejscrud/index');
        }
    
    public function index()
    {
        $article = Article::latest()->paginate(10);
        
        $response = [
            
            'pagination' => [
                
                'total' => $article->total(),
                'per_page' => $article->perPage(),
                'current_page' => $article->currentPage(),
                'last_page' => $article->lastPage(),
                'from' => $article->FirstItem(),
                'to' => $article->lastItem()
                ],
            
            'data' =>$article
        ];
        
        return response()->json($response);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'title' => 'required',
           'description' => 'required',     
                ]);
    
        $create = Article::create($request->all());
        return response()->json($create);
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
        $this->validate($request,[
           'title' => 'required',
           'description' => 'required',     
            ]);
    
        $edit = Article::find($id)->update($request->all());
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        return response()->json(['done']);
    }
}

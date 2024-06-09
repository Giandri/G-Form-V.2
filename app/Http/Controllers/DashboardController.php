<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    //dashboard customer
    public function index()
    {
        $articles = Article::orderBy('created_at','DESC')->get();
        
        return view('table', [
            'articles' => $articles
        ]); 
    }

    //product page
    public function create()
    {
        return view('dashboard');
    }

    public function store(Request $request)
    {
        $rules =  [
            'name' => 'required',
            'tag' => 'required',

        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        
        $validator = Validator::make($request->all(),$rules);

        if ($validator -> fails()){

            return redirect()->route('account.dashboard')->withInput()->withErrors($validator);
        }

        $article = new Article();
        $article -> name = $request->name;
        $article -> tag = $request->tag;
        $article -> description = $request->description;
        $article -> save();

        if($request->image != ""){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;

            $image->move(public_path('upload/articles'),$imageName);

            $article -> image = $imageName;
            $article -> save();
        }

        

        return redirect()->route('account.index')->with('success','Article created successfully.');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('edit',[
            'article' => $article
        ]);
    }
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
    
        $rules =  [
            'name' => 'required',
            'tag' => 'required',
        ];
    
        if ($request->image != "") {
            $rules['image'] = 'image';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->route('account.index')->withInput()->withErrors($validator);
        }
    
        $article->name = $request->name;
        $article->tag = $request->tag;
        $article->description = $request->description;
        $article->save();
    
        if ($request->image != "") {
            File::delete(public_path('upload/articles/'.$article->image));
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('upload/articles'), $imageName);
            $article->image = $imageName;
            $article->save();
        }
    
        return redirect()->route('account.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        File::delete(public_path('upload/articles/'.$article->image));
        $article->delete();

        return redirect()->route('account.index')->with('success', 'Article deleted successfully.');
    }
}

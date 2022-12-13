<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verset;
use App\Models\Book;
use App\Http\Resources\VersetResource;
use Illuminate\Support\Facades\Gate;

class VersetAdminController extends Controller
{
    //

    public function index()
    {
        //
        $versets = Verset::where('id','>','0')
                                   ->orderBy('created_at','DESC')
                                   ->latest()
                                   ->get();

        return VersetResource::collection($versets);
    }

 // Show form
    public function show()
    {
        //
      $books = Book::get();

       return response()->json([
                   "books" => $books
              ],200);
    }


    public function store(Request $request)
    {

         //
       // dd($request->display_at);

        request()->validate([
        'book' => ['required','string'],
        'chapter' => ['required','integer'],
        'verse' => ['required','integer'],
        'text' => ['required','string'],
        'display_at' =>['required','date','unique:versets']
      ]);
         
     $verset = Verset::create([
              "book"=>$request->book,
              "chapter"=>$request->chapter,
              "verse"=>$request->verse,
              "text"=>$request->text,
              "display_at" => $request->display_at
             ]);

        if($verset){

              return response()->json([
                   "success" => "Verset ajouté avec succes"
              ],201);
           //  return new PostResource($post);
         }else{
            return response()->json([
               "error" => "erreur dajout  du verset"
            ]);
         }
       
    }

    public function edit(Verset $verset)
    {
        //
      $books = Book::get();

       return response()->json([
                   "books" => $books,
                   "verset" => $verset
              ],200);
    }


    public function update(Request $request, Verset $verset)
    {
        //
      request()->validate([
        'book' => ['required','string','min:2'],
        'chapter' => ['required','integer'],
        'verse' => ['required','integer'],
        'text' => ['required','string'],
        'display_at' =>['required','date']
      ]);
         

        //Authorisation
       $response = Gate::inspect('manage-users');

       if ($response->allowed()){
      // The action is authorized...
        $verset->update([
                    'book' => $request->book,
                    'chapter' => $request->chapter,
                    'verse' => $request->verse,
                    'text' => $request->text,
                    'display_at' => $request->display_at,
        ]);

        return response()->json([
                   "books" => "Verset changé avec succès"
              ],200);
      }else{

         echo $response->message();
       }

    }

     public function destroy(Verset $verset)
     {
        //
       
         $response = Gate::inspect('manage-users');
        
        //send mail
         
           if ($response->allowed()) {
               // The action is authorized...
          
             $verset->delete();
           
             return response()->json([
                   "success" => "verset supprimé avec succès!"
              ]);

              }else{

                 echo $response->message();
            }

    }




}

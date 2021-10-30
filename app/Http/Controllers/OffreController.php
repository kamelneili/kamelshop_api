<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Offre;
use App\Http\Resources\OffreResource;

class OffreController extends Controller
{
    public function index()
    {
        $user = Auth::User();

        $offres = Offre::paginate(12) ;//->where('user_id',$user->id);
        return OffreResource::collection( $offres );
    }

public function addOffre(Request $request)
{

    $user = Auth::User();
    $offre_date=$request->input("offre_date");
	$content=$request->input("content");
		$title=$request->input("title");
		$categoryId=$request->input("category_id");


        $offre = new Offre();
        $offre->user_id = $user->id;
		$offre->title=$title;
		$offre->content=$content;
         $offre->offre_date=$offre_date;
        $offre->category_id=$categoryId;



   // var_dump($cart);
    $offre->save();
    $user->save();
    return $offre;
    // return new CartResource($cart);


}

public function search($query)
{


 //   $query = $request->input('query');

     $offres = Offre::where('title', 'like', "%$query%")
                       // ->orWhere('details', 'like', "%$query%")
    //                    ->orWhere('description', 'like', "%$query%")
                       ->paginate(30)
                    ;

    //$products = Product::search($query)->paginate(10);
    return OffreResource::collection( $offres );
}

}

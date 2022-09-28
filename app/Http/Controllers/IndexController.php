<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function uploadform()
    {
        return view('index');
    }

    
    
    
    public function uploadFile(Request $request)  { //$request= det som kommer in i url:en (bilden)
   
        $image = $request->imagefile;    //Plocka ut info om bilden ur request
        $image->storeAS('public',$image->getClientOriginalName());//temporär sökväg
        $img = Image::make(storage_path('app/public').'/' .$image->getClientOriginalName()); //skapar intervention image (går att manipulera)
        
        
        if($request->get('size') === 'instagram'){

            $img->fit(1080, 1080);
        
        } else{
            
            $img->fit(1280, 630);

        }


        if($request->get('logo') === 'svart'){
           
            $logo = Image::make(storage_path('Lundqvist_logotyp_svart.png'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->insert($logo, 'bottom-right', 10, 10);
        
        } else{
            $logo = Image::make(storage_path('Lundqvist_logotyp_vit.png'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->insert($logo, 'bottom-right', 10, 10);

        }
        

        $img->save(storage_path('app/public') . '/' . $image->getClientOriginalName());
        return view ('uploadedFile',['img' => asset('storage') . '/' . $image->getClientOriginalName()]);
    }
}


/*marcus
<?php
 //Funktion för att ta emot och behandla bild
    public function processImage (Request $request) {
        
        //Plocka ut info om bilden ur request-objektet och kolla så det verkligen skickats en bild från formuläret 
        $imageinfo = $request->imagefile;
        if ($imageinfo === null) {
            return view('error', ['errormsg' => 'Du har inte valt någon fil']);
        }
        if (!exif_imagetype($imageinfo->path())) {
            return view('error', ['errormsg' => 'Filen är inte en bildfil']);
        }
        //Skapa imageobjekt, path är sökvägen till den temporära filen som laddats upp
        $image = Image::make($imageinfo->path());
        
        //Kolla vilken logofärg och sociala medier som valts, skapa imageobjekt med logo av rätt färg och ställ in variabler för bredd och höjd på slutgiltig bild
        switch ($request->logocolor) {
            case 'light':
                $logo = Image::make(Storage::Disk('local')->get('lundqvist_logotyp_vit.png'));
                break;
            case 'dark':
                $logo = Image::make(Storage::Disk('local')->get('lundqvist_logotyp_vit.png'));
                break;
            default:
                return view('error', ['errormsg' => 'Du har inte valt färg för logotypen!']);
        }
        
        switch ($request->platform) {
            case 'facebook':
                $width = 1200;
                $height = 630;
                break;
            case 'instagram':
                $width = 1080;
                $height = 1080;
                break;
            default:
                return view('error', ['errormsg' => 'Du har inte valt sociala medier-plattform!']);
        }
        //Skala och beskär bilden till rätt format
        $image->fit($width, $height);
        //Skala om logo till halva bredden av bildens storlek, känns som en lämplig storlek
        $logo->widen($image->width()/2);
        //lägg in logon i nedre hörnet på bilden
        $image->insert($logo, 'bottom-right');
        
        //bygg ett filnamn, kommer att bli originalfilnamnet med -logo tillagt
        $newname = pathinfo($imageinfo->getClientOriginalName(), PATHINFO_FILENAME) 
                   . '-logo' . '.' .
                   pathinfo($imageinfo->getClientOriginalName(), PATHINFO_EXTENSION);
        //Storage::Disk('public')->put($newname, $image);
        //Spara den färdiga bilden och returnera en view där bilden visas. Vet inte om det här är bästa sättet att göra det på i Laravel
        $image->save(storage_path('app/public') . '/' . $newname);
        return view('result', ['image' => '../storage/' . $newname]);
    }
}
Footer
 */
    

    
    
    
   
       
      
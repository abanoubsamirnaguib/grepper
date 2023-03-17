use  Intervention\Image\ImageManagerStatic as Image;
public function detailsAll()
    {
       // change DB
         $products=$this->productRepo->with('images')->get();
         $arr1=[];
         foreach($products as $product){  
                 $ext = pathinfo($product->image, PATHINFO_EXTENSION);
                  if(in_array($ext,['png', 'jpg'])){
                     \DB::table('products')->where("id",$product->id )->update(['new_image'=>'uploads/Product/webp/'.pathinfo(  $product->image ,PATHINFO_FILENAME).'.webp']);
                     foreach($product->images as $image){
                         // array_push($arr1 , $product->images);
                         \DB::table('product_images')->where("id",$image->id )->update(['new_image'=>'uploads/Product/webp/'.pathinfo(  $image->image ,PATHINFO_FILENAME).'.webp']);
                         array_push($arr1 ,["product_id"=>$image->product_id ,"id"=>$image->id , 'image'=>pathinfo(  $image->image ,PATHINFO_FILENAME) ]);
                     }

                 }
                 }
                 dd($arr1);

                 // read files (jpg && png ) and convert it 
             ini_set('memory_limit', '-1');
             ini_set('max_execution_time', 300);
             $arrFiles = array();

             //read jpg and png files in folder to convert 
             $handle = opendir('../storage/app/public/uploads/Product');
             if ($handle) {
             while (($entry = readdir($handle)) !== FALSE) {
             $arrFiles[] = $entry;
             }
             }

             //loop and convert 
             $arr=[];
             foreach($arrFiles as $arrFile){  
                 $ext = pathinfo($arrFile, PATHINFO_EXTENSION);
                 $newFileName =Storage::disk('public')->path('uploads/Product/'.pathinfo($arrFile, PATHINFO_FILENAME).'.'.$ext) ;
                  if(in_array($ext,['png', 'jpg'])){
                     array_push($arr , $newFileName);
                     Image::make($newFileName)->encode('webp', 90)                     
                     // ->resize(400, 400, function ($constraint) {
                     //     $constraint->aspectRatio();})               
                     ->save(Storage::disk('public')->path('uploads/Product/webp/'.pathinfo($arrFile, PATHINFO_FILENAME) . '.webp'));
                  };
             }
             dd ( $arr);
    }
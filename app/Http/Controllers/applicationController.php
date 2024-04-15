<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
//use App\Models\suppliers;
use App\Models\items;
use App\Models\categories;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;
//use App\Models\department;

class applicationController extends Controller
{
   
    public function addsupplier(Request $request)
    {
         
        try {

            $request->validate([
                'name' => 'required|string|max:30',
                'contact' => 'required|numeric|digits:10',
               // 'email' => 'required|string|max:255',
                'address' => 'required|string|max:50',
            ]); 
    
            $supplier = new suppliers();
            $supplier->name = $request->input('name');
            $supplier->contact = $request->input('contact');
            $supplier->email = $request->input('email');
            $supplier->address = $request->input('address');
            $supplier->save();
    
            return response()->json(['message'=>'SUPPLIER SAVED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems supplier with same phone number already registered !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    
    
    }
    public function getSuppliers(){
        $suppliers=suppliers::all();
        return response()->json(['data'=>$suppliers]);

    }

    public function addItem(Request $request)
    {
        
        //return redirect()->route('suppliers.create')->with('success', 'Supplier added successfully.');
    
        try {

            $request->validate([
                'title' => 'required|string|max:30',
                //'subject' => 'required|max:30',
                'class' => 'required|max:20',
                'price' => 'required',
               // 'file' => 'required',
                'file' => 'required|mimes:pdf|max:2048',
                 'desc' => 'required|string',
              // 'desc' => 'required|numeric|digits:10',
               // 'email' => 'required|string|max:255', 
            ]); 

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
           // $Path = 'uploads/' . $fileName;
            //Storage::disk('local')->put( $Path, file_get_contents($file));
    
            $item = new items();
            $item->title = $request->input('title');
            $item->category_id = $request->input('categoryId');
            $item->class = $request->input('class');
            $item->price = $request->input('price');
            $item->file_name = $fileName;
            $item->file_path = 'uploads/' . $fileName;
            $item->desc= $request->input('desc');
          
            $item->save();
    
            return response()->json(['message'=>'ITEM SAVED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems item same item type is already enterd in the system !!'.$e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    

    }


    public function getItems(){
        //to item table with categories and suppliersb based on foreign key and primary key
       // $items=items::with('categories','suppliers')->get();
        $items=items::with('categories')->get();

       // $test=$items->categories->id;
        //dd($test);
        //$items=items::all();
        //$user = categories::find(1); 
        
        return response()->json(['data'=>$items]);

    }

    public function getItemsCategory(Request $request ,$category){
       
        $bookss = items::with('categories')->select('category_id')->distinct()->get();
        $myitems = items::where('category_id', $category)->get(); 
       // return response()->json(['data'=>$myitems]);
       $check=2;
       
      return view('welcome', compact('myitems', 'check', 'bookss'));
      

    }

    public function getItemsCategoryy(){
        //to item table with categories and suppliersb based on foreign key and primary key
       // $items=items::with('categories','suppliers')->get();
       // $items=items::with('categories')->get();
        //$categoryName = $items->categories->name; 
       // $test=$items->categories->id;
        //dd($test);
        //$items=items::all();
        //$user = categories::find(1); 

        $bookss = items::with('categories')->select('category_id')->distinct()->get();
       // $bookss = items::select('category_id')->distinct()->get();
        //$myitems = items::where('category_id', $category)->get();
        
        //$trans = items::with('categories')->where('category_id', $ca)->where('status', 0)->first();
       return response()->json(['data'=>$bookss]);
        // $check=2;
        //$myitems=items::with('categories')->get();  
        // $bookss = items::with('categories')->distinct()->get();

       
    
      // return view('welcome')->with('$myitems')->with('check', $check);
      // return view('welcome', compact('myitems', 'check','bookss'));
      

    }
  





    public function updateItems(Request $request, $id)
    {
        
        try {

            $request->validate([
                'title' => 'required|string|max:30',
                //'subject' => 'required|max:30',
                'class' => 'required|max:20',
                'price' => 'required',
               // 'file' => 'required',
              //  'file' => 'required|mimes:pdf|max:2048',
               'desc' => 'required',
               // 'email' => 'required|string|max:255', 
              
            ]); 

            //$file = $request->file('file');
           // $Path = 'uploads/' . $fileName;
            //$fileName = time() . '_' . $file->getClientOriginalName();
            //$file->move(public_path('uploads'), $fileName);

           // Storage::disk('local')->put( $Path, file_get_contents($file));
            
            $item=items::find($id);
            // $item = new items();
            $item->title = $request->input('title');
            $item->category_id = $request->input('categoryId');
            $item->class = $request->input('class');
            $item->price = $request->input('price');
           // $item->file_name = $fileName;
           // $item->file_path = 'uploads/' . $fileName;
            $item->desc= $request->input('desc');

             $item->save();
            
            return response()->json(['message'=>'ITEM UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems item same item type is already enterd in the system !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        

    }


     public function addCategory(Request $request)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
               // 'item_no' => 'required|max:30',
              
            ]); 
            //$item=items::find($id);
             $category = new categories();
             $category->name = $request->input('name');
             $category->description = $request->input('description');
             $category->save();
            
            return response()->json(['message'=>'CATEGORY UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems item same item type is already enterd in the system !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }


    public function getCategories(){
        $categories=categories::all();
        return response()->json(['data'=>$categories]);
    }



    public function updateCategory(Request $request, $id)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
               // 'item_no' => 'required|max:30',
               
              
            ]); 
            //$item=items::find($id);
             $category = categories::find($id);
             $category->name = $request->input('name');
             $category->description = $request->input('description');
             $category->save();
            
            return response()->json(['message'=>'CATEGORY UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems item same item type is already enterd in the system !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }



    public function deleteCategory($id)
    {
        
        try {

            
          //  $categoryID = categories::find($id);
          $category = categories::find($id);

          if (!$category) {
              return response()->json(['message' => 'Category not found.'], 404);
          }
              //to prevent deleting category when it has related items
          $relatedItemsCount = items::where('category_id', $id)->count();
      
          if ($relatedItemsCount > 0) {
              return response()->json(['message' => 'Warning! This Category has related items and cannot be deleted.'], 422);
          } else {
              $category->delete();
              return response()->json(['message' => 'Category deleted successfully.'], 200);
          }
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact sytem admin !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }


    public function deleteItems($id)
    {
        
        try {

            
            //  $categoryID = categories::find($id);
            $items = items::find($id);
  
            if (!$items) {
                return response()->json(['message' => 'Category not found.'], 404);
            }
                //to prevent deleting category when it has related items
            $relatedItemsCount = Transaction::where('item_id', $id)->count();
        
            if ($relatedItemsCount > 0) {
                return response()->json(['message' => 'Warning! This items has related transactions and cannot be deleted.'], 422);
            } else {
                $items->delete();
                return response()->json(['message' => 'item deleted successfully.'], 200);
            }
              
          } catch (QueryException $e) {
              return response()->json(['error' => 'Database Error:Contact sytem admin !!'], 500);
          } catch (\Exception $e) {
              return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
          }
        
    }




    public function downloadItem($id)
{
   // dd($id);
    $myfile=items::find($id);
  //$filePath =$mfiles_path=$myfile->file_path;
   $filename=$myfile->file_name;
   //$filenamef=$myfile->file_path;
  //$filePath = 'uploads/'. $filename;
   // $filePath = storage_path('uploads/' . $filename); // Adjust the path according to your storage configuration
  
   //$filePath = storage_path('uploads/' . $filename);
  
  $filePath = str_replace('\\', '/', public_path('uploads/' . $filename));

 
 //dd($filePath);
   //\Log::info("File exists: $filePath");
   //dd($filePath);
    if (file_exists($filePath)) {
        return response()->download($filePath, $filename);
        
    


        
   }
    \Log::error("File not found: $filePath");
    
    return response()->json(['error' => 'File not found'], 404);

   // $file = File::findOrFail($id);
   // $filePath = storage_path('app/public/' . $filename);

    //return response()->download($filePath, $filename ,['Content-Type' => 'application/pdf']);
    //return response()->download($filePath, $pdf->title);


}




    public function addDepartment(Request $request)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
              
         
            ]); 
            //$item=items::find($id);
             $department = new department();
             $department->name = $request->input('name');
             $department->description = $request->input('description');
             $department->save();
            
            return response()->json(['message'=>'DEPARTMENT ADDED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact adminstrator!!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
     

    }


    public function getDepartments(){

        $departments=department::all();

        return response()->json(['data'=>$departments],200);
    }


    public function updateDepartment(Request $request,$id)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
              
         
            ]); 
            $department=department::find($id);
             //$department = new department();
             $department->name = $request->input('name');
             $department->description = $request->input('description');
             $department->save();
            
            return response()->json(['message'=>'DEPARTMENT UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact adminstrator for help!!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
     

    }

    public function deleteDepartment($id)
    {
        
        try {

           
             $dept = department::find($id);
             //to delete categories with its related items
            
             $dept->delete();
            
            return response()->json(['message'=>'DEPT DELETED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact sytem admin!!'], 500);
        } 
        
    }


    


}

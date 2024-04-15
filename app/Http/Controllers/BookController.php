<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\items;
use App\Models\Payment;
use App\Models\categories;
use Cart;


class BookController extends Controller
{
    public function welcome()
    {
        //$books = Book::latest()->get();
       
       // return view('welcome', compact('books'));
       //$books=items::with('categories')->get();
       $bookss1 = items::with('categories')->select('category_id')->distinct()->get();
       $check=3;
        $books = items::latest()->get();
      //  View::share('bookss', $bookss);
        return view('welcome', compact('books', 'check', 'bookss1'));
    }

    


    public function transactions()
    {
        //$trans = Transaction::latest()->get();
       
       // return view('books.transactions', compact('trans'));
       $trans=Transaction::with('items')->latest()->get();

       return response()->json(['data'=>$trans]);



       

    }


    public function deleteTransaction($id)
    {
        //$trans = Transaction::latest()->get();
       
       // return view('books.transactions', compact('trans'));
    
       try {
        $trans=Transaction::find($id);
        $trans->delete();

        //to delete categories with its related items
     
       return response()->json(['message'=>'ITEM DELETED SUCCESSFULLY'],200);
       
   } catch (QueryException $e) {
       return response()->json(['error' => 'Database Error:Contact sytem admin!!'], 500);
   } catch (\Exception $e) {
       return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
   }

    }

     public function payments()
    {
        $pays = Payment::latest()->get();
       
        //return view('books.payments', compact('pays'));
         return response()->json(['data'=>$pays]);
    }

    public function create()
    {
        return view('books.create');
    }
    public function store(Request $request)
    {
        $request->validate([
           'title'=>'required',
           'price'=>'required',
           'desc'=>'required',
       ]);

        Book::create($request->all());
        return back();
    }
    public function book($id)
    {
        $book = Book::find($id);
        $books = Book::latest()->get();
        

        return view('books.book', compact('book', 'books'));
    }

    public function addToCart(Request $request, $id)
    {
        //$book = Book::find($id);
        $book = items::find($id);
        $check=2;
        
        $bookss = items::with('categories')->select('category_id')->distinct()->get();
        return view('books.cart', compact('book' ,'check', 'bookss'));
        
     /*   Cart::add(array(
        'id' => $rowId,
        'name' => $book->title,
        'price' => $book->price,
        'quantity' =>$quantity,
        'image'=>$book->image
)); */

       // $books = \Cart::getContent();
       // $subTotal = Cart::getSubTotal();
        //$cartTotalQuantity = Cart::getTotalQuantity();
        //return view('books.cart', compact('book','subTotal','cartTotalQuantity'));
        //$cartTotalQuantity = Cart::getTotalQuantity();
      
    }

    public function cart()
    {   $books = \Cart::getContent();
        $subTotal = Cart::getSubTotal();
        $cartTotalQuantity = Cart::getTotalQuantity();
        return view('books.cart', compact('books','subTotal','cartTotalQuantity'));
    }

     public function download()
        {   $books = \Cart::getContent();
            
            return view('books.download');
        }
}

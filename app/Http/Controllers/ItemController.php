<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        $items = $request->input('items');
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $status = $request->input('status');
        
        // 商品名検索
        $query = Item::query();
        if(!empty($keyword)) {
          $query->where('name', 'LIKE', "%{$keyword}%");
        }
        // 種別検索
        if(!is_null($category)) {
          $query->where('type', $category);
        }
        //ステータス検索
        
        if(!is_null($status)) {
          $query->where('status', $status);
        }
       
        $items = $query->get();

        $pictur_books = Item::where('type','1')->get()->count();
        $pocket_edition_books = Item::where('type','2')->get()->count();
        $comics = Item::where('type','3')->get()->count();
        $magazines = Item::where('type','4')->get()->count();
        $reference_books = Item::where('type','5')->get()->count();

    return view('item.index', compact(
        'items',
        'keyword',
        'category',
        'status'
      ));
    }

   
        
    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'status' => $request->status,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }


  // 削除機能
    public function delete($id){
      $delete_item = Item::find($id);
      $delete_item->delete();
      return redirect(('item.index'));
    }


  }

    //public function search(Request $request){
    //     $keyword = $request->input('keyword');
    //     $category = $request->input('category');
    //     $status = $request->input('status');
        
    //     // 商品名検索
    //     $query = Item::query();
    //     if(!empty($keyword)) {
    //       $query->where('name', 'LIKE', "%{$keyword}%");
    //     }
    //     // 種別検索
    //     if(!is_null($category)) {
    //       $query->where('type', $category);
    //     }
    //     //ステータス検索
    //     if(!is_null($status)) {
    //       $query->where('status', $status);
    //     }
    //     // ページネーション設定 (10)は一度に表示する数
    //     $search_items = $query->paginate(10);
    //     $items = Item::all();

    // return view('index', compact(
    //     'search_items',
    //     'category', 
    //     'keyword', 
    //     'items',
    //     'status',
    //     'pictur_books',
    //     'pocket_edition_books',
    //     'comics',
    //     'magazines',
    //     '"reference_books',
    //     'query'
    //   ));
    

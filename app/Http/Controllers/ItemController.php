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
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();

        return view('item.index', compact('items'));
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
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
    
    public function search(Request $request){
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
        // ページネーション設定 (10)は一度に表示する数
        $search_items = $query->paginate(10);
        $items = Item::all();

    return view('index', compact(
        'search_items',
        'category', 
        'keyword', 
        'items',
        'status',
        'pictur_books',
        'pocket_edition_books',
        'comics',
        'magazines',
        '"reference_books',
        'query'
      ));

    }

    // 一覧ページ上の詳細ボタン 押下すると詳細ページへ遷移
  public function detail(Request $request){
    $item = Item::find($request->id);
    // 登録者取得(あえてEloquentでSQL文)
    $registered_admin_name = DB::select('select name from users where id = ?',[$item->registered_admin_id])[0]->name;
    // 更新者がいない場合(一度も更新されてない場合)「-」の表示にし、更新者がいる場合は更新者の名前を取得(あえてEloquentでSQL文)
    if (!isset(DB::select('select name from users where id = ?',[$item->updated_admin_id])[0])){
      $updated_admin_name = '-';
      }else{$updated_admin_name = DB::select('select name from users where id = ?',[$item->updated_admin_id])[0]->name;}
        return view('yanagisawa.detail',compact('item','registered_admin_name','updated_admin_name'));
  }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserEditController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index()
    {
        // ユーザー情報を全権取得する
        $users = DB::table('users')->get();

        // msg
        $msg = $users->isEmpty() ? '・データが見つかりませんでした' : '';

        return view('userEdit', compact('users', 'msg'));
    }

    // ヘッダーの入力項目で検索する処理
    public function search(Request $request)
    {
        // 入力された名前をセットする
        $name = $request->name;
        // フォームに入力された値で検索
        $users = DB::table('users')
            ->when(!empty($name), function ($query) use ($name) {
                return $query->where(DB::raw('name'), 'LIKE',  '%' . $name . '%');
            })->get();

        // データが0件だった時に表示するメッセージ
        $msg = $users->isEmpty() ? '・データが見つかりませんでした' : '';

        return view('userEdit', compact('users', 'msg'));
    }

    // ユーザーを削除する
    public function delete(Request $request)
    {
        //　リクエストが送られてきたユーザーを削除する
        User::where('name', $request->name)->where('id', $request->id)->delete();

        // ユーザー情報を全権取得する
        $users = DB::table('users')->get();

        // msg
        $msg = 'ユーザー名：' . $request->name . 'を削除しました';

        return view('userEdit', compact('users', 'msg'));
    }

    // ユーザー情報を編集する
    public function edit(Request $request)
    {
        // 渡ってきた情報を元に更新する
        User::where('name', $request->name)
            ->where('id', $request->id)
            ->update([
                'adminAuth' => $request->AdminAuth == 'on' ? 1 : 0, // 管理者権限
                'checkAuth' => $request->CheckAuth == 'on' ? 1 : 0, // 確認権限
            ]);

        // ユーザー情報を全権取得する
        $users = DB::table('users')->get();

        // msg
        $msg = 'ユーザー名：' . $request->name . 'の情報を更新しました';

        return view('userEdit', compact('users', 'msg'));
    }
}

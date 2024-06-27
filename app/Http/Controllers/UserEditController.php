<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserEditController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index()
    {
        // ユーザー情報を全権取得する
        $users = DB::table('users')->get();

        // msg
        $msg = $users->isEmpty() ? '・データが見つかりませんでした' : '';

        // 2段階認証登録
        // // Google2FA インスタンスの作成
        // $google2fa = new Google2FA();

        // // シークレットキーの生成
        // $secretKey = $google2fa->generateSecretKey();

        // // リカバリーコードの生成
        // $recoveryCodes = collect(range(1, 8))->map(function () {
        //     return Str::random(10) . '-' . Str::random(10);
        // })->toArray();

        // // JSONエンコードされたリカバリーコード
        // $recoveryCodesJson = json_encode($recoveryCodes);

        // // ユーザーIDが1のユーザーを取得（適宜変更）
        // $user = User::find(8);

        // // シークレットキーとリカバリーコードを保存
        // $user->update([
        //     'two_factor_secret' => encrypt($secretKey), // シークレットキーを暗号化して保存
        //     'two_factor_recovery_codes' => encrypt($recoveryCodesJson), // リカバリーコードを暗号化して保存
        // ]);
        // 2段階認証終了

        // return view('userEdit', compact('users', 'msg'));
        return response()->json([
            'users' => $users,
            'msg' => $msg,
        ]);
    }

    // ヘッダーの入力項目で検索する処理
    public function search(Request $request)
    {
        // 入力された名前をセットする
        $sName = $request->input('sName');
        // フォームに入力された値で検索
        $users = DB::table('users')
            ->when(!empty($sName), function ($query) use ($sName) {
                return $query->where(DB::raw('name'), 'LIKE',  '%' . $sName . '%');
            })->get();

        // データが0件だった時に表示するメッセージ
        $msg = $users->isEmpty() ? '・データが見つかりませんでした' : '';

        // return view('userEdit', compact('users', 'msg'));
        return response()->json([
            'users' => $users,
            'msg' => $msg,
            'sName' => $sName,
        ]);
    }

    // ユーザーを削除する
    public function delete(Request $request)
    {
        //　リクエストが送られてきたユーザーを削除する
        User::where('name', $request->input('eName'))->where('id', $request->input('eId'))->delete();

        // 入力された名前をセットする
        $sName = $request->input('sName');
        // ユーザー情報を全権取得する
        // $users = DB::table('users')->get();
        $users = DB::table('users')
            ->when(!empty($sName), function ($query) use ($sName) {
                return $query->where(DB::raw('name'), 'LIKE',  '%' . $sName . '%');
            })->get();

        // msg
        $msg = '・ユーザー名：' . $request->input('eName') . 'を削除しました';

        return response()->json([
            'users' => $users,
            'msg' => $msg,
            'sName' => $sName,
        ]);
    }

    // ユーザー情報を編集する
    public function edit(Request $request)
    {
        // 渡ってきた情報を元に更新する
        User::where('name', $request->input('eName'))
            ->where('id', $request->input('eId'))
            ->update([
                'adminAuth' => $request->input('AdminAuth'), // 管理者権限
                'checkAuth' => $request->input('CheckAuth'), // 確認権限
            ]);
        // 入力された名前をセットする
        $sName = $request->input('sName');

        // ユーザー情報を取得する
        $users = DB::table('users')
            ->when(!empty($sName), function ($query) use ($sName) {
                return $query->where(DB::raw('name'), 'LIKE',  '%' . $sName . '%');
            })->get();

        // msg
        $msg = '・ユーザー名：' . $request->input('eName') . 'の情報を更新しました';

        return response()->json([
            'users' => $users,
            'msg' => $msg,
            'sName' => $sName,
        ]);
    }
}

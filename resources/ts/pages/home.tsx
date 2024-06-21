import React, { useEffect, useState } from 'react';
import { Outlet } from 'react-router-dom';
import Button from '../components/button';
import UserInfo from '../components/userInfo';
import { rootConst } from '../const/rootConst';
import Header from '../components/header';
import { UserProps, ButtonProps, HttpRequestProps } from '../types/interfaces';
import axios from 'axios';
import { getCsrfToken } from '../function/getCsrfToken';

const Home: React.FC = () => {

  // ユーザー情報を格納するための変数を定義
  const [user, setUser] = useState<UserProps | null>(null);

  // ボタン押下時に切り替えを管理する
  const [reportsButton, setReportsButton] = useState<boolean>(false);
  const [dawnLoadButton, setDawnLoadButton] = useState<boolean>(false);

  // ボタンを押した際に表示の切り替えを行う
  const clickButton = (which:boolean) => {
    if(which){
      setReportsButton(reportsButton ? false : true)
      setDawnLoadButton(false)
    } else {      
      setReportsButton(false)
      setDawnLoadButton(dawnLoadButton ? false : true)
    }
  }

  // 表示の切り替えを行うためのcssオブジェクト
  const reportsButtonStyle = {
    display: reportsButton  ? 'block' : 'none',
  };
  const dawnloadButtonStyle = {
    display: dawnLoadButton  ? 'block' : 'none',
  };



  // 画面が読み込まれたら実行する処理：APIを呼び出してユーザー情報を取り出す
  useEffect(() => {
    const fetchUser = async () => {
      try {
        // csfrトークンを取得してヘッダーに追加する
        const csrfToken = getCsrfToken();
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        // エンドポイントからAPI呼び出し格納する
        const response = await axios.get(rootConst.GETUSERAPI);
        const data = response.data;
        // 必要なデータを整形
        const user: UserProps = {
          id: data.id,
          name: data.name,
          Department: data.Department,
          checkAuth: data.checkAuth,
          adminAuth: data.adminAuth,
        };
        setUser(user);
      } catch (error) {
        console.error('ユーザー情報の取得に失敗しました:', error);
      }
    };

    fetchUser();
  }, []);

  // ボタンコンポーネントに渡す用のプロパティを設定する
  const reportsPostBtn: ButtonProps = {
    label: '週報提出',
    checkAuth: true,
    adminAuth: true,
    classPro: 'btn btn-success-sub mb-2 buttonW',
    fontAwesome: 'fa-solid fa-pen-to-square',
  };

  const reportsCheckBtn: ButtonProps = {
    label: '週報確認',
    checkAuth: true,
    adminAuth: true,
    classPro: 'btn btn-success-sub mb-2 buttonW',
    fontAwesome: 'fa-solid fa-file-import',
  };

  const reportsCheckAdminBtn: ButtonProps = {
    label: '週報確認（管理者）',
    checkAuth: user?.checkAuth,
    adminAuth: true,
    classPro: 'btn btn-success-sub mb-2 buttonW',
    fontAwesome: 'fa-regular fa-eye',
  };

  const AdminBtn: ButtonProps = {
    label: '管理者用ページ',
    checkAuth: true,
    adminAuth: user?.adminAuth,
    classPro: 'btn mb-2 buttonW',
    fontAwesome: 'fa-solid fa-key',
  };

  const reportsPostPrm: HttpRequestProps = {
    requestURL: rootConst.REPORTSPOSTAPI,
    redirectURL: '/klug_app/public/reportsPost'
  };

  const reportsCheckPrm: HttpRequestProps = {
    requestURL: rootConst.REPORTSCHECKAPI,
    redirectURL: '/klug_app/public/reportsCheck'
  };

  const reportsCheckAdminPrm: HttpRequestProps = {
    requestURL: rootConst.REPORTSCHECKADMIN,
    redirectURL: '/klug_app/public/reportsCheckAdmin'
  };

  const adminPrm: HttpRequestProps = {
    requestURL: rootConst.ADMIN,
    redirectURL: '/klug_app/public/admin'
  };

  return (
    <>
      <Header label='トップページ' leftBtn='logout_btn' subHeaderProp='text-center bg-success text-white h4 py-2 mb-0' leftBtnProp='fa-solid fa-door-open' />
      <div className="wrapper">
        <main>
          <UserInfo user={user?.name ?? ""} Department={user?.Department ?? ""} classPro="bg-success text-white" />
          <button onClick={() => clickButton(true)} className='btn btn-success mb-2 buttonW'><i className='fa-solid fa-pen-to-square'>週報関係</i></button>
            <div style={reportsButtonStyle} className='ml-4'>
              <Button
                ButtonProps={reportsPostBtn}
                HttpRequestProps={reportsPostPrm}
              />
              <br />
              <Button
                ButtonProps={reportsCheckBtn}
                HttpRequestProps={reportsCheckPrm}
              />
              <br />
              <Button
                ButtonProps={reportsCheckAdminBtn}
                HttpRequestProps={reportsCheckAdminPrm}
              />
              <br />
            </div>
          <button onClick={() => clickButton(false)} className='btn btn-info mb-2 buttonW'><i className="fa-solid fa-download">資料ダウンロード</i></button>
          <div style={dawnloadButtonStyle} className='ml-4'>
          <button className='btn btn-info-sub mb-2 buttonW'><i className="fa-solid fa-inbox"></i>届出書</button>

          </div>
              <Button
                ButtonProps={AdminBtn}
                HttpRequestProps={adminPrm}
              />
          <Outlet />
        </main>
      </div>
    </>
  );
};

export default Home;
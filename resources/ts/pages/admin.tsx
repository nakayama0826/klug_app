import React, { useEffect, useState } from "react";
import Button from "../components/button";
import UserInfo from "../components/userInfo";
import Header from "../components/header";
import { rootConst } from "../const/rootConst";
import { ButtonProps, HttpRequestProps, UserProps } from '../types/interfaces';
import axios from "axios";
import { Outlet } from "react-router-dom";
import Home from "../pages/home";
import handleBackClick from "../function/handleBackClick";
import { getCsrfToken } from "../function/getCsrfToken";

const Admin: React.FC = () => {
  const [user, setUser] = useState<UserProps | null>(null);
  const [error, setError] = useState('');

	useEffect(() => {
		const fetchUser = async () => {
			try {
				const response = await axios.get('http://klgsmhsnitool.gulk.co.jp/getUser');
				const data = response.data;
				// 必要なデータを整形
				const user = {
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

  const onClickRegister = () => {
    window.location.href = 'http://klgsmhsnitool.gulk.co.jp/register';
  }

  const onClickHome = () => {
    window.location.href = 'http://klgsmhsnitool.gulk.co.jp';
  }

  // ボタンコンポーネントに渡す用のプロパティを設定する
  const userEditBtn: ButtonProps = {
    label: 'ユーザー編集',
    checkAuth: true,
    adminAuth: true,
    classPro: 'btn btn-secondary mb-2 mt-2 buttonW',
    fontAwesome: 'fa-solid fa-user-pen',
  };

  const dataDeleteBtn: ButtonProps = {
    label: 'データ削除',
    checkAuth: true,
    adminAuth: true,
    classPro: 'btn btn-secondary mb-2 buttonW',
    fontAwesome: 'fa-solid fa-trash',
  };

  const userEditPrm: HttpRequestProps = {
    requestURL:rootConst.USEREDITAPI,
    redirectURL:'/userEdit'
  };
  
  const dataDeletePrm: HttpRequestProps = {
    requestURL:rootConst.DATADELETE,
    redirectURL:'/dataDelete'
  };

  if (error) {
    handleBackClick();
  }

  if (!user) {
    return <Home />;
  }

  return (
    <>
      <Header label='管理者用ページ' leftBtn='logout_admin_btn' subHeaderProp='text-center bg-secondary text-white h4 py-2 mb-0' leftBtnProp='fa-solid fa-door-open' />
      <div className="wrapper">
        <main>
          <UserInfo user={user?.name ?? ""} Department={user?.Department ?? ""} classPro="bg-secondary text-white" />
          <button type="submit" className='btn mt-2 buttonW btn-secondary' onClick={onClickRegister}><i className="fa-solid fa-people-robbery"></i>
            ユーザー追加
          </button>
          <br />
          <Button
            ButtonProps={userEditBtn}
            HttpRequestProps={userEditPrm}
          />
          <br />
          <Button
            ButtonProps={dataDeleteBtn}
            HttpRequestProps={dataDeletePrm}
          />
          <br />
          <button type="submit" className='btn buttonW' onClick={onClickHome}><i className="fa-solid fa-home"></i>
            トップページへ
          </button>
          <Outlet />
        </main>
      </div>
    </>
  )
}

export default Admin;

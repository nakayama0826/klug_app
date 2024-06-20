import React from 'react';
import { useNavigate } from 'react-router-dom';
import { ButtonProps, HttpRequestProps } from '../types/interfaces';
import axios from 'axios';
import handleBackClick from '../function/handleBackClick';
import { getCsrfToken } from '../function/getCsrfToken';

interface props {
  // ボタンに表示するための文字列
  ButtonProps: ButtonProps;
  // ボタンに表示するための文字列
  HttpRequestProps: HttpRequestProps;
}

const Button: React.FC<props> = ({ ButtonProps, HttpRequestProps }) => {
  const navigate = useNavigate();

  const handleClick = async () => {
    try {
      // csfrトークンを取得してヘッダーに追加する
      const csrfToken = getCsrfToken();
      axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
      // APIエンドポイントにGETリクエストを送信
      const response = await axios.get(HttpRequestProps.requestURL);
      // 変数にデータを格納してnavigateに渡す
      const fetchedData = response.data;
      // データをnavigateに渡す
      navigate(HttpRequestProps.redirectURL, { state: { data: fetchedData } });

    } catch (err) {
      console.error('Fetch error:', err);
      handleBackClick();
    }
  };

  return (
    <button
      type="button"
      onClick={handleClick}
      style={!(ButtonProps.adminAuth && ButtonProps.checkAuth) ? { display: 'none' } : {}}
      disabled={!(ButtonProps.adminAuth && ButtonProps.checkAuth)}
      className={ButtonProps.classPro}
    ><i className={ButtonProps.fontAwesome}></i>
      {ButtonProps.label}
    </button>
  );
};

export default Button;

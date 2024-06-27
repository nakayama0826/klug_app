import React from "react";
import handleLogoutClick from "../function/handleLogoutClick";
import handleBackClick from "../function/handleBackClick";
import handleLogoClick from "../function/handleLogoClick";

// プロパティの型を定義
interface HeaderProps {
	label: string;
	leftBtn: string;
	subHeaderProp: string;
	leftBtnProp: string;
}

// ヘッダーのクリックされたアイコンの種類に応じて処理を変える
const funcInterface = (leftBtnProp:string) => {
	if(leftBtnProp === 'fa-solid fa-door-open') {
		// ログアウトボタン
		handleLogoutClick();
	} else {
		// それ以外であれば戻る
		handleBackClick();
	}
}

const header: React.FC<HeaderProps> = ({label, leftBtn, subHeaderProp, leftBtnProp}) => {
	return (
		<>
		<header id="header" className="py-3">
			<i id={leftBtn} className={leftBtnProp} onClick={()=>funcInterface(leftBtnProp)} style={{ width: '21.6px', height: '20px' }}></i>
			<form id="logout_form" method="POST" action="/" className="inline">
				<button type="submit" className="underline text-sm text-gray-600 hover:text-gray-900 ml-2"></button>
			</form>
			<img id="klug_logo" src='./images/klug_logo.jpg' onClick={()=>handleLogoClick()} alt="Klug Logo" />
			<i id="menu_tab" className="fa-solid fa-ellipsis"></i>
		</header>
		<div className={subHeaderProp}>
			<i id="sub_header"></i>
			{label}
		</div>
		</>
	);
}

export default header;
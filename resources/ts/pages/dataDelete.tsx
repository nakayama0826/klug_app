
import React, { useState, useEffect, FormEvent, ChangeEvent } from 'react';
import Header from '../components/header';
import { rootConst } from '../const/rootConst';
import { useLocation, useNavigate } from 'react-router-dom';
import axios from 'axios';      

const dataDelete = () => {
	const location = useLocation();

	const { data } = location.state as { data: any };

	// useStateフックでフォームの初期値を設定
	const [formData, setFormData] = useState({
		sYear: data?.sYear || '', 
		sMonth: data?.sMonth || '', 
		eYear: data?.eYear || '', 
		eMonth: data?.eMonth || '', 
		msg: data?.msg || '', 
	});

	// useEffectを使ってフォームデータを初期化
	useEffect(() => {
		if (data) {
			setFormData({
				sYear: data?.sYear || '', 
				sMonth: data?.sMonth || '', 
				eYear: data?.eYear || '', 
				eMonth: data?.eMonth || '', 
				msg: data?.msg || '', 
			});
		}
	}, [data]);

	const handleChange = (e: ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
		const { name, value } = e.target;
		setFormData(prevData => ({
			...prevData,
			[name]: value,
		}));
	};
	
	const navigate = useNavigate();
	
	const handleSubmit = async (e: React.FormEvent<HTMLFormElement>, url: string, redirectURL: string) => {
		e.preventDefault(); // デフォルトのフォーム送信を防止
		
		// バリデーションチェック
		if (formData.sYear === '' || formData.sMonth === '' || formData.eYear === '' || formData.eMonth === '') {
			setFormData(prevState => ({
				...prevState,
				msg: '・必須項目を入力してください。'
			}));
			return
		}

		try {
			// APIエンドポイントにPOSTリクエストを送信
			const response = await axios.post(url, formData);
			const fetchedData = response.data;

			if (response.status === 200) {
				// 成功した場合、適切なページにリダイレクト
				navigate(redirectURL, { state: { data: fetchedData }});
			} else {
				console.error('Error Happen');
			}
		} catch (error) {
			console.error('Error submitting form:', error);
		}
	};

	// 型アサーションを使って state の型を指定
	return (
		<>
			<Header label='データ削除' leftBtn='back_btn' subHeaderProp='text-center bg-secondary text-white h4 py-2 mb-0' leftBtnProp="fa-solid fa-backward-step" />
			<div className="wrapper pl-2 pt-2">
				{formData.msg && <p className='text-danger pt-1'>{formData.msg}</p>}
				<form onSubmit={(e) => handleSubmit(e, rootConst.DATADELETEDLETEAPI, "/dataDelete")}>
					<input type="text" id="sYear" name="sYear" value={formData.sYear} onChange={(e) => handleChange(e)} style={{ width: '60px' }} maxLength={4} placeholder="YYYY" pattern="\d{4}" />
					<input type="text" id="sMonth" name="sMonth" value={formData.sMonth} onChange={(e) => handleChange(e)} style={{ width: '40px' }} maxLength={2} placeholder="MM" pattern="\d{2}" />
					~
					<input type="text" id="eYear" name="eYear" value={formData.eYear} onChange={(e) => handleChange(e)} style={{ width: '60px' }} maxLength={4} placeholder="YYYY" pattern="\d{4}" />
					<input type="text" id="eMonth" name="eMonth" value={formData.eMonth} onChange={(e) => handleChange(e)} style={{ width: '40px' }} maxLength={2} placeholder="MM" pattern="\d{2}" />
					<button type="submit" className="btn-danger ml-2">削除</button>
				</form>
			</div>
		</>
	)
}

export default dataDelete

import React, { useState, useEffect, FormEvent, ChangeEvent } from 'react';
import Header from '../components/header';
import { useLocation, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { rootConst } from '../const/rootConst';

const userEdit = () => {
	const location = useLocation();
	const { data } = location.state as { data: any };

	// useStateフックでフォームの初期値を設定
	const [formData, setFormData] = useState({
		users: data?.users || [], 
		msg: data?.msg || '',         // 空文字で初期化
		sName: data?.sName || '',         // 空文字で初期化
		AdminAuth: '',         // 空文字で初期化
		CheckAuth: '',         // 空文字で初期化
		eName: '',         // 空文字で初期化
		eId: '',         // 空文字で初期化
	});

	// useEffectを使ってフォームデータを初期化
	useEffect(() => {
		if (data) {
			setFormData({
				users: data?.users || [],
				msg: data?.msg || '',
				sName: data?.sName || '',         // 空文字で初期化
				AdminAuth: '',         // 空文字で初期化
				CheckAuth: '',         // 空文字で初期化
				eName: '',         // 空文字で初期化
				eId: '',         // 空文字で初期化
			});
		}
	}, [data]);

	const change = (e: ChangeEvent<HTMLInputElement>, id: number) => {
		const { name, checked } = e.target;
		setFormData(prevData => ({
			...prevData,
			users: prevData.users.map((user:any) =>
				user.id === id ? { ...user, [name]: checked } : user
			),
		}));
	};

	const handleChange = (e: ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
		const { name, value } = e.target;
		setFormData(prevData => ({
			...prevData,
			[name]: value,
		}));
	};

	const navigate = useNavigate();

	const handleSubmit = async (e: React.FormEvent<HTMLFormElement>, url: string, redirectURL: string, arr:any) => {
		e.preventDefault();

		if(arr) {
			formData.AdminAuth = arr[0];
			formData.CheckAuth = arr[1];
			formData.eName = arr[2];
			formData.eId = arr[3];
		}
		try {
			// APIエンドポイントにPOSTリクエストを送信
			const response = await axios.post(url, formData);
			const fetchedData = response.data;

			if (response.status === 200) {
				// 成功した場合、適切なページにリダイレクト
				navigate(redirectURL, { state: { data: fetchedData } });
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
			<Header label='ユーザー編集' leftBtn='back_btn' subHeaderProp='text-center bg-secondary text-white h4 py-2 mb-0' leftBtnProp="fa-solid fa-backward-step" />
			<div className="wrapper px-0 mx-0 ">
			{formData.msg && <p className='text-danger pt-1'>{formData.msg}</p>}
				<form className='mt-2 ml-4' onSubmit={(e) => handleSubmit(e, rootConst.USEREDITSEARCHAPI, '/userEdit', false)}>
					<input type="text" name="sName" onChange={(e) => handleChange(e)} style={{ width: '80px' }} maxLength={24}
						placeholder="NAME" />
					<button type="submit" className="btn-secondary ml-2">検索</button>
				</form>
				<table id="check_table" className="text-center mt-1">
					<tbody>
						<tr>
							<th>名前</th>
							<th>管理権限</th>
							<th className='pl-2'>確認権限</th>
							<th></th>
						</tr>
						<tr className="red-line"></tr>
						{formData.users.map((user: any) => (
							<React.Fragment key={user.id}>
								<tr>
									<td className='check_td'>{user.name}</td>
									<td className='check_td'>
										<input type="checkbox" name="adminAuth" checked={user.adminAuth} onChange={(e) => change(e, user.id)} />
									</td>
									<td className='check_td'>
										<input type="checkbox" name="checkAuth" checked={user.checkAuth} onChange={(e) => change(e, user.id)} />
									</td>
									<td className='check_td'>
										<form onSubmit={(e) => handleSubmit(e, rootConst.USEREDITEDITAPI, '/userEdit', [user.adminAuth , user.checkAuth, user.name, user.id])}>
											<button className="btn-secondary mb-1" type="submit">変更</button>
										</form>
									</td>
									<td className='check_td'>
										<form onSubmit={(e) => handleSubmit(e, rootConst.USEREDITDELETEAPI, '/userEdit', [user.adminAuth , user.checkAuth, user.name, user.id])}>
											<button className="btn-danger mb-1" type="submit">削除</button>
										</form>
									</td>
								</tr>
								<tr className="red-line"></tr>
							</React.Fragment>
						))}
					</tbody>
				</table>
			</div>
		</>
	)
}

export default userEdit

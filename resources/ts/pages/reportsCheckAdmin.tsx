
import React, { useState, useEffect, ChangeEvent } from 'react';
import Header from '../components/header';
import { rootConst } from '../const/rootConst';
import { useLocation, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { getCsrfToken } from '../function/getCsrfToken';

const ReportsCheckAdmin = () => {
	const location = useLocation();
	const { data } = location.state as { data: any };

	// useStateフックでフォームの初期値を設定
	const [formData, setFormData] = useState({
		weekly_reports: data?.weekly_reports || [], 
		key_number: data?.key_number || '',         // 空文字で初期化
		check: data?.check || false,               // falseで初期化
		name: data?.name || '',               // 空文字で初期化
		id: '',               	// 空文字で初期化
		year_input: data?.year || '', 	// デフォルトで現在の年
		month_input: data?.month || '', // デフォルトで現在の月（0から始まるため+1）
		msg: data?.msg || '',    // 空文字で初期化
		last_week: data?.inputCheck || false,   // falseで初期化
	});

	// useEffectを使ってフォームデータを初期化
	useEffect(() => {
		if (data) {
			setFormData({
				weekly_reports: data?.weekly_reports || [],
				key_number: data?.key_number || '',
				check: data?.check,
				name: data?.name || '',
				id: data?.name_id,
				year_input: data?.year || '',
				month_input: data?.month || '',
				msg: data?.msg || '',
				last_week: data?.inputCheck || false,
			});
		}
	}, [data]);

	const change = (e: ChangeEvent<HTMLInputElement>) => {
		const { name, checked } = e.target;
		setFormData(prevData => ({
			...prevData,
			last_week: checked,
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

	const handleSubmit = async (e: React.FormEvent<HTMLFormElement>, url: string, redirectURL: string, arr: any, check: boolean) => {
		e.preventDefault();

		if(!check) {
			formData.name = arr[0];
			formData.id = arr[1];
			formData.key_number = arr[2];
		}

		try {
			// csfrトークンを取得してヘッダーに追加する
			const csrfToken = getCsrfToken();
			axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
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
			<Header label='週報確認（管理者用）' leftBtn='back_btn' subHeaderProp='text-center bg-success text-white h5 py-2 mb-0' leftBtnProp="fa-solid fa-backward-step" />
			<div className="wrapper pt-2 pl-2">
				<form onSubmit={(e) => handleSubmit(e, rootConst.REPORTSCHECKADMINSEARCHAPI, '/reportsCheckAdmin', [formData.last_week], true)}>
					<input type="text" name="name" value={formData.name} className="mr-1" onChange={(e) => handleChange(e)} style={{ width: '80px' }} maxLength={24}
						placeholder="NAME" />

					<input type="text" id="year_input" name="year_input" className="mr-1" value={formData.year_input} onChange={(e) => handleChange(e)} style={{ width: '60px' }} maxLength={4} placeholder="YYYY" pattern="\d{4}" />
					<input type="text" id="month_input" name="month_input" className="mr-1" value={formData.month_input} onChange={(e) => handleChange(e)} style={{ width: '40px' }} maxLength={2} placeholder="MM" pattern="\d{2}" />
					<input type="checkbox" id="last_week" name="last_week" className="mr-1" checked={formData.last_week} onChange={(e) => change(e)}/>
					<label htmlFor="last_week" className="small mb-0">直近の週報を取得</label>

					<button type="submit" className="btn-success ml-2">検索</button>
				</form>
				<table id="check_table" className="text-center">
					<tbody>
						<tr className="red-line"></tr>

						{formData.weekly_reports.map((report: any) => (
							<React.Fragment key={`${report.key_number}_${report.name_id}`}>
								<tr>
									<td className='check_td'>週報:{report.name}</td>
									<td className='check_td'>
										<div>{new Date(report.first_day).toLocaleDateString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit' })}</div>
									~
										<div>{new Date(report.last_day).toLocaleDateString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit' })}</div>
									</td>
									<td className='check_td'>
										<form onSubmit={(e) => handleSubmit(e, rootConst.REPORTSCHECKADMINSCOMFIRMAPI, '/reportsComfirm', [report.name, report.name_id, report.key_number], false)}>
											<button className="btn-primary mb-1" type="submit">確認</button>
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

export default ReportsCheckAdmin

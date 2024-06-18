
import React, { useState, useEffect, FormEvent, ChangeEvent } from 'react';
import Header from '../components/header';
import { rootConst } from '../const/rootConst';
import { useLocation, useNavigate } from 'react-router-dom';
import axios from 'axios';      

const ReportsPost = () => {
	const location = useLocation();
	const { data } = location.state as { data: any };
	// useStateフックでフォームの初期値を設定
	const [formData, setFormData] = useState({
		weekly_reports: data?.weekly_reports || [], 
		key_number: data?.key_number || '',         // 空文字で初期化
		check: data?.check,               	    // falseで初期化
		year_input: data?.year || '', 		    // デフォルトで現在の年
		month_input: data?.month || '', 	    // デフォルトで現在の月（0から始まるため+1）
		msg: data?.msg || '',                       // 空文字で初期化
	});

	// useEffectを使ってフォームデータを初期化
	useEffect(() => {
		if (data) {
			setFormData({
				weekly_reports: data?.weekly_reports || [],
				key_number: data?.key_number || '',
				check: data?.check || false,
				year_input: data?.year || '',
				month_input: data?.month || '',
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

	const handleSubmit = async (e: React.FormEvent<HTMLFormElement>, url: string, redirectURL: string, num:string) => {
		e.preventDefault();

		// TODO
		formData.key_number = num;

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
			<Header label='週報確認' leftBtn='back_btn' subHeaderProp='text-center bg-success text-white h4 py-2 mb-0' leftBtnProp="fa-solid fa-backward-step" />
			<div className="wrapper pt-2">
				<form className='pl-4' onSubmit={(e) => handleSubmit(e, rootConst.REPORTSCHECKSEARCHAPI, '/klug_app/public/reportsCheck', "")}>
					<input type="text" id="year_input" name="year_input" className='mr-1' value={formData.year_input} onChange={(e) => handleChange(e)} style={{ width: '60px' }} maxLength={4} placeholder="YYYY" pattern="\d{4}" />
					<input type="text" id="month_input" name="month_input" value={formData.month_input} onChange={(e) => handleChange(e)} style={{ width: '40px' }} maxLength={2} placeholder="MM" pattern="\d{2}" />
					<button type="submit" className="btn-success ml-2">検索</button>
				</form>
				{formData.msg && <p className='text-danger pt-1 ml-3'>{formData.msg}</p>}
				<table id="check_table" className="text-center">
					<tbody>
						<tr className="red-line"></tr>
						{!formData.check && (
							<>
								<tr>
									<td className='check_td'>週報</td>
									<td colSpan={3} className="text-danger check_td">
										※先週分の週報が未提出です
									</td>
									<td className='check_td'>
										<form onSubmit={(e) => handleSubmit(e, rootConst.REPORTSCHECKEDITAPI, '/klug_app/public/reportsPost', '')}>
											<input type="hidden" name="key_number" value='' />
											<button type="submit" className="btn-danger mb-1">
												提出
											</button>
										</form>
									</td>
								</tr>
								<tr className="red-line"></tr>
							</>
						)}
						{formData.weekly_reports.map((report:any) => (
							<React.Fragment key={report.key_number}>
								<tr>
									<td className='check_td'>週報</td>
									<td className='check_td'>
										<div>{new Date(report.first_day).toLocaleDateString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit' })}</div>
									~
										<div>{new Date(report.last_day).toLocaleDateString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit' })}</div>
									</td>
									<td className='check_td'>
										<form onSubmit={(e) => handleSubmit(e, rootConst.REPORTSCHECKCOMFIRMAPI, '/klug_app/public/reportsComfirm', report.key_number)}>
											<button className="btn-primary mb-1" type="submit">確認</button>
										</form>
										{formData.key_number - Number(report.key_number) < 3 && (
											<form onSubmit={(e) => handleSubmit(e, rootConst.REPORTSCHECKEDITAPI, '/klug_app/public/reportsPost', report.key_number)}>
												<button className="btn-warning" type="submit">編集</button>
											</form>
										)}
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

export default ReportsPost
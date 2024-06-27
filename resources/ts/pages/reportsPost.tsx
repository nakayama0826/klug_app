
import React, { useState, ChangeEvent } from 'react';
import Header from '../components/header';
import { rootConst } from '../const/rootConst';
import { useLocation, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { getCsrfToken } from '../function/getCsrfToken';

// 週報提出用のコンポーネント
const ReportsPost = () => {
	// 画面遷移された際の初期値を設定する
	const location = useLocation();
	const { data } = location.state as { data: any };
	
	// useStateを使ってエラー用の変数を設定
	const [error, setError] = useState('');

	// useStateフックでフォームの初期値を設定
	const [formData, setFormData] = useState({
		name: data?.user.name || '',
		name_id: data?.user.id || '',
		key_number: data?.key_number || '',
		today: data?.today || '',
		reporting_date: data?.today.replace(/[年月日]/g, '-') || '',
		newPost: data?.newPost || false,
		first_day: data?.reportsPost?.first_day || '',
		last_day: data?.reportsPost?.last_day || '',
		post: data?.reportsPost?.post || data?.lastReports?.post ||'',
		concern: data?.reportsPost?.concern || data?.lastReports?.concern ||'',
		schedule: data?.reportsPost?.schedule || data?.lastReports?.schedule ||'',
		work_day1: data?.reportsPost?.work_day1 || data?.lastReports?.work_day1 || '',
		start_time1: data?.reportsPost?.start_time1 || data?.lastReports?.start_time1 || '', 
		end_time1: data?.reportsPost?.end_time1 || data?.lastReports?.end_time1 || '',
		work_day2: data?.reportsPost?.work_day2 || data?.lastReports?.work_day2 || '',
		start_time2: data?.reportsPost?.start_time2 || data?.lastReports?.start_time2 || '', 
		end_time2: data?.reportsPost?.end_time2 || data?.lastReports?.end_time2 || '',
		work_day3: data?.reportsPost?.work_day3 || data?.lastReports?.work_day3 || '', 
		start_time3: data?.reportsPost?.start_time3 || data?.lastReports?.start_time3 || '', 
		end_time3: data?.reportsPost?.end_time3 || data?.lastReports?.end_time3 || '',
		work_day4: data?.reportsPost?.work_day4 || data?.lastReports?.work_day4 || '',
		start_time4: data?.reportsPost?.start_time4 || data?.lastReports?.start_time4 || '', 
		end_time4: data?.reportsPost?.end_time4 || data?.lastReports?.end_time4 || '',
		work_day5: data?.reportsPost?.work_day5 || data?.lastReports?.work_day5 || '',
		start_time5: data?.reportsPost?.start_time5 || data?.lastReports?.start_time5 || '', 
		end_time5: data?.reportsPost?.end_time5 || data?.lastReports?.end_time5 || '',
		work_day6: data?.reportsPost?.work_day6 || data?.lastReports?.work_day6 || '',
		start_time6: data?.reportsPost?.start_time6 || data?.lastReports?.start_time6 || '', 
		end_time6: data?.reportsPost?.end_time6 || data?.lastReports?.end_time6 || '',
		work_day7: data?.reportsPost?.work_day7 || data?.lastReports?.work_day7 || '',
		start_time7: data?.reportsPost?.start_time7 || data?.lastReports?.start_time7 || '', 
		end_time7: data?.reportsPost?.end_time7 || data?.lastReports?.end_time7 || '',
	});

	// フォームが変更された際にステートの値を更新する
	const handleChange = (e: ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
		// 渡ってきたインプットの情報を設定する
		const { name, value } = e.target;

		// 入力項目が開始日なら作業時間を自動入力をする
		if(name === 'first_day') {
			handleWorkDayChange(e);
		}

		// 値を更新する
		setFormData(prevData => ({
			...prevData,
			[name]: value,
		}));
	};

	const navigate = useNavigate();

	// フォームの送信ハンドラ
	const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
		e.preventDefault();

		// バリデーションチェック
		if (formData.post === '' || formData.first_day === '' || formData.last_day === '') {
			setError('・必須項目を入力してください。');
			return
		}

		//
		try {
			// csfrトークンを取得してヘッダーに追加する
			const csrfToken = getCsrfToken();
			axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
			// APIエンドポイントにPOSTリクエストを送信
			const response = await axios.post(formData.newPost ? rootConst.REPORTSPOSTENTRYAPI :rootConst.REPORTSPOSTEDITAPI , formData);
			// レスポンスによって処理の流れを制御する
			if (response.status === 200) {
				// 成功した場合、適切なページにリダイレクト
				navigate('/');
			} else {
				console.error('Error Happen');
			}
		} catch (error) {
			console.error('Error submitting form:', error);
		}
	};

	// 日付が変更されたときに作業時間に連続する5日を設定する関数
	const handleWorkDayChange = (e: ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
		const startDate = new Date(e.target.value);
		for (let i = 1; i <= 5; i++) {
			// 入力された値から日付を取得する
			const currentDate = new Date(e.target.value);
			// 値を整形して作業時間に割り当てる
			currentDate.setDate(startDate.getDate() + i - 1);
			const formattedDate = currentDate.toISOString().split('T')[0];
			setFormData(prev => ({
				...prev,
				[`work_day${i}`]: formattedDate,
			}));
		}
	};

	return (
		<>
			<Header label={!formData.newPost ? '週報提出(更新)' : '週報提出'} leftBtn='back_btn' subHeaderProp={`text-center ${!formData.newPost ? 'bg-warning' : 'bg-success'} text-white h4 py-2 mb-0`} leftBtnProp="fa-solid fa-backward-step" />
			<div className="wrapper">
				<div className="post_container pt-1 px-0">
					{error && <p className='text-danger'>{error}</p>}
					<div className="form_info">
						<div className="h6">報告日：{formData.today}</div>
						<div className="h6">報告者：{formData.name}</div>
					</div>
					<form onSubmit={(e) => handleSubmit(e)}>
						<table>
							<tbody>
								<tr>
									<td><label className="badge badge-danger">必須</label>業務期間</td>
								</tr>
								<tr>
									<td><input id="first_day" type="date" className="border_input" name="first_day" value={formData.first_day} onChange={(e) => handleChange(e)} /></td>
									<td>～</td>
									<td><input id="last_day" type="date" className="border_input" name="last_day" value={formData.last_day} onChange={(e) => handleChange(e)} /></td>
								</tr>
								<tr>
									<td><label className="badge badge-danger">必須</label>業務内容</td>
								</tr>
								<tr>
									<td colSpan={3}>
										<textarea className="border_textarea_post" name="post" value={formData.post} onChange={(e) => handleChange(e)}></textarea>
									</td>
								</tr>
								<tr>
									<td>懸念点</td>
								</tr>
								<tr>
									<td colSpan={3}>
										<textarea className="border_textarea" name="concern" value={formData.concern} onChange={(e) => handleChange(e)}></textarea>
									</td>
								</tr>
								<tr>
									<td>来週の予定・備考</td>
								</tr>
								<tr>
									<td colSpan={3}>
										<textarea className="border_textarea" name="schedule" value={formData.schedule} onChange={(e) => handleChange(e)}></textarea>
									</td>
								</tr>
								<tr>
									<td>今週の作業時間</td>
								</tr>
							</tbody>
						</table>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day1" type="date" name="work_day1" value={formData.work_day1} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="start_time1" type="time" name="start_time1" value={formData.start_time1} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="end_time1" type="time" name="end_time1" value={formData.end_time1} onChange={(e) => handleChange(e)} />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day2" type="date" name="work_day2" value={formData.work_day2} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="start_time2" type="time" name="start_time2" value={formData.start_time2} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="end_time2" type="time" name="end_time2" value={formData.end_time2} onChange={(e) => handleChange(e)} />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day3" type="date" name="work_day3" value={formData.work_day3} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="start_time3" type="time" name="start_time3" value={formData.start_time3} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="end_time3" type="time" name="end_time3" value={formData.end_time3} onChange={(e) => handleChange(e)} />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day4" type="date" name="work_day4" value={formData.work_day4} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="start_time4" type="time" name="start_time4" value={formData.start_time4} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="end_time4" type="time" name="end_time4" value={formData.end_time4} onChange={(e) => handleChange(e)} />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day5" type="date" name="work_day5" value={formData.work_day5} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="start_time5" type="time" name="start_time5" value={formData.start_time5} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="end_time5" type="time" name="end_time5" value={formData.end_time5} onChange={(e) => handleChange(e)} />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day6" type="date" name="work_day6" value={formData.work_day6} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="start_time6" type="time" name="start_time6" value={formData.start_time6} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="end_time6" type="time" name="end_time6" value={formData.end_time6} onChange={(e) => handleChange(e)} />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day7" type="date" name="work_day7" value={formData.work_day7} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="start_time7" type="time" name="start_time7" value={formData.start_time7} onChange={(e) => handleChange(e)} />
							</div>
							<div className="col-3">
								<input id="end_time7" type="time" name="end_time7" value={formData.end_time7} onChange={(e) => handleChange(e)} />
							</div>
						</div>
						<div>
							<button type="submit" className={`btn mt-2 buttonW ${!formData.newPost ? 'btn-secondary' : 'btn-success'}`} disabled={!formData.newPost}>
								提出
							</button>
							<button type="submit" className={`btn mt-2 buttonW ${formData.newPost ? 'btn-secondary' : 'btn-warning'}`} disabled={formData.newPost}>
								更新
							</button>
						</div>
					</ form>
				</div>
			</div>
		</>
	)
}

export default ReportsPost
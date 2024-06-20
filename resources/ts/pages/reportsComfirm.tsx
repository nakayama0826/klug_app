
import React, { useState } from 'react';
import Header from '../components/header';
import { useLocation } from 'react-router-dom';
import handleBackClick from '../function/handleBackClick';

// 週報確認用コンポーネント
const ReportsComfirm = () => {
	// 画面遷移してきた時の値を設定する
	const location = useLocation();
	const { data } = location.state as { data: any };

	// useStateフックでフォームの初期値を設定:
	const [formData] = useState({
		name: data?.reportsPost?.name || '',
		today: data?.reportsPost?.reporting_date,
		first_day: data?.reportsPost?.first_day || '',
		last_day: data?.reportsPost?.last_day || '',
		post: data?.reportsPost?.post || '',
		concern: data?.reportsPost?.concern || '',
		schedule: data?.reportsPost?.schedule || '',
		work_day1: data?.reportsPost?.work_day1 || '', start_time1: data?.reportsPost?.start_time1 || '', end_time1: data?.reportsPost?.end_time1 || '',
		work_day2: data?.reportsPost?.work_day2 || '', start_time2: data?.reportsPost?.start_time2 || '', end_time2: data?.reportsPost?.end_time2 || '',
		work_day3: data?.reportsPost?.work_day3 || '', start_time3: data?.reportsPost?.start_time3 || '', end_time3: data?.reportsPost?.end_time3 || '',
		work_day4: data?.reportsPost?.work_day4 || '', start_time4: data?.reportsPost?.start_time4 || '', end_time4: data?.reportsPost?.end_time4 || '',
		work_day5: data?.reportsPost?.work_day5 || '', start_time5: data?.reportsPost?.start_time5 || '', end_time5: data?.reportsPost?.end_time5 || '',
	});

	return (
		<>
			<Header label='週報確認' leftBtn='back_btn' subHeaderProp='text-center btn-primary text-white h4 py-2 mb-0' leftBtnProp="fa-solid fa-backward-step" />
			<div className="wrapper">
				<div className="post_container pt-1 px-0">
					<div className="form_info">
						<div className="h6">報告日：{formData.today}</div>
						<div className="h6">報告者：{formData.name}</div>
					</div>
						<table>
							<tbody>
								<tr>
									<td><label className="badge badge-danger">必須</label>業務期間</td>
								</tr>
								<tr>
									<td><input id="first_day" type="date" className="border_input" name="first_day"
										value={formData.first_day} readOnly /></td>
									<td>～</td>
									<td><input id="last_day" type="date" className="border_input" name="last_day"
										value={formData.last_day} readOnly /></td>
								</tr>
								<tr>
									<td><label className="badge badge-danger">必須</label>業務内容</td>
								</tr>
								<tr>
									<td colSpan={3}>
										<textarea className="border_textarea_post" name="post" value={formData.post} readOnly></textarea>
									</td>
								</tr>
								<tr>
									<td>懸念点</td>
								</tr>
								<tr>
									<td colSpan={3}>
										<textarea className="border_textarea" name="concern" value={formData.concern} readOnly></textarea>
									</td>
								</tr>
								<tr>
									<td>来週の予定・備考</td>
								</tr>
								<tr>
									<td colSpan={3}>
										<textarea className="border_textarea" name="schedule" value={formData.schedule} readOnly></textarea>
									</td>
								</tr>
								<tr>
									<td>今週の作業時間</td>
								</tr>
							</tbody>
						</table>

						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day1" type="date" name="work_day1" value={formData.work_day1} readOnly />
							</div>
							<div className="col-3">
								<input id="start_time1" type="time" name="start_time1" value={formData.start_time1} readOnly />
							</div>
							<div className="col-3">
								<input id="end_time1" type="time" name="end_time1" value={formData.end_time1} readOnly />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day2" type="date" name="work_day2" value={formData.work_day2} readOnly />
							</div>
							<div className="col-3">
								<input id="start_time2" type="time" name="start_time2" value={formData.start_time2} readOnly />
							</div>
							<div className="col-3">
								<input id="end_time2" type="time" name="end_time2" value={formData.end_time2} readOnly />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day3" type="date" name="work_day3" value={formData.work_day3} readOnly />
							</div>
							<div className="col-3">
								<input id="start_time3" type="time" name="start_time3" value={formData.start_time3} readOnly />
							</div>
							<div className="col-3">
								<input id="end_time3" type="time" name="end_time3" value={formData.end_time3} readOnly />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day4" type="date" name="work_day4" value={formData.work_day4} readOnly />
							</div>
							<div className="col-3">
								<input id="start_time4" type="time" name="start_time4" value={formData.start_time4} readOnly />
							</div>
							<div className="col-3">
								<input id="end_time4" type="time" name="end_time4" value={formData.end_time4} readOnly />
							</div>
						</div>
						<div className="row pb-2">
							<div className="col-5">
								<input id="work_day5" type="date" name="work_day5" value={formData.work_day5} readOnly />
							</div>
							<div className="col-3">
								<input id="start_time5" type="time" name="start_time5" value={formData.start_time5} readOnly />
							</div>
							<div className="col-3">
								<input id="end_time5" type="time" name="end_time5" value={formData.end_time5} readOnly />
							</div>
						</div>

						<div>
							<button className={`btn mt-2 buttonW btn-primary`} onClick={handleBackClick}>
								戻る
							</button>
						</div>
				</div>
			</div>
		</>
	)
}

export default ReportsComfirm
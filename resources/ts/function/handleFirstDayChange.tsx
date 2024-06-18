// ロゴがクリックされたときの処理
const handleFirstDayChange = async () => {
	const firstDayInput = document.getElementById('first_day');

	const workDayInputs = [
		document.getElementById('work_day1'),
		document.getElementById('work_day2'),
		document.getElementById('work_day3'),
		document.getElementById('work_day4'),
		document.getElementById('work_day5')
	];

		const firstDayDate = new Date(firstDayInput.value);

		for (let i = 0; i < 4 + 1; i++) {
			const workDay = new Date(firstDayDate);
			workDay.setDate(firstDayDate.getDate() + i);
			workDayInputs[i].value = workDay.toISOString().split('T')[0];
		}
};

export default handleFirstDayChange

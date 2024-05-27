// ホーム画面のログアウトボタンが押された時の処理
const logoutEl = document.getElementById('logout_btn');
if (logoutEl !== null) {

    logoutEl.addEventListener('click', function () {
        var userConfirmed = confirm('ログアウトしますか？');
        if (userConfirmed) {
            document.getElementById('logout_form').submit();
        }
    })
}

// ヘッダーのバックボタンが押された時の処理
const backEl = document.getElementById('back_btn');

if (backEl !== null) {
    backEl.addEventListener('click', function () {
        // window.location.href='{{ url()->previous() }}';
        history.back()
    })
}

// 作業時刻に値が設定されたら自動で設定を行う
const firstDayInput = document.getElementById('first_day');

// 値をセットするための作業時間の要素を取得する
const workDayInputs = [
    document.getElementById('work_day1'),
    document.getElementById('work_day2'),
    document.getElementById('work_day3'),
    document.getElementById('work_day4'),
    document.getElementById('work_day5')
];

// 作業期間１が入力されたらそれからの5日間を自動で入力
function updateWorkDays() {
    if (firstDayInput !== null) {
        const firstDayDate = new Date(firstDayInput.value);

        for (let i = 0; i < 4 + 1; i++) {
            const workDay = new Date(firstDayDate);
            workDay.setDate(firstDayDate.getDate() + i);
            workDayInputs[i].value = workDay.toISOString().split('T')[0];
        }
    }
}

if (firstDayInput !== null) {
    firstDayInput.addEventListener('input', updateWorkDays);
}
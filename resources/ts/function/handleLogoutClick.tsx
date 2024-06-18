
import { getCsrfToken } from './getCsrfToken';
import axios from 'axios';

// ログアウトボタンがクリックされたときの処理
// const navigate = useNavigate();
const handleLogoutClick = async () => {
	const userConfirmed = window.confirm('ログアウトしますか？');
	const csrfToken = getCsrfToken();
	if (userConfirmed) {
		const logoutForm = document.getElementById('logout_form') as HTMLFormElement;
		if (logoutForm) {
			await axios.post('/klug_app/public/logout', {}, {
				headers: {
					'X-CSRF-TOKEN': csrfToken
				},
				withCredentials: true // 必要に応じて、認証情報をクッキーに含める
			});
			window.location.reload();
		} else {
			console.error('ログアウトフォームが見つかりませんでした。');
		}
	}
};

export default handleLogoutClick
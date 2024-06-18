import React from "react";
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import UserEdit from "./pages/userEdit";
import ReportsPost from './pages/reportsPost';
import ReportsCheck from './pages/reportsCheck';
import ReportsComfirm from './pages/reportsComfirm';
import ReportsCheckAdmin from './pages/reportsCheckAdmin';
import Admin from "./pages/admin";
import Home from "./pages/home";
import DataDelete from "./pages/dataDelete";

const Main: React.FC = () => {
	return (
		<>
			<BrowserRouter>
				<Routes>
					<Route path="/klug_app/public/" element={<Home />} />
					<Route path="/klug_app/public/dashboard" element={<Home />} />
					<Route path="/klug_app/public/reportsPost" element={<ReportsPost />} />
					<Route path="/klug_app/public/reportsComfirm" element={<ReportsComfirm />} />
					<Route path="/klug_app/public/reportsCheck" element={<ReportsCheck />} />
					<Route path="/klug_app/public/reportsCheckAdmin" element={<ReportsCheckAdmin />} />
					<Route path="/klug_app/public/admin" element={<Admin />} />
					<Route path="/klug_app/public/userEdit" element={<UserEdit />} />
					<Route path="/klug_app/public/dataDelete" element={<DataDelete />} />
				</Routes>
			</BrowserRouter>
		</>
	);
}

export default Main;
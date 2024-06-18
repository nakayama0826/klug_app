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
					<Route path="/" element={<Home />} />
					<Route path="/dashboard" element={<Home />} />
					<Route path="/reportsPost" element={<ReportsPost />} />
					<Route path="/reportsComfirm" element={<ReportsComfirm />} />
					<Route path="/reportsCheck" element={<ReportsCheck />} />
					<Route path="/reportsCheckAdmin" element={<ReportsCheckAdmin />} />
					<Route path="/admin" element={<Admin />} />
					<Route path="/userEdit" element={<UserEdit />} />
					<Route path="/dataDelete" element={<DataDelete />} />
				</Routes>
			</BrowserRouter>
		</>
	);
}

export default Main;
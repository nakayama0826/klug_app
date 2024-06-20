import React from "react";
import Main from './main';
import { createRoot } from 'react-dom/client';

const container = document.getElementById('app');
const root = createRoot(container!); // TypeScriptのためのnullチェック

root.render(
	<React.StrictMode>
		<Main />
	</React.StrictMode>
);
import React, { useEffect, useState } from "react";
import Main from './main';
import { createRoot } from 'react-dom/client';
import axios from 'axios';

const container = document.getElementById('app');
const root = createRoot(container!); // TypeScriptのためのnullチェック

root.render(
	<React.StrictMode>
		<Main />
	</React.StrictMode>
);
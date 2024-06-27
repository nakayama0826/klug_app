export interface UserProps {
	id: number;
	name: string;
	Department: string;
	checkAuth: boolean;
	adminAuth: boolean;
}

export interface ButtonProps {
	label: string;
	checkAuth?: boolean;
	adminAuth?: boolean;
	classPro?: string;
	fontAwesome?: string;
}

export interface HttpRequestProps {
	requestURL: string;
	redirectURL: string;
}


export interface Props {
	Button: ButtonProps;
	httpRequest: HttpRequestProps;
}

export interface DownLoadButtonProps {
	showButton: string;
	closeButton: string;
	dialog: string;
	fileName: string;
	fileNameType: string;
	classPro?: string;
	fontAwesome?: string;
}
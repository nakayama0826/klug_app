import React from 'react';
import { DownLoadButtonProps } from '../types/interfaces';
import axios from 'axios';
import fileDownload from 'js-file-download'

interface props {
	// ボタンに表示するための文字列
	DownLoadButtonProps: DownLoadButtonProps;
}

const DownLoadButton: React.FC<props> = ({ DownLoadButtonProps }) => {
	// TODO
	const showButton = document.getElementById(DownLoadButtonProps.showButton); // 表示ボタン
	const closeButton = document.getElementById(DownLoadButtonProps.closeButton); // 閉じるボタン
	const dialog: HTMLDialogElement = document.getElementById(DownLoadButtonProps.dialog) as HTMLDialogElement;

	// 表示ボタンをクリック時したとき、
	showButton?.addEventListener("click", () => {
	  // モーダルを開く
	  dialog?.showModal();
	});

	// 閉じるボタンをクリック時したとき、
	closeButton?.addEventListener("click", () => {
	  // モーダルを閉じる
	  dialog?.close();
	});

	const handleClickOk = (url:string, filename:string) => {
		axios.get(url, {
		  responseType: 'blob',
		})
		.then((res) => {
		  fileDownload(res.data, filename);
		  dialog?.close();
		})
	}

	return (
		<>
			<button id={DownLoadButtonProps.showButton} type='button' className={DownLoadButtonProps.classPro}><i className={DownLoadButtonProps.fontAwesome}></i>{DownLoadButtonProps.fileName}</button>
			<dialog id={DownLoadButtonProps.dialog} className='w-75'>
				<div>・{DownLoadButtonProps.fileName}をダウンロードしますか？</div>
				<img src={`./images/${DownLoadButtonProps.fileName}.jpg`} alt="" />
				<div className="mr-auto d-flex justify-content-end">
					<button type="button" className='btn btn-primary' onClick={() => handleClickOk(`http://localhost/klug_app/public/dlc/${DownLoadButtonProps.fileName}.${DownLoadButtonProps.fileNameType}`, `${DownLoadButtonProps.fileName}.${DownLoadButtonProps.fileNameType}`)}>Ok</button>
					<button id={DownLoadButtonProps.closeButton} className='btn ml-1' type="button">Cancel</button>
				</div>
			</dialog>
		</>
	);
};

export default DownLoadButton;

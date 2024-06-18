import React from 'react';

interface Props {
  user: string;
  Department: string;
  classPro: string;
}

const UserInfo: React.FC<Props> = ({ user, Department, classPro }) => {
  return (
	<div id="member_info" className="container text-center">
	<table className="table-bordered" width="100%">
	  <thead>
	    <tr className="text-center">
	      <th className={classPro}>氏名</th>
	      <th className={classPro}>所属部署</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr className="text-center">
	      <td>{user}</td>
	      <td>{Department}</td>
	    </tr>
	  </tbody>
	</table>
      </div>
  );
};

export default UserInfo;

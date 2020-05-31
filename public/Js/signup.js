//----------------------------------------------------------//
//                  SIGNUP FORM CONFIRMATION                //
//----------------------------------------------------------//

let confirmation = () => {
	let emailInput = document.getElementById('emailInput');
	let emailErr = '';
	emailInput.addEventListener('keyup', () => {
		emailValue = emailInput.value;
		let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if (emailValue.match(mailformat)) {
			emailErr = '';
			let errBlock = document.getElementById('errBlock');
			errBlock.style.display = 'none';
			errBlock.getElementsByTagName('p')[0].innerText = '';
		} else {
			emailErr = 'Invalid email';
			let errBlock = document.getElementById('errBlock');
			errBlock.style.display = 'block';
			errBlock.getElementsByTagName('p')[0].innerText = emailErr;
		}
	});
};

window.onload = () => {
	confirmation();
};

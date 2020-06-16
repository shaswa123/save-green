//--------------------------------------------------//
//                  POST REQ FOR EDIT               //
//--------------------------------------------------//
window.onload = () => {
	document.getElementById('save-changes').addEventListener('click', () => {
		document.getElementById('save-changes').submit();
	});
};

//--------------------------------------------------//
//   CHECKING VARIOUS INPUT FOR CAMPAIGN CREATION   //
//--------------------------------------------------//
window.onload = () => {
	document.getElementById('title').onkeyup = () => {
		document.getElementById('charNum').innerHTML = 20 - document.getElementById('title').value.length;
		if (20 - document.getElementById('title').value.length < 0) {
			let err = 'Title is too long';
			let errBlock = document.getElementById('err-block');
			errBlock.style.display = 'block';
			errBlock.getElementsByTagName('p')[0].innerHTML = err;
			document.getElementsByClassName('createCampBtn')[0].setAttribute('disabled', true);
		} else {
			document.getElementById('err-block').style.display = 'none';
			if (document.getElementsByClassName('createCampBtn')[0].hasAttribute('disabled'))
				document.getElementsByClassName('createCampBtn')[0].removeAttribute('disabled');
		}
	};
};

//-----------------------------------------------------//
//                  UPLOADED IMAGES                    //
//-----------------------------------------------------//

$(document).ready(function() {
	if (window.File && window.FileList && window.FileReader) {
		let imgCount = document.getElementsByClassName('uploaded_images')[0];
		$('#files').on('change', function(e) {
			if (Number(imgCount.innerHTML) < 3) {
				document.getElementById('files').removeAttribute('disabled');
				var files = e.target.files,
					filesLength = files.length;
				for (var i = 0; i < filesLength; i++) {
					var f = files[i];
					var fileReader = new FileReader();
					fileReader.onload = function(e) {
						var file = e.target;
						//e.traget.result is a base64 encoding of the image
						$(
							'<span class="pip">' +
								'<img class="imageThumb" src="' +
								e.target.result +
								'" title="' +
								file.name +
								'"/>' +
								'<br/><span class="remove">Remove image</span>' +
								'</span>'
						).insertAfter('#files');
						//If an Image is added it is important to add +1 to the count
						imgCount.innerHTML = Number(imgCount.innerHTML) + 1;
						$('.remove').click(function() {
							$(this).parent('.pip').remove();
							//When removed the count for number of images uploaded should decrease by 1
							imgCount.innerHTML = Number(imgCount.innerHTML) - 1;
						});
					};
					fileReader.readAsDataURL(f);
				}
			} else {
				//Disable the upload button
				document.getElementById('files').setAttribute('disabled', true);
			}
		});
	} else {
		alert("Your browser doesn't support to File API");
	}
});

//----------------------------------------------------//
//						SPINNER                       //
//----------------------------------------------------//

function spinnerFunc() {
	$(
		'<div class="backgroundFixed"></div>' +
			'<div class="spinnerContainer">' +
			'<h5 style="text-align:center; width:100%; margin-top:10em;">Creating a new campaign...</h5>' +
			'<p style="text-align:center; width:100%; font-size:15px; font-weight:500; color:red;">Please do not refresh your page</p>' +
			'<div class="w-100 d-flex">' +
			'<div class="spinner-border" style="margin:auto; margin-top:2em; margin-bottom:5em;" role="status">' +
			'<span class="sr-only">Loading...</span>' +
			'</div>' +
			'</div>' +
			'</div>'
	).insertAfter('#navBar');
}

//----------------------------------------------------//
//            Js BEFORE CAMPAIGN CREATION             //
//----------------------------------------------------//

window.onload = () => {
	let createCampBtn = document.getElementsByClassName('createCampBtn')[0];
	createCampBtn.addEventListener('click', () => {
		let uploadedImgs = document.getElementsByClassName('imageThumb');
		$('<input name="numerOfImages" type="hidden" value ="' + String(uploadedImgs.length) + '">').insertAfter(
			'#files'
		);
		for (let i = 0; i < uploadedImgs.length; i++) {
			// console.log(uploadedImgs[i].src);
			$(
				'<input type="hidden" name="img' + String(i) + '" value = "' + String(uploadedImgs[i].src) + '">'
			).insertAfter('#files');
		}
		let body = (document.getElementsByTagName('body')[0].style.overflowY = 'hidden');
		spinnerFunc();
		// document.getElementsByClassName('spinnerContainer')[0].scrollIntoView();
		document.getElementsByClassName('createCampClose')[0].click();
		document.getElementsByClassName('createCampSubBtn')[0].click();
	});
};

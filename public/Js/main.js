let navBg = () => {
	let flagNav = false;
	let navBar = document.getElementsByClassName('navigation-bar')[0];
	$(window).scroll(() => {
		if ($(window).scrollTop() > 500) {
			flagNav = true;
			//Add shadow
			// navBar.classList.add('shadow');
			//Make background white
			navBar.style.backgroundColor = '#2e3c4b';
			navBar.style.position = 'sticky';
			navBar.style.top = '0px';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'white';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'white';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'white';
			}
			// let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			// navToggle.style.borderColor = 'white';
		} else {
			flagNav = false;
			//navBar.remove('shadow');
			navBar.style.backgroundColor = 'transparent';
			navBar.style.position = 'absolute';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'black';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'black';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'black';
			}
			// let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			// navToggle.style.borderColor = 'black';
		}
	});
	navBar.addEventListener('mouseover', () => {
		if (!flagNav) {
			navBar.style.backgroundColor = '#2e3c4b';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'white';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'white';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'white';
			}
			// let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			// navToggle.style.borderColor = 'white';
		}
	});
	navBar.addEventListener('mouseout', () => {
		if (!flagNav) {
			navBar.style.backgroundColor = 'transparent';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'black';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'black';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'black';
			}
			// let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			// navToggle.style.borderColor = 'black';
		}
	});
};

$(window).on('load', () => {
	navBg();
	setTimeout(() => {
		let spinnerContainer = (document.getElementsByClassName('spinnerContainer')[0].style.display = 'none');
		let main_body = (document.getElementsByClassName('main-body-section')[0].style.display = 'block');
		let body = (document.getElementsByTagName('body')[0].style.overflow = 'auto');
	}, 2000);
});

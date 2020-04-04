let navBg = () => {
	let flagNav = false;
	let navBar = document.getElementsByClassName('navigation-bar')[0];
	let sectionOne = $('.section-1');
	$(window).scroll(() => {
		let oTop = $('.section-1').offset().top - window.innerHeight;
		if ($(window).scrollTop() >= oTop + 200) {
			flagNav = true;
			//Make background white
			navBar.style.backgroundColor = 'whitesmoke';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'black';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'black';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'black';
			}
			let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			navToggle.style.borderColor = 'black';
		} else if ($(window).scrollTop() < oTop + 200) {
			flagNav = false;
			navBar.style.backgroundColor = 'transparent';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'white';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'white';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'white';
			}
			let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			navToggle.style.borderColor = 'white';
		}
	});
	navBar.addEventListener('mouseover', () => {
		if (!flagNav) {
			navBar.style.backgroundColor = 'whitesmoke';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'black';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'black';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'black';
			}
			let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			navToggle.style.borderColor = 'black';
		}
	});
	navBar.addEventListener('mouseout', () => {
		if (!flagNav) {
			navBar.style.backgroundColor = 'transparent';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'white';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'white';
			}
			let navToggleLines = document.getElementsByClassName('lines');
			for (let i = 0; i < navToggleLines.length; i++) {
				navToggleLines[i].style.backgroundColor = 'white';
			}
			let navToggle = document.getElementsByClassName('navbar-toggler')[0];
			navToggle.style.borderColor = 'white';
		}
	});
};

$(window).on('load', () => {
	navBg();
});

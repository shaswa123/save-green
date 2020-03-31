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
		} else if ($(window).scrollTop() < oTop + 200) {
			flagNav = false;
			navBar.style.backgroundColor = 'transparent';
			document.getElementsByClassName('navbar-brand')[0].style.color = 'white';
			let navLinks = document.getElementsByClassName('nav-link');
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].style.color = 'white';
			}
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
		}
	});
};

// let sectionTwo = () => {
// 	let bottom = $('.section-3');
// 	let section2 = document.getElementsByClassName('section-2')[0];
// 	$(window).scroll(() => {
// 		let oTop = $('.section-2').offset().top - window.innerHeight;
// 		if ($(window).scrollTop() > oTop + 400 && $(window).scrollTop() <= $('.section-3').offset().top + 50) {
// 			section2.style.opacity = '1';
// 		} else {
// 			section2.style.opacity = '0';
// 		}
// 	});
// };

$(window).on('load', () => {
	navBg();
	// sectionTwo();
});

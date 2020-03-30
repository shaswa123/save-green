let navBar = document.getElementsByClassName('navigation-bar')[0];
let navBg = () => {
	navBar.addEventListener('mouseover', () => {
		navBar.style.backgroundColor = 'white';
		document.getElementsByClassName('navbar-brand')[0].style.color = 'black';
		let navLinks = document.getElementsByClassName('nav-link');
		for (let i = 0; i < navLinks.length; i++) {
			navLinks[i].style.color = 'black';
		}
	});
	navBar.addEventListener('mouseout', () => {
		navBar.style.backgroundColor = 'transparent';
		document.getElementsByClassName('navbar-brand')[0].style.color = 'white';
		let navLinks = document.getElementsByClassName('nav-link');
		for (let i = 0; i < navLinks.length; i++) {
			navLinks[i].style.color = 'white';
		}
	});
};

let sectionOne = $('.section-1');

$(window).scroll(() => {
	let oTop = $('.section-1').offset().top - window.innerHeight;
	if ($(window).scrollTop() >= oTop + 200) {
		//Make background white
		navBar.style.backgroundColor = 'white';
		document.getElementsByClassName('navbar-brand')[0].style.color = 'black';
		let navLinks = document.getElementsByClassName('nav-link');
		for (let i = 0; i < navLinks.length; i++) {
			navLinks[i].style.color = 'black';
		}
	} else if ($(window).scrollTop() < oTop + 200) {
		navBar.style.backgroundColor = 'transparent';
		document.getElementsByClassName('navbar-brand')[0].style.color = 'white';
		let navLinks = document.getElementsByClassName('nav-link');
		for (let i = 0; i < navLinks.length; i++) {
			navLinks[i].style.color = 'white';
		}
		navBg();
	}
});

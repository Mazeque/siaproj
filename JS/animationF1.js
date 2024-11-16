const observerLeft = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry)
        if(entry.isIntersecting) {
            entry.target.classList.add('show-left');
        } else {
            entry.target.classList.remove('show-left');
        }
    });
});

const hiddenElementsLeft = document.querySelectorAll('.hidden-left');
hiddenElementsLeft.forEach((el) => observerLeft.observe(el));

const observerRight = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry)
        if(entry.isIntersecting) {
            entry.target.classList.add('show-right');
        } else {
            entry.target.classList.remove('show-right');
        }
    });
});

const hiddenElementsRight = document.querySelectorAll('.hidden-right');
hiddenElementsRight.forEach((el) => observerRight.observe(el));

const observerBottom = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry)
        if(entry.isIntersecting) {
            entry.target.classList.add('show-bottom');
        } else {
            entry.target.classList.remove('show-bottom');
        }
    });
});

const hiddenElementsBottom = document.querySelectorAll('.hidden-bottom');
hiddenElementsBottom.forEach((el) => observerBottom.observe(el));
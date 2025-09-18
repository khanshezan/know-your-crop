gsap.registerPlugin(ScrollTrigger);

// Nav changes background color from the second page
// This will only work on larger screens to prevent issues on mobile.
if (window.innerWidth > 900) {
    gsap.to('#nav', {
        backgroundColor: "rgba(0, 0, 0, 0.3)",
        height: "110px",
        duration: 0.5,
        scrollTrigger: {
            trigger: "#nav",
            scroller: "body",
            start: "top -90%",
            end: "top -100%",
            scrub: 1
        }
    });
} else {
    // Keep nav styling consistent on mobile
    gsap.set('#nav', {
        backgroundColor: "rgba(0, 0, 0, 0.8)",
        height: "80px"
    });
}

let cards = document.querySelectorAll(".card");
let stackArea = document.querySelector(".stack-area");

function rotateCards() {
    let angle = 0;
    cards.forEach((card, index) => {
        if (card.classList.contains("away")) {
            card.style.transform = `translateY(-120vh) rotate(-48deg)`;
        } else {
            card.style.transform = `rotate(${angle}deg)`;
            angle = angle - 10;
            card.style.zIndex = cards.length - index;
        }
    });
}
rotateCards();

function handleScroll(scrollY) {
    let distance = window.innerHeight * 0.5;
    let topVal = stackArea.getBoundingClientRect().top;

    let index = -1 * (topVal / distance + 1);
    index = Math.floor(index);

    for (let i = 0; i < cards.length; i++) {
        if (i <= index) {
            cards[i].classList.add("away");
        } else {
            cards[i].classList.remove("away");
        }
    }
    rotateCards();
}

const lenis = new Lenis();

// Only apply scroll-based animations for the card stack on larger screens
if (window.innerWidth > 900) {
    lenis.on("scroll", ({ scroll }) => {
        handleScroll(scroll);
    });
}

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

// VanillaTilt for Page 3 cards
VanillaTilt.init(document.querySelectorAll(".p3card"), {
    max: 15,
    speed: 450,
    glare: true,
    "max-glare": 1,
});
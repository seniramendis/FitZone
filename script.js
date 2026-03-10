// ==========================================
// HERO SLIDER LOGIC
// ==========================================
const heroQuotes = [
    {
        heading: "Modernizing Your Fitness Journey",
        subtext: "The most trusted health and wellness center in Kurunegala. Access high-end equipment, professional trainers, and dynamic classes.",
        image: "https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1920&auto=format&fit=crop" 
    },
    {
        heading: "Push Your Limits, Achieve Your Goals",
        subtext: "Elevate your fitness with personalized training, dynamic group classes, and premium equipment right here in Kurunegala.",
        image: "https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=1920&auto=format&fit=crop" 
    },
    {
        heading: "Balance Your Life, Empower Your Body",
        subtext: "More than just a gym. Experience a holistic approach to physical and mental well-being with Kurunegala's premier fitness experts.",
        image: "https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=1920&auto=format&fit=crop" 
    },
    {
        heading: "Sweat Today. Shine Tomorrow.",
        subtext: "Your ultimate fitness destination in Kurunegala. State-of-the-art facilities, expert coaching, and a community that pushes you forward.",
        image: "https://images.unsplash.com/photo-1558611848-73f7eb4001a1?q=80&w=1920&auto=format&fit=crop" 
    }
];

let currentIndex = 0;
const textSlider = document.getElementById('text-slider');
const headingElement = document.getElementById('hero-heading');
const subtextElement = document.getElementById('hero-subtext');
const heroSection = document.querySelector('.hero');

function changeHeroText() {
    textSlider.classList.add('fade-out');
    
    setTimeout(() => {
        currentIndex = (currentIndex + 1) % heroQuotes.length;
        
        headingElement.textContent = heroQuotes[currentIndex].heading;
        subtextElement.textContent = heroQuotes[currentIndex].subtext;
        heroSection.style.backgroundImage = `url('${heroQuotes[currentIndex].image}')`;
        
        textSlider.classList.remove('fade-out');
    }, 500); 
}

setInterval(changeHeroText, 5000);

// ==========================================
// MOBILE MENU TOGGLE LOGIC
// ==========================================
const mobileMenu = document.getElementById('mobile-menu');
const navContainer = document.getElementById('nav-container');
const header = document.getElementById('main-header'); // Target the header

if (mobileMenu) {
    mobileMenu.addEventListener('click', () => {
        // Toggle the classes to show/hide menu and hide logo
        navContainer.classList.toggle('active');
        header.classList.toggle('menu-open'); 
        
        // Change the icon from a hamburger (bars) to an 'X' (xmark)
        const icon = mobileMenu.querySelector('i');
        if (navContainer.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-xmark');
        } else {
            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');
        }
    });
}
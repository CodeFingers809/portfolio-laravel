import './bootstrap';

// Terminal typing effect
class TerminalTyper {
    constructor(element, text, speed = 50) {
        this.element = element;
        this.text = text;
        this.speed = speed;
        this.index = 0;
    }

    type() {
        if (this.index < this.text.length) {
            this.element.textContent += this.text.charAt(this.index);
            this.index++;
            setTimeout(() => this.type(), this.speed);
        }
    }

    start() {
        this.element.textContent = '';
        this.type();
    }
}

// Time-based Theme Manager
class ThemeManager {
    constructor() {
        this.themes = {
            morning: { start: 6, end: 11 },   // 06:00 - 11:59
            day: { start: 12, end: 16 },      // 12:00 - 16:59
            sunset: { start: 17, end: 20 },   // 17:00 - 20:59
            night: { start: 21, end: 5 }      // 21:00 - 05:59
        };
        this.themeOrder = ['morning', 'day', 'sunset', 'night'];
        this.currentTheme = null;
    }

    getTodayDate() {
        const now = new Date();
        return `${now.getFullYear()}-${now.getMonth() + 1}-${now.getDate()}`;
    }

    getUserPreference() {
        const savedTheme = localStorage.getItem('user-theme-preference');
        const savedDate = localStorage.getItem('user-theme-date');
        const today = this.getTodayDate();

        // Return saved preference only if it's from today
        if (savedTheme && savedDate === today) {
            return savedTheme;
        }

        // Clear old preference
        localStorage.removeItem('user-theme-preference');
        localStorage.removeItem('user-theme-date');
        return null;
    }

    saveUserPreference(theme) {
        localStorage.setItem('user-theme-preference', theme);
        localStorage.setItem('user-theme-date', this.getTodayDate());
    }

    getCurrentTheme() {
        const hour = new Date().getHours();

        if (hour >= this.themes.morning.start && hour <= this.themes.morning.end) {
            return 'morning';
        } else if (hour >= this.themes.day.start && hour <= this.themes.day.end) {
            return 'day';
        } else if (hour >= this.themes.sunset.start && hour <= this.themes.sunset.end) {
            return 'sunset';
        } else {
            return 'night';
        }
    }

    getNextTheme() {
        const currentIndex = this.themeOrder.indexOf(this.currentTheme);
        const nextIndex = (currentIndex + 1) % this.themeOrder.length;
        return this.themeOrder[nextIndex];
    }

    applyTheme(theme, savePreference = false) {
        // Remove all theme classes
        document.body.classList.remove('theme-morning', 'theme-day', 'theme-sunset', 'theme-night');

        // Apply new theme
        document.body.classList.add(`theme-${theme}`);
        this.currentTheme = theme;

        // Store in localStorage for consistency
        localStorage.setItem('current-theme', theme);
        localStorage.setItem('theme-timestamp', Date.now().toString());

        // Save user preference if requested
        if (savePreference) {
            this.saveUserPreference(theme);
        }

        // Update theme button
        this.updateThemeButton(theme);

        console.log(`Applied theme: ${theme}${savePreference ? ' (saved for today)' : ''}`);
    }

    updateThemeButton(theme) {
        const button = document.getElementById('theme-toggle');
        const iconSpan = document.getElementById('theme-icon');
        const nameText = document.getElementById('theme-name-text');

        const themeIcons = {
            morning: '☀️',
            day: '🌤️',
            sunset: '🌅',
            night: '🌙'
        };

        const themeNames = {
            morning: 'morning',
            day: 'day',
            sunset: 'sunset',
            night: 'night'
        };

        if (button) {
            button.setAttribute('aria-label', `Current theme: ${theme}. Click to change.`);
        }

        if (iconSpan) {
            iconSpan.textContent = themeIcons[theme];
        }

        if (nameText) {
            nameText.textContent = themeNames[theme];
        }
    }

    cycleTheme() {
        const nextTheme = this.getNextTheme();
        this.applyTheme(nextTheme, true);
        this.showToast(nextTheme);
    }

    showToast(theme) {
        // Remove existing toast if any
        const existingToast = document.querySelector('.theme-toast');
        if (existingToast) {
            existingToast.remove();
        }

        // Create new toast
        const toast = document.createElement('div');
        toast.className = 'theme-toast';

        const themeNames = {
            morning: 'Morning Mode',
            day: 'Day Mode',
            sunset: 'Sunset Mode',
            night: 'Night Mode'
        };

        const themeIcons = {
            morning: '☀️',
            day: '🌤️',
            sunset: '🌅',
            night: '🌙'
        };

        toast.textContent = `${themeIcons[theme]} ${themeNames[theme]} - Saved for today`;
        document.body.appendChild(toast);

        // Show toast
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        // Hide and remove toast after 2 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 2000);
    }

    init() {
        // Check if user has a preference for today
        const userPreference = this.getUserPreference();

        let theme;
        if (userPreference) {
            // Use user's saved preference for today
            theme = userPreference;
            console.log('Using saved user preference:', theme);
        } else {
            // Use time-based theme
            theme = this.getCurrentTheme();
        }

        this.applyTheme(theme);

        // Setup theme toggle button
        const themeButton = document.getElementById('theme-toggle');
        if (themeButton) {
            themeButton.addEventListener('click', () => {
                this.cycleTheme();
            });
        }

        // Update theme every minute to catch time changes (only if no user preference)
        setInterval(() => {
            const currentUserPreference = this.getUserPreference();

            // Only auto-update if user hasn't set a preference for today
            if (!currentUserPreference) {
                const newTheme = this.getCurrentTheme();
                const currentTheme = localStorage.getItem('current-theme');

                if (newTheme !== currentTheme) {
                    this.applyTheme(newTheme);
                }
            }
        }, 60000); // Check every minute
    }
}

// Initialize theme manager before other effects
const themeManager = new ThemeManager();
themeManager.init();

// Initialize terminal effects
document.addEventListener('DOMContentLoaded', () => {
    // Intro Loader Animation
    const introLoader = document.getElementById('intro-loader');
    const percentageDisplay = document.getElementById('loading-percentage');
    const mainContent = document.getElementById('main-content');

    // Check if this is the first visit in this session
    const hasSeenLoader = sessionStorage.getItem('hasSeenLoader');

    if (introLoader && percentageDisplay && mainContent) {
        if (hasSeenLoader) {
            // Skip loader, show content immediately
            introLoader.remove();
            mainContent.classList.remove('opacity-0');
            mainContent.classList.add('opacity-100');
        } else {
            // Show loader animation
            let percentage = 0;
            const duration = 3000; // 3 seconds
            const startTime = Date.now();

            // Animate percentage counter
            const updatePercentage = () => {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Easing function for smoother animation
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                percentage = Math.floor(easeOutQuart * 100);

                percentageDisplay.textContent = percentage;

                if (percentage < 100) {
                    requestAnimationFrame(updatePercentage);
                } else {
                    // Mark that user has seen the loader
                    sessionStorage.setItem('hasSeenLoader', 'true');

                    // Wait a bit before fading out
                    setTimeout(() => {
                        introLoader.classList.add('fade-out');
                        // Show main content
                        mainContent.classList.remove('opacity-0');
                        mainContent.classList.add('opacity-100');
                        // Remove loader from DOM after transition
                        setTimeout(() => {
                            introLoader.remove();
                        }, 500);
                    }, 500);
                }
            };

            // Start the animation after a brief delay
            setTimeout(() => {
                updatePercentage();
            }, 100);
        }
    }

    // Typing effect for elements with data-type attribute
    document.querySelectorAll('[data-type]').forEach(element => {
        const text = element.getAttribute('data-type');
        const speed = parseInt(element.getAttribute('data-speed')) || 50;
        const typer = new TerminalTyper(element, text, speed);

        // Use IntersectionObserver to start typing when element is visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    typer.start();
                    observer.unobserve(element);
                }
            });
        }, { threshold: 0.1 });

        observer.observe(element);
    });

    // Parallax effect for hero section
    const handleParallax = () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('[data-parallax]');

        parallaxElements.forEach(element => {
            const speed = parseFloat(element.getAttribute('data-parallax')) || 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    };

    window.addEventListener('scroll', handleParallax);

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '#!') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in-section').forEach(section => {
        observer.observe(section);
    });

    // Scroll-triggered animations with different effects
    const scrollAnimateObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const animationType = element.getAttribute('data-animate');
                const delay = element.getAttribute('data-delay') || 0;

                setTimeout(() => {
                    if (animationType) {
                        element.classList.add(animationType);
                    }
                }, delay);

                scrollAnimateObserver.unobserve(element);
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -80px 0px'
    });

    // Apply animations to different sections
    document.querySelectorAll('.scroll-animate').forEach(element => {
        scrollAnimateObserver.observe(element);
    });

    // Matrix rain effect (optional, for background)
    const createMatrixRain = () => {
        const canvas = document.getElementById('matrix-canvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const chars = '01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
        const fontSize = 14;
        const columns = canvas.width / fontSize;
        const drops = [];

        for (let i = 0; i < columns; i++) {
            drops[i] = 1;
        }

        function draw() {
            // Get theme colors from CSS variables
            const bgColor = getComputedStyle(document.body).getPropertyValue('--theme-bg-primary');
            const textColor = getComputedStyle(document.body).getPropertyValue('--theme-text-accent');

            ctx.fillStyle = bgColor + '0D'; // 5% opacity
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = textColor + '66'; // 40% opacity
            ctx.font = fontSize + 'px monospace';

            for (let i = 0; i < drops.length; i++) {
                const text = chars[Math.floor(Math.random() * chars.length)];
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);

                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
                drops[i]++;
            }
        }

        setInterval(draw, 33);

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    };

    createMatrixRain();

    // Glitch effect trigger
    document.querySelectorAll('.glitch-trigger').forEach(element => {
        element.addEventListener('mouseenter', () => {
            element.classList.add('glitch-effect');
            setTimeout(() => {
                element.classList.remove('glitch-effect');
            }, 300);
        });
    });

    // Pixelated Globe
    const createPixelGlobe = () => {
        const canvas = document.getElementById('globe-canvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const centerX = 100;
        const centerY = 100;
        const radius = 80;
        let rotation = 0;

        // Generate pixelated dots on sphere
        const dots = [];
        const pixelSize = 4;

        for (let lat = -90; lat <= 90; lat += 15) {
            for (let lon = 0; lon < 360; lon += 15) {
                const phi = (lat * Math.PI) / 180;
                const theta = (lon * Math.PI) / 180;

                const x = radius * Math.cos(phi) * Math.cos(theta);
                const y = radius * Math.cos(phi) * Math.sin(theta);
                const z = radius * Math.sin(phi);

                dots.push({ x, y, z, originalLon: lon });
            }
        }

        function drawGlobe() {
            // Get theme colors from CSS variables
            const borderColor = getComputedStyle(document.body).getPropertyValue('--theme-text-accent').trim();

            ctx.clearRect(0, 0, 200, 200);

            // Draw outer circle
            ctx.strokeStyle = borderColor + '80'; // 50% opacity
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
            ctx.stroke();

            // Draw equator
            ctx.strokeStyle = borderColor + '4D'; // 30% opacity
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.ellipse(centerX, centerY, radius, radius * 0.3, 0, 0, Math.PI * 2);
            ctx.stroke();

            // Draw meridians
            for (let i = 0; i < 4; i++) {
                const angle = (i * Math.PI) / 4;
                ctx.save();
                ctx.translate(centerX, centerY);
                ctx.rotate(angle);
                ctx.beginPath();
                ctx.ellipse(0, 0, radius * 0.3, radius, 0, 0, Math.PI * 2);
                ctx.stroke();
                ctx.restore();
            }

            // Sort and draw dots
            const rotatedDots = dots.map(dot => {
                const lon = dot.originalLon + rotation;
                const theta = (lon * Math.PI) / 180;
                const phi = Math.asin(dot.z / radius);

                const x = radius * Math.cos(phi) * Math.cos(theta);
                const y = radius * Math.cos(phi) * Math.sin(theta);
                const z = dot.z;

                return { x, y, z };
            }).sort((a, b) => a.y - b.y); // Sort by depth

            // Get theme color for dots
            const dotColor = getComputedStyle(document.body).getPropertyValue('--theme-text-secondary').trim();

            rotatedDots.forEach(dot => {
                if (dot.y > -radius * 0.8) { // Only draw front-facing dots
                    const screenX = centerX + dot.x;
                    const screenY = centerY + dot.z;
                    const brightness = (dot.y + radius) / (2 * radius);

                    ctx.fillStyle = dotColor + Math.floor(brightness * 0.8 * 255).toString(16).padStart(2, '0');
                    ctx.fillRect(
                        Math.floor(screenX / pixelSize) * pixelSize,
                        Math.floor(screenY / pixelSize) * pixelSize,
                        pixelSize,
                        pixelSize
                    );
                }
            });

            rotation += 1;
            requestAnimationFrame(drawGlobe);
        }

        drawGlobe();
    };

    createPixelGlobe();

    // Text Fill Animation on Scroll
    const textFillElements = document.querySelectorAll('.text-fill-animate');

    const updateTextFill = () => {
        textFillElements.forEach(element => {
            const rect = element.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Calculate what percentage of the element is visible
            // Element starts filling when it enters the bottom 70% of viewport
            // and completes when it reaches the top 30% of viewport
            const triggerStart = windowHeight * 0.8;
            const triggerEnd = windowHeight * 0.2;

            let fillPercent = 0;

            if (rect.top < triggerStart && rect.bottom > triggerEnd) {
                // Calculate fill based on position
                const totalRange = triggerStart - triggerEnd;
                const currentPosition = triggerStart - rect.top;
                fillPercent = Math.min(Math.max((currentPosition / totalRange) * 100, 0), 100);
            } else if (rect.top <= triggerEnd) {
                // Fully visible
                fillPercent = 100;
            }

            element.style.setProperty('--fill-percent', `${fillPercent}%`);
        });
    };

    // Run on scroll
    window.addEventListener('scroll', updateTextFill, { passive: true });

    // Initial check
    updateTextFill();

    // Radial Progress Circle Animation
    const animateRadialProgress = () => {
        const progressCircles = document.querySelectorAll('.radial-progress-fill');

        progressCircles.forEach(circle => {
            const value = parseInt(circle.getAttribute('data-value'));
            const radius = 90;
            const circumference = 2 * Math.PI * radius;
            const offset = circumference - (value / 100) * circumference;

            // Set the stroke-dashoffset for the animation
            circle.style.strokeDashoffset = offset;
        });
    };

    // Observe radial progress circles and animate when visible
    const radialProgressObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const circle = entry.target.querySelector('.radial-progress-fill');
                if (circle && !circle.hasAttribute('data-animated')) {
                    circle.setAttribute('data-animated', 'true');

                    // Trigger animation
                    const value = parseInt(circle.getAttribute('data-value'));
                    const radius = 90;
                    const circumference = 2 * Math.PI * radius;
                    const offset = circumference - (value / 100) * circumference;

                    circle.style.strokeDashoffset = offset;
                }
                radialProgressObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.3
    });

    // Observe all radial progress elements
    document.querySelectorAll('.radial-progress').forEach(progress => {
        radialProgressObserver.observe(progress);
    });
});

// Copy to clipboard functionality
window.copyToClipboard = function(text, element) {
    navigator.clipboard.writeText(text).then(() => {
        // Show feedback
        const originalHTML = element.innerHTML;
        const feedback = document.createElement('div');
        feedback.className = 'absolute inset-0 flex items-center justify-center bg-zinc-700/20 rounded';
        feedback.innerHTML = '<span class="text-zinc-300 text-sm font-semibold">Copied!</span>';
        element.style.position = 'relative';
        element.appendChild(feedback);

        setTimeout(() => {
            feedback.remove();
        }, 1500);
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
};

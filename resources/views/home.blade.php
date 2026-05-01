<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage Pro | Modern School Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            overflow-x: hidden;
          
        }
        
        .hero-section {
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                        url('https://images.unsplash.com/photo-1536337005238-94b997371b40?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=869') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }
        
        .features-section {
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            padding: 100px 0;
        }
        
        .testimonials-section {
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                        url('https://images.unsplash.com/photo-1529390079861-591de354faf5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            padding: 100px 0;
        }
        
        .stats-section {
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                        url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            padding: 100px 0;
        }
        
        .contact-section {
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                        url('https://plus.unsplash.com/premium_photo-1683195786201-9bdb8afcd78c?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870') no-repeat center center/cover;
            padding: 100px 0;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }
        
        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        
        .animate-slide-up {
            animation: slideUp 1s ease-in-out;
        }
        
        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .navbar {
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background-color: rgba(15, 23, 42, 0.95);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }
        
        .navbar.scrolled .nav-link {
            color: #e2e8f0;
        }
        
        .navbar.scrolled .logo {
            color: #60a5fa;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar fixed w-full z-50 py-4 px-6 md:px-12 flex justify-between items-center">
        <div class="logo text-2xl font-bold text-white">EduManage<span class="text-blue-400">Pro</span></div>
        
        <div class="nav-links hidden md:flex space-x-8">
            <a href="/home" class="nav-link text-white font-medium hover:text-blue-300 transition">Home</a>
            <a href="/about" class="nav-link text-white font-medium hover:text-blue-300 transition">About</a>
            <a href="/contact" class="nav-link text-white font-medium hover:text-blue-300 transition">Contact</a>
            <a href="/blog" class="nav-link text-white font-medium hover:text-blue-300 transition">Blog</a>
        </div>
        
        <div class="nav-buttons flex space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-lg">Portal</a>
            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition shadow-lg">Check Result</a>
        </div>
        
        <!-- Mobile menu button -->
        <button class="md:hidden text-white text-2xl">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container mx-auto px-6 md:px-12 animate-fade-in">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-slide-up">Modern School Management <span class="text-blue-400">Simplified</span></h1>
                <p class="text-xl mb-8 animate-slide-up">Streamline your educational institution with our all-in-one platform designed for efficiency, engagement, and excellence.</p>
                <div class="flex space-x-4 animate-slide-up">
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition shadow-lg">Get Started</a>
                    <a href="#" class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white px-6 py-3 rounded-lg font-medium transition">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-4xl font-bold text-center mb-16 animate-fade-in">Why Choose <span class="text-blue-400">EduManage Pro</span>?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-800 bg-opacity-70 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up">
                    <div class="text-blue-400 text-4xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Advanced Analytics</h3>
                    <p class="mb-4">Gain insights into student performance, attendance trends, and institutional metrics with our powerful analytics dashboard.</p>
                    <a href="#" class="text-blue-300 font-medium flex items-center">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-slate-800 bg-opacity-70 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="text-blue-400 text-4xl mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Parent-Teacher Portal</h3>
                    <p class="mb-4">Foster collaboration between educators and parents with real-time updates, messaging, and progress tracking.</p>
                    <a href="#" class="text-blue-300 font-medium flex items-center">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-slate-800 bg-opacity-70 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="text-blue-400 text-4xl mb-4">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Mobile-First Design</h3>
                    <p class="mb-4">Access all features on any device with our responsive design that works seamlessly on smartphones, tablets, and desktops.</p>
                    <a href="#" class="text-blue-300 font-medium flex items-center">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-4xl font-bold text-center mb-16 animate-fade-in">What Our <span class="text-blue-400">Clients Say</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-slate-800 bg-opacity-70 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1540569876033-6e5d046a1d77?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Principal" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <h3 class="font-bold text-xl">Dr. Michael Johnson</h3>
                            <p class="text-blue-300">Principal, Greenfield High School</p>
                        </div>
                    </div>
                    <p class="italic">"EduManage Pro has transformed how we manage our school. The parent engagement has increased by 40% since implementation."</p>
                    <div class="flex text-yellow-400 mt-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-slate-800 bg-opacity-70 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1361&q=80" alt="Teacher" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <h3 class="font-bold text-xl">Sarah Williams</h3>
                            <p class="text-blue-300">Teacher, Riverside Elementary</p>
                        </div>
                    </div>
                    <p class="italic">"The gradebook and attendance features have saved me hours each week. I can focus more on teaching and less on paperwork."</p>
                    <div class="flex text-yellow-400 mt-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-4xl font-bold text-center mb-16 animate-fade-in">Our <span class="text-blue-400">Impact</span> in Numbers</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <!-- Stat 1 -->
                <div class="animate-pulse-slow">
                    <div class="text-5xl font-bold text-blue-400 mb-2">500+</div>
                    <p class="text-xl">Schools Using Our Platform</p>
                </div>
                
                <!-- Stat 2 -->
                <div class="animate-pulse-slow" style="animation-delay: 0.5s;">
                    <div class="text-5xl font-bold text-blue-400 mb-2">75K+</div>
                    <p class="text-xl">Students Managed</p>
                </div>
                
                <!-- Stat 3 -->
                <div class="animate-pulse-slow" style="animation-delay: 1s;">
                    <div class="text-5xl font-bold text-blue-400 mb-2">98%</div>
                    <p class="text-xl">Customer Satisfaction</p>
                </div>
                
                <!-- Stat 4 -->
                <div class="animate-pulse-slow" style="animation-delay: 1.5s;">
                    <div class="text-5xl font-bold text-blue-400 mb-2">24/7</div>
                    <p class="text-xl">Support Available</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <div class="max-w-4xl mx-auto bg-slate-800 bg-opacity-70 backdrop-blur-lg rounded-xl p-8 md:p-12 card-hover animate-slide-up">
                <h2 class="text-4xl font-bold text-center mb-8">Get In <span class="text-blue-400">Touch</span></h2>
                
                <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block mb-2">Full Name</label>
                        <input type="text" id="name" class="w-full bg-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Your Name">
                    </div>
                    
                    <div>
                        <label for="email" class="block mb-2">Email Address</label>
                        <input type="email" id="email" class="w-full bg-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Your Email">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="subject" class="block mb-2">Subject</label>
                        <input type="text" id="subject" class="w-full bg-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Subject">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="message" class="block mb-2">Message</label>
                        <textarea id="message" rows="5" class="w-full bg-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Your Message"></textarea>
                    </div>
                    
                    <div class="md:col-span-2 text-center">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition shadow-lg">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">EduManage<span class="text-blue-400">Pro</span></h3>
                    <p class="mb-4">Modern school management solutions for the digital age.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <a href="/home" class="nav-link text-white font-medium hover:text-blue-300 transition">Home</a>
            <a href="/about" class="nav-link text-white font-medium hover:text-blue-300 transition">About</a>
            <a href="/contact" class="nav-link text-white font-medium hover:text-blue-300 transition">Contact</a>
            <a href="/blog" class="nav-link text-white font-medium hover:text-blue-300 transition">Blog</a>
     
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="/blog" class="hover:text-blue-400 transition">Blog</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Documentation</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Support</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">FAQ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Contact Info</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-2 mt-1 text-blue-400"></i>
                            <span>123 Education Street, Learning City</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mr-2 mt-1 text-blue-400"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mr-2 mt-1 text-blue-400"></i>
                            <span>info@edumanagepro.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 mt-8 pt-8 text-center">
                <p>&copy; 2025 EduManage Pro. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-slide-up').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
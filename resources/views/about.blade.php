<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EduManage Pro</title>
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
        
        .page-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1758270704840-0ac001215b55?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1031') no-repeat center 35% /cover;
            height: 50vh;
            display: flex;
            align-items: center;
            color: white;
        }
        
        .about-section {
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            padding: 100px 0;
        }
        
        .team-section {
            background: url('https://images.unsplash.com/photo-1523059623039-a9ed027e7fad?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA') no-repeat center center/cover;
            padding: 100px 0;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        
        .animate-slide-up {
            animation: slideUp 1s ease-in-out;
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
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .navbar.scrolled .nav-link {
            color: #333;
        }
        
        .navbar.scrolled .logo {
            color: #3b82f6;
        }
        
        .active-page {
            color: #3b82f6 !important;
            font-weight: 600;
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
            <a href="{{ route('login')}}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition shadow-lg">Portal</a>
            <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition shadow-lg">Check Result</a>
        </div>
        
        <!-- Mobile menu button -->
        <button class="md:hidden text-white text-2xl">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- About Hero -->
    <section class="page-hero">
        <div class="container mx-auto px-6 md:px-12 animate-fade-in">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-slide-up">About <span class="text-blue-400">EduManage Pro</span></h1>
                <p class="text-xl animate-slide-up">Transforming education management with innovative technology solutions.</p>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-up">
                    <h2 class="text-4xl font-bold mb-6">Our <span class="text-blue-400">Mission</span></h2>
                    <p class="text-lg mb-6">At EduManage Pro, we believe that technology should empower educators, not complicate their work. Our mission is to provide schools with intuitive, comprehensive management tools that save time, improve communication, and enhance the educational experience for everyone involved.</p>
                    <p class="text-lg mb-8">Founded in 2018 by a team of educators and technologists, we've grown to serve over 500 schools worldwide, helping them streamline administrative tasks and focus on what matters most: student success.</p>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-2xl font-bold text-blue-400 mb-2">500+</h3>
                            <p>Schools Trust Us</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-blue-400 mb-2">75K+</h3>
                            <p>Students Managed</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-blue-400 mb-2">15+</h3>
                            <p>Countries Served</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-blue-400 mb-2">98%</h3>
                            <p>Client Satisfaction</p>
                        </div>
                    </div>
                </div>
                
                <div class="animate-slide-up" style="animation-delay: 0.2s;">
                    <img src="https://images.unsplash.com/photo-1594077841990-3909f3a482a9?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=774" alt="Our Team" class="rounded-xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-4xl font-bold text-center mb-16 animate-fade-in">Meet Our <span class="text-blue-400">Leadership Team</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6 text-center card-hover animate-slide-up">
                    <img src="https://images.unsplash.com/photo-1522529599102-193c0d76b5b6?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870" alt="CEO" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-2xl font-bold mb-2">Robert Johnson</h3>
                    <p class="text-blue-300 mb-4">CEO & Founder</p>
                    <p class="mb-4">Former school principal with 15+ years in education administration.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6 text-center card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <img src="https://images.unsplash.com/photo-1631131431211-4f768d89087d?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870" alt="CTO" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-2xl font-bold mb-2">Sarah Williams</h3>
                    <p class="text-blue-300 mb-4">Chief Technology Officer</p>
                    <p class="mb-4">Tech innovator with a passion for creating solutions that make a difference.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6 text-center card-hover animate-slide-up" style="animation-delay: 0.4s;">
                    <img src="https://images.unsplash.com/photo-1594077810908-9ffd89d704ac?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=774" alt="Head of Product" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-2xl font-bold mb-2">Michael Chen</h3>
                    <p class="text-blue-300 mb-4">Head of Product</p>
                    <p class="mb-4">Product visionary focused on user experience and educational impact.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
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
                        <li><a href="#" class="hover:text-blue-400 transition">Documentation</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Support</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Privacy Policy</a></li>
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
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p>&copy; 2023 EduManage Pro. All rights reserved.</p>
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
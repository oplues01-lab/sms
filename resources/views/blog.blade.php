<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - EduManage Pro</title>
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
                        url('https://images.unsplash.com/photo-1573164574397-dd250bc8a598?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=869') no-repeat center 35% /cover;
            height: 50vh;
            display: flex;
            align-items: center;
            color: white;
        }
        
        .blog-section {
            background: url('https://plus.unsplash.com/premium_photo-1714265045257-f40bdb8f6afc?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870') no-repeat center center/cover;
            padding: 100px 0;
        }
        
        .newsletter-section {
           background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
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
        
        .blog-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .blog-content {
            flex-grow: 1;
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
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition shadow-lg">Portal</a>
            <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition shadow-lg">Check Result</a>
        </div>
        
        <!-- Mobile menu button -->
        <button class="md:hidden text-white text-2xl">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Blog Hero -->
    <section class="page-hero">
        <div class="container mx-auto px-6 md:px-12 animate-fade-in">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-slide-up">Our <span class="text-blue-400">Blog</span></h1>
                <p class="text-xl animate-slide-up">Insights, tips, and news about education technology and school management.</p>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Blog Post 1 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl overflow-hidden blog-card card-hover animate-slide-up">
                    <img src="https://img.freepik.com/free-photo/teacher-using-digital-tablet-online-education_53876-102645.jpg?w=900&t=st=1690300470~exp=1690301070~hmac=3e2d6e9b8d1d5b7d8d2b9c5b0d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a" alt="Digital Learning" class="w-full h-48 object-cover">
                    <div class="p-6 blog-content">
                        <div class="flex items-center text-sm mb-3">
                            <span class="bg-blue-500 text-white px-2 py-1 rounded mr-3">Technology</span>
                            <span>August 15, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">5 Ways Technology is Transforming Classroom Learning</h3>
                        <p class="mb-4">Explore how digital tools are enhancing student engagement and improving educational outcomes in modern classrooms.</p>
                        <a href="#" class="text-blue-300 font-medium flex items-center">Read More <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
                
                <!-- Blog Post 2 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl overflow-hidden blog-card card-hover animate-slide-up" style="animation-delay: 0.1s;">
                    <img src="https://img.freepik.com/free-photo/medium-shot-woman-holding-laptop_23-2149399484.jpg?w=900&t=st=1690300486~exp=1690301086~hmac=3e2d6e9b8d1d5b7d8d2b9c5b0d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a" alt="Parent Engagement" class="w-full h-48 object-cover">
                    <div class="p-6 blog-content">
                        <div class="flex items-center text-sm mb-3">
                            <span class="bg-green-500 text-white px-2 py-1 rounded mr-3">Parent Engagement</span>
                            <span>August 8, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Boosting Parent Engagement with Digital Communication Tools</h3>
                        <p class="mb-4">Learn how schools are using technology to strengthen the home-school connection and improve student success.</p>
                        <a href="#" class="text-blue-300 font-medium flex items-center">Read More <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
                
                <!-- Blog Post 3 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl overflow-hidden blog-card card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <img src="https://img.freepik.com/free-photo/medium-shot-man-holding-laptop_23-2149399483.jpg?w=900&t=st=1690300501~exp=1690301101~hmac=3e2d6e9b8d1d5b7d8d2b9c5b0d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a" alt="Data Analytics" class="w-full h-48 object-cover">
                    <div class="p-6 blog-content">
                        <div class="flex items-center text-sm mb-3">
                            <span class="bg-purple-500 text-white px-2 py-1 rounded mr-3">Analytics</span>
                            <span>August 1, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Using Data Analytics to Improve Student Performance</h3>
                        <p class="mb-4">Discover how schools are leveraging data to identify at-risk students and implement targeted interventions.</p>
                        <a href="#" class="text-blue-300 font-medium flex items-center">Read More <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
                
                <!-- Blog Post 4 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl overflow-hidden blog-card card-hover animate-slide-up" style="animation-delay: 0.3s;">
                    <img src="https://img.freepik.com/free-photo/medium-shot-woman-holding-tablet_23-2149399485.jpg?w=900&t=st=1690300516~exp=1690301116~hmac=3e2d6e9b8d1d5b7d8d2b9c5b0d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a" alt="Remote Learning" class="w-full h-48 object-cover">
                    <div class="p-6 blog-content">
                        <div class="flex items-center text-sm mb-3">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded mr-3">Remote Learning</span>
                            <span>July 25, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Best Practices for Hybrid and Remote Learning Models</h3>
                        <p class="mb-4">A comprehensive guide to implementing effective hybrid learning strategies that work for students and teachers.</p>
                        <a href="#" class="text-blue-300 font-medium flex items-center">Read More <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
                
                <!-- Blog Post 5 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl overflow-hidden blog-card card-hover animate-slide-up" style="animation-delay: 0.4s;">
                    <img src="https://img.freepik.com/free-photo/teacher-pointing-whiteboard_23-2147878074.jpg?w=900&t=st=1690300531~exp=1690301131~hmac=3e2d6e9b8d1d5b7d8d2b9c5b0d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a" alt="Teacher Development" class="w-full h-48 object-cover">
                    <div class="p-6 blog-content">
                        <div class="flex items-center text-sm mb-3">
                            <span class="bg-red-500 text-white px-2 py-1 rounded mr-3">Professional Development</span>
                            <span>July 18, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Empowering Teachers with Professional Development Tools</h3>
                        <p class="mb-4">How technology is revolutionizing teacher training and ongoing professional development in schools.</p>
                        <a href="#" class="text-blue-300 font-medium flex items-center">Read More <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
                
                <!-- Blog Post 6 -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl overflow-hidden blog-card card-hover animate-slide-up" style="animation-delay: 0.5s;">
                    <img src="https://img.freepik.com/free-photo/medium-shot-people-working-laptop_23-2149309651.jpg?w=900&t=st=1690300546~exp=1690301146~hmac=3e2d6e9b8d1d5b7d8d2b9c5b0d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a5b5d5a" alt="Administrative Efficiency" class="w-full h-48 object-cover">
                    <div class="p-6 blog-content">
                        <div class="flex items-center text-sm mb-3">
                            <span class="bg-indigo-500 text-white px-2 py-1 rounded mr-3">Administration</span>
                            <span>July 11, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Streamlining School Administration with Automation</h3>
                        <p class="mb-4">Discover how automation tools are reducing administrative burdens and freeing up educators to focus on teaching.</p>
                        <a href="#" class="text-blue-300 font-medium flex items-center">Read More <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center mt-12 animate-fade-in">
                <nav class="flex space-x-2">
                    <a href="#" class="px-4 py-2 bg-white bg-opacity-10 rounded-lg hover:bg-blue-500 transition">Previous</a>
                    <a href="#" class="px-4 py-2 bg-blue-500 rounded-lg">1</a>
                    <a href="#" class="px-4 py-2 bg-white bg-opacity-10 rounded-lg hover:bg-blue-500 transition">2</a>
                    <a href="#" class="px-4 py-2 bg-white bg-opacity-10 rounded-lg hover:bg-blue-500 transition">3</a>
                    <a href="#" class="px-4 py-2 bg-white bg-opacity-10 rounded-lg hover:bg-blue-500 transition">Next</a>
                </nav>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <div class="max-w-3xl mx-auto bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-8 md:p-12 text-center card-hover animate-slide-up">
                <h2 class="text-4xl font-bold mb-4">Subscribe to Our <span class="text-blue-400">Newsletter</span></h2>
                <p class="text-lg mb-8">Stay updated with the latest trends in education technology, school management tips, and product updates.</p>
                
                <form class="flex flex-col md:flex-row gap-4">
                    <input type="email" placeholder="Your email address" class="flex-grow bg-white bg-opacity-20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition shadow-lg">Subscribe</button>
                </form>
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
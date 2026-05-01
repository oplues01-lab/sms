<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EduManage Pro</title>
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
                        url('https://plus.unsplash.com/premium_photo-1661717876697-1c47186f54fd?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870') no-repeat center 20% / cover;
    height: 50vh;
    display: flex;
    align-items: center;
    color: white;
           
        }
        
        .contact-section {
            background-color:grey;
            padding: 100px 0;
        }
        
        .info-section {
            background:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),  url('https://plus.unsplash.com/premium_photo-1714211557353-2be0aca291ee?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870') no-repeat center center/cover;
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
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition shadow-lg">Portal</a>
            <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition shadow-lg">Check Result</a>
        </div>
        
        <!-- Mobile menu button -->
        <button class="md:hidden text-white text-2xl">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Contact Hero -->
    <section class="page-hero">
        <div class="container mx-auto px-6 md:px-12 animate-fade-in">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-slide-up">Contact <span class="text-blue-400">Us</span></h1>
                <p class="text-xl animate-slide-up">Get in touch with our team for any inquiries or support.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section  text-black">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="animate-slide-up">
                    <h2 class="text-4xl font-bold mb-6">Get In <span class="text-blue-400">Touch</span></h2>
                    <p class="text-lg mb-8">Have questions about our school management system? Our team is here to help. Send us a message and we'll respond as soon as possible.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-blue-500 p-3 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-1">Our Location</h3>
                                <p>123 Education Street, Learning City, LC 12345</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-blue-500 p-3 rounded-lg mr-4">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-1">Phone Number</h3>
                                <p>+1 (555) 123-4567</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-blue-500 p-3 rounded-lg mr-4">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-1">Email Address</h3>
                                <p>info@edumanagepro.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-blue-500 p-3 rounded-lg mr-4">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-1">Working Hours</h3>
                                <p>Monday - Friday: 8:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-8 card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <form class="space-y-6 ">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block mb-2">Full Name</label>
                                <input type="text" id="name" class="w-full bg-white bg-opacity-20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Your Name">
                            </div>
                            
                            <div>
                                <label for="email" class="block mb-2">Email Address</label>
                                <input type="email" id="email" class="w-full bg-white bg-opacity-20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Your Email">
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block mb-2">Subject</label>
                            <input type="text" id="subject" class="w-full bg-white bg-opacity-20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Subject">
                        </div>
                        
                        <div>
                            <label for="message" class="block mb-2">Message</label>
                            <textarea id="message" rows="5" class="w-full bg-white bg-opacity-20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Your Message"></textarea>
                        </div>
                        
                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-medium transition shadow-lg w-full">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section text-white">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-4xl font-bold text-center mb-16 animate-fade-in">Frequently Asked <span class="text-blue-400">Questions</span></h2>
            
            <div class="max-w-3xl mx-auto space-y-6">
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up">
                    <h3 class="text-xl font-bold mb-2 flex justify-between items-center">
                        <span>How long does it take to implement EduManage Pro?</span>
                        <i class="fas fa-chevron-down text-blue-400"></i>
                    </h3>
                    <p class="mt-2">Most schools can be up and running within 2-4 weeks, depending on the size of your institution and specific requirements. We provide comprehensive onboarding and training to ensure a smooth transition.</p>
                </div>
                
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up" style="animation-delay: 0.1s;">
                    <h3 class="text-xl font-bold mb-2 flex justify-between items-center">
                        <span>Do you offer training for staff and teachers?</span>
                        <i class="fas fa-chevron-down text-blue-400"></i>
                    </h3>
                    <p class="mt-2">Yes, we provide comprehensive training sessions for administrators, teachers, and staff. This includes live webinars, video tutorials, and documentation to ensure everyone feels comfortable using the system.</p>
                </div>
                
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <h3 class="text-xl font-bold mb-2 flex justify-between items-center">
                        <span>Can EduManage Pro integrate with our existing systems?</span>
                        <i class="fas fa-chevron-down text-blue-400"></i>
                    </h3>
                    <p class="mt-2">Our platform offers API integration capabilities and can often connect with existing student information systems, accounting software, and other educational tools. Contact us to discuss your specific integration needs.</p>
                </div>
                
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6 card-hover animate-slide-up" style="animation-delay: 0.3s;">
                    <h3 class="text-xl font-bold mb-2 flex justify-between items-center">
                        <span>What kind of support do you provide?</span>
                        <i class="fas fa-chevron-down text-blue-400"></i>
                    </h3>
                    <p class="mt-2">We offer 24/7 technical support via email, phone, and live chat. Our dedicated support team is always available to help resolve any issues and answer your questions promptly.</p>
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
        
        // FAQ accordion functionality
        document.querySelectorAll('.bg-white.bg-opacity-10 h3').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                const icon = header.querySelector('i');
                
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    content.style.display = 'block';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        });
    </script>
</body>
</html>
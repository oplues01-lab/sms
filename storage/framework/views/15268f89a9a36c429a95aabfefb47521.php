<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        
        <style>
            /* Select2 Styling */
            .select2-container--default .select2-selection--multiple {
                border-color: #d1d5db;
                border-radius: 0.5rem;
                padding: 0.375rem;
                min-height: 42px;
            }
            
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #4f46e5;
                border-color: #4338ca;
                color: white;
                border-radius: 0.375rem;
                padding: 0.25rem 0.5rem;
            }
            
            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                color: white;
                margin-right: 0.25rem;
            }
            
            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
                color: #fca5a5;
            }
            
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            
            ::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 10px;
            }
            
            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
            
            /* Smooth scrolling */
            html {
                scroll-behavior: smooth;
            }
            
            /* Page transitions */
            .page-transition {
                animation: fadeIn 0.3s ease-in;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Card shadows */
            .card-shadow {
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            }
            
            .card-shadow:hover {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                transition: box-shadow 0.3s ease;
            }
            
            /* Loading spinner */
            .spinner {
                border: 3px solid #f3f4f6;
                border-top: 3px solid #4f46e5;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            /* Responsive design improvements */
            @media (max-width: 768px) {
                aside {
                    position: fixed;
                    left: -100%;
                    transition: left 0.3s ease;
                    z-index: 50;
                }
                
                aside.mobile-open {
                    left: 0;
                }
                
                .mobile-overlay {
                    display: none;
                    position: fixed;
                    inset: 0;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 40;
                }
                
                .mobile-overlay.active {
                    display: block;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay"></div>
        
        <div class="min-h-screen flex">
            <!-- Sidebar Navigation -->
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Mobile Menu Button -->
                <div class="lg:hidden bg-white border-b border-gray-200 p-4">
                    <button id="mobileMenuBtn" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Page Heading -->
                <?php if(isset($header)): ?>
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            <?php echo e($header); ?>

                        </div>
                    </header>
                <?php endif; ?>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-50 page-transition">
                    <?php echo e($slot); ?>

                </main>
                
                <!-- Footer -->
                <footer class="bg-white border-t border-gray-200 py-4 px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
                        <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Laravel')); ?>. All rights reserved.</p>
                    </div>
                </footer>
            </div>
        </div>

        <!-- jQuery (required by Select2) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Initialize Select2 -->
        <script>
            $(document).ready(function() {
                // Initialize Select2 for permission selects
                $('#permission_ids_assign').select2({
                    placeholder: 'Select permissions to assign',
                    width: '100%',
                    theme: 'default'
                });

                $('#permission_ids_revoke').select2({
                    placeholder: 'Select permissions to revoke',
                    width: '100%',
                    theme: 'default'
                });
                
                // Initialize all other select2 elements
                $('.select2').select2({
                    width: '100%',
                    theme: 'default'
                });
            });
            
            // Mobile menu functionality
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.querySelector('aside');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            if (mobileMenuBtn && sidebar && mobileOverlay) {
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                    mobileOverlay.classList.toggle('active');
                });
                
                mobileOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                    mobileOverlay.classList.remove('active');
                });
            }
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                });
            }, 5000);
        </script>
        
        <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\layouts\app.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration - Otak-Atik Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
</head>
<body>
    <div id="app">
        <div class="min-h-screen flex items-center justify-center p-4" style="background: linear-gradient(135deg, #F1561A 0%, #FF6B35 100%);">
            <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">
                
                <!-- Left Side - Form -->
                <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                    <h1 class="text-5xl lg:text-6xl font-bold mb-8 lg:mb-12 text-gray-900">Registration</h1>
                    
                    <!-- Alert Messages -->
                    <div v-if="successMessage" class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        @{{ successMessage }}
                    </div>
                    
                    <div v-if="errorMessage" class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        @{{ errorMessage }}
                    </div>
                    
                    <form @submit.prevent="handleSubmit" class="space-y-6">
                        <!-- Username Field -->
                        <div>
                            <input
                                v-model="form.username"
                                type="text"
                                placeholder="Username"
                                class="w-full px-6 py-4 bg-gray-200 rounded-2xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                required
                            />
                            <p v-if="errors.username" class="mt-2 text-sm text-red-600">@{{ errors.username[0] }}</p>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <input
                                v-model="form.email"
                                type="email"
                                placeholder="Email"
                                class="w-full px-6 py-4 bg-gray-200 rounded-2xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                required
                            />
                            <p v-if="errors.email" class="mt-2 text-sm text-red-600">@{{ errors.email[0] }}</p>
                        </div>

                        <!-- Password Field -->
                        <div class="relative">
                            <input
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                placeholder="Password"
                                class="w-full px-6 py-4 bg-gray-200 rounded-2xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                required
                            />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                            <p v-if="errors.password" class="mt-2 text-sm text-red-600">@{{ errors.password[0] }}</p>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full py-4 rounded-2xl font-semibold text-white text-xl transition-all hover:opacity-90 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                            style="background-color: #004ED4;"
                        >
                            <span v-if="!loading">Sign Up</span>
                            <span v-else>Loading...</span>
                        </button>
                    </form>
                </div>

                <!-- Right Side - Illustration -->
                <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center p-8" style="background: linear-gradient(135deg, #2D7A5F 0%, #3D8B6F 100%);">
                    <div class="text-center relative z-10">
                        <!-- Exclamation Icon -->
                        <div class="mb-6 flex justify-center">
                            <div class="bg-white rounded-2xl px-6 py-4 transform -rotate-12 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-700" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Welcome Text -->
                        <h2 class="text-5xl font-bold text-white mb-8 drop-shadow-lg">Welcome Back!</h2>
                        
                        <!-- Sign In Section -->
                        <div class="mb-8">
                            <p class="text-blue-600 font-semibold text-xl mb-4">Already have an account?</p>
                            <a
                                href="/login"
                                class="inline-block px-8 py-3 border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-green-700 transition-all"
                            >
                                Sign In
                            </a>
                        </div>

                        <!-- Koala Illustration -->
                        <div class="mt-8">
                            <div class="relative inline-block">
                                <!-- Koala Face -->
                                <div class="w-64 h-64 bg-gray-400 rounded-full relative shadow-2xl">
                                    <!-- Ears -->
                                    <div class="absolute -top-8 left-8 w-24 h-32 bg-gray-400 rounded-full"></div>
                                    <div class="absolute -top-8 right-8 w-24 h-32 bg-gray-400 rounded-full"></div>
                                    
                                    <!-- Inner Ears -->
                                    <div class="absolute top-0 left-12 w-16 h-20 bg-gray-500 rounded-full"></div>
                                    <div class="absolute top-0 right-12 w-16 h-20 bg-gray-500 rounded-full"></div>
                                    
                                    <!-- Eyes -->
                                    <div class="absolute top-20 left-12 w-12 h-16 bg-white rounded-full shadow-inner">
                                        <div class="absolute top-2 left-2 w-8 h-12 bg-black rounded-full">
                                            <div class="absolute top-2 right-1 w-3 h-4 bg-white rounded-full"></div>
                                        </div>
                                    </div>
                                    <div class="absolute top-20 right-12 w-12 h-16 bg-white rounded-full shadow-inner">
                                        <div class="absolute top-2 right-2 w-8 h-12 bg-black rounded-full">
                                            <div class="absolute top-2 left-1 w-3 h-4 bg-white rounded-full"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Nose -->
                                    <div class="absolute top-36 left-1/2 -translate-x-1/2 w-12 h-10 bg-gray-600 rounded-full"></div>
                                    
                                    <!-- Cheeks -->
                                    <div class="absolute top-40 left-8 w-10 h-8 bg-pink-300 rounded-full opacity-80"></div>
                                    <div class="absolute top-40 right-8 w-10 h-8 bg-pink-300 rounded-full opacity-80"></div>
                                    
                                    <!-- Mouth -->
                                    <div class="absolute top-44 left-1/2 -translate-x-1/2 w-16 h-10 bg-pink-400 rounded-b-full"></div>
                                    <div class="absolute top-44 left-1/2 -translate-x-1/2 w-16 h-2 bg-gray-400"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10 overflow-hidden">
                        <div class="text-9xl font-bold text-white transform rotate-12 mt-20">
                            01010101
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    form: {
                        username: '',
                        email: '',
                        password: ''
                    },
                    showPassword: false,
                    loading: false,
                    successMessage: '',
                    errorMessage: '',
                    errors: {}
                }
            },
            methods: {
                async handleSubmit() {
                    this.loading = true;
                    this.successMessage = '';
                    this.errorMessage = '';
                    this.errors = {};

                    try {
                        const response = await fetch('/api/register', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.form)
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.successMessage = 'Registration successful! Redirecting to login...';
                            this.form = {
                                username: '',
                                email: '',
                                password: ''
                            };
                            
                            // Redirect ke login setelah 2 detik
                            setTimeout(() => {
                                window.location.href = '/login';
                            }, 2000);
                        } else {
                            // Handle validation errors
                            if (data.errors) {
                                this.errors = data.errors;
                            }
                            this.errorMessage = data.message || 'Registration failed. Please try again.';
                        }
                    } catch (error) {
                        console.error('Registration error:', error);
                        this.errorMessage = 'An error occurred. Please try again later.';
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }).mount('#app');
    </script>
</body>
</html>
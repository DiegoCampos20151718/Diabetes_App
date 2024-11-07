<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
		<script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
		<script type="text/javascript">
			window.tailwind.config = {
				darkMode: ['class'],
				theme: {
					extend: {
						colors: {
							border: 'hsl(var(--border))',
							input: 'hsl(var(--input))',
							ring: 'hsl(var(--ring))',
							background: 'hsl(var(--background))',
							foreground: 'hsl(var(--foreground))',
							primary: {
								DEFAULT: 'hsl(var(--primary))',
								foreground: 'hsl(var(--primary-foreground))'
							},
							secondary: {
								DEFAULT: 'hsl(var(--secondary))',
								foreground: 'hsl(var(--secondary-foreground))'
							},
							destructive: {
								DEFAULT: 'hsl(var(--destructive))',
								foreground: 'hsl(var(--destructive-foreground))'
							},
							muted: {
								DEFAULT: 'hsl(var(--muted))',
								foreground: 'hsl(var(--muted-foreground))'
							},
							accent: {
								DEFAULT: 'hsl(var(--accent))',
								foreground: 'hsl(var(--accent-foreground))'
							},
							popover: {
								DEFAULT: 'hsl(var(--popover))',
								foreground: 'hsl(var(--popover-foreground))'
							},
							card: {
								DEFAULT: 'hsl(var(--card))',
								foreground: 'hsl(var(--card-foreground))'
							},
						},
					}
				}
			}
		</script>
		<style type="text/tailwindcss">
			@layer base {
				:root {
					--background: 0 0% 100%;
--foreground: 240 10% 3.9%;
--card: 0 0% 100%;
--card-foreground: 240 10% 3.9%;
--popover: 0 0% 100%;
--popover-foreground: 240 10% 3.9%;
--primary: 240 5.9% 10%;
--primary-foreground: 0 0% 98%;
--secondary: 240 4.8% 95.9%;
--secondary-foreground: 240 5.9% 10%;
--muted: 240 4.8% 95.9%;
--muted-foreground: 240 3.8% 46.1%;
--accent: 240 4.8% 95.9%;
--accent-foreground: 240 5.9% 10%;
--destructive: 0 84.2% 60.2%;
--destructive-foreground: 0 0% 98%;
--border: 240 5.9% 90%;
--input: 240 5.9% 90%;
--ring: 240 5.9% 10%;
--radius: 0.5rem;
				}
				.dark {
					--background: 240 10% 3.9%;
--foreground: 0 0% 98%;
--card: 240 10% 3.9%;
--card-foreground: 0 0% 98%;
--popover: 240 10% 3.9%;
--popover-foreground: 0 0% 98%;
--primary: 0 0% 98%;
--primary-foreground: 240 5.9% 10%;
--secondary: 240 3.7% 15.9%;
--secondary-foreground: 0 0% 98%;
--muted: 240 3.7% 15.9%;
--muted-foreground: 240 5% 64.9%;
--accent: 240 3.7% 15.9%;
--accent-foreground: 0 0% 98%;
--destructive: 0 62.8% 30.6%;
--destructive-foreground: 0 0% 98%;
--border: 240 3.7% 15.9%;
--input: 240 3.7% 15.9%;
--ring: 240 4.9% 83.9%;
				}
			}
		</style>
  </head>
  <body>
    <div class="bg-background text-foreground min-h-screen">
    
    <nav class="bg-gradient-to-r from-purple-500 to-blue-500 shadow-lg">
        <div class="container mx-auto flex justify-between items-center py-4">
            <h1 class="text-3xl font-extrabold text-white">Diabetes Manager</h1>
            <button class="bg-yellow-400 text-zinc-800 hover:bg-yellow-300 px-4 py-2 rounded-lg transition duration-300">Sign In</button>
        </div>
    </nav>
    
    <section class="container mx-auto py-12 text-center">
        <h2 class="text-6xl font-extrabold mb-4 text-gradient">Empowering You to Manage Diabetes</h2>
        <p class="text-lg mb-8 text-muted">Track your blood sugar, medications, and more with our easy-to-use platform.</p>
        <button class="bg-gradient-to-r from-green-400 to-teal-500 text-white hover:bg-green-300 px-6 py-3 rounded-lg transition duration-300">Get Started</button>
    </section>
    
    <section class="bg-card text-card-foreground py-12">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="p-6 rounded-lg shadow-lg bg-white transition-transform transform hover:scale-105 hover:shadow-2xl">
                <img src="https://placehold.co/150?text=Blood+Sugar" alt="Blood Sugar" class="mx-auto mb-4 rounded-full shadow-md" />
                <h3 class="text-xl font-bold mb-2 text-purple-600">Blood Sugar Tracking</h3>
                <p class="text-muted">Monitor your blood sugar levels and trends effortlessly.</p>
            </div>
            
            <div class="p-6 rounded-lg shadow-lg bg-white transition-transform transform hover:scale-105 hover:shadow-2xl">
                <img src="https://placehold.co/150?text=Medication" alt="Medication" class="mx-auto mb-4 rounded-full shadow-md" />
                <h3 class="text-xl font-bold mb-2 text-purple-600">Medication Reminders</h3>
                <p class="text-muted">Never miss a dose with our medication reminder feature.</p>
            </div>
            
            <div class="p-6 rounded-lg shadow-lg bg-white transition-transform transform hover:scale-105 hover:shadow-2xl">
                <img src="https://placehold.co/150?text=Insights" alt="Insights" class="mx-auto mb-4 rounded-full shadow-md" />
                <h3 class="text-xl font-bold mb-2 text-purple-600">Personalized Insights</h3>
                <p class="text-muted">Get actionable insights based on your health data.</p>
            </div>
        </div>
    </section>
    
    <section class="container mx-auto text-center py-12">
        <h2 class="text-5xl font-extrabold mb-4 text-gradient">Start Managing Your Diabetes Today</h2>
        <p class="text-lg mb-8 text-muted">Join thousands of users who are taking control of their health.</p>
        <button class="bg-gradient-to-r from-orange-400 to-red-500 text-white hover:bg-orange-300 px-6 py-3 rounded-lg transition duration-300">Sign Up Now</button>
    </section>
    
    <footer class="bg-gradient-to-r from-purple-500 to-blue-500 text-white text-center py-4">
        <p>&copy; 2023 Diabetes Manager. All rights reserved.</p>
    </footer>
</div>


  </body>
</html>
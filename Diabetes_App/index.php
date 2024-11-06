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
    <div class="p-4 bg-background rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-foreground">Hello! Kiki Alghifari</h1>
    <div class="flex items-center mt-2">
        <input type="text" placeholder="Search..." class="border border-border rounded-lg p-2 flex-grow" />
        <button class="ml-2 bg-primary text-primary-foreground p-2 rounded-lg">🔍</button>
    </div>

    <div class="mt-4">
        <div class="flex justify-between items-center">
            <div class="bg-red-500 text-white p-2 rounded-lg">MCG 5.7%</div>
            <div class="bg-green-500 text-white p-2 rounded-lg">AS 100 mg/dl</div>
            <div class="bg-yellow-500 text-white p-2 rounded-lg">TG 15%</div>
        </div>
        <div class="mt-4">
            <div class="relative w-full h-32 bg-zinc-200 rounded-full">
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-lg font-bold text-foreground">Health Score</span>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-24 h-24 rounded-full border-8 border-primary bg-transparent flex items-center justify-center">
                        <span class="text-2xl font-bold text-primary-foreground">75%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-6 text-xl font-semibold text-foreground">Research and courses</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div class="bg-card p-4 rounded-lg shadow-md">
            <img src="https://openui.fly.dev/openui/24x24.svg?text=📖" alt="Research Course" class="w-full h-24 object-cover rounded-md" />
            <h3 class="mt-2 font-bold text-foreground">Layanan Klinik</h3>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 mt-2 p-2 rounded-lg">Lihat semua</button>
        </div>
        <div class="bg-card p-4 rounded-lg shadow-md">
            <img src="https://openui.fly.dev/openui/24x24.svg?text=💊" alt="Pharmacy Service" class="w-full h-24 object-cover rounded-md" />
            <h3 class="mt-2 font-bold text-foreground">Layanan Apotek</h3>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 mt-2 p-2 rounded-lg">Lihat semua</button>
        </div>
        <div class="bg-card p-4 rounded-lg shadow-md">
            <img src="https://openui.fly.dev/openui/24x24.svg?text=🔬" alt="Laboratory Service" class="w-full h-24 object-cover rounded-md" />
            <h3 class="mt-2 font-bold text-foreground">Layanan Laboratorium</h3>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 mt-2 p-2 rounded-lg">Lihat semua</button>
        </div>
    </div>
</div>
  </body>
</html>
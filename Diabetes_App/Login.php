<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
  <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
  <title>Login</title>
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
            primary: { DEFAULT: 'hsl(var(--primary))', foreground: 'hsl(var(--primary-foreground))' },
            secondary: { DEFAULT: 'hsl(var(--secondary))', foreground: 'hsl(var(--secondary-foreground))' },
            destructive: { DEFAULT: 'hsl(var(--destructive))', foreground: 'hsl(var(--destructive-foreground))' },
            muted: { DEFAULT: 'hsl(var(--muted))', foreground: 'hsl(var(--muted-foreground))' },
            accent: { DEFAULT: 'hsl(var(--accent))', foreground: 'hsl(var(--accent-foreground))' },
            popover: { DEFAULT: 'hsl(var(--popover))', foreground: 'hsl(var(--popover-foreground))' },
            card: { DEFAULT: 'hsl(var(--card))', foreground: 'hsl(var(--card-foreground))' },
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
  <div class="flex flex-col items-center justify-center min-h-screen bg-background">
    <div class="flex flex-col items-center mb-8">
      <img aria-hidden="true" alt="welcome-illustration" src="https://openui.fly.dev/openui/24x24.svg?text=👋" class="mb-4" />
      <h1 class="text-3xl font-bold text-primary">WELCOME</h1>
    </div>
    <h2 class="text-2xl font-semibold text-primary">Login</h2>
    <form class="w-full max-w-sm mt-4" method="POST" action="procesar_login.php">
      <div class="mb-4">
        <label class="block text-muted-foreground" for="email">Email ID</label>
        <input class="border border-border rounded-lg p-2 w-full" type="email" id="correo" name="correo" placeholder="Enter your email" required />
      </div>
      <div class="mb-4">
        <label class="block text-muted-foreground" for="password">Password</label>
        <input class="border border-border rounded-lg p-2 w-full" type="password" id="password" name="contraseña" placeholder="Contraseña" required/>
        <a href="#" class="text-accent text-sm hover:underline">Forgot Password?</a>
      </div>
      <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 rounded-lg p-2 w-full">Login</button>
    </form>
    <div class="flex items-center my-4">
      <hr class="flex-grow border-muted" />
      <span class="mx-2 text-muted-foreground">OR</span>
      <hr class="flex-grow border-muted" />
    </div>
    <button class="flex items-center justify-center bg-muted text-muted-foreground hover:bg-muted/80 rounded-lg p-2 w-full">
      <img src="https://openui.fly.dev/openui/24x24.svg?text=G" alt="Google logo" class="mr-2" />
      Login with Google
    </button>
    <p class="mt-4 text-muted-foreground">Don’t have an account? <a href="registrer.php" style="color: black;" class="text-accent hover:underline">Sign Up</a></p>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>

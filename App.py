from flask import Flask, request, render_template, redirect, url_for, session, jsonify
from pymongo import MongoClient
from bson.objectid import ObjectId
import bcrypt
from datetime import datetime

app = Flask(__name__)
app.secret_key = 'supersecretkey'  # Cambia esto por una clave secreta más segura

# Conectar a MongoDB
#client = MongoClient("mongodb+srv://alexcamdel254:KQVI1NIGDBkQpgme@cluster0.ryqs3.mongodb.net/")

client = MongoClient("mongodb+srv://pythonapp:pythonapp123@cluster0.r0bbl.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0")

db = client['Diabetes']
users_collection = db['users']
health_records_collection = db['health_records']

# Ruta para mostrar el formulario de login
@app.route('/')
def login_page():
    return render_template('login.html')

# Ruta para mostrar el formulario de datos de salud
@app.route('/health_form')
def health_form():
    return render_template('health_form.html')

@app.route('/home')
def Home():
    if 'username' in session and 'role' in session:
        return render_template('index.html', username=session['username'], role=session['role'])
    else:
        return redirect(url_for('login_page'))

# Ruta para manejar el login
@app.route('/login', methods=['POST'])
def login():
    username = request.form['username']
    password = request.form['password']
    user = users_collection.find_one({"username": username})
    if user and bcrypt.checkpw(password.encode('utf-8'), user['password']):
        session['username'] = user['username']
        session['role'] = user.get('role', 'User')  # Valor por defecto 'User' si no existe
        return jsonify({"status": "success", "message": "Inicio de sesión exitoso."}), 200
    else:
        return jsonify({"status": "error", "message": "Usuario o contraseña incorrecta."}), 401
    
# Ruta para mostrar el formulario de register
@app.route('/register_form')
def register_form():
    return render_template('register.html')

# Ruta para manejar el registro
@app.route('/register', methods=['POST'])
def register():
    registeredUser = {
        "name": request.form['name'],
        "last_name": request.form['last_name'],
        "username": request.form['rusername'],
        "password": request.form['rpassword'],
        "role": "User"
    }
    
    # Verifica si el usuario ya existe
    existing_user = users_collection.find_one({"username": registeredUser["username"]})
    if existing_user:
        return jsonify({"status": "error", "message": "¡Woops! El nombre de usuario ya existe, elige otro."}), 409
    
    # Encripta la contraseña
    password = request.form['rpassword'].encode('utf-8')
    hashed_password = bcrypt.hashpw(password, bcrypt.gensalt())

    # Completa el registro del usuario con la contraseña encriptada
    registeredUser["password"] = hashed_password
    registeredUser["role"] = "User"
    
    # Inserta el nuevo usuario en la colección
    users_collection.insert_one(registeredUser)
    return jsonify({"status": "success", "message": "¡Registro exitoso! Inicia sesión."}), 201

# Ruta para recibir y procesar los datos de salud
@app.route('/submit_health_data', methods=['POST'])
def submit_health_data():
    health_data = {
        "Pregnancies": int(request.form['pregnancies']),
        "Glucose": int(request.form['glucose']),
        "BloodPressure": int(request.form['blood_pressure']),
        "SkinThickness": int(request.form['skin_thickness']),
        "Insulin": int(request.form['insulin']),
        "BMI": float(request.form['bmi']),
        "DiabetesPedigreeFunction": float(request.form['diabetes_pedigree']),
        "Age": int(request.form['age'])
    }

    # Simulación de evaluación de diabetes (un resultado simple para prueba)
    outcome = 1 if health_data['Glucose'] >= 140 else 0  # Ejemplo de criterio simple
    health_data['Outcome'] = outcome
    health_records_collection.insert_one(health_data)

    if outcome == 1:
        return "Positivo para diabetes. Consulta a un médico."
    else:
        return "Negativo para diabetes. Mantén hábitos saludables."

# Ruta para cerrar sesión
@app.route('/logout')
def logout():
    session.clear()
    return redirect(url_for('login_page'))

if __name__ == "__main__":
    app.run(debug=True)

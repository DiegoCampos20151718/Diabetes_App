from flask import Flask, request, render_template, redirect, url_for
from pymongo import MongoClient
from bson.objectid import ObjectId
import bcrypt
from datetime import datetime

app = Flask(__name__)

# Conectar a MongoDB
client = MongoClient("mongodb+srv://alexcamdel254:KQVI1NIGDBkQpgme@cluster0.ryqs3.mongodb.net/")
db = client['Diabetes']  # Cambia 'your_database_name' por el nombre de tu BD
users_collection = db['Users']
health_records_collection = db['health_records']

# Ruta para mostrar el formulario de login
@app.route('/')
def login_page():
    return render_template('login.html')

# Ruta para mostrar el formulario de datos de salud
@app.route('/health_form')
def health_form():
    return render_template('health_form.html')

# Ruta para manejar el login
@app.route('/login', methods=['POST'])
def login():
    username = request.form['username']
    password = request.form['password']
    user = users_collection.find_one({"username": username})
    if user and bcrypt.checkpw(password.encode('utf-8'), user['password']):
        return redirect(url_for('health_form'))
    else:
        return "Usuario o contraseña incorrecta."

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

if __name__ == "__main__":
    app.run(debug=True)

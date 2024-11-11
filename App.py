# from flask import Flask, request, render_template, redirect, url_for, session
# from pymongo import MongoClient
# from bson.objectid import ObjectId
# import bcrypt
# from datetime import datetime

# app = Flask(__name__)
# app.secret_key = 'supersecretkey'  # Cambia esto por una clave secreta más segura

# # Conectar a MongoDB
# client = MongoClient("mongodb+srv://alexcamdel254:KQVI1NIGDBkQpgme@cluster0.ryqs3.mongodb.net/")
# db = client['Diabetes']
# users_collection = db['Users']
# health_records_collection = db['health_records']

# # Ruta para mostrar el formulario de login
# @app.route('/')
# def login_page():
#     return render_template('login.html')

# # Ruta para mostrar el formulario de datos de salud
# @app.route('/health_form')
# def health_form():
#     return render_template('health_form.html')

# @app.route('/Home')
# def Home():
#     if 'username' in session and 'role' in session:
#         return render_template('index.html', username=session['username'], role=session['role'])
#     else:
#         return redirect(url_for('login_page'))

# # Ruta para manejar el login
# @app.route('/login', methods=['POST'])
# def login():
#     username = request.form['username']
#     password = request.form['password']
#     user = users_collection.find_one({"username": username})
#     if user and bcrypt.checkpw(password.encode('utf-8'), user['password']):
#         session['username'] = user['username']
#         session['role'] = user.get('role', 'User')  # Valor por defecto 'User' si no existe
#         return redirect(url_for('Home'))
#     else:
#         return "Usuario o contraseña incorrecta."

# # Ruta para recibir y procesar los datos de salud
# @app.route('/submit_health_data', methods=['POST'])
# def submit_health_data():
#     health_data = {
#         "Pregnancies": int(request.form['pregnancies']),
#         "Glucose": int(request.form['glucose']),
#         "BloodPressure": int(request.form['blood_pressure']),
#         "SkinThickness": int(request.form['skin_thickness']),
#         "Insulin": int(request.form['insulin']),
#         "BMI": float(request.form['bmi']),
#         "DiabetesPedigreeFunction": float(request.form['diabetes_pedigree']),
#         "Age": int(request.form['age'])
#     }

#     # Simulación de evaluación de diabetes (un resultado simple para prueba)
#     outcome = 1 if health_data['Glucose'] >= 140 else 0  # Ejemplo de criterio simple
#     health_data['Outcome'] = outcome
#     health_records_collection.insert_one(health_data)

#     if outcome == 1:
#         return "Positivo para diabetes. Consulta a un médico."
#     else:
#         return "Negativo para diabetes. Mantén hábitos saludables."

# # Ruta para cerrar sesión
# @app.route('/logout')
# def logout():
#     session.clear()
#     return redirect(url_for('login_page'))

# if __name__ == "__main__":
#     app.run(debug=True)

from flask import Flask, request, jsonify, render_template
import pandas as pd
from scipy.stats import entropy
from sklearn.model_selection import train_test_split
from sklearn import tree
from pymongo import MongoClient

app = Flask(__name__)

# Conexión a MongoDB
client = MongoClient("mongodb+srv://Quetzal:Sparky123@cluster0.lyfbd.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0")
db = client.Diabetes
coleccion = db.health_records

# Obtener los documentos de MongoDB y convertirlos en un DataFrame
documents = coleccion.find()
documentos = list(documents)  # Convertir a lista para el DataFrame
datos_finales = pd.DataFrame(documentos)

# Calcular la entropía para las variables
variables = ['Age', 'Glucose', 'Pregnancies', 'BloodPressure', 'SkinThickness', 'Insulin', 'BMI', 'DiabetesPedigreeFunction']
entropias = {}
for var in variables:
    probs = datos_finales[var].value_counts(normalize=True)
    entropias[var] = entropy(probs, base=2)
    print(f"Entropía de '{var}': {entropias[var]}")

# Seleccionar las características y la variable objetivo
features = datos_finales[variables]
target = datos_finales['Outcome']

# Dividir los datos en conjuntos de entrenamiento y prueba
X_train, X_test, y_train, y_test = train_test_split(features, target, test_size=0.30)

# Crear y entrenar el árbol de decisión
decision_tree = tree.DecisionTreeClassifier(criterion='entropy', max_depth=4)
decision_tree.fit(X_train, y_train)

# Evaluar el modelo
accuracy = decision_tree.score(X_test, y_test)
print(f"Exactitud del modelo: {accuracy}")

# Ruta principal para mostrar el formulario HTML
@app.route('/')
def home():
    return render_template('formTest.html')

# Ruta para mostrar el formulario de datos de salud
@app.route('/health_form')
def health_form():
    return render_template('health_form.html')

# Ruta para mostrar el formulario de register
@app.route('/register_form')
def register_form():
    return render_template('register.html')

@app.route('/Home')
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
        return redirect(url_for('Home'))
    else:
        return "Usuario o contraseña incorrecta."
    
# Ruta para manejar el registro
@app.route('/register', methods=['POST'])
def register():
    registeredUser = {
        "name": request.form['name'],
        "last_name": request.form['last_name'],
        "username": request.form['rusername'],
        "password": request.form['rpassword'].encode('utf-8'),
        "role": "User"
    }
    
    if registeredUser.username == users_collection.find_one({"username": registeredUser.username}):
        return "Woops! Ya existe ese nombre de usuario, por favor elige otro :P"
    else:
        registeredUser = users_collection.insert_one({})
        

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
        resultado_texto = "No se detecta riesgo de diabetes."
    
    return jsonify({'resultado': resultado_texto})

if __name__ == '__main__':
    app.run(debug=True)

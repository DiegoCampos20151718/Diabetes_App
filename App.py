from flask import Flask, request, render_template, redirect, url_for, session, jsonify
from pymongo import MongoClient
from bson.objectid import ObjectId
import bcrypt
from datetime import datetime
import pandas as pd
from scipy.stats import entropy
from sklearn.model_selection import train_test_split
from sklearn import tree

app = Flask(__name__)
app.secret_key = 'supersecretkey'  # Cambia esto por una clave secreta más segura

# Conexión a MongoDB
client = MongoClient("mongodb+srv://alexcamdel254:KQVI1NIGDBkQpgme@cluster0.ryqs3.mongodb.net/")
db = client['Diabetes']  # Cambia 'Diabetes' por el nombre de tu BD
users_collection = db['Users']
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

# Eliminar filas con valores NaN en las características o la variable objetivo
datos_finales = datos_finales.dropna(subset=variables + ['Outcome'])

# Seleccionar las características y la variable objetivo después de eliminar NaNs
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


# Ruta principal para mostrar el formulario HTML
@app.route('/formTest')
def formTest():
    return render_template('formTest.html')

# Ruta para realizar el diagnóstico
@app.route('/evaluar_diabetes', methods=['POST'])
def evaluar_diabetes():
    datos = request.get_json()
    
    # Obtener todas las variables del JSON recibido
    input_data = {
        'Age': int(datos['age']),
        'Glucose': float(datos['glucose']),
        'Pregnancies': int(datos['pregnancies']),
        'BloodPressure': float(datos['bloodpressure']),
        'SkinThickness': float(datos['skinthickness']),
        'Insulin': float(datos['insulin']),
        'BMI': float(datos['bmi']),
        'DiabetesPedigreeFunction': float(datos['diabetespedigreefunction']),
    }
    
    # Crear un DataFrame con los datos del usuario
    datos_usuario = pd.DataFrame([input_data])
    resultado = decision_tree.predict(datos_usuario)
    
    # Generar el diagnóstico
    if resultado[0] == 1:
        resultado_texto = "Posible riesgo de diabetes."
    else:
        resultado_texto = "No se detecta riesgo de diabetes."
    
    return jsonify({'resultado': resultado_texto})

# Ruta para cerrar sesión
@app.route('/logout')
def logout():
    session.clear()
    return redirect(url_for('login_page'))

if __name__ == "__main__":
    app.run(debug=True)

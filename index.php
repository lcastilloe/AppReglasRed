<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red con Formulario</title>
    <!-- Fuente de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <style>
        /* Estilo general */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            background-color: #ffffff;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
        }

        /* Mensaje de bienvenida */
        .welcome {
            text-align: center;
            font-size: 36px;
            color: #012856;
            font-weight: 800; /* Extra Bold */
            margin: 20px 0;
        }

        /* Sección dividida */
        .split-container {
            display: flex;
            flex: 1;
            justify-content: space-between;
            padding: 0 50px;
        }

        .left-section,
        .right-section {
            width: 48%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            text-align: left;
            font-size: 24px;
            font-weight: 800; /* Extra Bold */
            color: #2e4b94;
        }

        .left-section svg {
            margin-top: 20px;
        }

        /* Estilos del formulario */
        .right-section form {
            width: 100%;
        }

        .right-section .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .right-section label {
            font-size: 18px;
            color: #2e4b94;
            margin-right: 10px;
            flex: 1;
        }

        .right-section input,
        .right-section select {
            flex: 2;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background-color: #2e4b94;
            color: white;
            font-size: 16px;
        }

        .right-section button {
            padding: 10px 20px;
            background-color: #2e4b94;
            color: white;
            border: none;
            border-radius: 20px; /* Botón redondeado */
            font-size: 18px;
            font-weight: 800; /* Extra Bold */
            cursor: pointer;
            margin-top: 10px;
            display: block;
            margin: 10px auto;
        }

        .right-section button:hover {
            background-color: #012856;
        }

        .additional-section {
            text-align: center;
            margin-top: 20px;
        }

        .additional-section p {
            font-size: 18px;
            font-weight: 800; /* Extra Bold */
            color: #2e4b94;
        }

        .additional-section table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .additional-section th, .additional-section td {
            border: 1px solid #2e4b94;
            text-align: center;
            padding: 10px;
            font-size: 16px;
        }

        .additional-section th {
            background-color: #2e4b94;
            color: white;
        }

        /* Pie de página */
        .footer {
            background-color: #012856;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 20px;
            font-weight: 800; /* Extra Bold */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Mensaje de bienvenida en la parte superior -->
        <div class="welcome">
            ¡BIENVENIDO!
        </div>
        <!-- Sección dividida en dos columnas -->
        <div class="split-container">
            <div class="left-section">
                SE TIENE LA SIGUIENTE RED
                <!-- Diagrama de red generado con SVG -->
                <svg width="250" height="400" xmlns="http://www.w3.org/2000/svg">
                    <!-- Diagrama de red (c0, s1, h1, h2) -->
                     <!-- Nodo c0 -->
                    <circle cx="125" cy="40" r="30" fill="#2e4b94">
                        <animate attributeName="r" from="30" to="35" dur="1s" repeatCount="indefinite" />
                    </circle>
                    <text x="125" y="45" fill="white" font-size="16" font-family="Arial" text-anchor="middle">C0</text>
                    
                    <!-- Nodo s1 -->
                    <line x1="125" y1="70" x2="125" y2="160" stroke="#2e4b94" stroke-width="3">
                        <animate attributeName="stroke-width" from="3" to="6" dur="1s" repeatCount="indefinite" />
                    </line>
                    <circle cx="125" cy="190" r="30" fill="#012856">
                        <animate attributeName="r" from="30" to="35" dur="1s" repeatCount="indefinite" />
                    </circle>
                    <text x="125" y="195" fill="white" font-size="16" font-family="Arial" text-anchor="middle">S1</text>
                    
                    <!-- Nodo h1 -->
                    <line x1="125" y1="220" x2="75" y2="320" stroke="#2e4b94" stroke-width="3">
                        <animate attributeName="stroke-width" from="3" to="6" dur="1s" repeatCount="indefinite" />
                    </line>
                    <circle cx="75" cy="350" r="30" fill="#2e4b94">
                        <animate attributeName="r" from="30" to="35" dur="1s" repeatCount="indefinite" />
                    </circle>
                    <text x="75" y="355" fill="white" font-size="16" font-family="Arial" text-anchor="middle">h1</text>
                    
                    <!-- Nodo h2 -->
                    <line x1="125" y1="220" x2="175" y2="320" stroke="#2e4b94" stroke-width="3">
                        <animate attributeName="stroke-width" from="3" to="6" dur="1s" repeatCount="indefinite" />
                    </line>
                    <circle cx="175" cy="350" r="30" fill="#2e4b94">
                        <animate attributeName="r" from="30" to="35" dur="1s" repeatCount="indefinite" />
                    </circle>
                    <text x="175" y="355" fill="white" font-size="16" font-family="Arial" text-anchor="middle">h2</text>
                </svg>
            </div>
            <div class="right-section">
                PUEDES CREAR LAS REGLAS:
                <form>
                    <div class="form-group">
                        <label for="priority">PRIORIDAD:</label>
                        <input type="number" id="priority" name="priority" required>
                    </div>
                    <div class="form-group">
                        <label for="input_port">PUERTO ENTRADA:</label>
                        <input type="number" id="input_port" name="input_port" required>
                    </div>
                    <div class="form-group">
                        <label for="output_port">PUERTO SALIDA:</label>
                        <input type="number" id="output_port" name="output_port" required>
                    </div>
                    <div class="form-group">
                        <label for="rule_type">TIPO DE REGLA:</label>
                        <select id="rule_type" name="rule_type">
                            <option value="permitir">IP</option>
                            <option value="denegar">ARP</option>
                        </select>
                    </div>
                    <button type="submit">ENVIAR REGLAS</button>
                </form>
                <div class="additional-section">
                    <p>¿QUÉ REGLAS SE HAN ESTABLECIDO?</p>
                    <table>
                        <thead>
                            <tr>
                                <th>PRIORIDAD</th>
                                <th>PUERTO ENTRADA</th>
                                <th>PUERTO SALIDA</th>
                                <th>TIPO REGLA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>2</td>
                                <td>IP</td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Pie de página -->
        <div class="footer">
            JUAN SOLARTE - MARCELA CASTILLO
        </div>
    </div>
</body>
</html>

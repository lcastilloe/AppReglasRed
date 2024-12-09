<?php
header('Content-Type: text/html; charset=utf-8');

class RyuFlowManager {
    private $controllerIp = '192.168.18.202';
    private $controllerPort = 8080;
    private $dpid = 1;
    private $rulesFile = 'rules.json';

    public function sendFlowRule($priority, $inputPort, $outputPort, $ruleType) {
        $url = "http://{$this->controllerIp}:{$this->controllerPort}/stats/flowentry/add";
        
        $ruleConfig = [
            'dpid' => $this->dpid,
            'table_id' => 0,
            'priority' => $priority,
            'match' => [
                'in_port' => $inputPort
            ],
            'actions' => [
                [
                    'type' => 'OUTPUT',
                    'port' => $outputPort
                ]
            ]
        ];

        // Configurar tipo de tráfico
        $ruleConfig['match']['eth_type'] = ($ruleType == 'permitir') ? 2048 : 2054;

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($ruleConfig)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // Guardar regla localmente
        if ($result) {
            $this->saveRule($priority, $inputPort, $outputPort, $ruleType);
        }

        return $result ? true : false;
    }

    private function saveRule($priority, $inputPort, $outputPort, $ruleType) {
        $rules = file_exists($this->rulesFile) 
            ? json_decode(file_get_contents($this->rulesFile), true) 
            : [];

        $rules[] = [
            'prioridad' => $priority,
            'puerto_entrada' => $inputPort,
            'puerto_salida' => $outputPort,
            'tipo_regla' => $ruleType
        ];

        file_put_contents($this->rulesFile, json_encode($rules));
    }

    public function getEstablishedRules() {
        return file_exists($this->rulesFile) 
            ? json_decode(file_get_contents($this->rulesFile), true) 
            : [];
    }
}

// Procesar formulario
$flowManager = new RyuFlowManager();
$rules = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $priority = $_POST['priority'] ?? null;
    $inputPort = $_POST['input_port'] ?? null;
    $outputPort = $_POST['output_port'] ?? null;
    $ruleType = $_POST['rule_type'] ?? null;

    if ($priority && $inputPort && $outputPort && $ruleType) {
        $result = $flowManager->sendFlowRule($priority, $inputPort, $outputPort, $ruleType);
    }
}

$rules = $flowManager->getEstablishedRules();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red con Formulario</title>
    <style>
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

        /* Imagen de Millonarios */
        .logo {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 100px; /* Ajusta el tamaño según sea necesario */
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
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome">¡BIENVENIDO!</div>
        <div class="split-container">
            <div class="left-section">
                SE TIENE LA SIGUIENTE RED
                <svg width="250" height="400" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG original del documento -->
                    <circle cx="125" cy="40" r="30" fill="#2e4b94">
                        <animate attributeName="r" from="30" to="35" dur="1s" repeatCount="indefinite" />
                    </circle>
                    <text x="125" y="45" fill="white" font-size="16" font-family="Arial" text-anchor="middle">C0</text>
                    
                    <line x1="125" y1="70" x2="125" y2="160" stroke="#2e4b94" stroke-width="3">
                        <animate attributeName="stroke-width" from="3" to="6" dur="1s" repeatCount="indefinite" />
                    </line>
                    <circle cx="125" cy="190" r="30" fill="#012856">
                        <animate attributeName="r" from="30" to="35" dur="1s" repeatCount="indefinite" />
                    </circle>
                    <text x="125" y="195" fill="white" font-size="16" font-family="Arial" text-anchor="middle">S1</text>
                    
                    <line x1="125" y1="220" x2="75" y2="320" stroke="#2e4b94" stroke-width="3">
                        <animate attributeName="stroke-width" from="3" to="6" dur="1s" repeatCount="indefinite" />
                    </line>
                    <circle cx="75" cy="350" r="30" fill="#2e4b94">
                        <animate attributeName="r" from="30" to="35" dur="1s" repeatCount="indefinite" />
                    </circle>
                    <text x="75" y="355" fill="white" font-size="16" font-family="Arial" text-anchor="middle">h1</text>
                    
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
                <form method="POST">
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
                            <?php foreach ($rules as $rule): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($rule['prioridad']); ?></td>
                                    <td><?php echo htmlspecialchars($rule['puerto_entrada']); ?></td>
                                    <td><?php echo htmlspecialchars($rule['puerto_salida']); ?></td>
                                    <td><?php echo htmlspecialchars($rule['tipo_regla']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer">JUAN SOLARTE - MARCELA CASTILLO</div>
    </div>
</body>
</html>
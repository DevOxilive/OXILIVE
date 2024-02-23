<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>javascript</title>
    <style>
        body {
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        canvas {
            border: 1px solid black;
            margin: 20px auto;
            
        }
    </style>
</head>

<body>
    <h1>Javascript</h1>

    <p>Puntuación: <span id="puntuacion">0</span></p>
    <canvas id="miCanvas" width="400" height="400"></canvas>

    <script>
        var canvas = document.getElementById('miCanvas');
        var ctx = canvas.getContext('2d');

        // Tamaño de cada celda en el grid
        var tamanoCelda = 20;

        var puntuacion = 0;

        // Inicialización de la serpiente
        var serpiente = [{
                x: 2,
                y: 0
            },
            {
                x: 1,
                y: 0
            },
            {
                x: 0,
                y: 0
            }
        ];

        // Dirección inicial de la serpiente
        var direccion = 'derecha';

        // Posición de la comida
        var comida = obtenerNuevaComida();

        // Actualización del juego cada 100 milisegundos
        setInterval(actualizarJuego, 100);

        // Manejar eventos de teclado
        document.addEventListener('keydown', manejarTeclaPresionada);

        function manejarTeclaPresionada(event) {
            // Cambiar la dirección de la serpiente según la tecla presionada
            switch (event.key) {
                case 'ArrowUp':
                    if (direccion !== 'abajo') direccion = 'arriba';
                    break;
                case 'ArrowDown':
                    if (direccion !== 'arriba') direccion = 'abajo';
                    break;
                case 'ArrowLeft':
                    if (direccion !== 'derecha') direccion = 'izquierda';
                    break;
                case 'ArrowRight':
                    if (direccion !== 'izquierda') direccion = 'derecha';
                    break;
            }
        }

        function actualizarJuego() {
            var comio = verificarComida();
            moverSerpiente();

            // Solo elimina la última cola si no ha comido
            if (!comio) {
                serpiente.pop();
            }

            verificarColision();
            dibujar();
        }


        function moverSerpiente() {
            // Crear nueva cabeza en la dirección actual
            var nuevaCabeza = {
                x: serpiente[0].x,
                y: serpiente[0].y
            };

            switch (direccion) {
                case 'arriba':
                    nuevaCabeza.y--;
                    break;
                case 'abajo':
                    nuevaCabeza.y++;
                    break;
                case 'izquierda':
                    nuevaCabeza.x--;
                    break;
                case 'derecha':
                    nuevaCabeza.x++;
                    break;
            }

            // Agregar la nueva cabeza al principio del array
            serpiente.unshift(nuevaCabeza);
        }

        function verificarColision() {
            // Verificar colisión con las paredes
            if (
                serpiente[0].x < 0 ||
                serpiente[0].x >= canvas.width / tamanoCelda ||
                serpiente[0].y < 0 ||
                serpiente[0].y >= canvas.height / tamanoCelda
            ) {
                reiniciarJuego();
            }

            // Verificar colisión con la propia serpiente
            for (var i = 1; i < serpiente.length; i++) {
                if (serpiente[i].x === serpiente[0].x && serpiente[i].y === serpiente[0].y) {
                    reiniciarJuego();
                }
            }
        }

        function verificarComida() {
            // Verificar si la cabeza de la serpiente está en la posición de la comida
            if (serpiente[0].x === comida.x && serpiente[0].y === comida.y) {
                // Crear nueva comida y hacer crecer la serpiente
                comida = obtenerNuevaComida();
                crecerSerpiente();

                puntuacion += 1;
                // Actualizar la puntuación en el HTML
                document.getElementById('puntuacion').textContent = puntuacion;

                return true; // La serpiente ha comido
            }

            return false; // La serpiente no ha comido
        }


        function crecerSerpiente() {
            // La serpiente crece añadiendo una nueva cabeza en la dirección opuesta a la actual
            var nuevaCabeza = {
                x: serpiente[0].x,
                y: serpiente[0].y
            };

            switch (direccion) {
                case 'arriba':
                    nuevaCabeza.y--;
                    break;
                case 'abajo':
                    nuevaCabeza.y++;
                    break;
                case 'izquierda':
                    nuevaCabeza.x--;
                    break;
                case 'derecha':
                    nuevaCabeza.x++;
                    break;
            }


        }



        function obtenerNuevaComida() {
            // Generar una nueva posición aleatoria para la comida
            var x = Math.floor(Math.random() * (canvas.width / tamanoCelda));
            var y = Math.floor(Math.random() * (canvas.height / tamanoCelda));

            // Asegurarse de que la comida no aparezca en la posición actual de la serpiente
            for (var i = 0; i < serpiente.length; i++) {
                if (x === serpiente[i].x && y === serpiente[i].y) {
                    return obtenerNuevaComida();
                }
            }

            return {
                x: x,
                y: y
            };
        }

        function dibujar() {
            // Limpiar el canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Dibujar la serpiente
            for (var i = 0; i < serpiente.length; i++) {
                ctx.fillStyle = i == 0 ? 'green' : "white";
                ctx.fillRect(serpiente[i].x * tamanoCelda, serpiente[i].y * tamanoCelda, tamanoCelda, tamanoCelda);
                ctx.strokeStyle = 'black';
                ctx.strokeRect(serpiente[i].x * tamanoCelda, serpiente[i].y * tamanoCelda, tamanoCelda, tamanoCelda);
            }

            // Dibujar la comida
            ctx.fillStyle = 'red';
            ctx.fillRect(comida.x * tamanoCelda, comida.y * tamanoCelda, tamanoCelda, tamanoCelda);
            ctx.strokeStyle = 'black';
            ctx.strokeRect(comida.x * tamanoCelda, comida.y * tamanoCelda, tamanoCelda, tamanoCelda);
        }

        function reiniciarJuego() {
            alert('¡Perdiste! Puntuación final: ' + puntuacion + '\nReiniciando el juego.');
            serpiente = [{
                    x: 2,
                    y: 0
                },
                {
                    x: 1,
                    y: 0
                },
                {
                    x: 0,
                    y: 0
                }
            ];

            // Dirección inicial de la serpiente
            direccion = 'derecha';

            // Posición de la comida
            comida = obtenerNuevaComida();
            puntuacion = 0;
            // Actualizar la puntuación en el HTML
            document.getElementById('puntuacion').textContent = puntuacion;
        }
    </script>
</body>

</html>
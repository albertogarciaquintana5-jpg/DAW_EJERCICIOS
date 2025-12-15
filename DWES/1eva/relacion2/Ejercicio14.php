<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 14 - Calificación con Vanilla JS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card-main { max-width: 700px; margin: 40px auto; }
        input.is-invalid { border-color: #dc3545 !important; }
        input.is-valid { border-color: #28a745 !important; }
        .error-msg { color: #dc3545; font-size: 0.875rem; margin-top: 4px; }
        .field-group { position: relative; }
        .field-group:hover { background-color: rgba(0,0,0,0.01); transition: 0.2s; }
        .info-badge { display: inline-block; background: #e7f3ff; border-left: 3px solid #2196F3; padding: 8px 12px; margin: 8px 0; border-radius: 3px; font-size: 0.9rem; }
        .card-main.highlight { box-shadow: 0 8px 20px rgba(33, 150, 243, 0.3); transition: 0.3s; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Ejercicio 14 - Sistema de Calificación</a>
        </div>
    </nav>

    <main class="container">
        <div class="card card-main shadow" id="mainCard">
            <div class="card-body">
                <h5 class="card-title mb-2" id="cardTitle">Cálculo de Calificación Final</h5>
                <p class="text-muted small mb-3">Validación con Vanilla JavaScript + envío a PHP para cálculos y progress bar.</p>

                <form method="POST" action="Ejercicio14_process.php" id="gradeForm" class="needs-validation">
                    
                    <!-- Nombre -->
                    <div class="mb-3 field-group">
                        <label for="nombre" class="form-label">Nombre completo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Juan García">
                        <div class="error-msg" id="err_nombre" style="display:none;"></div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3 field-group">
                        <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ej: juan@ejemplo.com">
                        <div class="error-msg" id="err_email" style="display:none;"></div>
                    </div>

                    <!-- Notas -->
                    <div class="row">
                        <div class="col-md-6 mb-3 field-group">
                            <label for="inicial" class="form-label">Nota inicial (0-10) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="inicial" name="inicial" placeholder="0">
                            <div class="error-msg" id="err_inicial" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3 field-group">
                            <label for="primera" class="form-label">Primera evaluación <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="primera" name="primera" placeholder="0">
                            <div class="error-msg" id="err_primera" style="display:none;"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 field-group">
                            <label for="segunda" class="form-label">Segunda evaluación <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="segunda" name="segunda" placeholder="0">
                            <div class="error-msg" id="err_segunda" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3 field-group">
                            <label for="tercera" class="form-label">Tercera evaluación <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="tercera" name="tercera" placeholder="0">
                            <div class="error-msg" id="err_tercera" style="display:none;"></div>
                        </div>
                    </div>

                    <div class="info-badge">
                        <strong>ℹ️ Puntuación:</strong> Todas las notas tienen el mismo peso (media simple = suma / 4).
                    </div>

                    <div class="mt-4 d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Calcular calificación</button>
                        <button type="reset" class="btn btn-outline-secondary" id="btnReset">Limpiar formulario</button>
                        <button type="button" class="btn btn-sm btn-info ms-auto" id="btnTest">Tests</button>
                    </div>

                </form>

                <!-- Test Battery Results -->
                <div id="testSection" style="display:none; margin-top:20px; padding-top:20px; border-top:1px solid #ddd;">
                    <h6>Batería de Tests - Validación Numérica</h6>
                    <pre id="testResults" style="background:#f5f5f5; padding:10px; border-radius:4px; font-size:0.85rem; max-height:200px; overflow-y:auto;"></pre>
                </div>

            </div>
            <div class="card-footer text-muted text-center small">
                Todos los campos son obligatorios. Los datos se envían a PHP para cálculo y salida con progress bar.
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      (function(){
        'use strict';

        // ============ UTILITY FUNCTIONS ============
        function trim(s) {
          return (s || '').toString().trim();
        }

        function isNumeric(val) {
          return !isNaN(parseFloat(val)) && isFinite(val);
        }

        function isValidEmail(email) {
          var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          return re.test(trim(email));
        }

        function isValidGrade(val) {
          if (!isNumeric(val)) return false;
          var n = parseFloat(val);
          return n >= 0 && n <= 10;
        }

        // ============ DOM ELEMENTS ============
        var form = document.getElementById('gradeForm');
        var cardTitle = document.getElementById('cardTitle');
        var mainCard = document.getElementById('mainCard');
        var btnTest = document.getElementById('btnTest');
        var testSection = document.getElementById('testSection');
        var testResults = document.getElementById('testResults');

        var fields = {
          nombre: { el: document.getElementById('nombre'), err: document.getElementById('err_nombre') },
          email: { el: document.getElementById('email'), err: document.getElementById('err_email') },
          inicial: { el: document.getElementById('inicial'), err: document.getElementById('err_inicial') },
          primera: { el: document.getElementById('primera'), err: document.getElementById('err_primera') },
          segunda: { el: document.getElementById('segunda'), err: document.getElementById('err_segunda') },
          tercera: { el: document.getElementById('tercera'), err: document.getElementById('err_tercera') }
        };

        // ============ FIELD VALIDATORS ============
        function validateNombre() {
          var val = trim(fields.nombre.el.value);
          if (val.length < 2) {
            fields.nombre.err.textContent = 'Nombre debe tener al menos 2 caracteres.';
            fields.nombre.err.style.display = 'block';
            fields.nombre.el.classList.add('is-invalid');
            fields.nombre.el.classList.remove('is-valid');
            return false;
          }
          fields.nombre.err.style.display = 'none';
          fields.nombre.el.classList.remove('is-invalid');
          fields.nombre.el.classList.add('is-valid');
          return true;
        }

        function validateEmail() {
          var val = trim(fields.email.el.value);
          if (!isValidEmail(val)) {
            fields.email.err.textContent = 'Correo electrónico inválido.';
            fields.email.err.style.display = 'block';
            fields.email.el.classList.add('is-invalid');
            fields.email.el.classList.remove('is-valid');
            return false;
          }
          fields.email.err.style.display = 'none';
          fields.email.el.classList.remove('is-invalid');
          fields.email.el.classList.add('is-valid');
          return true;
        }

        function validateGradeField(fieldName) {
          var field = fields[fieldName];
          var val = trim(field.el.value);
          if (!isValidGrade(val)) {
            field.err.textContent = 'Introduce un número entre 0 y 10.';
            field.err.style.display = 'block';
            field.el.classList.add('is-invalid');
            field.el.classList.remove('is-valid');
            return false;
          }
          field.err.style.display = 'none';
          field.el.classList.remove('is-invalid');
          field.el.classList.add('is-valid');
          return true;
        }

        // ============ EVENT LISTENERS ============
        fields.nombre.el.addEventListener('change', validateNombre);
        fields.nombre.el.addEventListener('blur', function() {
          fields.nombre.el.value = trim(fields.nombre.el.value);
        });
        cardTitle.addEventListener('dblclick', function(evt) {
          evt.preventDefault();
          fields.nombre.el.value = trim(fields.nombre.el.value);
          validateNombre();
        });

        fields.email.el.addEventListener('change', validateEmail);
        fields.email.el.addEventListener('input', function() {
          if (trim(fields.email.el.value) === '') {
            fields.email.el.classList.remove('is-valid', 'is-invalid');
            fields.email.err.style.display = 'none';
          } else {
            validateEmail();
          }
        });

        ['inicial', 'primera', 'segunda', 'tercera'].forEach(function(name) {
          fields[name].el.addEventListener('change', function() { validateGradeField(name); });
          fields[name].el.addEventListener('input', function() {
            if (trim(fields[name].el.value) === '') {
              fields[name].el.classList.remove('is-valid', 'is-invalid');
              fields[name].err.style.display = 'none';
            } else {
              validateGradeField(name);
            }
          });
        });

        mainCard.addEventListener('mouseover', function() {
          mainCard.classList.add('highlight');
        });
        mainCard.addEventListener('mouseout', function() {
          mainCard.classList.remove('highlight');
        });

        form.addEventListener('submit', function(evt) {
          evt.preventDefault();
          var allValid = true;

          if (!validateNombre()) allValid = false;
          if (!validateEmail()) allValid = false;
          ['inicial', 'primera', 'segunda', 'tercera'].forEach(function(name) {
            if (!validateGradeField(name)) allValid = false;
          });

          if (!allValid) {
            alert('Por favor, revisa los errores en el formulario.');
            var firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();
            return false;
          }

          form.submit();
        });

        document.getElementById('btnReset').addEventListener('click', function() {
          form.reset();
          Object.keys(fields).forEach(function(name) {
            fields[name].el.classList.remove('is-valid', 'is-invalid');
            fields[name].err.style.display = 'none';
          });
          testSection.style.display = 'none';
        });

        var testCases = [
          { val: '5', name: '5', expected: true },
          { val: '10.0', name: '10.0', expected: true },
          { val: '0', name: '0', expected: true },
          { val: '7.5', name: '7.5', expected: true },
          { val: '-1', name: '-1', expected: false },
          { val: '11', name: '11', expected: false },
          { val: 'abc', name: 'abc', expected: false },
          { val: '', name: '(empty)', expected: false },
          { val: '10.00001', name: '10.00001', expected: false }
        ];

        btnTest.addEventListener('click', function() {
          testSection.style.display = 'block';
          var results = [];
          results.push('=== TEST BATTERY: isValidGrade() ===\n');
          testCases.forEach(function(tc) {
            var ok = isValidGrade(tc.val);
            var pass = ok === tc.expected;
            results.push('[' + (pass ? '✓ PASS' : '✗ FAIL') + '] value="' + tc.name + '" -> ' + ok + ' (expected ' + tc.expected + ')');
          });
          testResults.textContent = results.join('\n');
        });

        fields.nombre.el.addEventListener('keydown', function(e) {
          if (e.key === 'Enter') {
            e.preventDefault();
            fields.email.el.focus();
          }
        });
        fields.email.el.addEventListener('keydown', function(e) {
          if (e.key === 'Enter') {
            e.preventDefault();
            fields.inicial.el.focus();
          }
        });

      })();
    </script>
</body>
</html>
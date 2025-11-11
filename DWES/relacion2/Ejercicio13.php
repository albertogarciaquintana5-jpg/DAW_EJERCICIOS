<?php
// Ejercicio13.php
// Versión: validación con Vanilla JavaScript (todo en este archivo)
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ejercicio 13 — Validación en Vanilla JS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{padding:16px}
    .error-text{color:#b00;font-size:0.9em;display:none}
    #resultBox{margin-top:12px}
    .highlight{box-shadow:0 0 10px rgba(0,123,255,0.2)}
    pre#testResults{background:#f8f9fa;padding:8px;border-radius:4px}
  </style>
</head>
<body>
  <div class="container">
    <h1 id="title">Ejercicio 13 — Validación con Vanilla JS</h1>
    <p class="text-muted">Demostración de técnicas: addEventListener, trim, comprobaciones numéricas, onchange, onsubmit, onmouseover, onmouseout, dblclick y manipulación de estilos desde JS.</p>

    <div class="card" id="card">
      <div class="card-body">
        <form id="formGrade">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="nombre" class="form-label">Nombre</label>
              <input id="nombre" name="nombre" class="form-control" type="text" placeholder="Ej: Ana Pérez">
              <div id="err_nombre" class="error-text">Nombre obligatorio (2+ caracteres).</div>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Correo</label>
              <input id="email" name="email" class="form-control" type="email" placeholder="ejemplo@dominio.com">
              <div id="err_email" class="error-text">Correo no válido.</div>
            </div>

            <div class="col-6 col-md-3">
              <label for="inicial" class="form-label">Nota inicial</label>
              <input id="inicial" name="inicial" class="form-control" type="number" step="0.01" placeholder="0-10">
              <div id="err_inicial" class="error-text">Número entre 0 y 10.</div>
            </div>
            <div class="col-6 col-md-3">
              <label for="primera" class="form-label">Primera</label>
              <input id="primera" name="primera" class="form-control" type="number" step="0.01" placeholder="0-10">
              <div id="err_primera" class="error-text">Número entre 0 y 10.</div>
            </div>
            <div class="col-6 col-md-3">
              <label for="segunda" class="form-label">Segunda</label>
              <input id="segunda" name="segunda" class="form-control" type="number" step="0.01" placeholder="0-10">
              <div id="err_segunda" class="error-text">Número entre 0 y 10.</div>
            </div>
            <div class="col-6 col-md-3">
              <label for="tercera" class="form-label">Tercera</label>
              <input id="tercera" name="tercera" class="form-control" type="number" step="0.01" placeholder="0-10">
              <div id="err_tercera" class="error-text">Número entre 0 y 10.</div>
            </div>

            <div class="col-12 text-end">
              <button id="btnSubmit" class="btn btn-primary" type="submit">Calcular (JS)</button>
              <button id="btnClear" type="button" class="btn btn-outline-secondary ms-2">Limpiar</button>
            </div>
          </div>
        </form>

        <div id="resultBox"></div>

        <hr>
        <div>
          <button id="runTests" class="btn btn-sm btn-secondary">Ejecutar batería de tests</button>
          <button id="demoStyle" class="btn btn-sm btn-info ms-2">Demo estilo (mouseover)</button>
          <pre id="testResults"></pre>
        </div>
      </div>
    </div>

    <p class="mt-3 small text-muted">Nota: Validación principal realizada por JavaScript en el cliente; en producción siempre validar también en servidor.</p>
  </div>

  <script>
    // Vanilla JS validation utilities and event wiring
    (function(){
      // Utilities
      function trimStr(s){ return (s||'').toString().trim(); }
      function isNumeric(v){ return !Number.isNaN(parseFloat(v)) && Number.isFinite(Number(v)); }
      function inRange(v, min, max){ return isNumeric(v) && Number(v) >= min && Number(v) <= max; }
      function isValidEmail(email){ var re = /^[^@\s]+@[^@\s]+\.[^@\s]+$/; return re.test(trimStr(email)); }

      // Elements
      var form = document.getElementById('formGrade');
      var nombre = document.getElementById('nombre');
      var email = document.getElementById('email');
      var fields = {
        inicial: document.getElementById('inicial'),
        primera: document.getElementById('primera'),
        segunda: document.getElementById('segunda'),
        tercera: document.getElementById('tercera')
      };
      var errs = {
        nombre: document.getElementById('err_nombre'),
        email: document.getElementById('err_email'),
        inicial: document.getElementById('err_inicial'),
        primera: document.getElementById('err_primera'),
        segunda: document.getElementById('err_segunda'),
        tercera: document.getElementById('err_tercera')
      };
      var resultBox = document.getElementById('resultBox');
      var testResults = document.getElementById('testResults');
      var runTestsBtn = document.getElementById('runTests');
      var btnClear = document.getElementById('btnClear');
      var card = document.getElementById('card');
      var title = document.getElementById('title');

      // Individual validators
      function validateNombre(){
        var v = trimStr(nombre.value);
        if (v.length < 2){ nombre.classList.add('is-invalid'); errs.nombre.style.display='block'; return false; }
        nombre.classList.remove('is-invalid'); errs.nombre.style.display='none'; return true;
      }

      function validateEmail(){
        var v = trimStr(email.value);
        if (!isValidEmail(v)){ email.classList.add('is-invalid'); errs.email.style.display='block'; return false; }
        email.classList.remove('is-invalid'); errs.email.style.display='none'; return true;
      }

      function validateNote(name){
        var el = fields[name];
        var v = trimStr(el.value);
        if (!inRange(v,0,10)){ el.classList.add('is-invalid'); errs[name].style.display='block'; return false; }
        el.classList.remove('is-invalid'); errs[name].style.display='none'; return true;
      }

      // Attach events with addEventListener
      nombre.addEventListener('change', validateNombre);
      nombre.addEventListener('blur', function(){ nombre.value = trimStr(nombre.value); });
      // double click on title trims name (demo of dblclick)
      title.addEventListener('dblclick', function(){ nombre.value = trimStr(nombre.value); validateNombre(); });

      email.addEventListener('change', validateEmail);

      Object.keys(fields).forEach(function(k){
        var el = fields[k];
        el.addEventListener('change', function(){ validateNote(k); });
        el.addEventListener('input', function(){ /* live feedback */ validateNote(k); });
      });

      // mouse over/out demo
      card.addEventListener('mouseover', function(){ card.classList.add('highlight'); });
      card.addEventListener('mouseout', function(){ card.classList.remove('highlight'); });

      // submit handler
      form.addEventListener('submit', function(e){
        e.preventDefault();
        var ok = true;
        if (!validateNombre()) ok = false;
        if (!validateEmail()) ok = false;
        Object.keys(fields).forEach(function(k){ if (!validateNote(k)) ok = false; });

        if (!ok){ resultBox.innerHTML = '<div class="alert alert-danger">Corrige los errores antes de continuar.</div>'; return; }

        // compute average and display result (client-side)
        var a = parseFloat(fields.inicial.value);
        var b = parseFloat(fields.primera.value);
        var c = parseFloat(fields.segunda.value);
        var d = parseFloat(fields.tercera.value);
        var avg = (a + b + c + d) / 4.0;
        resultBox.innerHTML = '<div class="alert alert-success">' +
          '<p><strong>' + escapeHtml(nombre.value) + '</strong> (' + escapeHtml(email.value) + ')</p>' +
          '<p>Calificación final (media simple): <strong>' + avg.toFixed(2) + '</strong></p>' +
          '</div>';
      });

      // Clear button
      btnClear.addEventListener('click', function(){ form.reset(); resultBox.innerHTML=''; Object.keys(errs).forEach(function(k){ errs[k].style.display='none'; }); Object.keys(fields).forEach(function(k){ fields[k].classList.remove('is-invalid'); }); nombre.classList.remove('is-invalid'); email.classList.remove('is-invalid'); });

      // Test battery for numeric validation
      function runTests(){
        var samples = [
          {val:'5', ok:true}, {val:'10', ok:true}, {val:'0', ok:true}, {val:'-1', ok:false}, {val:'11', ok:false}, {val:'abc', ok:false}, {val:'', ok:false}, {val:'7.25', ok:true}
        ];
        var out = [];
        samples.forEach(function(s){
          var res = inRange(s.val,0,10);
          out.push('"'+s.val+'" -> valid: '+res+' (expected '+s.ok+')');
        });
        testResults.textContent = out.join('\n');
      }
      runTestsBtn.addEventListener('click', runTests);

      // small safe escape for output
      function escapeHtml(str){ return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

      // Demo style button triggers mouseover/out programmatically
      document.getElementById('demoStyle').addEventListener('click', function(){ card.classList.add('highlight'); setTimeout(function(){ card.classList.remove('highlight'); }, 800); });

    })();
  </script>

</body>
</html>

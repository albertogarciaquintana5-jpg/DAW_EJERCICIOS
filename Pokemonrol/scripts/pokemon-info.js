/**
 * pokemon-info.js
 * Maneja el modal de información detallada del Pokémon con visualización de stats en rombo
 */

// Variable global para almacenar datos del Pokémon
let currentPokemonData = null;

/**
 * Muestra el modal con información detallada del Pokémon
 */
async function showPokemonInfo(boxId) {
  try {
    // Cargar información desde API
    const res = await fetch('api/get_pokemon_info.php?box_id=' + boxId);
    if (!res.ok) {
      showToast('Error al cargar información del Pokémon', 'danger');
      return;
    }

    const data = await res.json();
    if (!data.success) {
      showToast(data.error || 'Error desconocido', 'danger');
      return;
    }

    currentPokemonData = data;
    renderPokemonInfoModal(data);

    // Mostrar modal
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('pokemonInfoModal'));
    modal.show();

  } catch (e) {
    console.error('Error cargando info:', e);
    showToast('Error de red al cargar información', 'danger');
  }
}

/**
 * Renderiza el contenido del modal con toda la información
 */
function renderPokemonInfoModal(data) {
  const pokemon = data.pokemon;
  const stats = data.stats;
  const statsBase = data.stats_base;
  const movimientos = data.movimientos || [];
  const movimientosDisponibles = data.movimientos_disponibles || [];

  const container = document.getElementById('pokemonInfoContent');
  
  // Construir HTML del modal
  let html = `
    <div class="pokemon-info-header" style="margin: -1rem -1rem 1rem -1rem;">
      <h3 style="color:white; font-weight:700; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
        ${escapeHtml(pokemon.apodo || pokemon.nombre_especie)}
      </h3>
      <div class="pokemon-info-sprite">
        ${pokemon.sprite ? `<img src="img/pokemon/${escapeHtml(pokemon.sprite)}" alt="${escapeHtml(pokemon.nombre_especie)}">` : '⚡'}
      </div>
      <div class="pokemon-info-meta">
        <div class="pokemon-info-meta-item">
          <strong>Especie</strong>
          ${escapeHtml(pokemon.nombre_especie)}
        </div>
        <div class="pokemon-info-meta-item">
          <strong>Nivel</strong>
          ${pokemon.nivel}
        </div>
        <div class="pokemon-info-meta-item">
          <strong>CP</strong>
          ${pokemon.cp}
        </div>
        <div class="pokemon-info-meta-item">
          <strong>HP</strong>
          ${pokemon.hp_actual}/${pokemon.hp_maximo}
        </div>
      </div>
    </div>

    <!-- STATS DIAMOND (ROMBO) -->
    <div class="stats-diamond-container">
      ${renderStatsDiamond(stats, statsBase)}
    </div>

    <!-- NATURALEZA Y HABILIDAD -->
    <div class="pokemon-nature-ability">
      <div class="pokemon-nature-section">
        <div class="pokemon-nature-name">🎭 Naturaleza: ${escapeHtml(pokemon.naturaleza)}</div>
        <div class="pokemon-nature-effect">
          ${pokemon.stat_aumentado || pokemon.stat_reducido ? `
            ${pokemon.stat_aumentado ? `<span style="color:#4caf50;">↑ ${pokemon.stat_aumentado}</span>` : ''}
            ${pokemon.stat_reducido ? `<span style="color:#f44336;">↓ ${pokemon.stat_reducido}</span>` : ''}
          ` : 'Sin efectos (neutral)'}
        </div>
      </div>

      <div class="pokemon-ability-section">
        <div class="pokemon-ability-name">⚡ Habilidad: ${escapeHtml(pokemon.habilidad)}</div>
        <div class="pokemon-ability-desc">${escapeHtml(pokemon.habilidad_descripcion || 'Sin descripción')}</div>
      </div>
    </div>

    <!-- MOVIMIENTOS APRENDIDOS -->
    <div class="pokemon-moves-section">
      <div class="pokemon-moves-title">
        <span>🎯 Movimientos (${movimientos.length}/4)</span>
      </div>
      <div class="pokemon-moves-list">
        ${movimientos.length === 0 ? `
          <div class="small-muted" style="padding: 1rem; text-align:center;">
            Este Pokémon no conoce ningún movimiento aún
          </div>
        ` : movimientos.map((move, idx) => `
          <div class="move-card">
            <div class="move-slot-badge">${move.slot}</div>
            <div class="move-type-badge" style="background-color: ${escapeHtml(move.tipo_color || '#888')};">
              ${escapeHtml(move.tipo || 'Normal')}
            </div>
            <div class="move-info">
              <div class="move-name">${escapeHtml(move.nombre)}</div>
              <div class="move-stats">
                ${move.potencia > 0 ? `<div class="move-stat-item"><strong>Potencia:</strong> ${move.potencia}</div>` : ''}
                ${move.categoria !== 'estado' ? `<div class="move-stat-item"><strong>Precisión:</strong> ${move.precision}%</div>` : ''}
                <div class="move-stat-item"><strong>PP:</strong> ${move.pp}</div>
              </div>
            </div>
            <div class="move-pp">
              <div class="move-pp-bar">
                <div class="move-pp-fill" style="width: ${((move.pp_actual || move.pp) / move.pp) * 100}%"></div>
              </div>
              <small>${move.pp_actual || move.pp}/${move.pp}</small>
            </div>
            <button class="btn btn-sm btn-outline-danger" onclick="forgetMove(${pokemon.id}, ${move.slot})">Olvidar</button>
          </div>
        `).join('')}
      </div>
    </div>

    <!-- MOVIMIENTOS DISPONIBLES PARA APRENDER -->
    <div class="learn-moves-section">
      <div class="learn-moves-title">
        📚 Movimientos disponibles para aprender (${movimientosDisponibles.length})
      </div>
      <div class="learn-moves-grid">
        ${movimientosDisponibles.length === 0 ? `
          <div class="small-muted" style="padding: 1rem; text-align:center;">
            No hay movimientos disponibles para esta especie
          </div>
        ` : movimientosDisponibles.map((move) => `
          <div class="available-move-card">
            <div class="available-move-name">${escapeHtml(move.nombre)}</div>
            <div class="available-move-level">Nv. ${move.nivel_aprendizaje}</div>
            ${movimientos.length < 4 ? `
              <button class="btn btn-sm btn-primary" onclick="learnMove(${pokemon.id}, ${move.id}, ${movimientos.length + 1})">
                Enseñar
              </button>
            ` : ''}
          </div>
        `).join('')}
      </div>
    </div>
  `;

  container.innerHTML = html;
}

/**
 * Renderiza el rombo de estadísticas
 */
function renderStatsDiamond(stats, statsBase) {
  const stats_order = ['hp', 'ataque', 'defensa', 'sp_ataque', 'sp_defensa', 'velocidad'];
  const stat_labels_es = {
    'hp': 'HP',
    'ataque': 'ATQ',
    'defensa': 'DEF',
    'sp_ataque': 'ESP.ATQ',
    'sp_defensa': 'ESP.DEF',
    'velocidad': 'VEL'
  };

  // Encontrar el valor máximo para normalizar
  const maxValue = Math.max(...Object.values(stats));
  const radius = 80;

  // Calcular puntos del rombo (posiciones normalizadas)
  const points = {};
  const angles = {
    'hp': -90,          // Arriba derecha
    'ataque': -30,       // Arriba
    'defensa': 30,       // Derecha
    'sp_ataque': 90,     // Abajo derecha
    'velocidad': 150,    // Abajo
    'sp_defensa': -150   // Izquierda
  };

  Object.keys(angles).forEach(stat => {
    const angle = angles[stat] * Math.PI / 180;
    const ratio = stats[stat] / maxValue;
    const r = radius * ratio;
    points[stat] = {
      x: 100 + r * Math.cos(angle),
      y: 100 + r * Math.sin(angle),
      angle: angle
    };
  });

  // Crear SVG con el polígono del rombo
  let svg = `
    <svg width="200" height="200" viewBox="0 0 200 200" style="position: relative;">
      <!-- Grid lines -->
      <line x1="100" y1="20" x2="100" y2="180" stroke="#ddd" stroke-width="1"/>
      <line x1="20" y1="100" x2="180" y2="100" stroke="#ddd" stroke-width="1"/>
      
      <!-- Polygon fill -->
      <polygon points="${stats_order.map(s => `${points[s].x},${points[s].y}`).join(' ')}" 
               fill="rgba(255, 203, 5, 0.2)" 
               stroke="#ffcb05" 
               stroke-width="2"/>
      
      <!-- Grid circles (opcional) -->
      ${[0.25, 0.5, 0.75, 1].map(r => `
        <circle cx="100" cy="100" r="${radius * r}" fill="none" stroke="#eee" stroke-width="0.5" stroke-dasharray="2,2"/>
      `).join('')}
    </svg>
  `;

  // HTML del rombo con labels
  let html = `
    <div class="stats-diamond" style="position: relative;">
      ${svg}
      
      <!-- Centro -->
      <div class="stats-diamond-center">${stats.velocidad}</div>
      
      <!-- Labels de stats -->
      <div class="stat-label hp">
        <div class="stat-label-value">${stats.hp}</div>
        <div class="stat-label-name">HP</div>
      </div>
      <div class="stat-label ataque">
        <div class="stat-label-value">${stats.ataque}</div>
        <div class="stat-label-name">ATQ</div>
      </div>
      <div class="stat-label defensa">
        <div class="stat-label-value">${stats.defensa}</div>
        <div class="stat-label-name">DEF</div>
      </div>
      <div class="stat-label sp_ataque">
        <div class="stat-label-value">${stats.sp_ataque}</div>
        <div class="stat-label-name">ESP.ATQ</div>
      </div>
      <div class="stat-label sp_defensa">
        <div class="stat-label-value">${stats.sp_defensa}</div>
        <div class="stat-label-name">ESP.DEF</div>
      </div>
      <div class="stat-label velocidad">
        <div class="stat-label-value">${stats.velocidad}</div>
        <div class="stat-label-name">VEL</div>
      </div>
    </div>
  `;

  return html;
}

/**
 * Enseña un movimiento al Pokémon
 */
async function learnMove(pokemonId, moveId, slot) {
  try {
    const res = await fetch('api/learn_move.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({
        box_id: pokemonId,
        movimiento_id: moveId,
        slot: slot,
        action: 'add'
      })
    });

    const data = await res.json();
    if (!data.success) {
      showToast(data.error || 'Error enseñando movimiento', 'danger');
      return;
    }

    showToast('¡Movimiento aprendido!', 'success');
    
    // Recargar información
    if (currentPokemonData) {
      currentPokemonData.movimientos = data.movimientos;
      renderPokemonInfoModal(currentPokemonData);
    }

  } catch (e) {
    console.error('Error:', e);
    showToast('Error de red', 'danger');
  }
}

/**
 * Olvida un movimiento
 */
async function forgetMove(pokemonId, slot) {
  if (!confirm('¿Deseas que olvide este movimiento?')) return;

  try {
    const res = await fetch('api/learn_move.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({
        box_id: pokemonId,
        slot: slot,
        action: 'remove'
      })
    });

    const data = await res.json();
    if (!data.success) {
      showToast(data.error || 'Error olvidando movimiento', 'danger');
      return;
    }

    showToast('Movimiento olvidado', 'success');
    
    // Recargar información
    if (currentPokemonData) {
      currentPokemonData.movimientos = data.movimientos;
      renderPokemonInfoModal(currentPokemonData);
    }

  } catch (e) {
    console.error('Error:', e);
    showToast('Error de red', 'danger');
  }
}

/**
 * Escapa caracteres HTML para evitar XSS
 */
function escapeHtml(text) {
  if (!text) return '';
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, m => map[m]);
}

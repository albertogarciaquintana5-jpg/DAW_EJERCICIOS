<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
  // No está autenticado
  $_SESSION['error'] = 'Debes iniciar sesión para ver el panel.';
  header('Location: index.php'); exit;
}
$userRaw = $_SESSION['user'];
$user = htmlspecialchars(($userRaw['nombre'] ?? $userRaw['correo'] ?? 'Entrenador'));
$user_id = (int)($userRaw['id'] ?? 0);

// Fetch user's data from DB to render dynamic dashboard
$inventory = [];
$box = [];
$team = [];
$pokedex = [];
$species = [];
if ($user_id > 0) {
  // inventory
  $sql = "SELECT i.cantidad, i.item_id, it.nombre, it.clave, it.icono, it.descripcion, it.effect_type, it.effect_value FROM inventario i JOIN items it ON it.id=i.item_id WHERE i.user_id = ?";
  if ($stmt = $mysqli->prepare($sql)) { $stmt->bind_param('i', $user_id); $stmt->execute(); $res = $stmt->get_result(); while ($r = $res->fetch_assoc()) $inventory[] = $r; $stmt->close(); }

  // box
  $sql = "SELECT pb.*, ps.nombre AS especie, ps.sprite AS sprite FROM pokemon_box pb JOIN pokemon_species ps ON ps.id = pb.species_id WHERE pb.user_id = ? ORDER BY pb.created_at DESC";
  if ($stmt = $mysqli->prepare($sql)) { $stmt->bind_param('i', $user_id); $stmt->execute(); $res = $stmt->get_result(); while ($r = $res->fetch_assoc()) $box[] = $r; $stmt->close(); }

  // team
  $sql = "SELECT t.slot, pb.id AS box_id, ps.nombre AS especie, ps.sprite AS sprite, pb.apodo, pb.nivel, pb.cp FROM team t LEFT JOIN pokemon_box pb ON t.pokemon_box_id = pb.id LEFT JOIN pokemon_species ps ON pb.species_id = ps.id WHERE t.user_id = ? ORDER BY t.slot ASC";
  if ($stmt = $mysqli->prepare($sql)) { $stmt->bind_param('i', $user_id); $stmt->execute(); $res = $stmt->get_result(); while ($r = $res->fetch_assoc()) $team[] = $r; $stmt->close(); }

  // pokedex entries
  $sql = "SELECT p.species_id, ps.nombre, p.visto, p.capturado, p.veces_visto, p.first_seen_at FROM pokedex p JOIN pokemon_species ps ON p.species_id = ps.id WHERE p.user_id = ?";
  if ($stmt = $mysqli->prepare($sql)) { $stmt->bind_param('i', $user_id); $stmt->execute(); $res = $stmt->get_result(); while ($r = $res->fetch_assoc()) $pokedex[$r['species_id']] = $r; $stmt->close(); }

  // all species (for showing unknowns) limited to some for demo
  $sql = "SELECT id, nombre, sprite FROM pokemon_species ORDER BY id LIMIT 200";
  if ($stmt = $mysqli->prepare($sql)) { $stmt->execute(); $res = $stmt->get_result(); while ($r = $res->fetch_assoc()) $species[] = $r; $stmt->close(); }
}

// Shop items (items with a price)
$shop_items = [];
if ($user_id > 0) {
  $sql = "SELECT id, clave, nombre, descripcion, icono, price FROM items WHERE price IS NOT NULL ORDER BY id";
  if ($stmt = $mysqli->prepare($sql)) { $stmt->execute(); $res = $stmt->get_result(); while ($r = $res->fetch_assoc()) $shop_items[] = $r; $stmt->close(); }
}

// Get user money balance
$money = 0.00;
if ($user_id > 0) {
  $sql = "SELECT money FROM usuarios WHERE id = ? LIMIT 1";
  if ($stmt = $mysqli->prepare($sql)) { $stmt->bind_param('i', $user_id); $stmt->execute(); $res = $stmt->get_result(); if ($r = $res->fetch_assoc()) $money = (float)$r['money']; $stmt->close(); }
}

// Map equipped box ids to slot for quick reference
$equippedBoxMap = [];
foreach ($team as $t) {
  if (!empty($t['box_id'])) $equippedBoxMap[$t['box_id']] = $t['slot'];
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel - Pokémon Rol</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="p-4">
  <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1>Bienvenido, <?= $user; ?></h1>
        <p class="small-muted"><?= htmlspecialchars($userRaw['correo'] ?? '') ?> · Tu panel de entrenador</p>
        <?php if (isset($money)): ?>
          <div class="mt-1"><span class="badge bg-warning text-dark">Saldo: € <?= number_format($money, 2, ',', '.'); ?></span></div>
        <?php endif; ?>
      </div>
      <div>
        <a href="index.php" class="btn btn-outline-dark">Cerrar sesión</a>
      </div>
    </div>
    <!-- Toast container -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 100px;">
      <div id="toastContainer" style="position: absolute; top: 0; right: 0;"></div>
    </div>
    <div class="dashboard-container">
      <aside class="sidebar">
        <h5 class="mb-3">Menú</h5>
          <ul class="nav nav-pills flex-column" id="menuTabs" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#d20" type="button"> <span class="emoji">🎲</span> Tirar D20</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#inventario" type="button"> <span class="emoji">👜</span> Inventario</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#caja" type="button"> <span class="emoji">📦</span> Caja Pokémon</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#equipo" type="button"> <span class="emoji">⚔️</span> Equipo</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pokedex" type="button"> <span class="emoji">📘</span> Pokédex</button></li>
          </ul>
      </aside>
        <main class="flex-fill">
          <div class="d-block d-md-none mb-3">
            <nav class="nav nav-pills justify-content-around">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#d20">🎲</button>
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#inventario">👜</button>
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#caja">📦</button>
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#equipo">⚔️</button>
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pokedex">📘</button>
            </nav>
          </div>
          <div class="tab-content">
            <!-- D20 TAB -->
            <div class="tab-pane fade" id="d20" role="tabpanel">
              <div class="card p-3 card-section">
                <div class="section-title">Tirar D20</div>
                <div class="small-muted mb-2">Tira un dado de 20 típico de rol. Se guarda el historial en tu navegador.</div>
                <div class="d-flex align-items-center gap-3">
                  <button class="btn btn-lg btn-primary" onclick="rollD20()">🎲 Tirar D20</button>
                  <div id="d20Result" class="fw-bold fs-3">--</div>
                </div>
                <div class="mt-3">
                  <div class="fw-bold">Historial</div>
                  <ul id="d20History" class="list-group mt-2"></ul>
                </div>
              </div>
            </div>
            <!-- INVENTARIO TAB -->
            <div class="tab-pane fade show active" id="inventario" role="tabpanel">
              <div class="card p-3 card-section">
                <div class="section-title">Inventario</div>
                <div class="small-muted mb-2">Objetos disponibles <b>(dime de meterte algun objeto)</b></div>
                <div class="d-grid gap-2">
                  <?php if (count($inventory) === 0): ?>
                  <div class="small-muted">No tienes items en el inventario.</div>
                  <?php else: foreach ($inventory as $it): ?>
                  <?php $iconClass = 'ball';
                        if (strpos(strtolower($it['clave']), 'potion') !== false) $iconClass = 'potion';
                        if (strpos(strtolower($it['clave']), 'great') !== false || strpos(strtolower($it['clave']), 'super') !== false) $iconClass = 'pokeball';
                  ?>
                  <div class="item-card" data-item-id="<?= (int)$it['item_id'] ?>" data-item-clave="<?= htmlspecialchars($it['clave']) ?>" data-effect-type="<?= htmlspecialchars($it['effect_type'] ?? '') ?>" data-effect-value="<?= htmlspecialchars($it['effect_value'] ?? '') ?>">
                    <?php
                      $iconPath = '';
                      if (!empty($it['icono'])) {
                        $given = $it['icono'];
                        $base = pathinfo($given, PATHINFO_FILENAME);
                        $svgPathLocal = __DIR__ . '/img/items/' . $base . '.svg';
                        $givenLocal = __DIR__ . '/img/items/' . $given;
                        $pngLocal = __DIR__ . '/img/items/' . $base . '.png';
                        if (file_exists($svgPathLocal)) {
                          $iconPath = 'img/items/' . $base . '.svg';
                        } elseif (file_exists($givenLocal)) {
                          $iconPath = 'img/items/' . $given;
                        } elseif (file_exists($pngLocal)) {
                          $iconPath = 'img/items/' . $base . '.png';
                        }
                      }
                      if ($iconPath === '') $iconPath = 'img/items/default.svg';
                    ?>
                    <div class="item-avatar <?= $iconClass ?>">
                      <img class="item-img" src="<?= htmlspecialchars($iconPath) ?>" alt="<?= htmlspecialchars($it['nombre'] ?? '') ?>">
                    </div>
                    <div class="item-meta">
                      <div class="fw-bold"><?= htmlspecialchars($it['nombre']); ?></div>
                      <div class="small-muted">Cantidad: <span class="item-qty"><?= (int)$it['cantidad'] ?></span></div>
                      <?php if (!empty($it['effect_type'])): ?>
                      <div class="tiny-muted">Efecto: <?= htmlspecialchars($it['effect_type']) ?><?= isset($it['effect_value']) && $it['effect_value'] !== null ? ' (' . htmlspecialchars($it['effect_value']) . ')' : '' ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="item-actions">
                      <button class="btn btn-sm btn-outline-primary" onclick="useItem(<?= (int)$it['item_id'] ?>, this)">Usar</button>
                      <button class="btn btn-sm btn-outline-secondary" onclick="showSendItemModal(<?= (int)$it['item_id'] ?>)">Enviar</button>
                    </div>
                  </div>
                  <?php endforeach; endif; ?>
                </div>
              </div>
              <!-- Tienda: items con precio -->
              <div class="card p-3 mt-3">
                <div class="section-title">Tienda</div>
                <div class="small-muted mb-2">Compra objetos disponibles</div>
                <div class="d-grid gap-2">
                  <?php if (empty($shop_items)): ?>
                    <div class="small-muted">No hay artículos en la tienda.</div>
                  <?php else: foreach ($shop_items as $si): ?>
                    <div class="d-flex align-items-center justify-content-between shop-item">
                      <div class="d-flex align-items-center">
                        <?php
                          $shopIconPath = '';
                          if (!empty($si['icono'])) {
                            $given = $si['icono'];
                            $base = pathinfo($given, PATHINFO_FILENAME);
                            $svgLocal = __DIR__ . '/img/items/' . $base . '.svg';
                            $givenLocal = __DIR__ . '/img/items/' . $given;
                            $pngLocal = __DIR__ . '/img/items/' . $base . '.png';
                            if (file_exists($svgLocal)) {
                              $shopIconPath = 'img/items/' . $base . '.svg';
                            } elseif (file_exists($givenLocal)) {
                              $shopIconPath = 'img/items/' . $given;
                            } elseif (file_exists($pngLocal)) {
                              $shopIconPath = 'img/items/' . $base . '.png';
                            }
                          }
                          if ($shopIconPath === '') $shopIconPath = 'img/items/default.svg';
                        ?>
                        <div class="item-avatar" style="width:48px;height:48px; margin-right:12px;">
                          <img src="<?= htmlspecialchars($shopIconPath) ?>" alt="<?= htmlspecialchars($si['nombre']) ?>">
                        </div>
                        <div>
                          <div class="fw-bold"><?= htmlspecialchars($si['nombre']) ?></div>
                          <div class="small-muted"><?= htmlspecialchars($si['descripcion'] ?? '') ?></div>
                        </div>
                      </div>
                      <div class="text-end">
                        <div class="fw-bold">€ <?= number_format((float)$si['price'], 2, ',', '.') ?></div>
                        <div class="mt-1"><button class="btn btn-sm btn-primary" onclick="buyItem('<?= htmlspecialchars($si['clave']) ?>', 1)">Comprar</button></div>
                      </div>
                    </div>
                  <?php endforeach; endif; ?>
                </div>
              </div>
            </div>

            <!-- CAJA TAB -->
            <div class="tab-pane fade" id="caja" role="tabpanel">
              <div class="card p-3 card-section">
                <div class="section-title">Caja Pokémon</div>
                <div class="small-muted mb-2">Pokémon guardados <b>(dime de meterte algum pokémon</b></div>
                <div class="d-grid gap-2">
                  <?php if (count($box) === 0): ?>
                  <div class="small-muted">No hay pokémon en la caja.</div>
                  <?php else: foreach($box as $pb): ?>
                  <?php $equippedSlot = isset($equippedBoxMap[$pb['id']]) ? (int)$equippedBoxMap[$pb['id']] : null; ?>
                  <div class="pokemon-card" data-box-id="<?= (int)$pb['id'] ?>">
                    <div class="pokemon-avatar">
                      <?php if (!empty($pb['sprite'])): ?>
                        <img src="img/pokemon/<?= htmlspecialchars($pb['sprite']) ?>" class="pokemon-img" alt="<?= htmlspecialchars($pb['apodo'] ?? $pb['especie'] ?? 'Pokémon') ?>">
                      <?php else: ?>
                        ⚡
                      <?php endif; ?>
                    </div>
                    <div class="pokemon-meta">
                      <h5><?= htmlspecialchars($pb['apodo'] ?? $pb['especie']); ?></h5>
                      <small>Nivel <?= (int)($pb['nivel'] ?? 0) ?> · CP <?= (int)($pb['cp'] ?? 0) ?><?php if ($pb['hp'] !== null): ?> · HP <?= (int)$pb['hp'] ?><?php endif; ?></small>
                    </div>
                    <div class="item-actions">
                      <?php if ($equippedSlot): ?>
                      <button class="btn btn-sm btn-outline-success" disabled>Equipado (<?= $equippedSlot ?>)</button>
                      <button class="btn btn-sm btn-outline-primary" onclick="showEquipModal(<?= (int)$pb['id'] ?>)">Mover</button>
                      <?php else: ?>
                      <button class="btn btn-sm btn-outline-primary" onclick="showEquipModal(<?= (int)$pb['id'] ?>)">Mover</button>
                      <?php endif; ?>
                      <button class="btn btn-sm btn-outline-secondary" onclick="showSendItemModal(<?= (int)$pb['id'] ?>)">Enviar</button>
                      <button class="btn btn-sm btn-outline-info" onclick="markAsSeen(<?= (int)$pb['species_id'] ?>)">Marcar Pokédex</button>
                    </div>
                  </div>
                  <?php endforeach; endif; ?>
                </div>
              </div>
            </div>

            <!-- EQUIPO TAB -->
            <div class="tab-pane fade" id="equipo" role="tabpanel">
              <div class="card p-3 card-section">
                <div class="section-title">Equipo Pokémon (debes tener un pokémon en la caja pokémon)</div>
                <div class="small-muted mb-2">Tu equipo activo</div>
                <div class="team-grid">
                  <?php for ($s=1;$s<=6;$s++): 
                      $slot = null;
                      foreach ($team as $t) if ((int)$t['slot'] === $s) { $slot = $t; break; }
                  ?>
                  <div class="team-slot" data-slot="<?= $s ?>">
                    <div class="pokemon-avatar">
                      <?php if (!$slot): ?>
                        ✨
                      <?php elseif (!empty($slot['sprite'])): ?>
                        <img src="img/pokemon/<?= htmlspecialchars($slot['sprite']) ?>" class="pokemon-img" alt="<?= htmlspecialchars($slot['especie'] ?? ($slot['apodo'] ?? 'Pokémon')) ?>">
                      <?php else: ?>
                        ⚔️
                      <?php endif; ?>
                    </div>
                    <div>
                      <div class="fw-bold"><?= $slot ? htmlspecialchars($slot['especie'] ?? ($slot['apodo'] ?? '')) : 'Libre' ?></div>
                      <div class="small-muted"><?= $slot ? ('Nivel ' . (int)($slot['nivel'] ?? 0)) : 'Vacío' ?></div>
                    </div>
                    <div class="item-actions">
                      <?php if ($slot): ?>
                      <button class="btn btn-sm btn-outline-danger" onclick="unequip(<?= $s ?>)">Desequipar</button>
                      <?php else: ?>
                      <button class="btn btn-sm btn-outline-primary" onclick="showEquipModal(null, <?= $s ?>)">Equipar</button>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php endfor; ?>
                </div>
              </div>
            </div>

            <!-- POKEDEX TAB -->
            <div class="tab-pane fade" id="pokedex" role="tabpanel">
              <div class="card p-3 card-section">
                <div class="section-title">Pokédex</div>
                <ul class="nav nav-tabs" id="pokedexTabs" role="tablist">
                  <li class="nav-item" role="presentation"><button class="nav-link active" id="pokemons-tab" data-bs-toggle="tab" data-bs-target="#pokemons" type="button" role="tab">Pokémon</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="personajes-tab" data-bs-toggle="tab" data-bs-target="#personajes" type="button" role="tab">Personajes</button></li>
                </ul>
                <div class="tab-content mt-3" id="pokedexContent">
                  <div class="tab-pane fade show active" id="pokemons" role="tabpanel">
                    <div class="small-muted mb-2">Tu lista de Pokémon en la Pokédex</div>
                    <div class="grid-unknown">
                      <?php foreach ($species as $sp):
                        $entry = $pokedex[$sp['id']] ?? null;
                        $seen = $entry && (int)$entry['visto'] === 1;
                      ?>
                      <div class="unknown-item">
                        <div class="unknown-avatar">
                          <?php if ($seen && !empty($sp['sprite'])): ?>
                            <img src="img/pokemon/<?= htmlspecialchars($sp['sprite']) ?>" class="pokemon-img" alt="<?= htmlspecialchars($sp['nombre']) ?>">
                          <?php else: ?>
                            <?= $seen ? '🐾' : '?' ?>
                          <?php endif; ?>
                        </div>
                        <div>
                          <div class="fw-bold"><?= $seen ? htmlspecialchars($sp['nombre']) : 'Desconocido' ?></div>
                          <div class="small-muted"><?= $seen ? 'Especie' : 'Sin registrar' ?></div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="personajes" role="tabpanel">
                    <div class="small-muted mb-2">Personajes descubiertos en tu aventura</div>
                    <div class="grid-unknown">
                      <?php for ($i=0;$i<8;$i++): ?>
                      <div class="unknown-item">
                        <div class="unknown-avatar">?</div>
                        <div>
                          <div class="fw-bold">Desconocido</div>
                          <div class="small-muted">Rol --</div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

  <!-- Equip Modal -->
  <div class="modal fade" id="equipModal" tabindex="-1" aria-labelledby="equipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="equipModalLabel">Equipar Pokémon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div id="equipModalPokemonInfo" class="mb-2"></div>
          <div class="d-grid gap-2">
            <!-- slot buttons inserted by JS -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="equipConfirmBtn">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Send Item Modal -->
  <div class="modal fade" id="sendItemModal" tabindex="-1" aria-labelledby="sendItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendItemModalLabel">Enviar Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div id="sendItemModalInfo" class="mb-2">Introduce el correo del destinatario</div>
          <input type="email" id="sendRecipientEmail" class="form-control mb-2" placeholder="correo@ejemplo.com">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="sendItemConfirmBtn">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Use Item Modal -->
  <div class="modal fade" id="useItemModal" tabindex="-1" aria-labelledby="useItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="useItemModalLabel">Usar Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div id="useItemModalInfo" class="mb-2">Selecciona el Pokémon objetivo</div>
          <div id="useItemModalGrid" class="d-grid gap-2"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
      </main>
    </div>
  </div>
</body>
</html>
<script>
  // Update active classes for sidebar and mobile top nav on tab show
  const tabLinks = document.querySelectorAll('.sidebar .nav-link, .d-block.d-md-none .nav-link');
  tabLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      // Buttons with data-bs-toggle handle tab show, but we update active classes for the UI
      tabLinks.forEach(l=>l.classList.remove('active'));
      this.classList.add('active');
    });
  });

  async function useItem(itemId, btn) {
    // Check item type (data attribute on card)
    try {
      const card = btn.closest('.item-card');
      const itemClave = card ? (card.dataset.itemClave || '').toLowerCase() : '';
      const effectType = card ? (card.dataset.effectType || '').toLowerCase() : '';
      // If the item has an effect that requires a target (heals, revive, clear_status), show modal to pick target
      const needsTarget = ['heal_flat','heal_percent','revive','clear_status'].includes(effectType) || itemClave.includes('potion') || itemClave.includes('pocion');
      if (needsTarget) {
        showUseItemModal(itemId, btn);
        return;
      }
      const origText = btn.textContent;
      btn.disabled = true;
      btn.textContent = 'Usando...';
      const res = await fetch('api/use_item.php', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify({ item_id: itemId }) });
      const j = await res.json();
      if (!j.success) showToast(j.error || 'Error al usar item', 'danger');
      else {
        // update the remaining quantity in the UI
        if (card) {
          const qtySpan = card.querySelector('.item-qty');
          if (qtySpan) qtySpan.textContent = j.remaining;
          if (j.remaining <= 0) {
            const useBtn = card.querySelector('button'); if (useBtn) { useBtn.disabled = true; useBtn.textContent = 'Agotado'; }
          }
        }
        if (j.applied) {
          showToast('Item aplicado: ' + (j.applied.healed ? ('+'+j.applied.healed+' HP') : 'OK'), 'success');
          // update specific pokemon HP if present
          const pcard = document.querySelector('.pokemon-card[data-box-id="' + j.applied.box_id + '"]');
          if (pcard) {
            // optionally show HP or visual feedback
            pcard.classList.add('border-success'); setTimeout(()=>pcard.classList.remove('border-success'), 1000);
          }
        } else {
          showToast('Item usado: ' + (j.remaining !== undefined ? ('Quedan ' + j.remaining) : ''), 'success');
        }
        // redraw inventory if provided
        if (j.inventory) renderInventory(j.inventory);
      }
    } catch (e) { showToast('Error de red', 'danger'); }
    finally { if (btn.textContent !== 'Agotado') { btn.textContent = 'Usar'; } btn.disabled = false; }
  }

  // (Modal-based equip implemented below) 


// After defining UI helpers, if server provided initial team, apply it now
try {
  if (window.__initial_team && typeof updateBoxEquippedState === 'function') {
    updateBoxEquippedState(window.__initial_team);
    if (typeof renderTeam === 'function') renderTeam(window.__initial_team);
  }
} catch(e) { console.warn('init team ui failed', e); }
  async function equipPokemon(boxId, slot) {
    const confirmBtn = document.getElementById('equipConfirmBtn');
    if (confirmBtn) confirmBtn.disabled = true;
    try {
      const res = await fetch('api/move_pokemon.php', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify({ action: 'equip', box_id: boxId, slot: slot }) });
      const j = await res.json();
      if (!j.success) showToast(j.error || 'Error al equipar', 'danger');
      else {
        showToast(j.message || 'Equipado', 'success');
        if (j.team) { renderTeam(j.team); updateBoxEquippedState(j.team); }
      }
    } catch (e) { showToast('Error de red', 'danger'); }
    finally { if (confirmBtn) confirmBtn.disabled = false; }
  }

  async function unequip(slot) {
    try {
      const res = await fetch('api/move_pokemon.php', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify({ action: 'unequip', slot: slot }) });
      const j = await res.json();
      if (!j.success) showToast(j.error || 'Error al desequipar', 'danger');
      else { showToast(j.message || 'Desequipado', 'success'); if (j.team) { renderTeam(j.team); updateBoxEquippedState(j.team); } }
    } catch (e) { showToast('Error de red', 'danger'); }
  }

  // Modal-based equip — build modal content dynamically
  let equipModalBoxId = null;
  let equipModalSelectedSlot = null;
  function showEquipModal(boxId, targetSlot = null) {
    const equipModalEl = document.getElementById('equipModal');
    const equipModal = bootstrap.Modal.getOrCreateInstance(equipModalEl);
    equipModalBoxId = boxId || null;
    equipModalSelectedSlot = targetSlot || null;
    const pokInfo = document.getElementById('equipModalPokemonInfo');
    const grid = equipModalEl.querySelector('.modal-body .d-grid');
    grid.innerHTML = '';
    if (!boxId && targetSlot) {
      // show list of box pokemons to choose from
      pokInfo.textContent = 'Selecciona un Pokémon de la caja para equipar en el slot ' + targetSlot;
      document.querySelectorAll('.pokemon-card[data-box-id]').forEach(el => {
        const bId = el.dataset.boxId;
        const title = el.querySelector('.pokemon-meta h5') ? el.querySelector('.pokemon-meta h5').textContent : ('#' + bId);
        const btn = document.createElement('button');
        btn.type = 'button'; btn.className = 'btn btn-outline-primary text-start';
        btn.textContent = title + ' (ID ' + bId + ')';
        btn.addEventListener('click', () => { equipModalBoxId = parseInt(bId); equipModalSelectedSlot = targetSlot; showEquipModal(equipModalBoxId, equipModalSelectedSlot); });
        grid.appendChild(btn);
      });
    } else {
      pokInfo.textContent = 'Pokémon ID: ' + (boxId ? boxId : '---');
      for (let s = 1; s <= 6; s++) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-outline-primary';
        btn.textContent = 'Slot ' + s;
        btn.dataset.slot = s;
        if (s === targetSlot) btn.classList.add('active');
        btn.addEventListener('click', () => {
          equipModalSelectedSlot = s;
          grid.querySelectorAll('button').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
        });
        grid.appendChild(btn);
      }
    }
    // On confirm, trigger equip
    const confirmBtn = document.getElementById('equipConfirmBtn');
    confirmBtn.onclick = async () => {
      if (!equipModalSelectedSlot) { showToast('Selecciona un slot', 'danger'); return; }
      if (!equipModalBoxId) { showToast('Selecciona primero un Pokémon de la caja.', 'danger'); return; }
      const origText = confirmBtn.textContent;
      confirmBtn.textContent = 'Equipando...';
      confirmBtn.disabled = true;
      await equipPokemon(equipModalBoxId, equipModalSelectedSlot);
      confirmBtn.textContent = origText;
      confirmBtn.disabled = false;
      equipModal.hide();
    };
    equipModal.show();
  }

  // -- Dynamic UI helpers
  function renderTeam(teamData) {
    const grid = document.querySelector('.team-grid');
    if (!grid) return;
    // Create a map slot -> data
    const map = {};
    for (let t of teamData) map[parseInt(t.slot)] = t;
    for (let s = 1; s <= 6; s++) {
      const slotEl = grid.querySelector('.team-slot[data-slot="' + s + '"]');
      if (!slotEl) continue;
      const t = map[s] || null;
      const avatar = slotEl.querySelector('.pokemon-avatar');
      const title = slotEl.querySelector('.fw-bold');
      const sub = slotEl.querySelector('.small-muted');
      const actions = slotEl.querySelector('.item-actions');
      if (t && t.box_id) {
        // Update avatar with <img> or emoji
        if (t.sprite) {
          avatar.innerHTML = '<img src="img/pokemon/' + t.sprite + '" class="pokemon-img">';
        } else {
          avatar.innerHTML = '⚔️';
        }
        title.textContent = t.especie || (t.apodo || '');
        sub.textContent = 'Nivel ' + (t.nivel || 0);
        actions.innerHTML = '<button class="btn btn-sm btn-outline-danger" onclick="unequip(' + s + ')">Desequipar</button>';
      } else {
        avatar.innerHTML = '✨';
        title.textContent = 'Libre';
        sub.textContent = 'Vacío';
        actions.innerHTML = '<button class="btn btn-sm btn-outline-primary" onclick="showEquipModal(null, ' + s + ')">Equipar</button>';
      }
    }
  }

  function updateBoxEquippedState(teamData) {
    // Build a map of box_id -> slot
    const map = {};
    for (let t of teamData) if (t.box_id) map[parseInt(t.box_id)] = t.slot;
    document.querySelectorAll('.pokemon-card[data-box-id]').forEach(el => {
      const bId = parseInt(el.dataset.boxId);
      const actions = el.querySelector('.item-actions');
      if (map[bId]) {
        actions.innerHTML = '<button class="btn btn-sm btn-outline-success" disabled>Equipado (' + map[bId] + ')</button> <button class="btn btn-sm btn-outline-primary" onclick="showEquipModal(' + bId + ')">Mover</button>';
      } else {
        actions.innerHTML = '<button class="btn btn-sm btn-outline-primary" onclick="showEquipModal(' + bId + ')">Mover</button>';
      }
    });
  }

  function renderInventory(inv) {
    // inv: array of {item_id, cantidad, nombre}
    for (const it of inv) {
      const card = document.querySelector('.item-card[data-item-id="' + it.item_id + '"]');
      if (!card) continue;
      const qtySpan = card.querySelector('.item-qty'); if (qtySpan) qtySpan.textContent = it.cantidad;
      const useBtn = card.querySelector('button'); if (useBtn) { useBtn.disabled = (it.cantidad <= 0); if (it.cantidad <= 0) useBtn.textContent = 'Agotado'; }
    }
  }

  // Toast helper
  function showToast(message, type='success') {
    const container = document.getElementById('toastContainer'); if (!container) return;
    const id = 'toast-' + Math.random().toString(36).substr(2,9);
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-' + (type === 'danger' ? 'danger' : 'success') + ' border-0';
    toast.role = 'alert'; toast.ariaLive = 'assertive'; toast.ariaAtomic = 'true';
    toast.id = id;
    toast.innerHTML = '<div class="d-flex"><div class="toast-body">' + message + '</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div>';
    container.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast, { delay: 3000 }); bsToast.show();
    // remove when hidden
    toast.addEventListener('hidden.bs.toast', () => { toast.remove(); });
  }

  // Show use item modal for potions
  let useModalItemId = null;
  function showUseItemModal(itemId, btn) {
    useModalItemId = itemId;
    const modalEl = document.getElementById('useItemModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    const info = document.getElementById('useItemModalInfo');
    const grid = document.getElementById('useItemModalGrid');
    // If caller provided the button, read effect info from the card
    let effectInfo = '';
    if (btn) {
      const card = btn.closest('.item-card');
      if (card) {
        const et = card.dataset.effectType || '';
        const ev = card.dataset.effectValue || '';
        if (et) effectInfo = ' (' + et + (ev ? ' ' + ev : '') + ')';
      }
    }
    info.textContent = 'Selecciona el Pokémon objetivo para usar el ítem' + effectInfo;
    grid.innerHTML = '';
    document.querySelectorAll('.pokemon-card[data-box-id]').forEach(el => {
      const bId = parseInt(el.dataset.boxId);
      const title = el.querySelector('.pokemon-meta h5') ? el.querySelector('.pokemon-meta h5').textContent : ('#' + bId);
      const btn2 = document.createElement('button'); btn2.type = 'button'; btn2.className = 'btn btn-outline-primary text-start';
      btn2.textContent = title + ' (ID ' + bId + ')';
      btn2.addEventListener('click', () => {
        // call API with item_id and box_id
        useItemConfirm(useModalItemId, bId);
        modal.hide();
      });
      grid.appendChild(btn2);
    });
    modal.show();
  }

  async function useItemConfirm(itemId, boxId) {
    try {
      const res = await fetch('api/use_item.php', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify({ item_id: itemId, box_id: boxId }) });
      const j = await res.json();
      if (!j.success) showToast(j.error || 'Error al usar item', 'danger');
      else {
        showToast(j.message || 'Item aplicado', 'success');
        if (j.applied) {
          const pcard = document.querySelector('.pokemon-card[data-box-id="' + j.applied.box_id + '"]');
          if (pcard) {
            pcard.classList.add('border-success'); setTimeout(()=>pcard.classList.remove('border-success'), 1000);
          }
        }
        if (j.inventory) renderInventory(j.inventory);
      }
    } catch (e) { showToast('Error de red', 'danger'); }
  }

  // Send item modal & handler
  let sendItemCurrentBoxId = null;
  function showSendItemModal(boxId) {
    const sendModalEl = document.getElementById('sendItemModal');
    const modal = bootstrap.Modal.getOrCreateInstance(sendModalEl);
    const input = document.getElementById('sendRecipientEmail'); input.value = '';
    sendItemCurrentBoxId = boxId;
    const btn = document.getElementById('sendItemConfirmBtn');
    btn.onclick = async () => {
      const email = input.value.trim(); if (!email) { showToast('Introduce un correo válido', 'danger'); return; }
      btn.disabled = true; btn.textContent = 'Enviando...';
      try {
        const res = await fetch('api/send_item.php', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify({ item_id: sendItemCurrentBoxId, to_email: email }) });
        const j = await res.json();
        if (!j.success) showToast(j.error || 'Error enviando item', 'danger'); else { showToast(j.message || 'Enviado', 'success'); if (j.inventory) renderInventory(j.inventory); }
      } catch (e) { showToast('Error de red', 'danger'); }
      finally { btn.disabled = false; btn.textContent = 'Enviar'; modal.hide(); }
    };
    modal.show();
  }

  // Store initial team data
  window.__initial_team = <?php echo json_encode(array_values($team)); ?>;

  // After defining UI helpers, if server provided initial team, apply it now
  try {
    if (window.__initial_team && typeof updateBoxEquippedState === 'function') {
      updateBoxEquippedState(window.__initial_team);
      if (typeof renderTeam === 'function') renderTeam(window.__initial_team);
    }
  } catch(e) { console.warn('init team ui failed', e); }
</script>

<script>
  async function buyItem(clave, quantity) {
    try {
      const res = await fetch('api/buy_item.php', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify({ clave: clave, quantity: quantity }) });
      const j = await res.json();
      if (!j.success) { showToast(j.error || 'Error en la compra', 'danger'); return; }

      // Actualizar badge de saldo
      const badge = document.querySelector('.badge.bg-warning');
      if (badge) {
        const val = (j.raw_balance !== undefined) ? j.raw_balance : parseFloat(j.balance || 0);
        badge.textContent = 'Saldo: € ' + new Intl.NumberFormat('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(val);
      }

      // Refrescar inventario desde endpoint y actualizar UI
      try {
        const r2 = await fetch('api/get_inventory.php');
        const j2 = await r2.json();
        if (j2 && j2.success && Array.isArray(j2.items)) {
          renderInventory(j2.items);
        }
      } catch (e) {
        // no fatal: mostrar mensaje
      }

      showToast('Compra realizada: ' + (j.item || clave), 'success');
    } catch (e) { showToast('Error de red', 'danger'); }
  }
</script>

<script>
  // D20 roller: client-side, stores history in localStorage
  function rollD20() {
    try {
      const val = Math.floor(Math.random() * 20) + 1;
      const resEl = document.getElementById('d20Result');
      if (resEl) {
        resEl.textContent = val;
        resEl.classList.remove('text-success','text-danger','text-dark');
        if (val === 20) resEl.classList.add('text-success');
        else if (val === 1) resEl.classList.add('text-danger');
        else resEl.classList.add('text-dark');
      }
      showToast('Tirada D20: ' + val, 'success');
      // add to history
      const hist = document.getElementById('d20History');
      const entry = { value: val, at: (new Date()).toISOString() };
      if (hist) {
        const li = document.createElement('li');
        li.className = 'list-group-item';
        const time = new Date(entry.at).toLocaleTimeString();
        li.textContent = time + ' — ' + entry.value;
        hist.insertBefore(li, hist.firstChild);
      }
      // persist
      try { 
        const prev = JSON.parse(localStorage.getItem('d20_history') || '[]');
        prev.unshift(entry);
        localStorage.setItem('d20_history', JSON.stringify(prev.slice(0,50)));
      } catch(e) {}
    } catch(e) { showToast('Error al tirar el dado', 'danger'); }
  }

  function initD20History() {
    try {
      const prev = JSON.parse(localStorage.getItem('d20_history') || '[]');
      const hist = document.getElementById('d20History');
      const resEl = document.getElementById('d20Result');
      if (hist && Array.isArray(prev)) {
        hist.innerHTML = '';
        for (const e of prev.slice(0,50)) {
          const li = document.createElement('li');
          li.className = 'list-group-item';
          const time = new Date(e.at).toLocaleTimeString();
          li.textContent = time + ' — ' + e.value;
          hist.appendChild(li);
        }
        if (prev.length && resEl) resEl.textContent = prev[0].value;
      }
    } catch(e) { /* ignore */ }
  }

  // Init on load
  try { document.addEventListener('DOMContentLoaded', initD20History); } catch(e) { initD20History(); }
</script>

  <!-- Equip Modal -->
  <div class="modal fade" id="equipModal" tabindex="-1" aria-labelledby="equipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="equipModalLabel">Equipar Pokémon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div id="equipModalPokemonInfo" class="mb-2"></div>
          <div class="d-grid gap-2">
            <!-- slot buttons inserted by JS -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="equipConfirmBtn">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Send Item Modal -->
  <div class="modal fade" id="sendItemModal" tabindex="-1" aria-labelledby="sendItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendItemModalLabel">Enviar Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div id="sendItemModalInfo" class="mb-2">Introduce el correo del destinatario</div>
          <input type="email" id="sendRecipientEmail" class="form-control mb-2" placeholder="correo@ejemplo.com">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="sendItemConfirmBtn">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Use Item Modal -->
  <div class="modal fade" id="useItemModal" tabindex="-1" aria-labelledby="useItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="useItemModalLabel">Usar Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div id="useItemModalInfo" class="mb-2">Selecciona el Pokémon objetivo</div>
          <div id="useItemModalGrid" class="d-grid gap-2"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

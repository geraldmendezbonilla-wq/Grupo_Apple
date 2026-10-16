<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
    <div>
        <h2 class="h3 fw-extrabold mb-1 d-flex align-items-center gap-2">
            <span class="p-2 bg-primary bg-gradient text-white rounded-3 shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                <i class="bi bi-people-fill fs-5"></i>
            </span>
            <span style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Directorio Inteligente de Personas
            </span>
        </h2>
        <p class="text-muted small mb-0 d-flex align-items-center gap-1">
            <i class="bi bi-patch-check-fill text-primary"></i>
            Módulo optimizado para la gestión de registros | <strong>Grupo Apple</strong>
        </p>
    </div>
    <div>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill shadow-sm fs-7">
            <i class="bi bi-cpu me-1"></i> Core v2.4 Active
        </span>
    </div>
</div>

    <!-- Barra de Búsqueda -->
    <div class="p-3 bg-light border-bottom">
        <form method="get" action="<?= base_url('persona/listar') ?>" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Buscar por cédula, nombres, apellidos, sexo, estado civil..." value="<?= esc($search ?? '') ?>">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                <?php if (!empty($search)): ?>
                    <a href="<?= base_url('persona/listar') ?>" class="btn btn-outline-secondary btn-sm">Limpiar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Cédula</th>
                        <th>Apellidos y Nombres</th>
                        <th>Fecha Nac.</th>
                        <th>Sexo</th>
                        <th>Estado Civil</th>
                        <th>Contactos</th>
                        <th class="text-end" style="width: 170px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($personas)): ?>
                        <?php foreach ($personas as $p): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-secondary border">#<?= esc($p['idpersona']) ?></span>
                                </td>
                                <td>
                                    <strong class="text-dark font-monospace"><?= esc($p['cedula']) ?></strong>
                                </td>
                                <td class="fw-semibold">
                                    <?= esc($p['apellidos'] . ' ' . $p['nombres']) ?>
                                </td>
                                <td class="text-muted small">
                                    <?= !empty($p['fechanacimiento']) ? date('d/m/Y', strtotime($p['fechanacimiento'])) : '<span class="fst-italic text-black-50">-</span>' ?>
                                </td>
                                <td>
                                    <?php if (!empty($p['sexo_nombre'])): ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis">
                                            <?= esc($p['sexo_nombre']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted small fst-italic">No definido</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($p['estadocivil_nombre'])): ?>
                                        <span class="badge bg-danger-subtle text-danger-emphasis">
                                            <?= esc($p['estadocivil_nombre']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted small fst-italic">No definido</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info-emphasis me-1" title="Direcciones">
                                        <i class="bi bi-geo-alt me-1"></i><?= esc($p['total_direcciones'] ?? 0) ?>
                                    </span>
                                    <span class="badge bg-success-subtle text-success-emphasis" title="Correos Electrónicos">
                                        <i class="bi bi-envelope me-1"></i><?= esc($p['total_correos'] ?? 0) ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('persona/actual/' . $p['idpersona']) ?>" class="btn btn-outline-primary" title="Ver Ficha">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="<?= base_url('persona/edit/' . $p['idpersona']) ?>" class="btn btn-outline-warning text-dark" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" title="Eliminar"
                                                onclick="confirmarBorrado('<?= base_url('persona/delete/' . $p['idpersona']) ?>', '¿Está seguro de eliminar a <?= esc($p['nombres'] . ' ' . $p['apellidos']) ?>?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2 text-secondary text-opacity-50"></i>
                                No se encontraron personas que coincidan con la búsqueda.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

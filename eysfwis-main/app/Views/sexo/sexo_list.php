<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Cabecera Moderna e Innovadora del Módulo -->
<div class="p-3 mb-4 bg-white rounded-4 border shadow-sm position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 bg-info bg-gradient opacity-10 rounded-circle" style="width: 120px; height: 120px; margin-right: -40px; margin-top: -40px;"></div>
    
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative z-1">
        <div class="d-flex align-items-center gap-3">
            <div class="p-3 bg-info bg-gradient text-white rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="bi bi-gender-ambiguous fs-4"></i>
            </div>
            <div>
                <h2 class="h4 fw-extrabold text-dark mb-1 d-flex align-items-center gap-2">
                    <span style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Catálogo de Registro de Sexo
                    </span>
                </h2>
                <p class="text-muted small mb-0 d-flex align-items-center gap-1">
                    <i class="bi bi-shield-check text-info"></i> Parámetros base del sistema | <strong>Grupo Apple</strong>
                </p>
            </div>
        </div>
        
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-info-subtle text-info border border-info-subtle px-3 py-2 rounded-pill shadow-xs">
                <i class="bi bi-activity me-1"></i> Módulo Activo
            </span>
        </div>
    </div>
</div>

<!-- Tarjeta de Contenido / Lista -->
<div class="card shadow-sm">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-gender-ambiguous text-warning me-2"></i>Catálogo de Sexos
            </h5>
            <small class="text-muted">Total de registros: <?= esc($total) ?></small>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('sexo/add') ?>" class="btn btn-warning btn-sm text-dark fw-semibold">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Sexo
            </a>
            <a href="<?= base_url('sexo') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-card-text me-1"></i> Ficha Registro
            </a>
        </div>
    </div>

    <!-- Barra de Búsqueda -->
    <div class="p-3 bg-light border-bottom">
        <form method="get" action="<?= base_url('sexo/listar') ?>" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Buscar sexo por nombre..." value="<?= esc($search ?? '') ?>">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                <?php if (!empty($search)): ?>
                    <a href="<?= base_url('sexo/listar') ?>" class="btn btn-outline-secondary btn-sm">Limpiar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nombre del Sexo</th>
                        <th>Personas Asociadas</th>
                        <th class="text-end" style="width: 170px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sexos)): ?>
                        <?php foreach ($sexos as $s): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-secondary border">#<?= esc($s['idsexo']) ?></span>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    <i class="bi bi-tag me-1 text-warning"></i><?= esc($s['nombre']) ?>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary-emphasis">
                                        <i class="bi bi-people me-1"></i><?= esc($s['total_personas'] ?? 0) ?> personas
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('sexo/actual/' . $s['idsexo']) ?>" class="btn btn-outline-primary" title="Ver Ficha">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="<?= base_url('sexo/edit/' . $s['idsexo']) ?>" class="btn btn-outline-warning text-dark" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" title="Eliminar"
                                                onclick="confirmarBorrado('<?= base_url('sexo/delete/' . $s['idsexo']) ?>', '¿Desea eliminar el sexo <?= esc($s['nombre']) ?>?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                No se encontraron registros de sexo.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

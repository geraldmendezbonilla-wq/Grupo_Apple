    <?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Cabecera Estilizada Módulo Estado Civil -->
<div class="p-3 mb-4 bg-white rounded-4 border shadow-sm position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 bg-danger bg-gradient opacity-10 rounded-circle" style="width: 120px; height: 120px; margin-right: -40px; margin-top: -40px;"></div>
    
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative z-1">
        <div class="d-flex align-items-center gap-3">
            <div class="p-3 bg-danger bg-gradient text-white rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="bi bi-heart-fill fs-4"></i>
            </div>
            <div>
                <h2 class="h4 fw-extrabold text-dark mb-1 d-flex align-items-center gap-2">
                    <span style="background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Gestión de Estados Civiles
                    </span>
                </h2>
                <p class="text-muted small mb-0 d-flex align-items-center gap-1">
                    <i class="bi bi-patch-check-fill text-danger"></i> Catálogo de filiación legal | <strong>Grupo Apple</strong>
                </p>
            </div>
        </div>
        
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill shadow-xs">
                <i class="bi bi-shield-lock me-1"></i> Módulo Seguro
            </span>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-heart-fill text-danger me-2"></i>Catálogo de Estados Civiles
            </h5>
            <small class="text-muted">Total de registros: <?= esc($total) ?></small>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('estadocivil/add') ?>" class="btn btn-danger btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Estado Civil
            </a>
            <a href="<?= base_url('estadocivil') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-card-text me-1"></i> Ficha Registro
            </a>
        </div>
    </div>

    <!-- Barra de Búsqueda -->
    <div class="p-3 bg-light border-bottom">
        <form method="get" action="<?= base_url('estadocivil/listar') ?>" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Buscar estado civil por nombre..." value="<?= esc($search ?? '') ?>">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                <?php if (!empty($search)): ?>
                    <a href="<?= base_url('estadocivil/listar') ?>" class="btn btn-outline-secondary btn-sm">Limpiar</a>
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
                        <th>Nombre del Estado Civil</th>
                        <th>Personas Asociadas</th>
                        <th class="text-end" style="width: 170px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($estadosCiviles)): ?>
                        <?php foreach ($estadosCiviles as $ec): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-secondary border">#<?= esc($ec['idestadocivil']) ?></span>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    <i class="bi bi-tag me-1 text-danger"></i><?= esc($ec['nombre']) ?>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary-emphasis">
                                        <i class="bi bi-people me-1"></i><?= esc($ec['total_personas'] ?? 0) ?> personas
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('estadocivil/actual/' . $ec['idestadocivil']) ?>" class="btn btn-outline-primary" title="Ver Ficha">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="<?= base_url('estadocivil/edit/' . $ec['idestadocivil']) ?>" class="btn btn-outline-warning text-dark" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" title="Eliminar"
                                                onclick="confirmarBorrado('<?= base_url('estadocivil/delete/' . $ec['idestadocivil']) ?>', '¿Desea eliminar el estado civil <?= esc($ec['nombre']) ?>?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                No se encontraron registros de estado civil.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

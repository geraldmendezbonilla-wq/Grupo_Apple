<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span class="fw-bold">
                    <i class="bi bi-plus-circle me-2"></i>Registrar Nuevo Teléfono
                </span>
                <a href="<?= (!empty($idpersonaSeleccion) ? base_url('persona/actual/' . $idpersonaSeleccion) : base_url('telefono')) ?>" class="btn btn-sm btn-light">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form method="post" action="<?= base_url('telefono/store') ?>">
                <?= csrf_field() ?>

                <?php if (!empty($idpersonaSeleccion)): ?>
                    <input type="hidden" name="retornar_persona" value="1">
                <?php endif; ?>

                <div class="card-body">
                    <!-- Selector de Persona -->
                    <div class="mb-3">
                        <label for="idpersona" class="form-label fw-semibold">Persona Propietaria <span class="text-danger">*</span></label>
                        <select class="form-select <?= isset($errors['idpersona']) ? 'is-invalid' : '' ?>" id="idpersona" name="idpersona" required>
                            <option value="">-- Seleccione una Persona --</option>
                            <?php foreach ($personas as $p): ?>
                                <option value="<?= esc($p['idpersona']) ?>" <?= ((isset($old['idpersona']) && $old['idpersona'] == $p['idpersona']) || ($idpersonaSeleccion == $p['idpersona'])) ? 'selected' : '' ?>>
                                    <?= esc($p['apellidos'] . ' ' . $p['nombres']) ?> (C.I. <?= esc($p['cedula']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['idpersona'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['idpersona']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Número -->
                    <div class="mb-3">
                        <label for="numero" class="form-label fw-semibold">Número de Teléfono <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control <?= isset($errors['numero']) ? 'is-invalid' : '' ?>" id="numero" name="numero" value="<?= esc($old['numero'] ?? old('numero')) ?>" placeholder="Ej: 0991234567" maxlength="20" required>
                            <?php if (isset($errors['numero'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['numero']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tipo" class="form-label fw-semibold">Tipo</label>
                            <?php $currTipo = $old['tipo'] ?? old('tipo') ?: 'Móvil'; ?>
                            <select class="form-select" id="tipo" name="tipo">
                                <option value="Móvil" <?= $currTipo === 'Móvil' ? 'selected' : '' ?>>Móvil</option>
                                <option value="Casa" <?= $currTipo === 'Casa' ? 'selected' : '' ?>>Casa</option>
                                <option value="Trabajo" <?= $currTipo === 'Trabajo' ? 'selected' : '' ?>>Trabajo</option>
                                <option value="Otro" <?= $currTipo === 'Otro' ? 'selected' : '' ?>>Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="operadora" class="form-label fw-semibold">Operadora</label>
                            <input type="text" class="form-control <?= isset($errors['operadora']) ? 'is-invalid' : '' ?>" id="operadora" name="operadora" value="<?= esc($old['operadora'] ?? old('operadora')) ?>" placeholder="Ej: Claro, Movistar, CNT" maxlength="50">
                            <?php if (isset($errors['operadora'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['operadora']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex justify-content-between">
                    <a href="<?= (!empty($idpersonaSeleccion) ? base_url('persona/actual/' . $idpersonaSeleccion) : base_url('telefono')) ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle-fill me-1"></i> Guardar Teléfono
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

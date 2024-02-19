<select id="seleccionar">
    <option value="">Selecciona una opción</option>
    <option value="Laboratorio">Laboratorio</option>
    <option value="Taller">Taller</option>
</select>

<div id="contenedorSubSelector">
    <div id="subSelectorLaboratorio" class="sub-selector" style="display:none;">
        <select>
            <option value="">Selecciona un laboratorio</option>
            <option value="Laboratorio1 " name="laboratorio">Laboratorio de especialidades</option>
            <option value="Laboratorio2" name="laboratorio">Laboratorio de redes</option>
            <option value="Laboratorio3" name="laboratori">Laboratio </option>
        </select>
    </div>
    <div id="subSelectorTaller" class="sub-selector" style="display:none;">
        <select>
            <option value="">Selecciona un taller</option>
            <option value="Taller1" name="taller">Taller 1</option>
            <option value="Taller2" name="taller">Taller 2</option>
        </select>
    </div>
</div>

<script>
    document.getElementById('seleccionar').addEventListener('change', function() {
        var seleccion = document.getElementById('seleccionar').value;
        var subSelectores = document.querySelectorAll('.sub-selector');
        subSelectores.forEach(function(selector) {
            selector.style.display = 'none';
        });
        var subSelector = document.getElementById('subSelector' + seleccion);
        if (subSelector) {
            subSelector.style.display = 'block';
        }
    });
</script>


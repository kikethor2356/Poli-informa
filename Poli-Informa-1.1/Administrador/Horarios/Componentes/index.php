<!-- Formulario HTML en index.php -->
<form action="RegisterHorario.php" method="post">
    <input type="text" name="maestro" placeholder="Nombre Maestro">
    <select name="nombre_laboratorio" id="">
        <option value="Especialidades">Laboratorio de Especialidades</option>
        <option value="Redes">Laboratorio de Redes</option>
        <option value="Taller1">Taller1</option>
        <option value="Taller2">Taller2</option>
    </select>
    <select name="hora_inicio" id="hora_inicio">
        <option value="7:00 am">7:00am</option>
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">12:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="1:00 pm">1:00pm</option>
        <option value="2:00 pm">2:00pm</option>
        <option value="3:00 pm">3:00pm</option>
        <option value="4:00 pm">4:00pm</option>
        <option value="5:00 pm">5:00pm</option>
        <option value="6:00 pm">6:00pm</option>
        <option value="7:00 pm">7:00pm</option>
        <option value="8:00 pm">8:00pm</option>
    </select>
   <select name="hora_fin" id="hora_fin">
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">12:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="1:00 pm">1:00pm</option>
        <option value="2:00 pm">2:00pm</option>
        <option value="3:00 pm">3:00pm</option>
        <option value="4:00 pm">4:00pm</option>
        <option value="5:00 pm">5:00pm</option>
        <option value="6:00 pm">6:00pm</option>
        <option value="7:00 pm">7:00pm</option>
        <option value="8:00 pm">8:00pm</option>
   </select>
   <select name="dias" id="dia_semana">
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miercoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Lunes">Viernes</option>
        <option value="Lunes">Sabado</option>
   </select>
    <input type="submit" name="submit" value="Guardar">
</form>




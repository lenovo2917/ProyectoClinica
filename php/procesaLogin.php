<?php
 include 'acceso.php';
 
 $nombre = filter_input(INPUT_POST, 'nombree');
 $contrasena = filter_input(INPUT_POST, 'clave');
 $rol = null;
 
 $sqlDoctor = "select ContrasenaD from doctores where"
 . " NombreCompletoD='" . $nombre . "';";
 $resultado1 = $dp->query($sqlDoctor);
 $row1 = $resultado1->fetch_assoc();

 $sqlSecretario = "select ContrasenaS from secretarios where"
 . " NombreCompletoS='" . $nombre . "';";
 $resultado2 = $dp->query($sqlSecretario);
 $row2 = $resultado2->fetch_assoc();

 $sqlPaciente = "select ContrasenaP from pacientes where"
 . " NombreCompletoP='" . $nombre . "';";
 $resultado3 = $dp->query($sqlPaciente);
 $row3 = $resultado3->fetch_assoc();   
 
 $sqlAdmin = "select ContrasenaA from administrador where" ////////////////////////////
 . " UsuarioA='" . $nombre . "';";
 $resultado4 = $dp->query($sqlAdmin);
 $row4 = $resultado4->fetch_assoc();


 if ($row1['ContrasenaD'] == $contrasena) {
    $rol = 'doctor';
    header("Location: ../doctores/IndexDoctores.html?rol=" . $rol);
    exit();
 } else if ($row2['ContrasenaS'] == $contrasena) {
   $rol = 'secretario';
   header("Location: ../Blog_Medico.php?rol=" . $rol);
   exit();
  }else if ($row3['ContrasenaP'] == $contrasena) {
   $rol = 'paciente';
   header("Location: ../Blog_Medico.php?rol=" . $rol);
   exit();
  }else if ($row4['ContrasenaA'] == $contrasena) {/////////////////
   $rol = 'admin';
   header("Location: ../Blog_Medico.php?rol=" . $rol);
   exit();
  }else {
 echo '</h2>Usuario o contraseña incorrecta</h2>';
 echo '<br><a href="login.html">Ir a login</a>';
 }

 ?>



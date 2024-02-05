<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

echo '<script>

window.location = "brutur/alertas";

</script>';

?>


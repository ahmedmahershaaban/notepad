<?php
  // destroy the session when there is no response from the ajax call

if(isset($_SESSION['last_action'])){
    if ($_SESSION['last_action'] < time() - 30 ) {
        session_destroy();
}
}


?>
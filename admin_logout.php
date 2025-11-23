<?php
session_start();
session_destroy();
?>
<script>
    sessionStorage.clear();
    window.location.href = 'admin_login.php';
</script>
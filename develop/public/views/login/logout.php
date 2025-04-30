<?php
session_name("hc_session");
session_start();
session_destroy();
header("location:../../../../");

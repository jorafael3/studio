<?php

$url = constant('URL');
$clientes = $url."clientes/nuevo";

?>

<ul class="metismenu" id="menu">

    <li>
        <a href="<?php echo constant('URL') ?>">
            <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li class="menu-label">Web Apps</li>
    <li>
        <a href="<?php echo $clientes ?>">
            <div class="parent-icon icon-color-4"><i class="lni lni-user"></i>
            </div>
            <div class="menu-title">Clientes</div>
        </a>
    </li>
    <li>
        <a href="chat-box.html">
            <div class="parent-icon icon-color-8"> <i class="lni lni-package"></i>
            </div>
            <div class="menu-title">Productos</div>
        </a>
    </li>
</ul>
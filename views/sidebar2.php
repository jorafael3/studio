<?php

$url = constant('URL');
$clientes = $url."clientes/nuevo";
$Proveedores = $url."Proveedores/nuevo";


?>

<ul class="metismenu" id="menu">
<li>
        <a href="<?php echo constant('URL') ?>">
            <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li>
        <a href="<?php echo $clientes ?>">
            <div class="parent-icon icon-color-4"><i class="lni lni-user"></i>
            </div>
            <div class="menu-title">Clientes</div>
        </a>
    </li>
    <li>
        <a href="<?php echo $Proveedores ?>">
            <div class="parent-icon icon-color-4"><i class="lni lni-user"></i>
            </div>
            <div class="menu-title">Proveedores</div>
        </a>
    </li>
    <li>
        <a href="<?php echo constant('URL') ?>Productos/Productos">
            <div class="parent-icon icon-color-8"> <i class="lni lni-package"></i>
            </div>
            <div class="menu-title">Productos</div>
        </a>
    </li>
    <li>
        <a href="<?php echo constant('URL') ?>Proforma/Proforma">
            <div class="parent-icon icon-color-9"> <i class="lni lni-add-files"></i>
            </div>
            <div class="menu-title">Proforma</div>
        </a>
    </li>


</ul>
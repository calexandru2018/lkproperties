<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="?show=home" ><i class="lnr lnr-home"></i> <span>Home</span></a></li>
                <li><a href="?show=city"><i class="lnr lnr-map"></i> <span>Cidades</span></a></li>
                <li><a href="?show=poi"><i class="lnr lnr-star-half"></i> <span>Pontos de Interesse</span></a></li>
                <li><a href="?show=service-common"><i class="lnr lnr-menu-circle"></i> <span>Comodidades Comuns</span></a></li>
                <li><a href="?show=service-unique"><i class="lnr lnr-tag"></i> <span>Comodidades Especiais</span></a></li>
                <li><a href="?show=activity"><i class="lnr lnr-heart"></i> <span>Actividades</span></a></li>
                <li><a href="?show=to-rent"><i class="lnr lnr-map-marker"></i> <span>Aluguer de Imóveis</span></a></li>
                <li><a href="?show=to-sell"><i class="lnr lnr-apartment"></i> <span>Venda de Imóveis</span></a></li>
                <li><a href="?show=faq"><i class="lnr lnr-question-circle"></i> <span>FAQ</span></a></li>
                <?php if($_SESSION['admin_privilege'] == 1 || $_SESSION['admin_privilege'] == 99) echo '<li><a href="?show=administrator"><i class="lnr lnr-users"></i> <span>Administradores</span></a></li>';?>
            </ul>
        </nav>
    </div>
</div>
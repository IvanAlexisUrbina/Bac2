<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
        <img id="logoSideBar" src="img/logo_prueba.jpg" alt="" srcset="">
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 ps ps--active-y">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="<?= Helpers\generateUrl("Access","Access","HomeView");?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Inicio</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Panel de control</span>
        </li>

        <?php if ($_SESSION['RolUser'] == '1'): ?>
        <li class="menu-item" style="">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-user-detail'></i>
                <div data-i18n="Layouts">Clientes</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Clients","Clients","ViewClientPortal");?>" class="menu-link">
                        <div data-i18n="Without menu">Ver clientes portal</div>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>


        <!-- COMPANY -->
        <?php if ($_SESSION['RolUser'] == '2' AND $_SESSION['StatusUser'] == '1'): ?>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-check"></i>
                <div data-i18n="Misc">Autorizaciones de registro</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Inbox","Inbox","viewInbox");?>" class="menu-link">
                        <div data-i18n="Error">Ver</div>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>


        <?php if ($_SESSION['RolUser'] == '2' OR  $_SESSION['RolUser'] == '3'  AND $_SESSION['StatusUser'] == '1'): ?>
        <li class="menu-item" style="">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-cube-alt'></i>
                <div data-i18n="Layouts">CRM</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("CRM","CRM","consultViewDate");?>" class="menu-link">
                        <div data-i18n="Without menu">Crear actividades</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("CRM","CRM","consultActivities");?>" class="menu-link">
                        <div data-i18n="Without menu">Ver actividades</div>
                    </a>
                </li>
            </ul>
        </li>


        <li class="menu-item" style="">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-user-detail'></i>
                <div data-i18n="Layouts">Clientes</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Access","Access","RegisterView");?>" class="menu-link">
                        <div data-i18n="Without menu">Enviar
                            registro</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Company","Company","consultCompanies");?>" class="menu-link">
                        <div data-i18n="Without navbar">Ver clientes</div>
                    </a>
                </li>
                <?php if ($_SESSION['RolUser'] == '2' AND $_SESSION['StatusUser'] == '1'): ?>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Clients","Clients","CreateSellers");?>" class="menu-link">
                        <div data-i18n="Container">Crear vendedores</div>
                    </a>
                </li>
                <?php endif; ?>

                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Clients","Clients","LimitCredit");?>" class="menu-link">
                        <div data-i18n="Fluid">Crear limite
                            crediticio</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item" style="">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-mail-send' ></i>
                <div data-i18n="Layouts">Solicitudes de compra</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Purchase_request","Purchase_request","ConsultRequestPurchaseView");?>" class="menu-link">
                        <div data-i18n="Without menu">Ver</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Purchase_request","Purchase_request","consultPurchaseView");?>" class="menu-link">
                        <div data-i18n="Without menu">Crear</div>
                    </a>
                </li>
            </ul>
        </li>



        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dollar"></i>
                <div data-i18n="Misc">Cotizaciones</div>
            </a>
            <?php if ($_SESSION['RolUser']==2) { ?>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Quote","Quote","quotesCompanies");?>" class="menu-link">
                        <div data-i18n="Under Maintenance">Ver</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Quote","Quote","ViewCreateQuote");?>" class="menu-link">
                        <div data-i18n="Error">Crear</div>
                    </a>
                </li>
            </ul>
            <?php }?>
            <?php if ($_SESSION['RolUser']==3) { ?>

            <ul class="menu-sub">

                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Quote","Quote","ViewCreateQuote");?>" class="menu-link">
                        <div data-i18n="Error">Crear</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Quote","Quote","ViewQuotes");?>" class="menu-link">
                        <div data-i18n="Under Maintenance">Ver</div>
                    </a>
                </li>
            </ul>
            <?php }?>

        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-truck"></i>
                <div data-i18n="Misc">Pedidos</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Order","Order","ordersCompanies");?>" class="menu-link">
                        <div data-i18n="Under Maintenance">Ver</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Order","Order","ViewCreateOrder");?>" class="menu-link">
                        <div data-i18n="Error">Crear</div>
                    </a>
                </li>
                <!-- <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Order","Order","ViewOrders");?>" class="menu-link">
                        <div data-i18n="Under Maintenance">Ver2</div>
                    </a>
                </li> -->
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-list-ol"></i>
                <div data-i18n="Misc">Listas de precios</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Groups","Groups","viewCreateGroups");?>" class="menu-link">
                        <div data-i18n="Error">Crear</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Misc">Bodegas</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Warehouse","Warehouse","ViewCreateWarehouse");?>"
                        class="menu-link">
                        <div data-i18n="Error">Crear</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-package"></i>
                <div data-i18n="Account Settings">Inventario</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Stock","Stock","ViewCreateStock");?>" class="menu-link">
                        <div data-i18n="Account">Crear artículo</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Articles","Articles","consult");?>" class="menu-link">
                        <div data-i18n="Notifications">Ver artículos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Category","Category","consultCateogries");?>" class="menu-link">
                        <div data-i18n="Notifications">Crear categorias</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-paste"></i>
                <div data-i18n="Authentications">Import/Export</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Data","Data","ImportView");?>" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Importar información</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= Helpers\generateUrl("Data","Data","ImportView");?>" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Exportar información</div>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>



        <!-- ROL CLIENT PORTAL INACTIVO -->
        <?php if ($_SESSION['RolUser'] == '2' AND $_SESSION['StatusUser'] == '2' ): ?>

        <li class="menu-item">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <a href="<?= Helpers\generateUrl("Company","Company","RegisterUpdateView");?>" class="menu-link"
                aria-current="page"> <i class="fa-solid fa-file-lines"></i> Registro</a>


        </li>
        <?php endif; ?>


        <!-- Layouts -->













        <!-- Misc -->
        <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li> -->
        <li class="menu-item">
            <!-- <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
            </a> -->
        </li>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 4px; height: 466px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 243px;"></div>
        </div>
    </ul>
</aside>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>


    <title>Panel de solicitudes</title> 
</head>
<body>
    <nav class="close">
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">FES Acatlán</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-estate"></i>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="uil uil-signout"></i>
                </a></li>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Buscar">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text" style="color: #607d8b; border-bottom: 4px solid #D59F0F">Dashboard</span>
                </div>
                <?php
                $result = DB::get_requests_by_area($db, $_COOKIE['aid']);
                ?>
                <div class="boxes">
                    <div class="box box1 shadow-xl">
                        <span class="text">Totales</span>
                        <span class="number"><?= $result->rowCount() ?></span>
                    </div>
                    <div class="box box2 shadow-xl">
                        <span class="text">Pendientes</span>
                        <span class="number">0</span>
                    </div>
                    <div class="box box3 shadow-xl">
                        <span class="text">Aceptadas</span>
                        <span class="number">0</span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text" style="color: #607d8b; border-bottom: 4px solid #D59F0F">Solicitudes pendientes</span>
                </div>

                <table id="awating_request_table" class="display">
                    <thead>
                        <th>Folio</th>
                        <th>Tipo de servicio</th>
                        <th>Responsable de area</th>
                        <th>Estatus</th>
                        <th>Seleccionar estatus</th>
                        <th>Cambiar de estatus</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($result as $row):?>
                        <tr>
                            <td>
                                <?= $row['request_id'] ?>
                            </td>
                            <td>
                                <?= $row['service_type'] ?>
                            </td>
                            <td>
                                <?= $row['area_manager'] ?>
                            </td>
                            <td>
                                <?= $row['description'] ?> 
                            </td>
                            <td>
                                <select id="sel-<?= $row['request_id'] ?>">
                                    <option value="r">Recibida</option>
                                    <option value="t">Trabajando</option>
                                    <option value="d">Detenida</option>
                                    <option value="c">Completada</option>
                                </select>
                            </td>
                            <td>
                                <input id="<?= $row['request_id'] ?>" type="submit" class="assign inline-flex items-center px-2 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white"
                                style="background-color: #002B7A;" value="Cambiar"/>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function(){
            $('#awating_request_table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json'
                }
            });
        })
    </script>
</body>
</html>
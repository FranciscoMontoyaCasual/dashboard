<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.6/dist/flowbite.min.css" />

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
                    <i class="uil uil-tachometer-fast-alt" style="background-color: #002B7A"></i>
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
                    <i class="uil uil-clock-three" style="background-color: #002B7A"></i>
                    <span class="text" style="color: #607d8b; border-bottom: 4px solid #D59F0F">Solicitudes pendientes</span>
                </div>

                <table id="awating_request_table" class="display">
                    <thead>
                        <th>Folio</th>
                        <th>Tipo de servicio</th>
                        <th>Responsable de area</th>
                        <th>Fecha de solicitud</th>
                        <th>Estatus</th>
                        <th></th>
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
                                <?= $row['request_date'] ?>
                            </td>
                            <td id="des-<?= $row['request_id'] ?>">
                                <?= $row['description'] ?> 
                            </td>
                            <td>
                                <button id="<?= $row['request_id'] ?>" class="show-request inline-flex items-center px-2 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white"
                                type="button" style="background-color: #002B7A;">Ver más</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


<div id="request-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
    <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">

        <div class="relative bg-white rounded-lg shadow overflow-x-auto">

            <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white"> Información de solicitud </h3>
                <button type="button" class="hidde-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
            </div>

            <div class="px-6 space-y-1">
                <div class="flex">
                    <div class="flex-auto">
                        <label for="request_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Folio de solicitud</label>
                        <textarea style="resize: none;" id="request_id" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>

                    <div class="flex-auto">
                        <label for="area" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Area solicitante</label>
                        <textarea style="resize: none;" id="area" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>

                    <div class="flex-auto">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Telefono</label>
                        <textarea style="resize: none;" id="phone" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-auto">
                        <label for="user_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre de usuario</label>
                        <textarea style="resize: none;" id="user_name" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>

                    <div class="flex-auto">
                        <label for="request_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fecha de solicitud</label>
                        <textarea style="resize: none;" id="request_date" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>

                    <div class="flex-auto">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Correo electronico</label>
                        <textarea style="resize: none;" id="email" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-none">
                        <label for="service_subtype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subtipo de servicio</label>
                        <textarea style="resize: none;" id="service_subtype" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>

                    <div class="flex-none">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descripcion</label>
                        <textarea style="resize: none;" id="description" rows="1" class="pb-2.5 pt-5 w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled></textarea>
                    </div>

                    <div class="flex-auto px-6">
                        <label for="sel-area" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Modificación de estatus</label>
                        <select id="sel-area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-48 py-4 px-6">
                            <option value="r">Recibida</option>
                            <option value="t">Trabajando</option>
                            <option value="d">Detenida</option>
                            <option value="c">Completada</option>
                        </select>
                    </div>

                </div>

                    <label for="message" class="block  text-sm font-medium text-gray-900 dark:text-gray-400">Comentario de solicitud</label>
                    <textarea style="resize: none;" id="message" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Inserta un comentario acerca del estado o rechazo de la solicitud"></textarea>
            </div>

            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                <button type="button" class="change-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cambiar</button>
                <button type="button" class="cancel text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 focus:z-10">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/flowbite@1.4.6/dist/flowbite.js"></script>
    <script>
        $(document).ready(function(){
            $('#awating_request_table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json'
                }
            });

            const target_el = document.getElementById('request-modal')
            const options = {
                onHide: () => {
                },
                onShow: () => {
                }
            }

            const modal = new Modal(target_el, options)

            $('.show-request').click(function(){
                let request_id = $(this)[0].id
                
                data = { request_id }
                $.post('/../utilities/modal.php', data, function(res){
                    $('#request_id').val(request_id)
                    $('#area').val(res.area)
                    $('#phone').val(res.phone)
                    $('#user_name').val(res.user_name)
                    $('#request_date').val(res.request_date)
                    $('#email').val(res.email)
                    $('#service_subtype').val(res.service_subtype)
                    $('#description').val(res.res_des)
                    $('#sel-area option').removeAttr('selected').filter('[value='+res.st_des+']').attr('selected', true)
                    modal.show()
                })

            })

            $('.change-btn').click(function(){
                let request_id = $('#request_id').val()
                let last_status = $('#' + 'des-' + request_id).text().trim()
                let new_status = $('#sel-area').find(':selected').text()
                let comment = $('#message').val()

                let data = {
                    request_id,
                    last_status,
                    new_status,
                    comment
                }

                console.log(request_id)
                console.log(last_status)
                console.log(new_status)
                console.log(comment)

                $.post('/../utilities/change.php', data, function(res){
                    if(res.status){
                        modal.hide()
                        location.reload()
                    }else
                        alert('Asignación no permitida')
                    
                })
            })

            $('.hidde-modal').click(function(){
                modal.hide()
            })

            $('.cancel').click(function(){
                modal.hide()
            })
        })
    </script>
</body>
</html>
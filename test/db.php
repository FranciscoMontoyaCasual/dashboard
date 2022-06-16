<?php
class DB{
    public static function connect_db(){
        //Informacion de la db
        $user = "uwuzfgv3wul6qaiz";
        $password = "XBNEg2jgXVRJsH2Lv7lZ";
        $database = "b6hcqydjtapf8xbiinfj";
    
        return new PDO("mysql:host=b6hcqydjtapf8xbiinfj-mysql.services.clever-cloud.com;dbname=$database", $user, $password);
    }

    public static function insert_user($db){
        //Informacion del usuario
        $rand_number = rand();
        $user_name = "jmontoya";
        $user_id = md5("$user_name$rand_number");
        // 0: admin, 1: area 1, 2: area 2, 3: area 3, 4: area 4
        $area_id = 2;
        $hashed_password = crypt('123');
    
        $insert_statement = $db->prepare("insert into user values(:user_id, :area_id, :user_name, :password)");
        $insert_statement->bindParam(":user_id", $user_id);
        $insert_statement->bindParam(":area_id", $area_id);
        $insert_statement->bindParam(":user_name", $user_name);
        $insert_statement->bindParam(":password", $hashed_password);
    
        if($insert_statement->execute())
            return true;
        else
            return false;
    }

    public static function insert_new_request($db, $request_id, $service_type, $area,
     $area_manager, $user_name, $request_date, $phone, $email, $category, $service_subtype, 
     $description){
        $query = "insert into request values('$request_id', '$service_type', '$area', '$area_manager',  '$user_name', '$request_date', '$phone', '$email', '$category', '$service_subtype', '$description', false)";
        $result = $db->query($query);

        return $result;
    }

    public static function auth_user($db, $user_name, $password){
        $temp = [];
    
        foreach($db->query("select u.user_id, user_name, password, role_id, area_id from user as u join role as r on r.user_id = u.user_id where u.user_name = '$user_name' limit 1") as $row){
            if(hash_equals($row['password'], crypt($password, $row['password']))){
                $temp['uid'] = $row['user_id'];
                $temp['usr'] = $row['user_name'];
                $temp['rol'] = $row['role_id'];
                $temp['aid'] = $row['area_id'];
    
                return $temp;
            }
        }
    
        $temp['msg'] = 'Nombre de usuario o contraseña incorrectos!';
    
        return $temp;
    }

    public static function auth_api_user($db, $token){
        $query = "select count(u.user_id) as res from user as u join role as r on u.user_id = r.user_id where u.user_id = '$token' and r.role_id = 3 limit 1";

        $result = $db->query($query);

        return $result;
    }

    public static function get_all_requests($db){
        $result = $db->query("select r.request_id, service_type, area, area_manager, user_name, request_date, phone, email, category, service_subtype, r.description, assigned, s.description, s.comment from request as r left join status as s on r.request_id = s.request_id where (s.description != 'Rechazada' or s.description is null) and s.status_id in (select max(status_id) from status group by request_id) or status_id is null order by request_id"); 
        
        return $result;
    }

    public static function get_requests_by_area($db, $area_id){
        $result = $db->query("select r.request_id, service_type, area_manager, request_date, s.description from request as r join status as s on r.request_id = s.request_id where r.request_id in (select request_id from assigned_request where area_id = $area_id) and final_date is null"); 
        
        return $result;
    }

    public static function get_request_by_id($db, $request_id){
        $query = "select r.request_id, service_type, area, area_manager, user_name, request_date, phone, email, category, service_subtype, r.description as res_des, assigned, s.description as st_des, s.comment from request as r left join status as s on r.request_id = s.request_id where r.request_id = '$request_id'";

        $result = $db->query($query);

        return $result;
    }

    public static function assign_request($db, $request_id, $area_id, $comment){
        $query = "insert into assigned_request value('$request_id', $area_id)";
        $s_query = "insert into status(request_id, description, comment, initial_date, final_date) values('$request_id', 'Recibida', '$comment', now(), null);";
        $u_query = "update request set assigned = true where request_id = '$request_id'";

        $db->query($query);
        $db->query($s_query);
        $db->query($u_query);
    }

    public static function reject_request($db, $request_id, $comment){
        $query = "insert into status(request_id, description, comment, initial_date, final_date) values('$request_id', 'Rechazada', '$comment', now(), now())";

        $db->query($query);
    }

    public static function get_request($db, $request_id){
        $temp = [];
        $query = "select request_id, service_type, area, area_manager, user_name, request_date, phone, email, category, service_subtype, description from request where request_id = '$request_id' limit 1";
        foreach($db->query($query) as $row){
            $temp['request_id'] = $row['request_id'];
            $temp['service_type'] = $row['service_type'];
            $temp['area'] = $row['area'];
            $temp['area_manager'] = $row['area_manager'];
            $temp['user_name'] = $row['user_name'];
            $temp['request_date'] = $row['request_date'];
            $temp['phone'] = $row['phone'];
            $temp['email'] = $row['email'];
            $temp['category'] = $row['category'];
            $temp['service_subtype'] = $row['service_subtype'];
            $temp['description'] = $row['description'];
        }

        return $temp;
    }

    public static function change_request_status($db, $request_id, $status, $comment){
        $up_query1 = "update status set final_date = now() where request_id = '$request_id' and final_date is null";
        $in_query1 = "insert into status(request_id, description, comment, initial_date, final_date) values('$request_id', '$status', '$comment', now(), null)";

        $in_query2 = "insert into status(request_id, description, comment, initial_date, final_date) values('$request_id', '$status', '$comment', now(), now())";

        if($status == 'Trabajando'){
            $db->query($up_query1);
            $db->query($in_query1);
        }else if($status == 'Detenida' || $status == 'Completada'){
            $db->query($up_query1);
            $db->query($in_query2);
        }
    }
}
?>
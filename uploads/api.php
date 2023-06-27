<?php

    require "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $dotenv = Dotenv\Dotenv::createImmutable("../")->load();
  
    
    $credenciales = new App\connect;
    
    
    $router->get('/camper', function() {
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare('SELECT * FROM tb_camper');
        $res -> execute();
        $res = $res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
        // print_r(file_get_contents('php://input'));
    });

    
    $router->get("/camper/{id}", function($id){
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare("SELECT * FROM tb_camper WHERE id = :ID");
        $res->bindParam("ID", $id);
        $res -> execute();
        $res = $res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
        // print_r(file_get_contents('php://input'));
    });
    
    $router->put('/camper', function() {
        $_DATA = json_decode(file_get_contents('php://input'),true);
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare('UPDATE tb_camper SET nombre = :nom WHERE id=:id');
        $res->bindvalue("id", $_DATA['id']);
        $res->bindvalue("nom", $_DATA['nom']);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
        // print_r(file_get_contents('php://input'));
    });

    $router->post("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare("INSERT INTO tb_camper (nombre, edad) VALUES (:NOMBRE, :EDAD)");
        $res->bindParam("NOMBRE", $_DATA['nom']);
        $res->bindParam("EDAD", $_DATA['edad']);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });

    $router->delete("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare("DELETE FROM tb_camper WHERE id = :ID");
        $res->bindParam("ID", $_DATA['id']);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });
// --
// -- Estructura de tabla para la tabla `academic_area`
// --

$router->get('/academic_area', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM academic_area');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/academic_area/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM academic_area WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/academic_area', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE academic_area SET id_area = :id_area, id_staff = :id_staff, id_position = :id_position, id_journey = :id_journey WHERE id = :id');
    $res->bindValue(":id", $_DATA['id']);
    $res->bindValue(":id_area", $_DATA['id_area']);
    $res->bindValue(":id_staff", $_DATA['id_staff']);
    $res->bindValue(":id_position", $_DATA['id_position']);
    $res->bindValue(":id_journey", $_DATA['id_journey']);
    $res->execute();
    $rowCount = $res->rowCount();
    echo json_encode($rowCount);
});

$router->post("/academic_area", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO academic_area (id, id_area, id_staff, id_position, id_journey) VALUES (:id,:id_area, :id_staff, :id_position, :id_journey)");
    $res->bindParam("id", $_DATA['id']);
    $res->bindParam("id_area", $_DATA['id_area']);
    $res->bindParam("id_staff", $_DATA['id_staff']);
    $res->bindParam("id_position", $_DATA['id_position']);
    $res->bindParam("id_journey", $_DATA['id_journey']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/academic_area", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM academic_area WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});


// --
// -- Estructura de tabla para la tabla `admin_area`
// --

$router->get('/admin_area', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM admin_area');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/admin_area/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM admin_area WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/admin_area', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE admin_area SET id_area = :id_area, id_staff = :id_staff, id_position = :id_position, id_journey = :id_journey WHERE id = :id');
    $res->bindvalue("id", $_DATA['id']);
    $res->bindvalue("id_area", $_DATA['id_area']);
    $res->bindvalue("id_staff", $_DATA['id_staff']);
    $res->bindvalue("id_position", $_DATA['id_position']);
    $res->bindvalue("id_journey", $_DATA['id_journey']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/admin_area", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO admin_area (id, id_area, id_staff, id_position, id_journey) VALUES (:id, :id_area, :id_staff, :id_position, :id_journey)");
    $res->bindParam("id", $_DATA['id']);
    $res->bindParam("id_area", $_DATA['id_area']);
    $res->bindParam("id_staff", $_DATA['id_staff']);
    $res->bindParam("id_position", $_DATA['id_position']);
    $res->bindParam("id_journey", $_DATA['id_journey']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/admin_area", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM admin_area WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

// --
// -- Estructura de tabla para la tabla `areas`
// --

$router->get('/areas', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM areas");
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/areas/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM areas WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/areas', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE areas SET name_area = :name_area WHERE id = :id');
    $res->bindvalue("id", $_DATA['id']);
    $res->bindvalue("name_area", $_DATA['name_area']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/areas", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO areas (id, name_area) VALUES (:id, :name_area)");
    $res->bindParam("id", $_DATA['id']);
    $res->bindParam("name_area", $_DATA['name_area']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/areas", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM areas WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

// --
// -- Estructura de tabla para la tabla `campers`
// --

$router->get('/campers', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM campers');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/campers/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM campers WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/campers', function() use ($credenciales) {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE campers SET id_team_schedule = :id_team_schedule, id_route = :id_route, id_trainer = :id_trainer, id_psycologist = :id_psycologist, id_teacher = :id_teacher, id_level = :id_level, id_journey = :id_journey, id_staff = :id_staff WHERE id = :id');
    $res->bindParam("id_team_schedule", $_DATA['id_team_schedule']);
    $res->bindParam("id_route", $_DATA['id_route']);
    $res->bindParam("id_trainer", $_DATA['id_trainer']);
    $res->bindParam("id_psycologist", $_DATA['id_psycologist']);
    $res->bindParam("id_teacher", $_DATA['id_teacher']);
    $res->bindParam("id_level", $_DATA['id_level']);
    $res->bindParam("id_journey", $_DATA['id_journey']);
    $res->bindParam("id_staff", $_DATA['id_staff']);
    $res->bindParam("id", $_DATA['id']);
    $res->execute();
    $rowCount = $res->rowCount();
    echo json_encode($rowCount);
});

$router->post("/campers", function() use ($credenciales) {
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO campers (id, id_team_schedule, id_route, id_trainer, id_psycologist, id_teacher, id_level, id_journey, id_staff) VALUES (:id, :id_team_schedule, :id_route, :id_trainer, :id_psycologist, :id_teacher, :id_level, :id_journey, :id_staff)");
    $res->bindParam("id", $_DATA['id']);
    $res->bindParam("id_team_schedule", $_DATA['id_team_schedule']);
    $res->bindParam("id_route", $_DATA['id_route']);
    $res->bindParam("id_trainer", $_DATA['id_trainer']);
    $res->bindParam("id_psycologist", $_DATA['id_psycologist']);
    $res->bindParam("id_teacher", $_DATA['id_teacher']);
    $res->bindParam("id_level", $_DATA['id_level']);
    $res->bindParam("id_journey", $_DATA['id_journey']);
    $res->bindParam("id_staff", $_DATA['id_staff']);
    $res->execute();
    $rowCount = $res->rowCount();
    echo json_encode($rowCount);
});

$router->delete("/campers", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM campers WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

// --
// -- Estructura de tabla para la tabla `chapters`
// --

$router->get('/chapters', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM chapters');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/chapters/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM chapters WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/chapters', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE chapters SET name_chapter = :name_chapter, start_date = :start_date, end_date = :end_date, description = :description, duration_days = :duration_days WHERE id = :id');
    $res->bindValue("id", $_DATA['id']);
    $res->bindValue("name_chapter", $_DATA['name_chapter']);
    $res->bindValue("start_date", $_DATA['start_date']);
    $res->bindValue("end_date", $_DATA['end_date']);
    $res->bindValue("description", $_DATA['description']);
    $res->bindValue("duration_days", $_DATA['duration_days']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/chapters", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO chapters (name_chapter, start_date, end_date, description, duration_days) VALUES (:name_chapter, :start_date, :end_date, :description, :duration_days)");
    $res->bindParam("name_chapter", $_DATA['name_chapter']);
    $res->bindParam("start_date", $_DATA['start_date']);
    $res->bindParam("end_date", $_DATA['end_date']);
    $res->bindParam("description", $_DATA['description']);
    $res->bindParam("duration_days", $_DATA['duration_days']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/chapters", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM chapters WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

// --
// -- Estructura de tabla para la tabla `cities`
// --

$router->get('/cities', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM cities');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/cities/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM cities WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/cities', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE cities SET name_city = :name_city, id_region = :id_region WHERE id = :id');
    $res->bindValue("id", $_DATA['id']);
    $res->bindValue("name_city", $_DATA['name_city']);
    $res->bindValue("id_region", $_DATA['id_region']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/cities", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO cities (id, name_city, id_region) VALUES (:id, :name_city, :id_region)");
    $res->bindParam("id", $_DATA['id']);
    $res->bindParam("name_city", $_DATA['name_city']);
    $res->bindParam("id_region", $_DATA['id_region']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/cities", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM cities WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

// --
// -- Estructura de tabla para la tabla `contact_info`
// --

$router->get('/contact_info', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM contact_info');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/contact_info/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM contact_info WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/contact_info', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE contact_info SET id_staff = :id_staff, whatsapp = :whatsapp, instagram = :instagram, linkedin = :linkedin, email = :email, address = :address, cel_number = :cel_number WHERE id = :id');
    $res->bindValue("id", $_DATA['id']);
    $res->bindValue("id_staff", $_DATA['id_staff']);
    $res->bindValue("whatsapp", $_DATA['whatsapp']);
    $res->bindValue("instagram", $_DATA['instagram']);
    $res->bindValue("linkedin", $_DATA['linkedin']);
    $res->bindValue("email", $_DATA['email']);
    $res->bindValue("address", $_DATA['address']);
    $res->bindValue("cel_number", $_DATA['cel_number']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/contact_info", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO contact_info (id_staff, whatsapp, instagram, linkedin, email, address, cel_number) VALUES (:id_staff, :whatsapp, :instagram, :linkedin, :email, :address, :cel_number)");
    $res->bindParam("id_staff", $_DATA['id_staff']);
    $res->bindParam("whatsapp", $_DATA['whatsapp']);
    $res->bindParam("instagram", $_DATA['instagram']);
    $res->bindParam("linkedin", $_DATA['linkedin']);
    $res->bindParam("email", $_DATA['email']);
    $res->bindParam("address", $_DATA['address']);
    $res->bindParam("cel_number", $_DATA['cel_number']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/contact_info", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM contact_info WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

// --
// -- Estructura de tabla para la tabla `countries`
// --

$router->get('/countries', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM countries');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/countries/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM countries WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/countries', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE countries SET name_country = :name_country WHERE id = :id');
    $res->bindValue("id", $_DATA['id']);
    $res->bindValue("name_country", $_DATA['name_country']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/countries", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO countries (name_country) VALUES (:name_country)");
    $res->bindParam("name_country", $_DATA['name_country']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/countries", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM countries WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

// --
// -- Estructura de tabla para la tabla `design_area`
// --

$router->get('/design_area', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM design_area');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/design_area/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM design_area WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/design_area', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE design_area SET id_area = :id_area, id_staff = :id_staff, id_position = :id_position, id_journey = :id_journey WHERE id = :id');
    $res->bindValue("id", $_DATA['id']);
    $res->bindValue("id_area", $_DATA['id_area']);
    $res->bindValue("id_staff", $_DATA['id_staff']);
    $res->bindValue("id_position", $_DATA['id_position']);
    $res->bindValue("id_journey", $_DATA['id_journey']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/design_area", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO design_area (id_area, id_staff, id_position, id_journey) VALUES (:id_area, :id_staff, :id_position, :id_journey)");
    $res->bindParam("id_area", $_DATA['id_area']);
    $res->bindParam("id_staff", $_DATA['id_staff']);
    $res->bindParam("id_position", $_DATA['id_position']);
    $res->bindParam("id_journey", $_DATA['id_journey']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/design_area", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM design_area WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});


// --
// -- Estructura de tabla para la tabla `emergency_contact`
// --

$router->get('/emergency_contact', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM emergency_contact');
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->get("/emergency_contact/{id}", function($id){
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("SELECT * FROM emergency_contact WHERE id = :ID");
    $res->bindParam("ID", $id);
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});

$router->put('/emergency_contact', function() {
    $_DATA = json_decode(file_get_contents('php://input'), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE emergency_contact SET id_staff = :id_staff, cel_number = :cel_number, relationship = :relationship, full_name = :full_name, email = :email WHERE id = :id');
    $res->bindValue("id", $_DATA['id']);
    $res->bindValue("id_staff", $_DATA['id_staff']);
    $res->bindValue("cel_number", $_DATA['cel_number']);
    $res->bindValue("relationship", $_DATA['relationship']);
    $res->bindValue("full_name", $_DATA['full_name']);
    $res->bindValue("email", $_DATA['email']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/emergency_contact", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO emergency_contact (id_staff, cel_number, relationship, full_name, email) VALUES (:id_staff, :cel_number, :relationship, :full_name, :email)");
    $res->bindParam("id_staff", $_DATA['id_staff']);
    $res->bindParam("cel_number", $_DATA['cel_number']);
    $res->bindParam("relationship", $_DATA['relationship']);
    $res->bindParam("full_name", $_DATA['full_name']);
    $res->bindParam("email", $_DATA['email']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/emergency_contact", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM emergency_contact WHERE id = :ID");
    $res->bindParam("ID", $_DATA['id']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});
   
    $router->run();
    
?>
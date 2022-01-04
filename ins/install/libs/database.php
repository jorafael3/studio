<?php
//error_reporting(0);


define('HOST', 'localhost');
define('DB', 'studio');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');


class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    private $pdo;

    public function __construct()
    {

        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
        $this->charset = constant('CHARSET');
    }

    function connect()
    {
        try {
            //$connection = "sqlsrv:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            if ($this->pdo) {
                return $this->pdo;
            } else {


                $this->pdo = new PDO("mysql:Server=" . $this->host . ";Database=" . $this->db . "", $this->user, $this->password);
                $options = [
                    PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES  => true,
                    PDO::ATTR_AUTOCOMMIT => true
                ];


                return $this->pdo;
            }

            //$pdo = new PDO($connection,$this->user,$this->password,$options);
            //return $pdo;

        } catch (PDOException $e) {
            //print_r('Error de conexion: '.$e->getMessage());
            print_r('Error de conexion: ');
        }
    }

    function VAlidate()
    {
        if ($this->connect()) {
            $this->Create_DataBase();

            return true;
        } else {
            return false;
        }
    }

    function Create_DataBase()
    {
        $conn = new PDO("mysql:Server=" . $this->host . ";Database=" . $this->db . "", $this->user, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS studio";
        if ($conn->exec($sql)) {
            $sql = "use studio";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS `clientes` (
                `id_cliente` int NOT NULL AUTO_INCREMENT,
                `nombre` varchar(100) NOT NULL,
                `ruc` varchar(15) NOT NULL,
                `correo` varchar(100) DEFAULT NULL,
                `telefono` varchar(100) DEFAULT NULL,
                `whatsapp` varchar(20) DEFAULT NULL,
                `direccion` varchar(500) DEFAULT NULL,
                `estado` int NOT NULL,
                `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
                `fecha_modificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                `Creador` varchar(50) NOT NULL,
                PRIMARY KEY (`id_cliente`)
              )";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS  `proveedores` (
                `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
                `nombre` varchar(100) NOT NULL,
                `ciudad` varchar(100) DEFAULT NULL,
                `whatsapp` varchar(50) DEFAULT NULL,
                `telefono` varchar(50) DEFAULT NULL,
                `contacto` varchar(100) DEFAULT NULL,
                `email` varchar(100) DEFAULT NULL,
                `direccion` varchar(500) DEFAULT NULL,
                `pagina` varchar(500) DEFAULT NULL,
                `observacion` varchar(1000) DEFAULT NULL,
                `estado` int(11) NOT NULL,
                `fecha_creacion` datetime DEFAULT current_timestamp(),
                `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
                `Creador` varchar(50) NOT NULL,
                PRIMARY KEY (`id_proveedor`)
              )";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS `productos` (
                `id_prod` int NOT NULL AUTO_INCREMENT,
                `nombre` varchar(100) NOT NULL,
                `descripcion` varchar(1000) NOT NULL,
                `precio` double DEFAULT NULL,
                `medida` int DEFAULT NULL,
                `estado` int DEFAULT NULL,
                `creacion` datetime DEFAULT CURRENT_TIMESTAMP,
                `actualizacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id_prod`)
              )";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS `proforma_cab` (
                `id_cab` int NOT NULL AUTO_INCREMENT,
                `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
                `nombre` varchar(1000) NOT NULL,
                `subtotal` double NOT NULL,
                `margen` double NOT NULL,
                `ganancia` double NOT NULL,
                `total` double NOT NULL,
                `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
                `fecha_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id_cab`)
              ) ";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS  `proforma_det` (
                `id_det` int NOT NULL AUTO_INCREMENT,
                `id_cab` int DEFAULT NULL,
                `id_prod` int DEFAULT NULL,
                `cantidad` int NOT NULL,
                `total` double NOT NULL,
                PRIMARY KEY (`id_det`)
              ) ";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS `factura` (
              `id_fact` int NOT NULL AUTO_INCREMENT,
              `id_cab` int NOT NULL,
              `id_cliente` int NOT NULL,
              `nombre` varchar(200) DEFAULT NULL,
              `descripcion` varchar(2000) DEFAULT NULL,
              `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
              `fecha_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id_fact`)
            )";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS `settings` (
                `Titulo_pr` varchar(100) NOT NULL,
                `direccion` varchar(500) NOT NULL,
                `correo` varchar(500) NOT NULL,
                `telefono1` varchar(20) NOT NULL,
                `telefono2` varchar(20) DEFAULT NULL,
                `logo_p` varchar(1000) DEFAULT NULL,
                `logo_orden` varchar(1000) DEFAULT NULL,
                `img_orden` varchar(1000) DEFAULT NULL,
                `pie_orden` varchar(500) DEFAULT NULL
              ) ";
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS `settings` (
                `Titulo_pr` varchar(100) NOT NULL,
                `direccion` varchar(500) NOT NULL,
                `correo` varchar(500) NOT NULL,
                `telefono1` varchar(20) NOT NULL,
                `telefono2` varchar(20) DEFAULT NULL,
                `logo_p` varchar(1000) DEFAULT NULL,
                `logo_orden` varchar(1000) DEFAULT NULL,
                `img_orden` varchar(1000) DEFAULT NULL,
                `pie_orden` varchar(500) DEFAULT NULL
              ) ";
            $conn->exec($sql);
            $sql = "INSERT INTO studio.settings (Titulo_pr,direccion,correo,telefono1,telefono2,logo_p,logo_orden,img_orden,pie_orden)
            values('Aj Esttudio','direccion','mail@mail.com','123456','123456','public/assets/images/aj.jpeg','public/assets/images/aj.jpeg','public/assets/images/bgorden.PNG','Pie Texto' ) ";
            $conn->exec($sql);

            $sql = "CREATE PROCEDURE IF NOT EXISTS`studio`.`CLIENTES`(
                IN nombre VARCHAR(100),
                IN ruc VARCHAR(15),
                IN correo VARCHAR(100),
                IN telefono VARCHAR(50),
                IN whatsapp VARCHAR(20),
                IN direccion VARCHAR(500),
                IN estado int,
                IN Creador VARCHAR(10),
                IN tipo int,
                IN id int
                )
                BEGIN
                     IF tipo = 1 THEN
                        INSERT INTO clientes(
                        nombre,
                        ruc,
                        correo,
                        telefono,
                        whatsapp,
                        direccion,
                        estado,
                        Creador
                        )
                        values(
                         nombre,
                        ruc,
                        correo,
                        telefono,
                        whatsapp,
                        direccion,
                        estado,
                        Creador
                        );
                     END IF;
                 
                     IF tipo = 2 THEN
                     update studio.clientes set
                     nombre = nombre,
                        ruc = ruc,
                        correo = correo,
                        telefono =  telefono,
                        whatsapp = whatsapp,
                        direccion = direccion,
                        estado = estado where id_cliente = id ;
                     END IF;
                END";
            $conn->exec($sql);


            $sql = "CREATE PROCEDURE IF NOT EXISTS `studio`.`PRODUCTOS`(
                IN nombre VARCHAR(100),
                IN descripcion VARCHAR(1000),
                IN precio double,
                IN medida int,
                IN estado int,
                IN tipo int,
                IN id int
                )
                begin
                     IF tipo = 1 then
                         INSERT INTO productos(
                             nombre,
                             descripcion,
                             precio,
                             medida,
                             estado 
                         )values(
                             nombre ,
                             descripcion,
                             precio,
                             medida,
                             estado 
                         );
                     END if;
                     IF tipo = 2 then
                         update studio.productos set
                         nombre = nombre,
                         descripcion  = descripcion,
                         precio = precio,
                         medida = medida ,
                         estado = estado
                         where id_prod = id;
                     END if;
                     
                END";
            $conn->exec($sql);

            $sql = "CREATE PROCEDURE IF NOT EXISTS `studio`.`PROFORMA_CAB`(
                IN nombre VARCHAR(500),
                IN sub double,
                IN marg double,
                IN ganan double,
                IN total double,
                IN tipo int,
                IN id int
                )
                begin
                    IF tipo = 1 then
                         INSERT INTO studio.proforma_cab (
                             nombre ,
                             subtotal ,
                             margen ,
                             ganancia ,
                             total 
                         )values(
                             nombre ,
                             sub,
                             marg,
                             ganan,
                             total 
                         );
                    END if;
                    IF tipo = 2 then
                        update studio.proforma_cab
                        set nombre = nombre,
                        subtotal = sub,
                        margen = marg,
                        ganancia = ganan,
                        total = total
                        where id_cab  = id;
                    END if;
                END";
            $conn->exec($sql);

            $sql = "CREATE PROCEDURE IF NOT EXISTS `studio`.`PROFORMA_DET`(
                IN id_cab int,
                IN cant int,
                IN total double,
                IN id_pr int,
                IN tipo int
                )
                begin
                    IF tipo = 1 then
                        INSERT INTO studio.proforma_det(
                             id_cab ,
                             cantidad ,
                             total ,
                             id_prod
                         )values(
                             id_cab ,
                             cant,
                             total,
                             id_pr
                         );
                     END if;
                    
                    IF tipo = 2 then
                        update studio.proforma_det 
                        set cantidad = cant,
                        total = total 
                        where id_cab = id_cab and id_det = id_pr;
                    END if;
                END
                ";
            $conn->exec($sql);


            $sql = "CREATE PROCEDURE IF NOT EXISTS `studio`.`FACTURAS`(
                IN id_prof int,
                IN id_cli int,
                IN nom varchar(200),
                IN descrip varchar(2000),
                IN tipo int
                )
                begin
                    IF tipo = 1 then
                        INSERT INTO studio.factura(
                             id_cab,
                             id_cliente ,
                             nombre ,
                             descripcion 
                         )values(
                             id_prof ,
                             id_cli,
                             nom,
                             descrip
                         );
                    END if;
                    IF tipo = 2 then
                        update studio.factura 
                        set
                        nombre = nom,
                        descripcion = descrip
                        where id_fact = id_prof;
                    END if;
                END";
            $conn->exec($sql);

            $sql = "CREATE PROCEDURE IF NOT EXISTS studio.PROVEEDORES(
                IN nombre VARCHAR(100),
               IN ciudad VARCHAR(100),
               IN telefono VARCHAR(50),
               IN whatsapp VARCHAR(20),
               IN contacto VARCHAR(100),
               IN correo VARCHAR(100),
               IN direccion VARCHAR(500),
               IN pagina VARCHAR(500),
               IN observacion VARCHAR(1000),
               IN estado int,
               IN Creador VARCHAR(10),
               IN tipo int,
               IN id int

                )
                begin
   
                    IF tipo = 1 THEN
                       INSERT INTO studio.proveedores(
                       nombre,
                       ciudad ,
                       telefono,
                       whatsapp,
                       contacto ,
                       email ,
                       direccion,
                       pagina ,
                       observacion ,
                       estado,
                       Creador
                       )
                       values(
                        nombre,
                       ciudad,
                       telefono,
                       whatsapp,
                       contacto ,
                       correo,
                       direccion,
                       pagina ,
                       observacion,
                       estado,
                       Creador
                       );
                    END IF;
                
                    IF tipo = 2 THEN
                    update studio.proveedores set
                    nombre = nombre,
                       ciudad = ciudad ,
                       telefono =  telefono,
                       whatsapp = whatsapp,
                       contacto  = contacto ,
                       email  = correo,                 
                       direccion = direccion,
                       pagina  = pagina ,
                       observacion = observacion ,
                       estado = estado where id_proveedor = id ;
                    END IF;
                END";
            $conn->exec($sql);
            unlink('../../cf.txt');
            return "ok";
        } else {
            return "err";
        }
    }
}

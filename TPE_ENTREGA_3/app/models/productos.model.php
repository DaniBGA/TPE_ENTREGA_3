<?php
require_once "./config.php";

class ProductosModel {

    private $db;

    function __construct() {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function getProductos ($order, $sort) {
        $query = $this->db->prepare("SELECT * FROM producto ORDER BY $sort $order");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    function get() {
        $query = $this->db->prepare('SELECT * FROM producto');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function checkProductos() {
        $query = $this->db->prepare('SELECT * FROM producto');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductosMenosUno ($id) {
        $query = $this->db->prepare('SELECT * FROM producto WHERE ID != ?');
        $query->execute([$id]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductosPorId ($id) {
        $query = $this->db->prepare('SELECT * FROM producto WHERE ID = ?');
        $query->execute([$id]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductoUnico ($id) {
        $query = $this->db->prepare('SELECT * FROM producto WHERE ID = ?');
        $query->execute([$id]);
        $productos = $query->fetch(PDO::FETCH_OBJ);
        return $productos;
    }

    function addProducto ($nombre, $imagen, $id_marca, $modelo, $motor, $kilometros, $detalles, $precio) {
        $query = $this->db->prepare('INSERT INTO producto ( nombre, imagen, marca, modelo, motor, kilometros, detalles, precio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$nombre, $imagen, $id_marca, $modelo, $motor, $kilometros, $detalles, $precio]);
        return $this->db->lastInsertId();
    }

    function updateProducto ($nombre, $imagen, $id_marca, $modelo, $motor, $kilometros, $detalles, $precio, $ID) {
        $query = $this->db->prepare('UPDATE producto SET nombre = ?, imagen = ?, marca = ?, modelo = ?, motor = ?, kilometros = ?, detalles = ?, precio = ? WHERE ID = ?');
        $query->execute([$nombre, $imagen, $id_marca, $modelo, $motor, $kilometros, $detalles, $precio, $ID]);
        return true;
    }
    function getProductosPaginado($page, $size, $sort, $order){
        $query = $this->db->prepare("SELECT * FROM producto ORDER BY $sort $order LIMIT $page, $size");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
}
<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_erros', 1);
//error_reporting(E_ALL);

abstract class AbstractDAO {

    public function select($conexao, $table_name, $aWheres = NULL, $class_name = NULL) {

        if (is_array($aWheres) && count($aWheres) > 0) {

            foreach ($aWheres as $field => $v)
                $keys[] = $field . ' = :' . $field;

            $cond = "WHERE " . implode(' and ', $keys);
        } else {

            $cond = '';
        }

        $sql = "SELECT * FROM $table_name $cond";

        $stmt = $conexao->prepare($sql);

        foreach ($aWheres as $f => $v) {
            $stmt->bindValue(':' . $f, $v);
        }

        try {
            $stmt->execute();

            if ($class_name != NULL)
                $result = $stmt->fetchAll(PDO::FETCH_CLASS, $class_name);
            else
                $result = $stmt->fetchAll();

            return $result;
        } catch (Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function selectGrid($conexao, $sql) {

        $stmt = $conexao->query($sql);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;
        } catch (Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function insert($conexao, $table_name, $id_seq, $assoc_array) {


        foreach ($assoc_array as $field => $v)
            $ins[] = ':' . $field;

        $ins = implode(',', $ins);
        $fields = implode(',', array_keys($assoc_array));
        $sql = "INSERT INTO $table_name ($fields) VALUES ($ins)";


        $stmt = $conexao->prepare($sql);

        foreach ($assoc_array as $f => $v) {
            $stmt->bindValue(':' . $f, $v);
        }

        try {
            $stmt->execute();
            if (!empty($id_seq)) {
                return $conexao->lastInsertId($id_seq);
            }
        } catch (Exception $e) {
            print $e->getMessage();
            throw new PDOException($e->getMessage());
        }
    }

    public function update($conexao, $table_name, $id_array, $assoc_array) {

        $idField = array_keys($id_array);
        $idFieldBind = array();
        $value = array_values($id_array);
        $where = "";


        for ($index = 0; $index < count($idField); $index++) {
            array_push($idFieldBind, ':' . $idField[$index]);
            if ($index + 1 == count($idField)) {
                $where .= $idField[$index] . " = :" . $idField[$index];
            } else {
                $where .= $idField[$index] . " = :" . $idField[$index] . " AND ";
            }
        }

        foreach ($assoc_array as $field => $v)
            $ins[] = ':' . $field;

        $ins = implode(',', $ins);
        $fields = implode(',', array_keys($assoc_array));
        $sql = "UPDATE $table_name SET ($fields) = ($ins)
        WHERE $where";

        $stmt = $conexao->prepare($sql);

        foreach ($assoc_array as $f => $v) {
            $stmt->bindValue(':' . $f, $v);
        }

        for ($i = 0; $i < count($idFieldBind); $i++) {
            $stmt->bindValue($idFieldBind[$i], $value[$i]);
        }

        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function delete($conexao, $table_name, $id_array) {

        $idField = array_shift(array_keys($id_array));
        $idFieldBind = ":" . $idField;
        $value = array_shift(array_values($id_array));

        $sql = "DELETE FROM $table_name WHERE $idField = $idFieldBind";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue($idFieldBind, $value);
        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function execute($conexao, $sql, $class_name = null) {

        $stmt = $conexao->prepare($sql);

        try {
            $stmt->execute();
            if (!$class_name) {
                $result = $stmt->fetchAll();
            } else {
                $result = $stmt->fetchAll(PDO::FETCH_CLASS, $class_name);
            }
            return $result;
        } catch (Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }

}

?>

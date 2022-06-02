<?php
include_once '_conexion.php';

$sql = _query("SELECT * FROM `mov_caja` WHERE idtransace !='' AND fecha='2021-12-27' AND idtransace NOT IN (SELECT abono_credito.id_abono_credito FROM abono_credito)");

while ($row = _fetch_array($sql)) {
  echo $row['idtransace']." ".$row['numero_doc']."<br>";
  $sql2 = _query("SELECT * FROM factura WHERE factura.numero_doc='$row[numero_doc]' AND factura.credito=1");
  while ($row2 = _fetch_array($sql2)) {
      echo $row2['id_factura']." ".$row2['total']."<br>";
      $table="credito";
      $form_data = array(
        'id_credito' => -$row2['id_factura'],
        'id_cliente' => $row2['id_cliente'],
        'fecha' => "0000-00-00",
        'tipo_doc' => $row2['tipo_documento'],
        'numero_doc' => $row2['numero_doc'],
        'id_factura' => $row2['id_factura'],
        'dias' =>  '30',
        'total' => $row2['total_menos_retencion'],
        'abono' => $row2['total_menos_retencion'],
        'saldo' => 0,
        'finalizada' => 1,
        'id_sucursal' => 1,
        'id_server' => '0',
      );
      $insert=_insert_s($table, $form_data);


        $table = 'abono_credito';
        $form_data = array(
          'id_abono_credito' => $row['idtransace'],
          'id_credito' => -$row2['id_factura'],
          'abono' => $row['valor'],
          'fecha' => $row['fecha'],
          'hora' => $row['hora'],
          'tipo_doc' => '',
          'num_doc' => '',
        );
        $insertar1 = _insert_s($table, $form_data);
  }
}
 ?>

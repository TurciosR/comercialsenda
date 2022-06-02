<?php
include_once "_core.php";
include ('num2letras.php');
include ('facturacion_funcion_imprimir.php');

function initial() {
	// Page setup
	$id_user=$_SESSION["id_usuario"];

	$_PAGE = array ();
	$_PAGE ['title'] = 'Reporte Inventario';
	$_PAGE ['links'] = null;
	$_PAGE ['links'] .= '<link href="css/bootstrap.min.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="font-awesome/css/font-awesome.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/iCheck/custom.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/chosen/chosen.css" rel="stylesheet">';
  $_PAGE ['links'] .= '<link href="css/plugins/select2/select2.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">';
  $_PAGE ['links'] .= '<link href="css/plugins/fileinput/fileinput.css" media="all" rel="stylesheet" type="text/css"/>';
	$_PAGE ['links'] .= '<link href="css/animate.css" rel="stylesheet">';
  $_PAGE ['links'] .= '<link href="css/style.css" rel="stylesheet">';
	$_PAGE ['links'] .= '<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">';

	include_once "header.php";
	include_once "main_menu.php";
	//permiso del script
	$id_user=$_SESSION["id_usuario"];
	$admin=$_SESSION["admin"];

	$uri = $_SERVER['SCRIPT_NAME'];
	$filename=get_name_script($uri);
	$links=permission_usr($id_user, $filename);


	//permiso del script
	if ($links!='NOT' || $admin=='1' ){
?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-2">
                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Reporte Inventario</h5>
                        </div>
                        <div class="ibox-content">
                  				  <input type="hidden" name="process" id="process" value="inventario">
                            <div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Categorias</label>
																	<select style="width:100%" class="categoria" id="id_categoria" name="id_categoria">
																		<?php
																		$sql = _query("SELECT * FROM categoria WHERE categoria.id_categoria IN (SELECT producto.id_categoria FROM producto JOIN stock ON stock.id_producto=producto.id_producto)");
																		while ($row = _fetch_array($sql)) {
																		 ?>
																		 <option value="<?=$row['id_categoria'] ?>"> <?=$row['nombre_cat'] ?> </option>
																		 <?php
																	 	}
																		  ?>
																	</select>
																</div>
															</div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <input type="hidden" name="id_sucursal" id="id_sucursal">
                                  <input type="submit" id="submit1" name="submit1" value="PDF" class="btn btn-primary m-t-n-xs" />
                                  <input type="submit" id="submit2" name="submit1" value="EXCEL" class="btn btn-primary m-t-n-xs" />
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php
include_once ("footer.php");
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#id_categoria").select2();
		$("#submit2").click(function()
		{
			var id_categoria = $("#id_categoria").val();
			var cadena = "reporte_inventario_xls.php?id_categoria="+id_categoria;
			window.open(cadena, '', '');
		});
		$("#submit1").click(function()
		{
			var id_categoria = $("#id_categoria").val();
			var cadena = "reporte_inventario_pdf.php?id_categoria="+id_categoria;
			window.open(cadena, '', '');
		});
	});
</script>
<?php
		} //permiso del script
else {
		echo "<div></div><br><br><div class='alert alert-warning'>No tiene permiso para este modulo.</div>";
	}
}


if(!isset($_POST['process'])){
	initial();
}
else
{
if(isset($_POST['process'])){
switch ($_POST['process']) {
	case 'edit':
		//insertar_empresa();
    editar();
		break;
	}
}
}
?>

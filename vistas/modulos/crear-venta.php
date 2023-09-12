<?php

if ($_SESSION["perfil"] == "Especial") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear Presupuesto

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active"> Crear Presupuesto</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon productN"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon productN"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if (!$ventas) {

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';


                    } else {

                      foreach ($ventas as $key => $value) {



                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="' . $codigo . '" readonly>';


                    }

                    ?>


                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon productN"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                      <option value="">Seleccionar cliente</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($categorias as $key => $value) {

                        echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';

                      }

                      ?>

                    </select>

                    <span class="input-group-addon productN"><button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar
                        cliente</button></span>

                  </div>

                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevoProducto" id="ContainerPrices">
                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-8 pull-right">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td style="width: 50%">
                            <div class="input-group">
                              <input type="number" class="form-control input-lg " min="0" id="nuevoImpuestoVenta"
                                name="nuevoImpuestoVenta" placeholder="0" required>
                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                              <span class="input-group-addon productN"><i class="fa fa-percent"></i></span>
                            </div>
                          </td>

                          <td style="width: 50%">
                            <div class="input-group">
                              <span class="input-group-addon" id="monedaTotal">
                                <i class="ion ion-social-usd"></i>
                              </span>
                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta"
                                name="nuevoTotalVenta" total="" placeholder="00000" readonly required>
                              <input type="hidden" name="totalVenta" id="totalVenta">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  <div class="col-xs-6" style="padding-right:0px">
                    <div class="input-group">
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option disabled selected>Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>
                      </select>
                    </div>
                  </div>
                  <div class="cajasMetodoPago"></div>
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                </div>
                <br>
              </div>

            </div>

            <div class="form-group row ">
              <div class="col-xs-6" style="padding-right:0px; left: 30%">
                <div class="input-group ">
                  <select class="form-control btn btn-warning" id="monedaCambio" name="monedaCambio" required>
                    <option disabled selected>Seleccione el tipo de moneda</option>
                    <option value="ARG">Peso Argentino</option>
                    <option value="USD">Dólar</option>
                    <option value="EUR">Euro</option>
                    <option value="JPY">Yen japonés</option>
                    <option value="CNY">Yuan chino</option>
                    <option value="RUB">Rublo ruso</option>
                  </select>
                </div>
              </div>
              <input type="hidden" id="listaMonedaCambio" name="listaMelistaMonedaCambiotodoPago">
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>
            </div>



          </form>

          <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta->ctrCrearVenta();

          ?>

        </div>

      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaVentas">

              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon productN"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre"
                  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon productN"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId"
                  placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon productN"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email"
                  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon productN"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono"
                  data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon productN"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección"
                  required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon productN"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento"
                  placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>



      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente->ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
<style>
  .cambiarMoneda {
    position: relative;
    left: auto;
  }
</style>

<script>
  $('#monedaCambio').on('change', remplazarMoneda)


  function validMoneda() {
    //alert("clink en agregar productos a la lista de compra")
    var moneda = $('#monedaCambio').val()
    if (moneda) {
      remplazarMoneda()
    }
  }

  function remplazarMoneda() {
    var moneda = $('#monedaCambio').val()
    //alert("mensaje para reemplazar moneda por "+ moneda)
    var ContainerPrices = $("#ContainerPrices").find(".productN")
    var monedaTotal = $("#monedaTotal")
    var monedaEfectivo1 = $("#pagoEfectivo")
    var monedaEfectivo2 = $("#descuentoPago")

    var pesoARG = `<i class="ion ion-social-usd"></i>`
    var dolar = `<strong>U$S</strong>`
    var euro = `<span class="material-symbols-outlined" style="font-size: 1.8rem">euro_symbol</span>`
    var rupia = `<span class="material-symbols-outlined" style="font-size: 1.8rem">currency_ruble</span>`
    var yuan = `<span class="material-symbols-outlined" style="font-size: 1.8rem">currency_yuan</span>`
    var yen = `<span class="material-symbols-outlined" style="font-size: 1.8rem">currency_yen</span>`

    var pesoArgentinoCom = `
      <span class="input-group-addon productN">
        <i class="ion ion-social-usd"></i>
      </span>
      `
    var dolarCom = `
      <span class="input-group-addon productN">
        <strong>U$S</strong>
      </span>
      `
    var euroCom = `
      <span class="input-group-addon productN">
        <span class="material-symbols-outlined" style="font-size: 1.8rem">euro_symbol</span>
      </span>
      `
    var rupiaCom = `
      <span class="input-group-addon productN">
        <span class="material-symbols-outlined" style="font-size: 1.8rem">currency_ruble</span>
      </span>
      `
    var yuanCom = `
      <span class="input-group-addon productN">
        <span class="material-symbols-outlined" style="font-size: 1.8rem">currency_yuan</span>
      </span>
      `
    var yenCom = `
      <span class="input-group-addon productN">
        <span class="material-symbols-outlined" style="font-size: 1.8rem">currency_yen</span>
      </span>
      `

    if (moneda == 'ARG') {
      ContainerPrices.replaceWith(pesoArgentinoCom)
      monedaTotal.html(pesoARG)
      monedaEfectivo1.html(pesoARG)
      monedaEfectivo2.html(pesoARG)
    }
    if (moneda == 'USD') {
      ContainerPrices.replaceWith(dolarCom)
      monedaTotal.html(dolar)
      monedaEfectivo1.html(dolar)
      monedaEfectivo2.html(dolar)
    }
    if (moneda == 'EUR') {
      ContainerPrices.replaceWith(euroCom)
      monedaTotal.html(euro)
      monedaEfectivo1.html(euro)
      monedaEfectivo2.html(euro)
    }
    if (moneda == 'JPY') {
      ContainerPrices.replaceWith(yenCom)
      monedaTotal.html(yen)
      monedaEfectivo1.html(yen)
      monedaEfectivo2.html(yen)
    }
    if (moneda == 'CNY') {
      ContainerPrices.replaceWith(yuanCom)
      monedaTotal.html(yuan)
      monedaEfectivo1.html(yuan)
      monedaEfectivo2.html(yuan)
    }
    if (moneda == 'RUB') {
      ContainerPrices.replaceWith(rupiaCom)
      monedaTotal.html(rupia)
      monedaEfectivo1.html(rupia)
      monedaEfectivo2.html(rupia)
    }
  }




</script>
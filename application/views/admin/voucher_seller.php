<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="hidratec-admin">
    <meta name="author" content="Sistema Hidratec ">
    <title>Comprobante de venta</title>
    <style type="text/css">
    body {
    width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F2F4F6; color: #74787E; -webkit-text-size-adjust: none;
    }

    .content-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .content-table thead tr {
        background-color: #08205c;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .content-table th,
    .content-table td {
        padding: 12px 15px;
    }

    .content-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    
    @media only screen and (max-width: 600px) {
      .email-body_inner {
        width: 100% !important;
      }
      .email-footer {
        width: 100% !important;
      }
    }
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }

  </style>
  </head>
  <body style="-webkit-text-size-adjust: none; box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; height: 100%; line-height: 1.4; margin: 0; width: 100% !important; background-color: #F2F4F6">
 

    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; background-color: #F2F4F6">
      <tr>
        <td style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;" >
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">
            <tr>
              <td class="email-masthead" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding: 25px 0; word-break: break-word;" align="center">
                <a class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                  Hidratec
                </a>
              </td>
            </tr>
            
            <tr style="border-width: 1px; border-color: #f2f4f6;">
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;" bgcolor="#FFFFFF">
                <table class="email-body_inner" width="800" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 800px; background-color: #FFFFFF">
                  
                  <tr>
                    <td class="content-cell" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                      <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;"> El cliente {{name_title}} ha realizado una compra con éxito, con fecha de emisión: {{date}}</h1>
                      
                      <table class="body-action" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
                        <tr>
                          <td style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                            
                            <table width="100%" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                              <tr>
                                <td align="center" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                                  <table  cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                    <tr>
                                      <td style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                                        <a class="button button--green" target="_blank" style="-webkit-text-size-adjust: none; background: #08205c; border-color: #08205c; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; text-decoration: none;">N° Orden {{order}} </a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <hr> 


                      <table  class="body-action" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;  background-image: url('')">
                        <tr>
                            <td>
                              <div class="card-title" style="text-align: left; margin-bottom: 15px; font-family: Lato, Tahoma, Sans-Serif;font-weight: 700;font-size: 1.3rem;color: #4A4A4A;">
                                Detalles De Cliente
                              </div>
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-12 col-sm-12" style='text-align: left;'> 
                                            <div class='row'>
                                              <span class='resume-delivery-min'><strong>Nombre:</strong> {{name}} </span>
                                            </div>
                                            <div class='row'>
                                              <span class='resume-delivery-min'><strong>Rut Empresa:</strong> {{rut}} </span>
                                            </div>
                                            <div class='row'>
                                              <span class='resume-delivery-text'><strong>Telefono/ Celular:</strong> {{phone}} </span>
                                            </div>
                                            <div class='row'>
                                              <span class='resume-delivery-text'><strong>E-mail:</strong> {{email}} </span>
                                            </div>
                                            <div class='row'>
                                              <span class='resume-delivery-text'><strong>Region:</strong> {{region}} </span>
                                            </div>
                                            <div class='row'>
                                              <span class='resume-delivery-text'><strong>Comuna:</strong> {{comuna}} </span>
                                            </div>
                                      </div>
                                  </div>
                              </div>
                            </td>
                        </tr>
                      </table>

                     <!--  <table class="body-action" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;  background-image: url('')">
                        <tr>
                            <td>
                              <div class="card-title" style="text-align: left; margin-bottom: 15px; font-family: Lato, Tahoma, Sans-Serif;font-weight: 700;font-size: 1.3rem;color: #4A4A4A;">
                                Tipo De Compra: <strong>Delivery</strong>
                              </div>
                              <div class="card-body"> 
                                  <div class="row" style='text-align:left;'>
                                      <span class='resume-delivery-min'><strong>Empresa Delivery:</strong> Starken</span>
                                  </div>
                                  <div class="row" style='text-align:left;'>
                                      <span class='resume-delivery-min'><strong>Dirección:</strong> #Aurora 2015</span>
                                  </div>
                                  <div class="row" style='text-align:left;'>
                                      <span class='resume-delivery-min'><strong>Depto/Casa/Oficina: </strong>-</span>
                                  </div>
                                  <div class="row" style='text-align:left;'>
                                      <span class='resume-delivery-min'><strong>Región:</strong> Coquimbo</span>
                                  </div>
                                  <div class="row" style='text-align:left;'>
                                      <span class='resume-delivery-min'><strong>Comuna:</strong> La Serena</span>
                                  </div>
                                  <div class="row" style='text-align:left;'>
                                      <span class='resume-delivery-min'><strong>Comentarios:</strong> -</span>
                                  </div>
                              </div>
                            </td>
                        </tr>
                      </table> -->

                     <!--  <table  class="body-action" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;  background-image: url('')">
                        <tr>
                            <td>
                              <div class="card-title" style="text-align: left; margin-bottom: 15px; font-family: Lato, Tahoma, Sans-Serif;font-weight: 700;font-size: 1.3rem;color: #4A4A4A;">
                                Tipo De Compra: <strong>Retiro en Sucursal</strong>
                              </div>
                              <div class="card-body">
                                  <div class="row" style='text-align:left;'>
                                      <span class='resume-delivery-min'><strong>Fecha disponible para retiro:</strong> Desde el 21-10-2022</span>
                                  </div>
                              </div>
                            </td>
                        </tr>
                      </table> -->
                      <table  class="body-action" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;  background-image: url('')">
                        <tr>
                            <td>
                              {{type_purchase}}
                            </td>
                        </tr>
                      </table>

                      <hr>

                      <table  class="body-action" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: auto; padding: 0; text-align: center; width: 100%;">
                        <tr>
                            <td>
                              <div class="card-title" style="text-align: left; margin-bottom: 15px; font-family: Lato, Tahoma, Sans-Serif;font-weight: 700;font-size: 1.3rem;color: #4A4A4A;">
                                <strong>Detalle De Compra</strong>
                              </div>
                              <div class="card-body" style="display: inline-block;"> 
                                <table class="content-table">
                                  <thead>
                                    <tr>
                                      <th>Producto</th>
                                      <th>Codigo</th>
                                      <th>Precio Unitario</th>
                                      <th>Cantidad</th>
                                      <th>Sub total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    {{purchase_detail}}
                                    <!-- <tr>
                                      <td>PISTONES DOBLE 57 X 57 CC</td>
                                      <td>RCSRT</td>
                                      <td>$32.423</td>
                                      <td>2</td>
                                      <td>$64.846</td>
                                    </tr> -->
                                  </tbody>
                                </table>
                              </div>
                            </td>
                        </tr>
                      </table>
                      <hr>
           

                       <div style="text-align: center;">
                        <p style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;">Equipo de ventas Hidratec.</p>
                      </div>
                      
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                <table class="email-footer" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
                  <tr>
                    <td class="content-cell" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                      <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;">© {{year}} Hidratec. Todos los derechos reservados.</p>
                      <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;">
                        <br />Casa Matriz: Proyectada Uno 1712, Galpón 4, condominio El Molino, Barrio Industrial - Coquimbo 
                        <br />Fono: (51)231482 E-mail: ventas@hidratec.cl www.hidratec.cl
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
<hr>


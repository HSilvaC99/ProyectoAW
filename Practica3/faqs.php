

<?php
require_once __DIR__ . '/includes/config.php';

$title = 'FAQs';

$content = <<<EOS
    <h1 class="mb-3 d-flex justify-content-center">PREGUNTAS FRECUENTES</h1><br>
    <hr class="border border-primary border-3 opacity-75">
    <div class = "container mb-5" style="border">
        <div class="accordion " id="accordionExample">
        <h3> 1. ENVÍOS Y ENTREGAS</h3>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                        <p>¿Dónde realizamos envíos?</p>
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Realizamos envíos a toda la península ibérica incluyendo las islas. Las provincias son las siguientes: Álava, Albacete, Alicante, Almería, Asturias, 
                            Ávila, Badajoz, Barcelona, Burgos, Cáceres, Cádiz, Cantabria, Castellón, Ciudad Real, Córdoba, Cuenca, Gerona, Granada, Guadalajara, Guipúzcoa, Huelva, 
                            Huesca, Islas Baleares, Jaén, La Coruña, La Rioja, Las Palmas, León, Lérida, Lugo, Madrid, Málaga, Murcia, Navarra, Orense, Palencia, Pontevedra, 
                            Salamanca, Santa Cruz de Tenerife, Segovia, Sevilla, Soria, Tarragona, Teruel, Toledo, Valencia, Valladolid, Vizcaya, Zamora y Zaragoza. <br></p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        <p>¿Cuál es el coste de envío?</p>
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>España peninsular y Portugal: 5’95€ si el pedido es inferior a 80€, si el pedido es superior a 80€ los gastos de envío son gratuitos. <br>

                            Islas Baleares: 15’95€ si el pedido es inferior a 80€, si el pedido es superior a 80€ los gastos de envío son 7’95€. <br>

                            Islas Canarias: 24’95€.<br></p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        <p>¿Cuánto tardará mi pedido en llegar?</p>
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Los artículos solicitados se enviarán el mismo día de completar el pedido en nuestra página web si es realizado antes de las 14:00h y siempre y cuando todos 
                        los artículos de dicho pedido se encuentren en stock, y serán recibidos en 24-48h. <br> <br>

                        En caso de los artículos bajo pedido se indica en los mismos el tiempo estimado de llegada a nuestras instalaciones en días laborables, pudiendo variar este plazo 
                        al no depender de nosotros la rapidez y eficacia de empresas externas; debe tenerse en cuenta que en este caso ofrecemos un producto que tenemos que recibir y para 
                        lo cual dependemos que muchas otras empresas hagan correctamente su parte del trabajo, con lo que es posible que suceda una demora algo distinta a la indicada. Una 
                        vez recibimos el/los artículos en nuestras instalaciones, se procesa como un pedido en stock y será recibido en las siguientes 24-48h. <br> <br>

                        Tiene que tener en cuenta para este plazo los días laborables, que son de lunes a viernes. Igual consideración deberá de tener en cuenta en el caso de días festivos 
                        tanto nacionales como locales. <br> <br>

                        Los pedidos que contengan artículos bajo pedido serán enviados una vez sean recibidos en nuestras instalaciones todos los productos contenidos en el mismo.<br></p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                        <p>¿Puedo cambiar mis datos de envío después de haber realizado el pedido?</p>
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Si, puedes ponerte en contacto con nuestro teléfono de atención al cliente y comunicarnos la modificación, siempre y cuando el pedido aún no 
                        haya sido enviado.<br></p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                        <p>¿Cómo puedo saber el estado de mi pedido?</p>
                    </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Si has realizado el pedido desde una cuenta de cliente, dentro de tu cuenta en la ventana “mis pedidos” puedes ver el estado del pedido, así como el 
                        seguimiento de este. Si el pedido ha sido realizado como invitado, no podrás ver el estado del pedido, excepto en las comunicaciones que se realizan por 
                        e-mail cuando modificamos dicho estado.<br></p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading6">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                        <p>¿Es posible cancelar un pedido cuando ya ha sido enviado?</p>
                    </button>
                </h2>
                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Si, pero los gastos de envío tanto de ida como de vuelta se descontarán del abono.<br></p>
                    </div>
                </div>
            </div>
            

        <h3> 2. PAGOS Y PRECIOS</h3>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading7">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                        <p>¿Qué métodos de pago son aceptados?</p>
                    </button>
                </h2>
                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>-En efectivo en tienda. <br><br>

                            -Pago a contrarrembolso: el Usuario pagará el importe del pedido al mensajero en el momento de la entrega de los artículos. <br><br>

                            -Ingreso bancario: el Usuario ingresará el importe del pedido en la cuenta corriente directamente en ventanilla del banco. Puede avisar telefónicamente 
                            o por email de dicho ingreso para acelerar la tramitación de su pedido. Debe de indicar su nombre en el ingreso para identificar el pago o bien enviarnos
                            por email copia del justificante bancario para asociar dicho pago con su pedido. <br><br>

                            -Transferencia bancaria: el Usuario realizará transferencia bancaria por el importe del pedido a la cuenta del banco. Puede avisar por email adjuntando 
                            copia de la transferencia para acelerar la tramitación de su pedido. Debe indicarnos su nombre en la transferencia para identificar el pago. 

                            -Pago a través de Tarjeta de Crédito: el Usuario pagará el importe del pedido a través del enlace con el TPV Virtual del banco que se creará 
                            automáticamente al realizar el pedido y elegir esta opción. En esta forma de pago se recibe la confirmación del banco que se ha realizado el pago, 
                            el resto de datos como numeración de tarjetas, etc. son comunicados por el Usuario únicamente al banco. Utiliza también, dependiendo de la tarjeta, 
                            la tecnología de CES (Comercio Electrónico Seguro) que necesita de un código de confirmación que recibe vía SMS, y que al realizar la compra, si no
                            se ha dado de alta previamente, la entidad de la tarjeta guiará en los pasos para que pueda darse de alta en el mismo momento. <br> <br>

                            -Pago a través de PayPal: el Usuario pagará el importe del pedido a través del enlace con PayPal que se creará automáticamente al realizar el 
                            pedido y elegir esta opción. En esta forma de pago se recibe la confirmación de PayPal que se ha realizado el pago, el resto de datos como numeración
                            de tarjetas, etc. son comunicados por el Usuario únicamente a PayPal.<br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading8">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                        <p>¿Hay que pagar algo al recibir el pedido?</p>
                    </button>
                </h2>
                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>No, siempre y cuando el pedido no se haya realizado con método de pago contrarrembolso. <br> <br>
                        En los pedidos cuyo destino tenga aduanas, es posible que estas le añadan algún gasto extra dependiendo del importe.
                        Este gasto es responsabilidad del cliente, y en ningún caso podemos conocer nosotros de antemano si se aplicará o cuál será el importe.
                        Esto depende completamente de la Administración de Aduanas y son ellos quienes cobran este suplemento, no nosotros. <br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading9">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                        <p>¿Cómo puedo saber si el pago ha sido aceptado?</p>
                    </button>
                </h2>
                <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Dentro de tu cuenta cliente te aparecerá la ventana “mis pedidos”, dentro de esta podrás comprobar el estado de tu pedido (siempre y cuando no lo 
                            hayas realizado como invitado). <br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading10">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                        <p>¿Qué debo hacer si el pago me ha dado error?</p>
                    </button>
                </h2>
                <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Revisar el saldo de tu cuenta, contactar con el banco o servicio por el que se está intentando realizar el pago y, si no logras localizar el error, 
                            ponerte en contacto con nuestro servicio de atención al cliente para intentar ayudarte a revisar el problema.<br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading11">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                        <p>¿Se puede pagar en cuotas?</p>
                    </button>
                </h2>
                <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Si, contamos con el método de pago Aplázame, el cual te permitirá financiar tu compra en cómodos plazos.<br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading12">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                        <p>¿Hacéis descuentos por pedidos grandes?</p>
                    </button>
                </h2>
                <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Para pedidos superiores a 2000€, podéis poneros en contacto con nuestro servicio de atención al cliente para valorar el pedido.<br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading13">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                        <p>¿Cómo consigo un descuento?</p>
                    </button>
                </h2>
                <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Realizamos diferentes descuentos y promociones a través de nuestros distintos canales de marketing. Síguenos y mantente al día de todas nuestras promociones.<br></p>
                        </div>
                    </div>
                </div>

        <h3> 3. DEVOLUCIONES, CAMBIOS Y GARANTÍA</h3>
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading14">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                        <p>¿Por qué motivos puedo cambiar o devolver un artículo?</p>
                    </button>
                </h2>
                <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>El cliente dispone de 14 días naturales desde la recepción del artículo para cualquier cambio o devolución, siempre y cuando dicho artículo se encuentre en
                            perfectas condiciones, sin ninguna marca de uso y en su embalaje original; en resumen, tal y como lo recibió. Los gastos de envío correrán a cargo del
                            cliente.<br></p>
                        </div>
                    </div>
                </div> 
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading15">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                        <p>¿Qué coste tiene un cambio o devolución?</p>
                    </button>
                </h2>
                <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Puedes realizar el envío con la empresa de transporte que prefieras, los gastos de envío dependerán de la misma.<br></p>
                        </div>
                    </div>
                </div> 
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading16">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                        <p>¿Cómo realizo un cambio o devolución?</p>
                    </button>
                </h2>
                <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Ponte en contacto con nuestro equipo de atención al cliente para informar de la devolución, preferiblemente y siempre que sea posible por teléfono 
                            dentro del horario comercial. Una vez hecho esto, y tal como te será indicado, deberás llevar tu paquete a la agencia de transporte de tu elección y 
                            realizar el envío por tu cuenta. <br> <br>


                        ¿Cómo debo preparar el paquete para su devolución, cambio o garantía? <br> <br>
                        Debes preparar el paquete de tal manera que no sufra daños en el transporte ni el artículo ni su embalaje original, ya sea enviado por ti (cambio o devolución) 
                        o recogido por nosotros (garantía). <br><br>

                        Añade dentro del paquete un papel indicando la referencia y nombre al que se realizó el pedido, y si se trata de una devolución, un cambio o una garantía. <br><br>

                        No pongas precinto, cinta de embalar o similares directamente en la caja del producto, y bajo ningún concepto se debe enviar el artículo sin envolver. 
                        En caso de sufrir daños el artículo o su embalaje por mala preparación en el transporte, será responsabilidad del cliente que lo envía.<br></p>
                    </div>
                    </div>
                </div> 
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading24">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse24" aria-expanded="false" aria-controls="collapse24">
                        <p>¿Cómo debo preparar el paquete para su devolución, cambio o garantía?</p>
                    </button>
                </h2>
                <div id="collapse24" class="accordion-collapse collapse" aria-labelledby="heading24" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Debes preparar el paquete de tal manera que no sufra daños en el transporte ni el artículo ni su embalaje original, ya sea enviado por ti 
                            (cambio o devolución) o recogido por nosotros (garantía). <br><br>

                        Añade dentro del paquete un papel indicando la referencia y nombre al que se realizó el pedido, y si se trata de una devolución, un cambio o una garantía. <br><br>

                        No pongas precinto, cinta de embalar o similares directamente en la caja del producto, y bajo ningún concepto se debe enviar el artículo sin envolver. 
                        En caso de sufrir daños el artículo o su embalaje por mala preparación en el transporte, será responsabilidad del cliente que lo envía. <br></p>
                        </div>
                    </div>
                </div> 
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading17">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                        <p>¿Cómo recibiré mi reembolso al devolver un artículo?</p>
                    </button>
                </h2>
                <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Podemos entregarte un vale descuento por importe del artículo devuelto o bien realizarte un reembolso a través del mismo método de pago por el que se realizó la compra. <br></p>
                        </div>
                    </div>
                </div> 
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading18">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                        <p>¿Cómo tramito la garantía?</p>
                    </button>
                </h2>
                <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading18" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Ponte en contacto con nosotros por WhatsApp al 655834662 indicándonos la referencia y nombre de pedido, el problema que has tenido y vídeos/fotos de 
                            dicho problema. Una vez hecho esto, nuestro técnico revisará el caso en un plazo máximo de 5 días laborables y, si dicho problema está contemplado en
                            la garantía, te indicaremos los pasos a seguir para tramitarla. <br><br>

                        Importante: Si el artículo una vez recibido queda excluido de garantía por un defecto o rotura no contemplado anteriormente, el cliente deberá abonar los
                        gastos de envío que suponga la tramitación y, en caso de desear la reparación, abonar los costes de la misma (mano de obra y materiales).<br></p>
                        </div>
                    </div>
                </div> 
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading19">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
                        <p>¿Cuánto tiempo tardaré en tener respuesta en caso de garantía?</p>
                    </button>
                </h2>
                <div id="collapse19" class="accordion-collapse collapse" aria-labelledby="heading19" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>El tiempo de reparación o sustitución de un artículo que ha sido enviado a nuestro servicio técnico y aceptado en garantía puede variar, 
                            pudiendo ser de 2 a 15 días laborables. Este tiempo puede verse afectado si fuera necesario el envío del artículo a las instalaciones del
                            servicio técnico oficial de la marca.<br></p>
                        </div>
                    </div>
                </div> 
                <div class="accordion-item">
                <h2 class="accordion-header" id="heading20">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                        <p>¿Quién paga los gastos de envío de un producto en garantía?</p>
                    </button>
                </h2>
                <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Los artículos recibidos que tengan algún defecto de fabricación y estén dentro de la garantía serán recogidos por nuestra agencia de transporte para su 
                            posterior tramitación al servicio técnico sin suponer ningún tipo de gasto para el cliente (para artículos que se encuentren en España peninsular o 
                            Portugal, no aplica fuera de dicho territorio), siempre y cuando dicha tramitación se lleve a cabo dentro de los primeros 60 días tras la recepción del 
                            artículo; para todas las tramitaciones a garantía que se lleven a cabo tras dicho plazo, el envío hacia nuestras instalaciones correrá a cargo del cliente.
                            Una vez recibido este artículo nuestra empresa se hará cargo de todos los gastos asociados a la reparación, trámites con el fabricante y gastos de envío
                            de vuelta hacia el cliente una vez realizada la reparación o sustitución del artículo.<br></p>
                        </div>
                    </div>
                </div> 

        <h3> 4. REALIZANDO LA COMPRA</h3>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading21">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                            <p>¿Cómo hago una compra online?</p>
                        </button>
                    </h2>
                    <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading21" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>Selecciona los artículos en los que estás interesado y añádelos al carrito de compra, especifica tus datos de envío en los campos indicados para ello 
                                y selecciona el método de pago de tu elección para la compra. <br><br>
                                Si tienes algún problema a la hora de realizar el pedido, no dudes en ponerte en contacto con nuestro teléfono de atención al cliente, estaremos encantados de poder ayudarte. <br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading22">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                            <p>¿Es seguro realizar una compra online?</p>
                        </button>
                    </h2>
                    <div id="collapse22" class="accordion-collapse collapse" aria-labelledby="heading22" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>Realizar una compra online en nuestra página web es totalmente seguro, ya que contamos con métodos de pago con garantía antifraude, para
                            garantizar a nuestros clientes el mejor servicio y tranquilidad a la hora de realizar el pago.<br></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading23">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse23" aria-expanded="false" aria-controls="collapse23">
                            <p>¿Es necesario registrarme para realizar la compra?</p>
                        </button>
                    </h2>
                    <div id="collapse23" class="accordion-collapse collapse" aria-labelledby="heading23" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>No es necesario, puedes realizar la compra como invitado, pero si deseas que se guarden tus pedidos en tu ficha de cliente para poder verlos posteriormente, te recomendamos que te crees una cuenta.<br></p>
                        </div>
                    </div>
                </div>
        </div>            
    </div>
EOS;

require_once INCLUDES_ROOT . '/templates/default_template.php';

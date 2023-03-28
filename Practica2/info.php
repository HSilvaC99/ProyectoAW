<?php 
require_once __DIR__ . '/includes/config.php'; 

$title = 'Información'; 

$content = <<<EOS
<div class="m-5"> 
  <div class="m-5 "> 
    <h1 class="text-center">GASTOS DE ENVÍO</h1><br> 
    <table class="table table-striped"> 
      <thead class="table-dark"> 
        <tr> 
          <th>Destino</th> 
          <th>Tiempo de entrega</th> 
          <th>Gastos de envío</th> 
        </tr> 
      </thead> 
      <tbody> 
        <tr> 
          <td>España peninsular</td> 
          <td>Todos los pedidos<br>Independientemente del peso<br>Tiempo de entrega 24h (sin contar festivos, sábados y 
            domingos)<br>El 97% de los pedidos llegan en 24h, el 3% restante en 48h</td> 
          <td>5,95€ IVA Incluido</td> 
        </tr> 
        <tr> 
          <td>Islas Baleares</td> 
          <td>Todos los pedidos<br>Independientemente del peso<br>Tiempo de entrega de 1 a 3 días (Menorca e Ibiza 
            pueden tener un retraso de hasta 5 días laborables)</td> 
          <td>15,95€ IVA Incluido</td> 
        </tr> 
        <tr> 
          <td>Portugal</td> 
          <td>Todos los pedidos<br>Independientemente del peso<br>Tiempo de entrega de 1 a 2 días</td> 
          <td>5,95€ IVA Incluido</td> 
        </tr> 
        <tr> 
          <td>Resto de Europa<br>ALEMANIA, FRANCIA, AUSTRIA, BELGICA, DINAMARCA, ITALIA, LUXEMBURGO, PAISES BAJOS, 
            REPUBLICA CHECA, ESLOVAQUIA, ESLOVENIA, HUNGRIA, POLONIA.</td> 
          <td>Todos los pedidos<br>Independientemente del peso<br>Tiempo de entrega de 3 a 6 días<br>Gastos de envío 
            gratis a partir de 200€ para toda Europa</td> 
          <td>9,95€ IVA Incluido</td> 
        </tr> 
      </tbody> 
    </table> 
  </div> 
  <br> 
  <p>LOS GASTOS DE ENVÍO SON GRATIS A PARTIR DE 200€ DE COMPRA (para la Península de España y Europa)</p> 
  <ul> 
    <li>Se realizan envíos a toda la Peninsula, Baleares, Portugal y Europa de lunes a viernes (excepto fines de semana 
      y festivos). No se realizan envíos a Ceuta, Melilla y Canarias.</li> 
    <li>Enviamos a Baleares por la empresa de transportes GLS</li> 
    <li>Los gastos de devolución por cambio de producto o talla es de 10 euros</li> 
    <li>Los gastos de devolución por recogida de producto para su posterior devolución del importe 5.95 €</li> 
    <li>Los pedidos confirmados y pagados antes de las 16:30h serán enviados en el mismo día.</li> 
    <li>Todos los productos disponibles en la tienda los tenemos en stock físico y para enviar inmediatamente.</li> 
  </ul> 
  <br> 
  <hr class="border border-primary border-3 opacity-75"> 
  <h1 class="text-center">DEVOLUCION Y GARANTÍAS</h1><br> 

  <p>Zeus-Airsoft sólo acepta devoluciones por posibles defectos en el producto</p> 

  <p>No aceptamos devoluciones por malfuncionamiento de las réplicas debido a un mal uso,desgaste o de réplicas 
    abiertas,modificadas o manipuladas.El plazo de devolución de productos en tu web es de 14 días naturales desde la 
    recepción del producto, en tal caso si el motivo de la devolución no es de indole mayor se procederá a la devolución 
    del importe mediante un vale de compra en la tienda.</p> 

  <p>- Los gastos de devolución en el caso de cambio de producto o talla es de 10 €</p> 

  <p>Para hacer uso de la garantía será imprescindible, presentar la marcadora en su embalaje original con sus 
    complementos de origen.</p> 

  <p>El periodo de garantía para las réplicas será de 6 meses.Es muy importante para nosotros que el cliente no note la 
    diferencia entre comprar en una tienda física y comprar en una tienda online, esa es sin duda nuestra nuestra 
    prioridad y por ello ponemos especial atención a las devoluciones. 
    Despues de ese periodo habria que someter a mantenimiento a las réplicas pagando el coste del mantenimiento</p> 

  <p>- Las imagenes de los productos en la web pueden ser a veces ligeramente distintas y no corresponder al 100%, por 
    modificaciones del producto por parte del fabricante</p> 

  <p>-Las gafas Bolle o Pegaso una vez abiertas del precinto no se pueden devolver pues estan vienen cerradas y 
    precintadas y todos los clientes quieren que sean nuevas las gafas que les lleguen.</p> 

  <p>Si se debe realizar una devolución, se enviarár el producto tal y como se recibió, incluidos el embalaje original y 
    todos los accesorios. Antes de enviar el producto, es necesario ponerse en contacto con nosotros al siguiente email 
    info@Zeus-Airsoft.com para poder hablar sobre la devolución.</p> 
  <p>Una vez hablemos sobre el posible problema que pueda tener el producto, enviaremos un mensajero de MRW para la 
    recogida del producto.En el caso de que el producto este en mal estado y no sea culpa del cliente,Zeus-Airsoft 
    correrá con los gastos de envió de ida y vuelta.</p> 

  <p>- En el caso de comprar una réplica y querer devolver el pedido sin motivo alguno ( aunque pueda parecer poco 
    razonable esta situación nos ha ocurrido varias veces) el coste por todas las gestiones realizadas por Zeus-Airsoft 
    en el trámite de la réplica y su posterior coste de devolución de transporte será de 30 € .El proceso de probar , 
    hacer factura , probar el vuelo , probar el crono y embalar es un proceso que lleva bastante tiempo y dinero por 
    parte de nuestra tienda y debe de tenerse en cuenta y valorar nuestro trabajo. </p> 
  <p>En caso de ser replicas upgradeadas a peticion del cliente se cobrara el precio de volver a montar la replica de 
    serie, pues un upgrade o volver a poner una replica de serie es un proceso lento y minucioso que debe de ser 
    valorado.</p> 

  <p>En el caso que el producto enviado no tenga ningún malfuncionamiento, este manipulado o el síntoma no quede 
    cubierto por la garantía del producto, será el cliente el responsable de cubrir los gastos de devolución,la mano de 
    obra y piezas empleados para solventar el problema.</p> 

  <p>En caso de proceder a la devolución del dinero , se podrá elegir entre recibir el importe en cuenta o un vale para 
    comprar en la tienda . En caso de extrema gravedad o solvencia económica por parte de la tienda se procederá siempre 
    a la devolución del importe un en un vale de compra por valor del importe de la devolución.</p> 
  <p>En el caso de que el cliente compre un producto de ropa en el cual está especificada perfectamente la talla y se da 
    el caso que no le queda bien y quiere descambiarlo,Zeus-Airsoft se ofrecerá a descambiarlo sin ningún problema, pero 
    el cliente deberá correr con los gastos de envió de ida y vuelta</p> 

  <p>Las baterías Lipo tienen un periodo de garantía de 30 días, suficiente para comprobar que funcionan correctamente. 
  </p> 

  <p>Cancelación de Pedidos</p> 

  <p>Los pedidos podrán ser cancelados siempre y cuando el pedido no haya sido enviado desde nuestra instalaciones. Si 
    el pedido fue enviado el cliente deberà pagar los gastos de envío correspondientes, que rondarán entre 10 y 15 € 
    dependiendo del volumen y peso del pedido, pongase en contacto con nosotros y le indicaremos todos los pasos a 
    seguir.</p> 

  <p>Dirección y datos de la empresa:</p> 

  <p>Calle del Prof. José García Santesmases, 9,</p> 
  <p>Madrid 28040</p> 
  <p>Madrid</p> 
  <p>España</p> 
  <p>Telefono XXX-XXX-XXX</p> 

  <p>Dueño de la tienda Sergio Garcia Diez con NIF XXXXXXXXX</p> 
  <br> 
  <hr class="border border-primary border-3 opacity-75"> 
  <h1 class="text-center">INFORMACIÓN VENTA Y REGLAMENTO</h1><br> 
  <p>Debido a varias preguntas por parte los clientes, agregamos la siguiente información sobre la venta de réplicas en 
    nuestra tienda.</p> 

  <p>** Importante - Si se necesita comprar varias réplicas con nombres distintos, indicanoslo en el comentario del 
    pedido para que podamos hacer cada factura con el nombre y datos correspondientes.</p> 

  <p>¿Cómo enviamos los pedidos en Zeus-Airsoft y las réplica que nos compráis?</p> 

  <p>En nuestra empresa le damos un importancia muy grande a probar todas las réplicas antes de enviarlas para que el 
    cliente cuando le llegue pueda disfrutarla sin ningún tipo de problema:</p> 

  <p>1 - Cuando el cliente realiza el pago , revisamos visualmente la réplica en busca de imperfecciones tanto de 
    materiales como de pintura.</p> 

  <p>2 - Después de comprobar que visualmente está todo bien , pasamos a probar con batería la réplica, cadencia de 
    disparo y cronamos la réplica para ver que está dando los fps adecuados para cada tipo de réplica, en caso negativo 
    revisamos la réplica hasta dar con la solución.</p> 

  <p>3 - Una vez pasamos crono, probamos la réplica en nuestra galería de 36 metros para ver que el hop up funciona 
    perfectamente y la precisión y alcance son los adecuados, en caso negativo revisamos la réplica para dar con la 
    solución.</p> 

  <p>4 - Una vez esta todo comprobado, pasamos a realizar la factura de la réplica con su número correspondiente ( todas 
    las réplicas que vendemos tienen número de serie único del fabricante) </p> 

  <p>5 - Embalamos la réplica con papel de burbuja para que no sufra ningún daño en su transporte, la envolvemos para 
    una mayor seguridad y discreción en papel negro film y enviamos el pedido , el pedido para españa tardará por norma 
    general 24 horas , si se piden modificaciones puede llegar a tardar entre 1 y 3 días, en todo caso siempre 
    informamos en el proceso de compra o en los textos de los productos.</p> 

  <p>Este es todo el proceso que realizamos en nuestra tienda antes del envío de las réplicas que vendemos en 
    Zeus-Airsoft.</p> 

  <p>6 - Si el cliente cuando le llega la réplica nota un mal funcionamiento de la réplica o cualquier otra 
    irregularidad pedimos por favor que nos lo haga saber para poder resolverle el problema que tenga con la mayor 
    rapidez posible.</p> 

  <p>Reglamentos de Armas </p> 

  <p>En el siguiente link podreis ver todo el reglamento de Armas actual , para conocer todos los detalles:</p> 

  <p><a 
      href="https://www.boe.es/buscar/doc.php?id=BOE-A-1993-6202">https://www.boe.es/buscar/doc.php?id=BOE-A-1993-6202</a> 
  </p> 
  <br> 
  <hr class="border border-primary border-3 opacity-75"> 
  <h1 class="text-center">CONDICIONES Y FORMAS DE PAGO</h1><br> 
  <p> Todas las réplicas que vende Zeus-Airsoft tienen número de serie unico del fabricante 
    En caso de querer comprar una réplica la factura puede ir a nombre del menor siempre que se tenga más de 14 años, 
    aconsejamos que los padres nos llamen para resolver las dudas que puedan tener.</p> 
  <p>Formas de Pago Disponibles</p> 
  <p>En Zeus-Airsoft tenemos diferentes formas de pago, pago a plazos , paypal , transferencia bancaría y tarjeta de 
    credito: </p> 
  <h4>FINANCIACIÓN AL INSTANTE CON APLAZAME</h4> 
  <p>Nuevo sistema de financiación ¡¡ en tan 1 minuto!! Solo necesitas un número de teléfono móvil, un DNI Español y una 
    tarjeta, serás capaz de financiar tus compras en nuestra tienda con un máximo de 1000 euros y hasta en 36 meses. El 
    sistema de forma automática determinará si un cliente es apto o no para recibir la financiación, la empresa Aplázame 
    es quien decide si da la financiación, nuestra tienda no puedo decidir en este proceso. El coste de financiar una 
    compra será el siguiente comisión de apertura 0,00 €, TIN 22,11 %, 16,5% Tae </p> 
  <p>Pedido mínimo financiable - desde 99 € </p> 
  <p>Al solicitar el préstamo se te pedirá; realizar el pago de una entrada inicial. La cuantía de tu préstamo será el 
    importe de tu cesta menos esa entrada inicial. Ésa es la cantidad que financiaremos en el número de cuotas que 
    elijas. Por ejemplo, una financiación a 6 meses implicará 7 pagos, uno en el momento de la concesión del crédito y 6 
    pagos en cada uno de los 6 meses siguientes a la compra.</p> 
  <p>Los pagos se hacen con la tarjeta que aporte el cliente a Aplázame. 
  <p> 
  <p>- Los pedidos con este sistema pueden demorarse en enviar 1 día para verificar la operación</p> 
  <p>El SMS enviado por Aplázame para la tramitación de la solicitud de crédito no tiene ningún coste para ti.</p> 
  <p>- Ejemplo de financiación para una cesta de 1000 euros a 12 meses. Se pide una entrada de 85,63 euros que el 
    cliente pagará con su tarjeta en el momento de realizar la operación. El importe a financiar es la diferencia entre 
    el importe de la cesta y la entrada que hemos pagado 914,37 €. Se solicitarán 12 pagos mensuales de 85,63 €, 
    entonces el importe total que debemos será de 1027,56 €</p> 
  <h4>-TRANSFERENCIA BANCARIA</h4> 
  <p>Su pedido será enviado cuando sea confirmado el pago. Para agilizar el processo, envíe el comprobante por email: 
    info@Zeus-Airsoft.com</p> 
  <p>Datos para Transferencia Bancaria:</p> 
  <p>Sergio Garcia Diez</p> 
  <p>Banco: Cajamar</p> 
  <p>Cuenta Corriente: </p> 
  <p>Número (CAJAMAR): ES98 3058 5018 7927 2001 2204 </p> 
  <p>Codigo SWIFT O BIC : CCRIES2AXXX</p> 
  <h4>TARJETA CRÉDITO</h4> 
  <p>Una vez confirme la compra, será redirigido automáticamente a un servidor seguro HTTPS, donde podrá proceder al 
    pago, necesitará el numero de tarjeta, fecha de caducidad y numero de seguridad que se encuentra en la parte trasera 
    de su tarjeta.</p> 
  <h4>PAYPAL</h4> 
  <p>Pague su pedido con su cuenta de Paypal.Este método de pago tiene una comisión por parte de Paypal, antes de 
    finalizar el pedido puede revisar el importe de la comision, ya que lo calcula directamente el sistema y se lo 
    muestra antes de confirmar el mismo.</p> 
  <br> 
  <hr class="border border-primary border-3 opacity-75"> 

  <section id="politica"> 
    <h1 class="text-center">AVISO LEGAL Y POLITICA DE PRIVACIDAD ADAPTADO RGPD (Versión Mayo-18)</h1><br> 

    <p>En cumplimiento de la Ley 34/2002 de Servicios de la Sociedad de la Información y de Comercio Electrónico de 
      España, le informamos que esta página Web es propiedad de Sergio Garcia Diez y siguiendo los principios de 
      licitud, lealtad y transparencia, ponemos a su disposición la siguiente información sobre el tratamiento que 
      realizaremos de sus datos de carácter personal.</t> 

    <h4>¿QUIÉN ES EL RESPONSABLE DEL TRATAMIENTO DE SUS DATOS DE CARÁCTER PERSONAL?</h4> 

    <p>TITULAR WEB</p> 

    <p>Denominación social: Sergio Garcia Diez</p> 

    <p>NIF:XXXXXXXXX </p> 
    <p>Dirección de correo electrónico: info@Zeus-Airsoft.com</p> 

    <p>Domicilio social: Calle del Prof. José García Santesmases, 9, 28040 Madrid</p> 

    <p>La presente información regula las condiciones de uso, las limitaciones de responsabilidad y las obligaciones que 
      los usuarios de la página Web que se publica bajo el nombre del dominio <b>www.Zeus-Airsoft.com</b> las cuales los 
      usuarios asumen y se comprometen a respetar.</p> 

    <h4>¿CON QUÉ FINALIDAD TRATAMOS SUS DATOS?</h4> 

    <p>A través del presente Portal, únicamente tratamos los datos de carácter personal que nos facilita en el 
      formulario “Contacto y a través de la intranet”, exclusivamente con la finalidad de remitirle la información 
      solicitada y/o resolver las dudas o cuestiones que nos plantea; y, si así lo ha consentido expresamente, para 
      enviarle comunicaciones electrónicas relativas a nuestras actividades o servicios, boletines, etc.</p> 

    <h4>¿POR CUÁNTO TIEMPO LOS CONSERVAREMOS?</h4> 

    <p>Sus datos, serán conservados el tiempo mínimo necesario para satisfacer la finalidad para la cual los facilitó 
      así como para atender las responsabilidades que se pudieran derivar de los datos suministrados y de cualquier otra 
      exigencia legal.</p> 

    <p>Al respecto, consideramos que si no se opone al tratamiento de sus datos y/o no los cancela expresamente, 
      continúa interesado en seguir incorporado a nuestros tratamientos hasta que Zeus-Airsoft lo considere oportuno y 
      mientras sea adecuado a la finalidad para la que se obtuvieron.</p> 

    <h4>¿CUÁL ES LA LEGITIMACIÓN PARA EL TRATAMIENTO DE SUS DATOS?</h4> 

    <p>La base legal para el tratamiento de sus datos personales es el consentimiento que presta al aceptar esta 
      Política de Privacidad antes de enviarnos/ facilitarnos sus datos.</p> 

    <p>Los datos que le solicitamos son adecuados, pertinentes y estrictamente necesarios y en ningún caso está obligado 
      a facilitárnoslos, pero su no comunicación podrá afectar a la finalidad del servicio o la imposibilidad de 
      prestarlo.</p> 

    <h4>¿PODEMOS OBTENER SUS DATOS DE REDES SOCIALES, ESPACIOS WEB, REGISTRO MERCANTIL, GUIAS TELEFÓNICAS?</h4> 
    <p>Zeus-Airsoft está presente en distintas redes sociales que podrá ver en nuestro espacio web, con 
      la finalidad de informar sobre los servicios que ofrece, así como de cualquier otra actividad o 
      evento que se realice y se quiera dar publicidad, pero en ningún momento obtendrá de las mismas 
      datos personales de los usuarios que interactúen en ellas, a menos que haya autorización expresa. 

    <h4>¿PODEMOS CEDER SUS DATOS A TERCEROS?</h4> 
    <p>Zeus-Airsoft no comunicará sus datos a ningún tercero, salvo que se le informe de ello expresamente o exista 
      obligación legal.</p> 

    <h4>¿CUÁLES SON SUS DERECHOS CUANDO NOS LOS FACILITA?</h4> 
    <p>Los derechos de protección de datos de los que dispone como titular o interesado son:</p> 

    <p>· Derecho a solicitar el acceso a los datos personales relativos al interesado</p> 

    <p>· Derecho de rectificación</p> 

    <p>· Derecho de supresión</p> 

    <p>· Derecho de oposición</p> 

    <p>· Derecho a solicitar la limitación de su tratamiento</p> 

    <p>· Derecho a la portabilidad de los datos</p> 

    <p>Podrá ejercer sus derechos de protección de datos personales dirigiendo una comunicación por 
      escrito al domicilio social de Zeus-Airsoft o al correo electrónico habilitado a tal efecto, info@Zeus-Airsoft.com 
      incluyendo en ambos casos fotocopia de su DNI u otro documento de identificación equivalente.por escrito 
      al domicilio social de Zeus-Airsoft o al correo electrónico habilitado a tal efecto, info@Zeus-Airsoft.com 
      incluyendo 
      en ambos casos fotocopia de su DNI u otro documento de identificación equivalente.</p> 

    <h4>¿PUEDE RETIRAR SU CONSENTIMIENTO EN CUALQUIER MOMENTO?</h4> 
    <p>Usted tiene la posibilidad y el derecho a retirar el consentimiento para cualquiera finalidad específica 
      otorgada en su momento, sin que ello afecte a la licitud del tratamiento basado en el consentimiento previo 
      a su retirada.</p> 

    <h4>¿DÓNDE PUEDE RECLAMAR EN CASO DE CONSIDERAR QUE SUS DATOS NO SON TRATADOS ADECUADAMENTE?</h4> 
    <p>Si lo estima pertinente, puede dirigir sus reclamaciones al correo info@prevenfor.es o a la autoridad de 
      protección de datos que corresponda, siendo la AEPD la indicada en España, www.agpd.es</p> 

    <h4>¿QUÉ HACEMOS PARA GARANTIZAR LA SEGURIDAD Y CONFIDENCIALIDAD DE SUS DATOS?</h4> 
    <p>Con el objetivo de salvaguardar la seguridad de sus datos personales, le informamos que Zeus-Airsoft ha adoptado 
      todas las medidas de índole técnica y organizativa necesarias para garantizar la seguridad de los datos personales 
      suministrados. Todo ello para evitar su alteración, pérdida, y/o tratamientos o accesos no autorizados, tal como 
      exige la normativa, si bien la seguridad absoluta no existe. 

      Igualmente, Zeus-Airsoft le informa que todo nuestro personal, cualquiera que sea la fase del tratamiento en la 
      que intervenga, ha adoptado el compromiso de tratar sus datos con el máximo celo y confidencialidad. Le recordamos 
      que ni Zeus-Airsoft, ni cualquiera de sus empleados, cederá o comunicará sus datos a terceros, excepto en los 
      casos legalmente previstos, o salvo que usted lo autorice expresamente en su contrato de prestación de servicios. 

      Zeus-Airsoft puede alterar la presente política de privacidad para adaptarla a las modificaciones que se produzcan 
      en la página Web así como por los cambios legislativos sobre datos personales que vayan apareciendo y afecten a 
      dicha política. 

      Por ello, le recomendamos su lectura, cada vez que nos facilite sus datos a través de la Página Web.</p> 

    <h4>APLAZAME Financiación</h4> 

    <p> 
      El usuario acepta que todos sus datos de carácter personal sean íntegramente cedidos a Aplazame desde el momento 
      en que el usuario haya iniciado la contratación del servicio de pago aplazado ofrecido por ésta última en el 
      momento de elegir la forma de pago. 

      Esta aceptación se extiende a terceras entidades que tuvieran que acceder a los ficheros para el buen fin del 
      contrato.</p> 
  </section> 
  <br> 
  <hr class="border border-primary border-3 opacity-75"> 
  <section id="cookies"> 

    <h1 class="text-center">Uso de cookies-RGPD - Version Mayo-18</h1> <br> 
    <br> 
    <p><b>Esta página web utiliza tecnología “cookies” </b><br><br> 

      Descripción: Las cookies constituyen una herramienta empleada por los servidores Web para almacenar y recuperar 
      información acerca de sus visitantes. 
      No es más que un fichero de texto que algunos servidores piden a nuestro navegador que escriba en nuestro disco 
      duro, con información acerca de lo que hemos estado visitando por dichas páginas. <br><br> 

      Poseen una fecha de caducidad, que puede oscilar desde el tiempo que dure la sesión hasta una fecha futura 
      especificada, a partir de la cual dejan de ser operativas. <b>www.Zeus-Airsoft.com</b> utiliza cookies para 
      facilitar la navegación por dicho Portal y para obtener una mayor eficacia y personalización de los servicios 
      ofrecidos a los Usuarios. Las cookies empleadas en <b>www.Zeus-Airsoft.com</b> se asocian únicamente con un 
      Usuario anónimo y su ordenador, no proporcionan referencias que permitan deducir el nombre y apellidos del Usuario 
      y no pueden leer datos de su disco duro ni incluir virus en sus equipos. Asimismo, <b>www.Zeus-Airsoft.com</b> no 
      puede leer las cookies implantadas en el disco duro del Usuario desde otros servidores. <br><br> 

      El usuario puede libremente decidir acerca de la implantación o no en su disco duro de las cookies empleadas en 
      <b>www.Zeus-Airsoft.com</b> En este sentido, el usuario puede configurar su navegador para aceptar o rechazar por 
      defecto todas las cookies o para recibir un aviso en pantalla de la recepción de cada cookie y decidir en ese 
      momento su implantación o no en su disco duro. <br> 

      Para ello le sugerimos consultar la sección de ayuda de su navegador para saber cómo cambiar la configuración que 
      actualmente emplea. Aun cuando el Usuario configurase su navegador para rechazar todas las cookies o rechazase 
      expresamente las cookies de <b>www.Zeus-Airsoft.com</b> podrá navegar por el Portal con el único inconveniente de 
      no poder disfrutar de las funcionalidades del Portal que requieran la instalación de alguna de ellas. En cualquier 
      caso, el Usuario podrá eliminar las cookies de <b>www.Zeus-Airsoft.com</b> implantadas en su disco duro en 
      cualquier momento, siguiendo el procedimiento establecido en la sección de ayuda de su navegador. <br><br> 

      <b> ¿Qué tipos de cookies utiliza esta página web?</b> <br><br> 

      En primer lugar, esta página utiliza el servicio de análisis web “Google Analytics”, que utiliza cookies que nos 
      permiten cuantificar el número de usuarios y así realizar la medición y análisis estadístico de la utilización que 
      hacen los usuarios del servicio ofertado. Para ello se analiza su navegación en nuestra página web con el fin de 
      mejorar la oferta de productos o servicios que le ofrecemos. Si desea más información acerca del uso de las 
      cookies que realiza nuestro proveedor de servicios de análisis web visite su política de privacidad pulsando <b><a 
          href="https://policies.google.com/privacy?hl=es"> aquí</a></b> y <b><a 
          href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage?hl=es-419">aquí</a>.</b> 
      <br> 

      Por otro lado, este sitio web, utiliza cookies que son necesarias para prestar el servicio expresamente solicitado 
      por el usuario, en concreto, las que facilitan la cumplimentación de formularios. <br> 

      Deshabilitación y eliminación de cookies: <br> 

      Las cookies pueden desactivarse, basta con configurar su navegador de Internet para que las borre, las bloquee o 
      le avise en caso de instalación de las mismas. No obstante, si usted selecciona esta configuración puede que no 
      tenga acceso a ciertas partes del sitio web, causar una navegación menos eficaz o no sacar partido a determinadas 
      funcionalidades. <br> 

      Para continuar sin cambios en la configuración de las cookies, simplemente continúe en la página web. <br> 
      Para más información acerca de cómo deshabilitar las cookies consulte los siguientes enlaces: <br> 

      Chrome: pulse <b><a href="https://support.google.com/accounts/answer/61416?hl=es">aquí</a>.</b> <br> 
      Internet Explorer: pulse <b><a 
          href="https://support.microsoft.com/es-es/windows/eliminar-y-administrar-cookies-168dab11-0753-043d-7c16-ede5947fc64d">aquí</a>.</b> 
      <br> 
      Firefox: pulse <b><a 
          href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias?redirectslug=habilitar-y-deshabilitar-cookies-que-los-sitios-we&redirectlocale=es"> 
          aquí</a>.</b> <br> 
      Safari: pulse <b><a href="https://support.apple.com/es-es/HT201265">aquí</a>.</b> <br> 
      Opera: pulse <b><a href="https://help.opera.com/en/latest/web-preferences/#cookies">aquí</a>.</b> 
    </p> 
  </section> 
  <br> 
  <hr class="border border-primary border-3 opacity-75"> 
  <section id="condiciones"> 
    <h1 class="text-center">Terminos y Condiciones</h1><br> 
    <p> <u> 
        <h4> 1. Información general y datos de contacto</h4> 
      </u> <br> 

      <b>Denominación social: Sergio Garcia Diez </b> <br> 

      <b> NIF:XXXXXXXXX</b> <br> 

      <b> Dirección de correo electrónico: info@Zeus-Airsoft.com </b> <br> 

      <b> Domicilio social: Calle del Prof. José García Santesmases, 9, 28040 Madrid </b> <br><br> 

      <u> 
        <h4> 2. Objeto y aceptación</h4> 
      </u> <br> 

      2.1. Este texto (en adelante, las "Condiciones Generales") regula el uso de los contenidos y la contratación de 
      servicios que ofrecemos desde Zeus-Airsoft a través de nuestro Sitio Web, por lo que cuando accede al mismo como 
      visitante, usuario o cliente (en adelante, el "Usuario") queda automáticamente vinculado al cumplimiento de estas 
      Condiciones Generales, lo que supone e implica que ha leído, comprende y acepta, sin limitaciones ni reservas, los 
      avisos legales disponibles en el Sitio Web, incluido el texto de la Política de Privacidad de Compatinet, por lo 
      que le recomendamos que los lea siempre que acceda a nuestro Sitio Web. <br> 

      2.2. Desde Zeus-Airsoft nos reservamos el derecho a modificar estas Condiciones Generales en cualquier momento, 
      por lo que el texto puede haber sufrido modificaciones cuando vuelva a acceder al Sitio Web. Estas Condiciones 
      Generales, así como cualquier otro aviso legal y las modificaciones de los mismos, son plenamente vigentes a 
      partir de su publicación en el Sitio Web, por lo que como Usuario le damos la posibilidad de imprimirlos y 
      almacenarlos. <br> <br> 

      <u> 
        <h4> 3. Privacidad y proteccion de datos personales</h4> 
      </u><br> 

      3.1. En Zeus-Airsoft respetamos la privacidad de sus datos personales, por lo que le sugerimos que lea el texto de 
      nuestra Politica de Privacidad para que entienda nuestras practicas de privacidad y proteccion de datos 
      personales. Le informamos como Usuario que dicho aviso legal queda incluido por referencia en estas Condiciones 
      Generales, de las que forma parte. <br><br> 

      <u> 
        <h4> 4. Descripcion y condiciones de los servicios </h4> 
      </u><br> 

      4.1. Todos los productos y servicios que le ofrecemos desde Compatinet a traves de nuestro Sitio Web 
      www.Zeus-Airsoft.com estan descritos en la pagina Web correspondiente a cada uno de los servicios, en la que 
      incluimos como minimo la informacion esencial sobre el servicio y caracteristicas del producto, para que conozca 
      en que consiste. <br><br> 

      <u> 
        <h4> 6. Precios y formas de pago aceptadas</h4> 
      </u> <br> 

      6.1. El precio de los articulos y servicios ofrecidos por Zeus-Airsoft a través del Sitio Web figura siempre en la 
      página Web de descripción correspondiente a cada uno de los servicios. Todos los precios indicados en el Sitio Web 
      incluyen los impuestos aplicables, por lo que son precios finales. <br> 

      6.2. En Zeus-Airsoft aceptamos como formas de pago tanto la transferencia o ingreso en cuenta de BBVA, como el 
      pago mediante tarjeta de débito y paypal <br><br> 

      <u> 
        <h4> 7. Contenidos y licencia limitada de propiedad intelectual e industrial</h4> 
      </u><br> 

      7.1. Los contenidos disponibles a través de nuestro Sitio Web, tales como textos, logotipos, imágenes, bases de 
      datos, software o código fuente, a título meramente enunciativo, son propiedad de Zeus-Airsoft o, en su caso, de 
      las personas o empresas que figuren como autores o titulares, tales como osCommerce, por lo que cualquier 
      violacion de los citados derechos de propiedad intelectual e industrial será perseguida en aplicación de la 
      normativa vigente. <br> 

      7.2. Como Usuario de nuestro Sitio Web le concedemos una licencia limitada, revocable y no exclusiva, para acceder 
      a éste, su consulta y uso responsable, a título personal, no estando autorizado para reproducir, explotar, 
      alterar, distribuir o comunicar públicamente a través de ningún medio la totalidad o parte de los contenidos 
      disponibles en nuestro Sitio Web para usos diferentes a la obtención de información o contratación de los 
      servicios que ofrecemos, no estando autorizado tampoco para descargar el Sitio Web o sus contenidos (excepto en la 
      memoria "cache" del equipo que utilice) a través del uso de robots, arañas, rastreadores, o herramientas similares 
      de extracción de datos que conlleven una sobrecarga injustificada del tráfico en nuestros servidores, con el 
      consiguiente perjuicio para el resto de los Usuarios, o instrumentos que dañen o inutilicen nuestras 
      infraestructuras o, en su caso, las de terceros. <br> <br> 

      <u> 
        <h4> 8. Nulidad e ineficacia </h4> 
      </u><br> 

      8.1. Desde Zeus-Airsoft le informamos como Usuario que en el supuesto de que alguna de las cláusulas de estas 
      Condiciones Generales fuese declarada nula o ineficaz por un Juzgado, Tribunal u órgano administrativo competente, 
      la nulidad o ineficacia afectará únicamente a dicha cláusula o a la parte de la misma que resulte nula o ineficaz, 
      que se tendrá por no puesta de manera total o parcial, subsistiendo las Condiciones Generales en todo lo demás. 
      <br><br> 

      <u> 
        <h4> 9. Normativa aplicable </h4> 
      </u><br> 

      9.1. Estas Condiciones Generales están sujetas a lo dispuesto en la Ley 7/1998, de 13 de abril, sobre condiciones 
      generales de la contratación, en la Ley 26/1984, de 19 de julio, general para la defensa de los consumidores y 
      usuarios, en el Real Decreto 1906/1999, de 17 de diciembre de 1999, por el que se regula la contratación 
      telefónica o electrónica con condiciones generales, en la Ley Orgónica 15/1999, de 13 de diciembre, de protección 
      de datos de carácter personal, en la Ley 7/1996, de 15 de enero, de ordenación del comercio minorista, en la Ley 
      34/2002 de 11 de julio, de servicios de la sociedad de la informacion y de comercio electrónico, y en la reciente 
      Ley 44/2006, de 29 de diciembre, de mejora de la protección de los consumidores y usuarios, así como a lo 
      dispuesto en el resto de normativa relacionada que pueda resultar de aplicación análoga en su caso. <br><br> 

      <u> 
        <h4> 10. Legislación aplicable y jurisdicción competente</h4> 
      </u><br> 

      10.1. Desde Zeus-Airsoft le informamos como Usuario que estas Condiciones Generales del Sitio Web, así como las 
      relaciones que se establezcan entre nosotros como partes, se regirán por lo dispuesto en la legislación española, 
      que será de aplicación a las mismas. <br> 

      10.2. Asimismo, para la resolución de cualquier controversia o reclamación derivada de la interpretación de estas 
      Condiciones Generales serán competentes los Juzgados y Tribunales de donde sea puesta la demanda. <br><br> 
    </p> 
  </section> 
</div> 
EOS; 

require __DIR__ . '/includes/template/template.php'; 
?>
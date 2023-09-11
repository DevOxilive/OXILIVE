<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../templates/header.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Preguntas frecuentes a OXILIVE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>index.php">Inicio</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section faq">
    <div class="row">
      <div class="col-lg-6">

        <div class="card basic">
          <div class="card-body">
            <h5 class="card-title">Preguntas básicas</h5>

            <div>
              <h6>1. ¿Cuáles son nuestros horarios?</h6>
              <p>Oxilive cuenta con servicio de 24 horas durante los 365 días del año.</p>
            </div>

            <div class="pt-2">
              <h6>2. ¿Cuándo recibire mi equipo médico solicitado?</h6>
              <p>La repartición de equipos solicitados y/o productos, se basa en la solicitud que el mismo cliente nos
                proporciona. Dando nosotros un rango aproximado de las horas en que podrá llegar.</p>
            </div>

            <div class="pt-2">
              <h6>3. ¿Cuánto debo pagar por mi equipo?</h6>
              <p>Los equipos médicos son solicitados y cotizados únicamente por el cliente y el coordinador de oxígeno.
              </p>
            </div>

          </div>
        </div>

        <!-- F.A.Q Group 1 -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Política de privacidad</h5>

            <div class="accordion accordion-flush" id="faq-group-1">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsOne-1" type="button"
                    data-bs-toggle="collapse">
                    ¿Con qué fines utilizaremos su datos personales?
                  </button>
                </h2>
                <div id="faqsOne-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                  <div class="accordion-body" style="text-align: justify;">
                    Los datos personales que recabamos sobre usted son necesarios para verificar y confirmar su
                    identidad; administrar y operar los servicios que se le presten y comercializar los productos que
                    solicita o contrata con nosotros, y para cumplir con las obligaciones derivadas de dicha
                    comercialización y prestación de servicios, finalidades que son necesarias para el servicio que se
                    solicita siendo primarias y secundarias. Finalidades Primarias: serán aquellas que son necesarias
                    para la relación Jurídica entre Oxilive y usted: Identificarlo; Proporcionarle la información que
                    usted solicite acerca de nuestros servicios; Brindarle el servicio médico que solicite en tiempo y
                    lugar; Asesoría médica presencial o en línea; Creación, estudio, análisis y conservación de su
                    expediente clínico electrónico; Conservación de registro para seguimiento a servicios en un futuro;
                    Asistencia, telefónica y en línea; Emisión de factura fiscal correspondiente a los servicios
                    adquiridos; Seguimiento de reclamaciones y reembolso; Cumplimiento Normativo. Finalidades
                    Secundarias: serán aquellos datos que adicionalmente utilizaremos para finalidades distintas y que
                    no dan origen a la relación jurídica entre usted y Oxilive, pero son de importancia para el servicio
                    solicitado: Realizar encuestas de calidad de servicio; Ofrecimiento de productos y nuevos servicios
                    a través de correo electrónico y vía telefónica; Contacto telefónico para conocer su opinión de
                    nuestros servicios; Llevar a cabo ofertas y promociones; Información de los productos y servicios de
                    Oxilive; Con fines publicitarios y comerciales.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsOne-2" type="button"
                    data-bs-toggle="collapse">
                    Negativa al uso de los datos personales para finalidades secundarias
                  </button>
                </h2>
                <div id="faqsOne-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                  <div class="accordion-body" style="text-align: justify;">
                    En caso de que no desee que sus datos personales sean tratados para finalidades secundarias
                    adicionales arriba descritas llene el formato correspondiente, debiendo enviarlo al correo
                    electrónico contacto@oxilive.com.mx, en caso de que usted acuda a nuestras oficinas en el domicilio
                    arriba señalado, puede presentar desde este momento un escrito, manifestando lo anterior, o bien
                    solicitar el formato correspondiente al área de Marketing.

                    Cuando obtengamos los datos personales de manera indirecta, usted contará con un plazo de 5 (cinco)
                    días hábiles para que, de ser el caso, manifieste su negativa en la finalidad secundaria. En caso de
                    no realizarlo, se entenderá que consiente en el tratamiento de los datos personales para dichas
                    finalidades.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsOne-3" type="button"
                    data-bs-toggle="collapse">
                    Datos personales con los que Oxilive puede recabar sobre usted
                  </button>
                </h2>
                <div id="faqsOne-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                  <div class="accordion-body" style="text-align: justify;">
                    Para llevar a cabo las finalidades descritas en el presente Aviso de Privacidad, Oxilive podrá
                    recabar y, en su caso, tratar los datos personales que a continuación se especifican: nombre
                    completo, copia de identificación oficial con fotografía (pasaporte, credencial de elector, cédula
                    profesional, licencia, cartilla); edad; fecha de nacimiento, copia del acta de nacimiento,
                    domicilio, copia de comprobante de domicilio (recibos de luz, teléfono, agua, predial), copia de pre
                    cartilla o cartilla militar liberada, estado civil; datos académicos, copia del acta de matrimonio,
                    copia de documentos migratorio, correo electrónico, teléfono particular, del trabajo, particular,
                    celular, copia del registro de contribuyentes (RFC), copia de la Clave única de registro poblacional
                    (CURP).
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsOne-4" type="button"
                    data-bs-toggle="collapse">
                    Datos personales sensibles con lo que Oxílive puede recabar sobre usted
                  </button>
                </h2>
                <div id="faqsOne-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                  <div class="accordion-body" style="text-align: justify;">
                    Además de los datos personales mencionados anteriormente para las finalidades informadas en el
                    presente Aviso de Privacidad; utilizaremos los siguientes datos personales considerado como
                    sensibles que requiere de especial protección: Estado de salud para efectos de prevención y
                    diagnóstico médico, prestación de asistencia sanitaria, alergias, medicamento que se ministra al
                    momento de solicitar un servicio de Oxilive, datos de Póliza de Gastos Médicos.

                    Estos datos sensibles serán tratados bajo estrictas medidas de seguridad que garanticen su
                    confidencialidad, únicamente para dar cumplimiento a las finalidades mencionadas en el presente
                    Aviso de Privacidad, y realizando esfuerzos razonables a efecto de que el periodo de tratamiento de
                    los mismo sea el mismo indispensable.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsOne-5" type="button"
                    data-bs-toggle="collapse">
                    Datos personales sensibles con lo que Oxílive puede recabar sobre usted
                  </button>
                </h2>
                <div id="faqsOne-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                  <div class="accordion-body" style="text-align: justify;">
                    Además de los datos personales mencionados anteriormente para las finalidades informadas en el
                    presente Aviso de Privacidad; utilizaremos los siguientes datos personales considerado como
                    sensibles que requiere de especial protección: Estado de salud para efectos de prevención y
                    diagnóstico médico, prestación de asistencia sanitaria, alergias, medicamento que se ministra al
                    momento de solicitar un servicio de Oxilive, datos de Póliza de Gastos Médicos.

                    Estos datos sensibles serán tratados bajo estrictas medidas de seguridad que garanticen su
                    confidencialidad, únicamente para dar cumplimiento a las finalidades mencionadas en el presente
                    Aviso de Privacidad, y realizando esfuerzos razonables a efecto de que el periodo de tratamiento de
                    los mismo sea el mismo indispensable>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div><!-- End F.A.Q Group 1 -->

      </div>

      <div class="col-lg-6">

        <!-- F.A.Q Group 2 -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sobre nuestros productos</h5>

            <div class="accordion accordion-flush" id="faq-group-2">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsTwo-1" type="button"
                    data-bs-toggle="collapse">
                    ¿Qué capacidades de tanques manejamos?
                  </button>
                </h2>
                <div id="faqsTwo-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                  <div class="accordion-body">
                    Los tanques que tenemos son de 10,000 L y de 9,500 L.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsTwo-2" type="button"
                    data-bs-toggle="collapse">
                    ¿Son confiables nuestros productos?
                  </button>
                </h2>
                <div id="faqsTwo-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                  <div class="accordion-body">
                    Nuestros productos son altamente evaluados y aprobados para su venta.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsTwo-3" type="button"
                    data-bs-toggle="collapse">
                    ¿Qué son los planes mensuales?
                  </button>
                </h2>
                <div id="faqsTwo-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                  <div class="accordion-body">
                    Adquiere uno de nuestros Planes Oxilive y recibe hasta tu domicilio con entrega Full (24 horas).
                    Para más información visita <a href="https://oxilive.com.mx/index.php/tanques-de-oxigeno/">Planes
                      Mensuales Oxilive</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End F.A.Q Group 2 -->

        <!-- F.A.Q Group 3 -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sobre nosotros</h5>

            <div class="accordion accordion-flush" id="faq-group-3">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-target="#faqsThree-1" type="button"
                    data-bs-toggle="collapse">
                    ¿Dónde estamos ubicados?
                  </button>
                </h2>
                <div id="faqsThree-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                  <div class="accordion-body">
                    OXILIVE, tiene domicilio vigente en calle Villa Guerrero número 227, colonia Sección las Fuentes,
                    Ciudad Nezahualcóyotl C.P 576000
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1881.652549146822!2d-99.03182232702254!3d19.399219297516787!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fce78dade241%3A0xc2df46ec959345d1!2sVilla%20Guerrero%20227%2C%20Atlacomulco%2C%2057600%20Nezahualc%C3%B3yotl%2C%20M%C3%A9x.%2C%20M%C3%A9xico!5e0!3m2!1ses!2sus!4v1691502258021!5m2!1ses!2sus"
                      width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Group 3 -->

      </div>

    </div>
  </section>

</main><!-- End #main -->

</html>
<?php
include("../../templates/footer.php");
?>
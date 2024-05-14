<x-guest-Layout>

<div class="">

    <nav class="navbar bg-body-tertiary nvar-panel">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('images/logo-nikken.png')}}" alt="NIKKEN">
            </a>        
            {{--<form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form>--}}
        </div>
    </nav>

    <div class="w-100 bg-secondary div-form">
        <div class="container bg-light">
            <div class="row py-5 px-5">

                <form action="#">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cupón:</label>
                        <input type="text" class="form-control w-50" id="cupon">                    
                    </div>                
                    <button type="button" class="btn btn-primary" onclick="searchCoupon()">Búscar</button>
                </form>
                
            </div>

        </div>
        <div class="container bg-light">
            <div class="row py-2 px-5">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#Código</th>
                        <th scope="col">First</th>                        
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--<tr>
                            <th scope="row">1</th>
                            <td>Mark</td>                        
                            <td><button type="button" class="btn btn-primary">Activar</button></td>
                        </tr>--}}
                        
                    </tbody>
                </table>
                
                
            </div>

        </div>
    </div>

</div>


@push('scripts')
<script>

    function searchCoupon(){
        $coupon = $("#cupon").val();
        if($coupon != ''){

            var url = '{{ route("panel.search") }}';
            axios.post(url, {
                'coupon': $coupon,
            }).then(response => {
                                //$(".searchPharmacy").removeAttr('disabled').html("VIEW PRICES");
                                //console.log(response);
                if (response.data.success) {

                    response.data.data.forEach(function(item) {
                        var fila = `<tr>
                                        <th scope="row">${item.codigoCupon}</th>
                                        <td>${item.email}</td>
                                        <td><button type="button" class="btn btn-primary">Activar</button></td>
                                    </tr>`;
                        $('.table tbody').append(fila);
                    });

                                
                }else{

                    // const inputOptions = new Promise((resolve) => {
                    //     setTimeout(() => {
                    //     resolve({
                    //         "Si": "Si",
                    //         "No": "No"            
                    //     });
                    //     }, 1000);
                    // });

                    // Swal.fire({
                    //     title: "<strong>Atención</strong>",
                    //     icon: "question",
                    //     html: "¿Ya realizó el proceso de registro ante la Dirección General Aduanas (SIGARD)?",
                    //     input: "radio",
                    //     inputOptions,
                    //     showCloseButton: false,
                    //     showCancelButton: false,
                    //     focusConfirm: false,
                    //     confirmButtonText: 'Continuar',
                    //     confirmButtonAriaLabel: "Thumbs up, great!",
                    //     allowOutsideClick: false,
                    //     allowEscapeKey: false,
                    //     allowEnterKey: false,
                    //     inputValidator: (value) => {
                    //         if (!value) {
                    //         return "¡Necesitas seleccionar una opción!";
                    //         }
                    //     }
                    // }).then((result) => {
                    //     // El resultado contendrá el valor seleccionado por el usuario
                    //     if (result.isConfirmed) {
                    //         const selectedOption = result.value;
                    //         //console.log("El usuario seleccionó:", selectedOption);
                    //         if(selectedOption == "No"){

                    //             var nuevaVentana = window.open("https://www.aduanas.gob.do/de-interes/iframes-consultas/registro-courier/", "_blank", "width=500,height=500");
                    //             //$(".alert-sigard").removeClass("d-none");
                    //             $("#modalSIGARD").modal("show");

                    //             // Verificar si la ventana secundaria se cierra cada segundo
                    //             var interval = setInterval(function() {
                    //                 if (nuevaVentana.closed) {
                    //                     ventanaSecundariaCerrada();
                    //                     clearInterval(interval); // Detener el temporizador cuando la ventana se cierra
                    //                 }
                    //             }, 1000);

                    //         }else{
                    //             $("#sigard1").prop('checked', true);
                    //             $("#sigard1").attr("disabled","true");
                    //             $("#sigard2").attr("disabled","true");
                    //         }            
                    //         // Aquí puedes realizar las acciones necesarias con la opción seleccionada
                    //     }
                    // });
    

                }
                                

            }).catch(error => {
                                //console.log("ssd");
                            
            });

        }
        
    }

</script>
@endpush



</x-guest-Layout>
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
        <div class="container bg-light mt-4">
            <div class="row py-5 px-5">

                <form action="#">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email:</label>
                        <input type="text" class="form-control w-50" id="email">                    
                    </div>                
                    <button type="button" class="btn" onclick="searchCoupon()">Búscar</button>
                </form>
                
            </div>

        </div>
        <div class="container bg-light">
            <div class="row py-2 px-5">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#Código</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Email</th>                        
                        <th scope="col">Estatus</th> 
                        <th scope="col">Recuperar</th>                        
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
        $email = $("#email").val();
        //alert($email);
        $('.table tbody').empty();
        if($email != ''){

            var url = '{{ route("panel.search") }}';
            var emailAgent = '{{$email}}';
            axios.post(url, {
                'email': $email,
                'agentEmail': emailAgent,                
            }).then(response => {
                                //$(".searchPharmacy").removeAttr('disabled').html("VIEW PRICES");
                                //console.log(response);
                if (response.data.success) {

                    response.data.data.forEach(function(item) {
                        var fila = '';
                        if(item.redimido >= 1){
                            $recuperar = 0;
                            if(item.redimido == 1){
                                $recuperar = 1;
                            }else if(item.redimido == 2){
                                $recuperar = 2;
                            }else if(item.redimido == 3){
                                $recuperar = 3;
                            }

                            var tipo = "";                            
                            if(item.tipo_u == "CLIENTE"){
                                tipo = "UBI";
                            }else if(item.tipo_u == "CI"){
                                tipo = "4x4";
                            }

                            fila = `<tr>
                                        <th scope="row">${item.codigoCupon}</th>
                                        <td>${tipo}</td>
                                        <td>${item.email}</td>
                                        <td>Redimido ${item.redimido} veces</td>
                                        <td>
                                            <span class="d-block">Puedes regerenar hasta ${$recuperar} redimidos</span>
                                            <input type="number" id="reactivar" value="1" min="1" max="${$recuperar}"/>
                                        </td>
                                        <td><button type="button" class="btn" onclick='activateCoupon("${item.codigoCupon}","${item.email}",${$recuperar})'>Activar</button></td>
                                    </tr>`;

                        }else{

                            var tipo = "";                            
                            if(item.tipo_u == "CLIENTE"){
                                tipo = "UBI";
                            }else if(item.tipo_u == "CI"){
                                tipo = "4x4";
                            }

                            fila = `<tr>
                                        <th scope="row">${item.codigoCupon}</th>
                                        <td>${tipo}</td>
                                        <td>${item.email}</td>
                                        <td>No redimido</td>
                                        <td></td>
                                        <td><button type="button" class="btn" disabled>Activar</button></td>
                                    </tr>`;

                        }
                        
                        $('.table tbody').append(fila);
                    });

                                
                }else{

                    
                    Swal.fire({
                        title: "<strong>Atención</strong>",
                        icon: "error",
                        html: "No se encontró el cupón.",                                        
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Continuar',                        
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,                        
                    });
    

                }
                                

            }).catch(error => {
                Swal.fire({
                        title: "<strong>Atención</strong>",
                        icon: "error",
                        html: "No se encontró el cupón.",                                        
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Continuar',                        
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,                        
                    });
                            
            });

        }else{
            $('#cupon').focus();

                    Swal.fire({
                        title: "<strong>Atención</strong>",
                        icon: "warning",
                        html: "Debe ingresar el cupón",                                        
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Continuar',                        
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,                        
                    });
                    
                    
        }
        
    }

    function activateCoupon($codigo,$email,$redimido){
            //alert($.trim($codigo));
            var url = '{{ route("panel.update") }}';
            var agentEmail = '{{$email}}';
            axios.post(url, {
                'coupon': $.trim($codigo),
                'agentEmail': $.trim(agentEmail),
                'userEmail': $email,
                'redimido': $redimido,
                'reactivar': $("#reactivar").val(),
            }).then(response => {
                                //$(".searchPharmacy").removeAttr('disabled').html("VIEW PRICES");
                                //console.log(response);
                if (response.data.success) {

                    Swal.fire({
                        title: "<strong>¡Felicidades!</strong>",
                        icon: "success",
                        html: "El código se ha redimido.",                                        
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Continuar',                        
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,                        
                    });
                                
                }else{

                    
                    Swal.fire({
                        title: "<strong>Atención</strong>",
                        icon: "error",
                        html: "Hubo un problema al activar el cupón, intentalo más tarde.",                                        
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Continuar',                        
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,                        
                    });

                }
                                

            }).catch(error => {
                Swal.fire({
                        title: "<strong>Atención</strong>",
                        icon: "error",
                        html: "Hubo un problema para buscar el cupón, intentalo más tarde.",                                        
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Continuar',                        
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,                        
                    });
                            
            });
        
    }

</script>
@endpush



</x-guest-Layout>
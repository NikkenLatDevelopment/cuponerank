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
                        <th scope="col">#</th>
                        <th scope="col">First</th>                        
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>                        
                            <td><button type="button" class="btn btn-primary">Activar</button></td>
                        </tr>
                        
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
                                
                }
                                

            }).catch(error => {
                                //console.log("ssd");
                            
            });

        }
        
    }

</script>
@endpush



</x-guest-Layout>
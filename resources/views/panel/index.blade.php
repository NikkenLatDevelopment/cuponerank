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

    <div class="w-100 bg-secondary">
        <div class="container bg-light">
            <div class="row py-5">

                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cupón:</label>
                        <input type="text" class="form-control w-50" id="cupon">                    
                    </div>                
                    <button type="submit" class="btn btn-primary">Búscar</button>
                </form>
                
            </div>

        </div>
        <div class="container bg-light">
            <div class="row py-2">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
                
                
            </div>

        </div>
    </div>

</div>



</x-guest-Layout>
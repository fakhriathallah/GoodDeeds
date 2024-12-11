@extends('template')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Done Deeds</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Prizes</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Owner</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $totalPrizes = 0;
                    @endphp
                    @foreach($deeds as $deed)
                      @php
                        $totalPrizes = $totalPrizes + $deed->prize;
                      @endphp  
                      <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm font-bold">{{$deed->title}}</h6>
                            </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs text-secondary mb-0">{{$deed->description}}</p>
                        </td>
                        <td>
                            <h6 class="text-sm mb-0 font-bold">Rp. {{$deed->prize}}</h6>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-success">{{$deed->status}}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{$deed->owner->name}}</span>
                        </td>
                        <td class="align-middle">
                        </td>    
                      </tr>
                    @endforeach
                    <tr>
                      <td>

                      </td>
                      <td class="align-end text-right">
                        <p class="text-bold">Total Prizes</p>
                      </td>
                      <td>
                        <p class="text-bold">Rp. {{$totalPrizes;}}</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            {{ $deeds->links() }}
          </div>
        </div>
      </div>
</main>
@endsection

<x-layout-dashboard title="Auto Replies">
  
    <div class="app-content">
        <link href="{{asset('plugins/datatables/datatables.min.css')}}" rel="stylesheet">
        <link href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet">
        <link href="{{asset('css/custom.css')}}" rel="stylesheet">
        <div class="content-wrapper">
            <div class="container">
                @if (session()->has('alert'))
                <x-alert>
                    @slot('type',session('alert')['type'])
                    @slot('msg',session('alert')['msg'])
                </x-alert>
             @endif
             @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
               
           
                
    
<div class="row mt-4">
  <div class="col">
      <div class="card">
          <div class="card-header d-flex justify-content-between">
          <h5 class="card-title">Histórico de Campanhas</h5>

          <div class="d-flex">
          
            <form action="{{route('campaigns.delete.all')}}" method="POST">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">Deletar Todas</button>
            </form>
          </div>
             
          </div>
          <div class="card-body">
              <table id="datatable1" class="display" style="width:100%">
                  <thead>
                      <tr>
                          <th>N.° Whatsapp</th>
                          <th>Nome</th>
                            <th>Tipo</th>
                            <th>Receptor</th>
                            <th>Mensagem</th>
                            <th>Agendamento</th>
                          <th>Status</th>
                          {{-- <th class="d-flex justify-content-center">Ação</th> --}}
                      </tr>
                  </thead>
                  <tbody>
                     @foreach ($campaigns as $campaign)
                         
                     <tr>
                            <td>{{$campaign->sender}}</td>
                            <td>{{$campaign->name}}</td>
                            <td><span class="badge badge-secondary badge-sm text-warning">{{$campaign->type}}</span></td>
                            <td>
                                {{$campaign->blasts_count}} <span class="badge badge-primary">total</span>
                                <br>
                                {{$campaign->blasts_success}} <span class="badge badge-success">Sucesso(s)</span>
                                <br>
                                {{$campaign->blasts_failed}} <span class="badge badge-danger">Falha(s)</span>
                                <br>
                                {{$campaign->blasts_pending}} <span class="badge badge-warning">Alerta(s)</span>
                                {{-- button view blasts list --}}
                                <br>
                                <a href="{{route('blastHistories',$campaign->id)}}" class="btn btn-primary btn-sm">Ver todos</a>
                            </td>
                             <td><button class="btn btn-primary" onclick="viewCampaignMessage({{$campaign->id}})">Ver</button></td>
                                       
                            <td>{{$campaign->schedule ?? '-'}}</td>
                            <td >
                                {{-- if status success badge success, if waiting badge warning if failed badge danger --}}
                                <span class="badge badge-{{$campaign->status === 'executed' ? 'success' : 'danger'}}">{{$campaign->status}}</span>
                                  </td>
                                
                            {{-- <td class="d-flex justify-content-center">
                                <a href="{{route('editBlast',$campaign->id)}}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{route('deleteBlast',$campaign->id)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                </form>
                            </td> --}}
                      </tr>
                      @endforeach
                    

                  </tbody>
                  <tfoot></tfoot>
              </table>
          </div>
      </div>
  </div>

</div>



    
            </div>
        </div>
    </div>
<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pré-visualização</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body previewCampaignMessage">
                 </div>
        </div>
    </div>
</div>


    <script src="{{asset('js/pages/datatables.js')}}"></script>
    <script src="{{asset('js/pages/select2.js')}}"></script>
    <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{asset('js/autoreply.js')}}"></script>
  <script>
    function viewCampaignMessage(id) {
    $.ajax({
        url: `/campaign/show/${id}`,
        type: 'GET',
        dataType: 'html',
        success: (result) => {

            $('.previewCampaignMessage').html(result);
            $('#modalView').modal('show')
        },
        error: (error) => {
            console.log(error);
        }
    })
    // 
}

  </script>
</x-layout-dashboard>





